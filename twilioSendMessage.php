<?php
/*
Author:   Nathan Mckee
Date:     2/20/24
File:	  twilioSendMessage.php
Purpose:  Receive form data from twilioForm.html, 
validate username/password and send SMS Message
*/
//initialize variables based on POST Array Data Received
$myUsername = $_POST['myUsername'];
$myPassword = $_POST['myPassword'];
$myMessage = $_POST['myMessage'];
//Initialize username/password variables
$correctUsername = "nmckee";
$correctPassword = "password";
if ($myUsername == $correctUsername and $myPassword == $correctPassword) 
    {    
    print('<p> Welcome, <strong>' .$myUsername. '</strong> ! Id be glad to send your message</p>');
    }

else 
    {
    print('Sorry, dude. Something didnt match, please try again');
    print('<p><a href="twilioform.html">Login Page</a></p>');
    }
//Start Twilio SMS Processing---------------------------

// Include the bundled autoload from the Twilio PHP Helper Library
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client;
// Your Account SID and Auth Token from twilio.com/console
// To set up environmental variables, see http://twil.io/secure
$account_sid = 'ACe4d56648ba27f4f73da4140298f75e50';  //removing getenv() for testing
$auth_token = '9f1b1051a12a59cfabd78ef1dec53773'; //removing getenv() for testing
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
$twilio_number = "+18556743368";
$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+19103854342',
    array(
        'from' => $twilio_number,
        'body' => ' '.$myMessage.' '
    )
);


?>
