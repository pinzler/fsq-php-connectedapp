<?php

//Once a user authenticates with your app, foursquare will push all of their checkin data to this script at each checkin

$obj = json_decode($_REQUEST['checkin']);
  

// Pull the info you want to save about the checkin https://developer.foursquare.com/docs/responses/checkin

// Examples of info to pull
	
$checkinid = $obj->id;
$chtime = $obj->createdAt;
$name = $obj->user->firstName;
$venueid =$obj->venue->id;
$venuename = $obj->venue->name;
$add = $obj->venue->location->address;
$lat = $obj->venue->location->lat;
$lng = $obj->venue->location->lng;
$userid = $obj->user->id;

// This is where the check-in comment or "shout" is stored
// if you are looking for a keyword or hashtag in a user's checkin, it will be in the "shout"

$shout = $obj->shout; 

		//If you want to create a "Connected App" reply that appears along with the checkin.

		$userOauth=""; // This needs to be pulled from your database since you only get the token when users authenticate with your app

        
	    $fields = array(
            //'url' => urlencode("http://..."),  //If you want your reply to be interactive 
            'text' => urlencode("Thanks for using my app, ".$name."!"),
            'oauth_token' => urlencode($userOauth),
            'v' => urlencode("20120827") // just needs a date
            );

	    $fields_string = "";
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
	    
	    $replyURL = "https://api.foursquare.com/v2/checkins/".$checkinid."/reply";
	    
	    // This reply needs to be POSTed
        $ch = curl_init();
       	curl_setopt($ch,CURLOPT_URL, $replyURL);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        $data = curl_exec($ch);
        curl_close($ch);


?>

