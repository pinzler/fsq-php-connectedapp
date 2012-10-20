<?php

	$key = $_REQUEST['code'];

	$client_id ="";
	$client_secret = "";
	$redirect_uri = "http://.../login.php"; //In this example the redirect_uri is just pointing back to this file

	$uri = file_get_contents("https://foursquare.com/oauth2/access_token?client_id=".$client_id."&client_secret=".$client_secret."&grant_type=authorization_code&redirect_uri=".$redirect_uri."&code=".$key, 
	    true);

	$obj = json_decode($uri);

	$usertoken = $obj->access_token; 
    //If you want to show "Connected App" check-in replies for this user you will need to save this access token  
    //in a database with the user's foursquare id so you get access it later 

	$uri = file_get_contents("https://api.foursquare.com/v2/users/self?oauth_token=".$obj->access_token,
	  true); 

	$obj = json_decode($uri);

	// Pull the info you want to save about the user https://developer.foursquare.com/docs/responses/user
	// Examples
	$foursquareid = $obj->response->user->id;
	$firstname = $obj->response->user->firstName;
	$lastname = $obj->response->user->lastName;
		
		// Not all fields available are actually present in the user object..	
	    if(isset($obj->response->user->contact->phone))	
			$phone = $obj->response->user->contact->phone;
		else 	
	    	$phone="";

		
	    if(isset($obj->response->user->contact->email))	
			$email = $obj->response->user->contact->email;
		else 	
	    	$email="";
	   	
?>



