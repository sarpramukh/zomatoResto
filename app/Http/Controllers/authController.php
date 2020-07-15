<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class authController extends Controller
{
  public function signin()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $client = new \GuzzleHttp\Client();

    try{
    	$res = $client->request('POST', 'https://getpocket.com/v3/oauth/request', [
		    'consumer_key' => "92364-656f1ded3bd2ef2229d3e944",
    		'redirect_uri' => "http://google.ca",
    		'headers'  => ['Content-Type' => "application/json; charset=UTF-8",'X-Accept' => "application/json"]
    		
		]);

        $results = $res->getBody();
        echo $res->getHeader('content-type')[0];
        //dd($results);
        $results = json_decode($results);

        

    }catch (\GuzzleHttp\Exception\ClientException $e) { 
    	print_r($e->getResponse());
	    if($e->getResponse()->getStatusCode() == '404'){
	        $email_error = "Something Wrong";
	    }
	}
    // Initialize the OAuth client
    /*$oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'consumer_key'  			=> "92364-656f1ded3bd2ef2229d3e944",
      'redirect_uri'  			=> "http://www.google.com",
      'urlAuthorize'  			=> "https://getpocket.com/v3/oauth/request",
      'urlAccessToken'          => "",
      'urlResourceOwnerDetails' => '',
    ]);*/

	
  }

public function gettoken()
{
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // Authorization code should be in the "code" query param
  if (isset($_GET['code'])) {
    // Check that state matches
    if(isset($_SESSION['oauth_state'])){
      if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth_state'])) {
        exit('State provided in redirect does not match expected value.');
      }
    }else{
      if(isset($_SESSION["loginUserID"]) && !empty($_SESSION["loginUserID"])){
         $this->signin();
      }else{
        return view('welcome');
      }
    }
    
    // Clear saved state
    unset($_SESSION['oauth_state']);

    // Initialize the OAuth client
    $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => env('OAUTH_APP_ID'),
      'clientSecret'            => env('OAUTH_APP_PASSWORD'),
      'redirectUri'             => env('OAUTH_REDIRECT_URI'),
      'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
      'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
      'urlResourceOwnerDetails' => '',
      'scopes'                  => 'Mail.Read Mail.Read.Shared Mail.ReadBasic User.Read User.Read.All User.ReadBasic.All openid offline_access'
    ]);

    try {
      // Make the token request
      $accessToken = $oauthClient->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);

      // Save the access token and refresh tokens in session
      // This is for demo purposes only. A better method would
      // be to store the refresh token in a secured database
      $tokenCache = new \App\TokenStore\TokenCache;
      $tokenCache->storeTokens($accessToken->getToken(), $accessToken->getRefreshToken(),
        $accessToken->getExpires());
      //dd($accessToken);
      // Redirect back to mail page
      return redirect()->route('home');
    }
    catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      exit('ERROR getting tokens: '.$e->getMessage());
    }
    exit();
  }
  elseif (isset($_GET['error'])) {
    exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
  }
}

public function checkTokenExpiry(){
  $tokenCache = new \App\TokenStore\TokenCache;
  return $tokenCache->getAccessToken();
}

}