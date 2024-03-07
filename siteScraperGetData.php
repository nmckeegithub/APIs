<?php

/*
Author:   Nathan Mckee
Date:     2/20/24
File:	  siteScraperGetData.php
Purpose:  Receive form data from siteScraperForm.html, 
validate username/password and get scraper data for $myUrl
*/
//initialize variables based on POST Array Data Received

$myUsername = $_POST['myUsername'];
$myPassword = $_POST['myPassword'];
$myUrl = $_POST['myUrl']; //need to validate correct format of url!!!!
//Initialize username/password variables
$correctUsername = "sitescraperuser";
$correctPassword = "password";
if ($myUsername == $correctUsername and $myPassword == $correctPassword) 
    {    
    $curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://site-scrapper.p.rapidapi.com/fetchsitetitle?url=https%3A%2F%2Fbooks.toscrape.com", //must had an "s" for secure sites
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: site-scrapper.p.rapidapi.com",
			"X-RapidAPI-Key: 59ddd86055msh8145a38c47c883cp182896jsnc3bd7e3cdbb2"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		//echo $response;  //will try to initialize variable instead of using "echo $response"
		$crawlData = $response;
		print('<p> Welcome, <strong>' .$myUsername. '</strong> ! Id be happy  to scrape: <b>' .$myUrl. '</b>  for you</p>');
		print('<p>Here\'s the data I Crawled from: <b>'.$myUrl.'</b>:</b><br><br> '.$crawlData.'</p>');
	}
	
    }
   


else 
    {
    print('Sorry, dude. Something didnt match, please try again');
    print('<p><a href="siteScraperForm.html">Login Page</a></p>');
    }






?>
