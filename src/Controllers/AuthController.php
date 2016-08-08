<?php

namespace App\Controllers;
use App\Models\User;

class AuthController extends Controller {
	
	function index ($request, $response, $args) {
		$user = User::take(2)->first();
		// Render index view
		return $this->render($response, 'index.phtml', compact('user'));
	}
	
    /**
     * Redirect the user to the Google authentication page.
     */
	function login ($request, $response, $args) {
		$auth = $this->getApp()->getContainer()->auth;

		return $response->withRedirect($auth->createAuthUrl()  );
	}
	

    /**
     * Obtain the user information from Google.
     */
	function auth ($request, $response, $args) {
		$code = $request->getParams() ['code'];
		$auth = $this->getApp()->getContainer()->auth;
		
		$auth->authenticate($code);
		$service = new \Google_Service_Oauth2($auth);

        $user = $this->findOrCreateUser($service->userinfo->get());

        //Auth::login($user);
        
        return $response->withRedirect('/');
	}
    
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $userinfo Google Data
     * @return User
     */
    private function findOrCreateUser($userinfo)
    {
        $user = User::where('id', $userinfo->id)->first();
        if ($user != NULL) {
            return $user;
        }
        
        $user = new User([
            'id' => $userinfo->id,
            'name' => $userinfo->name,
            'nickname' => explode('@', $userinfo->email)[0]
        ]);
        $user->save();
        
        return $user;
    }
}