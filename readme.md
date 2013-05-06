# Foursquare Connected App PHP Quick Template
=================================================================================

## Setup on Foursquare

Go to https://foursquare.com/developers/apps and create a new app

Fill in all the information required however you want, except:

1. Set the "Redirect URI" to where you put login.php

2. Set "Push API Notifications" to "Push checkins by this app's users"

3. Set the "Push url" to where you put 4sqpush.php (Must be https://...)

4. Check the "New users can connect via the web" option

5. Save Changes

6. Copy down your Client id and Client secret and insert them into index.html and login.php

## The files

index.html - Simple button that starts the authentication process.  This will take the user to a foursquare login page.

login.php - After the user logs in they will be redirected back here where we can do some more oauth stuff to collect some user data.

4sqpush.php - Once a user has authenticated, all of their foursquare check-in data will get pushed here.  Includes a simple in-app "Reply" example.

