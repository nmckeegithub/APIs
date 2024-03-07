<?php
/* Author:   Nathan Mckee
   Date:     3/5/24
   File:	 weatherGetData.php
   Purpose:  Receive form data from weatherSearchForm.html, 
             validate username/password and get open weather map search criteria chosen
*/
//initialize variables based on POST Array Data Received

$myUsername = $_POST['myUsername'];
$myPassword = $_POST['myPassword'];
$myLat = $_POST['myLat'];
$myLong = $_POST['myLong'];
//Initialize username/password variables
$correctUsername = "weatheruser";
$correctPassword = "password";
if ($myUsername == $correctUsername and $myPassword == $correctPassword) 
    {    
		function get_IP_address()
			{
			foreach (array('HTTP_CLIENT_IP',
					'HTTP_X_FORWARDED_FOR',
					'HTTP_X_FORWARDED',
					'HTTP_X_CLUSTER_CLIENT_IP',
					'HTTP_FORWARDED_FOR',
					'HTTP_FORWARDED',
					'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $IPaddress){
					$IPaddress = trim($IPaddress); // Just to be safe

                //if (filter_var($IPaddress,
                   //            FILTER_VALIDATE_IP,
                   //            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                   // !== false) {

			return $IPaddress;
                //}
																	}
															}
											}
	}

	$ip = get_IP_address();
	if ($ip == "::1")
		{
		$ip = "65.114.55.170";
		$isLocalHost = True;
		}
	$loc = file_get_contents(filename:"http://ip-api.com/json/$ip");
	$loc_o = json_decode($loc);

	$city = $loc_o->city;
	$state = $loc_o->region;
	$zip = $loc_o->zip;
	$lat = $loc_o->lat;
	$lon = $loc_o->lon;

//https://www.w3schools.com/php/filter_validate_ip.asp
//https://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php

	
	//Get remote user weather data
	$weatherData = file_get_contents(filename:"https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=0ea9892eb5854574ce5ef33a7787c6aa&units=imperial");
	$weatherData_o = json_decode($weatherData);
	$currentTemp = $weatherData_o->main->temp;
	$currentHumidity = $weatherData_o->main->humidity;
    print('<p> Welcome, <strong>' .$myUsername. '</strong> ! Glad you could make it!</p>');
	print('<p>It looks like you\'re in<strong> '.$city.', '.$state.': '.$zip.'</strong> | Current temp: <b>'.$currentTemp.'&deg;f</b> | Humidity: <b>'.$currentHumidity.'%</b></p>');
	if ($isLocalHost == true){
		Print('<p>This user is LocalHost</p><br>');
		Print('<p>The data type is:'.gettype($loc_o).'</p>');
							}
	}
else 
	{
    print('Sorry, dude. Something didnt match, please try your Username and Password again');
    print('<p><a href="cveSearchForm.html">Login Page</a></p>');
    }





?>