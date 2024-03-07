<?php
/* Author:   Nathan Mckee
   Date:     2/22/24
   File:	 sqorzSearchGetData.php
   Purpose:  Receive form data from sqorzSearchForm.html, 
             validate username/password and get Sqorz data based on search criteria chosen
*/
//initialize variables based on POST Array Data Received

$myUsername = $_POST['myUsername'];
$myPassword = $_POST['myPassword'];
$mySearchCriteria = $_POST['searchParameter'];
//Initialize username/password variables
$correctUsername = "sqorzuser";
$correctPassword = "password";
if ($myUsername == $correctUsername and $myPassword == $correctPassword) 
    {    
    //let the user know that we're searching using the correct parameters
	print('<p> Welcome, <strong>' .$myUsername. '</strong> ! Id be happy  to search the Sqorz Database based on your search criteria of: <b> ' .$mySearchCriteria. '</b> </p>');
    //Get JSON file and filter by search criteria
	$mySqorzSearch = file_get_contents(filename:"https://our.sqorz.com/json/leaderboard/65bafa1317bdc8e05c381083");
	//
	$mySqorzSearch_o = json_decode($mySqorzSearch);
	$mySqorz = $mySqorzSearch_o;
	print('<p> I found the following data: <p>');
	print('<p><b>(Leaderboard Comment Data:) </b>'.$mySqorz->comment.'</p>');
	print('<p><b>Sport: </b>'.$mySqorz->sportType.'</p>');
	print('<p><b>Member: </b>'.$mySqorz->members[39]->firstName.' '.$mySqorz->members[39]->lastName.'</p>');
	print('<b>Number Plate: </b>'.$mySqorz->members[39]->plate.'</p>');
	print('<img src="images/numberplate.webp" alt="bmx numberplate" width="177" height="115">');
	//$myResultsVuls = $myCveSearch_o->vulnerabilities; //not working!!!
	//print_r($myResultsVuls);
	/*for ($i = 0; $i <= $myResultsNums-1; $i++)
		{
		print('Element: '.$i.' '.$myResultsVuls[$i]->cve->id).'- Explanation...<br>'; //Print all cve ids based on how many are available
		}
	*/
	} 
	
else 
	{
    print('Sorry, dude. Something didnt match, please try again');
    print('<p><a href="sqorzSearchForm.html">Login Page</a></p>');
    }

?>