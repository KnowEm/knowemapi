<?php
require_once("knowem-api-client-2.0.php");

/* 
*
* GET ALL SOCIAL NETWORK CATEGORIES
*
* This makes a call to http://knowem.com/api2.0/categories/<ID>/<KEY>
* and returns an array with all the possible categories and their IDs in it.
*
*/

  $yourID = "<YOUR ID>";
	$yourUsername = "<YOUR USERNAME>";
	$yourPassword = "<YOUR PASSWORD>";
	$yourAPIKey = "<YOUR API KEY>";
	$yourAppName = "<YOUR UNIQUE APPLICATION NAME TO IDENTIFY YOURSELF>";


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Get All Categories</title>
	</head>
	
	<body>
		
		<h4>Click on any category to get a list of all social networks within that category</h4>

<?php

	$apiObj = new knowemAPI($yourID, $yourUsername, $yourPassword, $yourAPIKey, $yourAppName);
	$categoriesArray = $apiObj->getAllCategories();
	
	foreach ($categoriesArray['response'] as $catId => $catInfoArray) {
		echo "<p><a href='get-networks-by-category.php?id=" . $catId . "'>" . $catInfoArray['title'] . "</a></p>\n";
	}
	
?>

	</body>
</html>
