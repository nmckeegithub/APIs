<?php
/* Author:   Nathan Mckee
   Date:     2/22/24
   File:	 cveSearchGetData.php
   Purpose:  Receive form data from cveSearchForm.html, 
             validate username/password and get cve data based on search criteria chosen
*/
//initialize variables based on POST Array Data Received

$myUsername = $_POST['myUsername'];
$myPassword = $_POST['myPassword'];
$mySearchCriteria = $_POST['searchParameter'];
//Initialize username/password variables
$correctUsername = "cveuser";
$correctPassword = "password";
if ($myUsername == $correctUsername and $myPassword == $correctPassword) 
    {    
    //let the user know that we're searching using the correct parameters
	print('<p> Welcome, <strong>' .$myUsername. '</strong> ! Id be happy  to search the CVE Database based on your search criteria of: <b> ' .$mySearchCriteria. '</b> </p>');
    //Get JSON file and filter by search criteria
	$myCveSearch = file_get_contents(filename:"https://services.nvd.nist.gov/rest/json/cves/2.0/?pubStartDate=2021-08-04T00:00:00.000&pubEndDate=2021-08-04T12:00:00.000");
	//Will need to include reload due to common 503 errors!!!!
	$myCveSearch_o = json_decode($myCveSearch);
	$myResultsNums = $myCveSearch_o->totalResults;
	print('<p> I found the following data: <p>');
	print('<p> This page contains <b>'.$myResultsNums.'</b> results<p>');
	$myResultsVuls = $myCveSearch_o->vulnerabilities; //not working!!!
	//print_r($myResultsVuls);
	for ($i = 0; $i <= $myResultsNums-1; $i++)
		{
		print('Array Element: <b>'.$i.'</b> '.$myResultsVuls[$i]->cve->id.'--'.$myResultsVuls[$i]->cve->descriptions[0]->value.'<br><br>'); //Print all cve ids based on how many are available
		}
	}
else 
	{
    print('Sorry, dude. Something didnt match, please try your Username and Password again');
    print('<p><a href="cveSearchForm.html">Login Page</a></p>');
    }

?>