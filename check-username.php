<?php
require_once("knowem-api-client-2.0.php");

/* 
*
* CHECK A USERNAME AGAINST A GIVEN SOCIAL NETWORK
*
* This makes a call to http://knowem.com/api2.0/usernamecheck/<ID>/<KEY>/<SITEID>/<USERNAME>
* and returns an array with the results of a username check, based on the values you provide
* in the variables <SITEID>, the Social Network's ID, and <USERNAME>, the username you
* are checking against.
*
*/

  $yourID = "<YOUR ID>";
	$yourUsername = "<YOUR USERNAME>";
	$yourPassword = "<YOUR PASSWORD>";
	$yourAPIKey = "<YOUR API KEY>";
	$yourAppName = "<YOUR UNIQUE APPLICATION NAME TO IDENTIFY YOURSELF>";

	// GET CATEGORY FROM QUERY STRING
	$username = $_POST["username"];
		if (! eregi("^[a-zA-Z0-9]*$",$username) ) {  
			echo "<h4>Usernames can only contain alpha-numeric characters, no spaces, dashes, etc.</h4>";
			exit;
		}

	$siteId = intval($_POST["id"]);


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Checks Username Availability on a Social Network</title>
	</head>
	
	<body>
		
		<h4>Checks Username Availability on a Social Network</h4>

<?php

	if (!empty($siteId) && is_numeric($siteId) && !empty($username)) {

		// CHECK IF THIS USERNAME IS AVAILABLE ON THIS SOCIAL NETWORK

			$apiObj = new knowemAPI($yourID, $yourUsername, $yourPassword, $yourAPIKey, $yourAppName);
			$usernameResultsArray = $apiObj->checkUsernameBySiteId($siteId, $username);
			
?>
		<h4>Results for the name <i><?=$username?></i> on the Social Network <i><?=$usernameResultsArray['response'][$siteId]['title']?></i>:</h4>
		
		<p>
		The name <i><?=$username?></i> is <?=$usernameResultsArray['response'][$siteId]['result']?><br />
		URL: <?=$usernameResultsArray['response'][$siteId]['userURL']?>
		</p>



<?php
	} else {
		echo "<h4>Invalid Username or Social Network Id.</h4>";
	}
	

?>

	</body>
</html>
