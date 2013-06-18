<?php
/* 
* 
* KnowEm API v2.0 php class
* May 20, 2013
*
* A php class to get results from the KnowEm 2.0 API
*
*
*/

class knowemAPI { 

  protected $yourID;
	protected $yourUsername;
	protected $yourPassword;
	protected $yourAPIKey;
	protected $yourAppName;
	
	function __construct($yourID, $yourUsername, $yourPassword, $yourAPIKey, $yourAppName) {
		$this->yourID = $yourID;
		$this->yourUsername = $yourUsername;
		$this->yourPassword = $yourPassword;
		$this->yourAPIKey = $yourAPIKey;
		$this->yourAppName = $yourAppName;

		$this->apiURL = "http://knowem.com/api2.0/";
	}
	
	function getAllCategories() {
		//  LIST ALL SOCIAL NETWORK CATEGORIES
		$url = $this->apiURL . "categories/" . $this->yourID . "/" . $this->yourAPIKey;
		return $this->_curl_get($url);
	}

	function getSocialNetworksByCategory($thisCategoryId) {
		// LIST ALL SOCIAL NETWORKS WITHIN A CATEGORY
		$url = $this->apiURL . "sites/" . $this->yourID . "/" . $this->yourAPIKey . "/" . $thisCategoryId;
		return $this->_curl_get($url);
	}

	function checkUsernameBySiteId($thisSiteId, $thisUsername) {
		// CHECK AVAILABILITY OF USERNAME ON A SOCIAL NETWORK
		$url = $this->apiURL . "usernamecheck/" . $this->yourID . "/" . $this->yourAPIKey . "/" . $thisSiteId . "/" . $thisUsername;
		return $this->_curl_get($url);
	}

	private function _curl_get($url) {
			try {
				$curl = curl_init();  
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->yourAppName);
				curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($curl, CURLOPT_USERPWD, $this->yourUsername . ":" . $this->yourPassword);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		  		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
		  		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		  		curl_setopt($curl, CURLOPT_TIMEOUT, 20 );
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		
		    	if ($output = curl_exec($curl)) {

					// GET RESPONSE CODE
					$httpResponseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
					
					if ($httpResponseCode != "200") {
						// ERROR OF SOME KIND
						throw new Exception("Response Code is " . $httpResponseCode);
					} else {
						// DECODE JSON INTO ARRAY
						$resultArray = json_decode($output, true);
						
						if  ($resultArray['error'] != 0 || json_last_error() !== JSON_ERROR_NONE) {
							// JSON ERROR
							throw new Exception("JSON error response is " . print_r(json_last_error(), true));
						}

						return array("result" => "OK", "response" => $resultArray['response']);
					}
		    	} else {
		    		throw new Exception("Curl call failed.");
		    	}

				curl_close($curl);

			} catch(Exception $o) {
				return array("result" => "Error", "response" => array("message" => $o->getMessage()));
			}

	}


} // END CLASS

?>
