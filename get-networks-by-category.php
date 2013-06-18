<?php
require_once("knowem-api-client-2.0.php");

/* 
*
* GET ALL SOCIAL NETWORKS IN A CATEGORY
*
* This makes a call to http://knowem.com/api2.0/sites/<ID>/<KEY>/<CATEGORYID>
* and returns an array with all the social networks in a given category as supplied
* by you in the variable <CATEGORYID>
*
*/

  $yourID = "<YOUR ID>";
	$yourUsername = "<YOUR USERNAME>";
	$yourPassword = "<YOUR PASSWORD>";
	$yourAPIKey = "<YOUR API KEY>";
	$yourAppName = "<YOUR UNIQUE APPLICATION NAME TO IDENTIFY YOURSELF>";

	// GET CATEGORY FROM QUERY STRING
	$categoryId = intval($_GET["id"]);


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Get All Social Networks in a Category</title>
	</head>
	
	<body>
		
<?php

	if (!empty($categoryId) && is_numeric($categoryId)) {

		echo "<h4>All Social Networks in the Category ID requested (" . $categoryId . "):</h4>";

		// GET ALL SOCIAL NETWORKS IN THIS CATEGORY

			$apiObj = new knowemAPI($yourID, $yourUsername, $yourPassword, $yourAPIKey, $yourAppName);
			$networksArray = $apiObj->getSocialNetworksByCategory($categoryId);
			
			foreach ($networksArray['response'] as $siteId => $siteInfoArray) {
?>
			
				<p>
					<h4><?=$siteInfoArray['title']?></h4>
					<?=$siteInfoArray['description']?><br />

					<form action="check-username.php" method="post">
						<input type="text" name="username" size="20" />
						<input type="hidden" name="id" value="<?=$siteId?>" />
						<input type="submit" value="Check Username on <?=$siteInfoArray['title']?> &gt;" />
					</form>

					<img src="<?=$siteInfoArray['logo']?>" width="100" height="20" style="float: left;" /> 
					URL: <?=$siteInfoArray['siteURL']?><br />
					URL to Create New Account: <?=$siteInfoArray['signupURL']?><br />
					Date Added to KnowEm: <?=$siteInfoArray['dateAdded']?><br />
					Category: <?=$siteInfoArray['category']?><br />
					KnowEm Relevance Scores: <br />
					<ul>
						<li>Alexa: <?=$siteInfoArray['KnowEm Relevance Scores']['Alexa']?></li>
						<li>Google Pagerank: <?=$siteInfoArray['KnowEm Relevance Scores']['Google Pagerank']?></li>
						<li>Majestic Pages Indexed: <?=$siteInfoArray['KnowEm Relevance Scores']['Majestic Pages Indexed']?></li>
						<li>SEOMOZ Incoming Links: <?=$siteInfoArray['KnowEm Relevance Scores']['SEOMOZ Incoming Links']?></li>
						<li>SEOMOZ MozRank: <?=$siteInfoArray['KnowEm Relevance Scores']['SEOMOZ MozRank']?></li>
						<li>Scores last updated: <?=$siteInfoArray['KnowEm Relevance Scores']['Updated']?></li>
					</ul>
				</p>

<?php
			}
	
	} else {
		echo "<h4>Invalid Category Id.</h4>";
	}
	
?>

	</body>
</html>
