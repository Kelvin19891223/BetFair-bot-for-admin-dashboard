<?php
class Betfair
{
    /**
     * Define the login & the request API endpoints
     */
    const LOGIN_ENDPOINT   = "https://identitysso-api.betfair.com/api/certlogin";
    const REQUEST_ENDPOINT = "https://api.betfair.com/exchange/betting/json-rpc/v1";
    /**
     * The Betfair configuration options
     *
     * @var array
     */
    private $configuration;
    /**
     * The Betfair API session token
     *
     * @var string
     */
    private $sessionToken;
    /**
     * The class constructor
     * @param array $configuration The Betfair configuration options
     */
	public function setSessionToken($token){
		$this->sessionToken = $token;
	}	
    public function init($configuration) {
        if (!function_exists('curl_version')) {
            throw new Exception('The PHP curl extension is not installed. This extension is required to be able to use the API.');
        }
        if (!isset($configuration['username'])) {
            throw new Exception('The API username is missing from the configuration options');
        }
        if (!isset($configuration['password'])) {
            throw new Exception('The API password is missing from the configuration options');
        }
        if (!isset($configuration['appKey'])) {
            throw new Exception('The API application key is missing from the configuration options');
        }
        if (!isset($configuration['cert'])) {
            throw new Exception('The API certificate path is missing from the configuration options');
        }
        if (!is_readable($configuration['cert'])) {
            throw new Exception('The API certificate file does not exist or is not readable');
        }
        $this->configuration = $configuration;
    }
    /**
     * Logs into Betfair and gets a session token
     *
     * @param  boolean $refresh TRUE if a new session token is required, FALSE if the cached one can be use
     * @return string           The session token
     */
    public function getSessionToken($refresh = FALSE)
    {
        // If we have a cached session token and a new one is not needed
        // return the cached one
        if (!$refresh && !empty($this->sessionToken)) {
            return $this->sessionToken;
        }
        // Get the app key
        $appKey = $this->configuration['appKey'];
        // Initialize the CURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::LOGIN_ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Set the client SSL certificate
        curl_setopt($ch, CURLOPT_SSLCERT, $this->configuration['cert']);
        // Set the headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Application: ' . $appKey,
            'Accept: application/json'
        ));
        // Add the POST data
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('username' => $this->configuration['username'], 'password' => $this->configuration['password']), '', '&'));
        // Get the response
        $response = json_decode(curl_exec($ch));
        // Close the connection
        curl_close($ch);
        // If no sessionToken was found, throw an exception
        if (empty($response->sessionToken)) {
            throw new Exception('Could not get a valid session token from the login endpoint (check your configuration options)');
        }
        // Set the cached session token & return it
        $this->sessionToken = $response->sessionToken;
        // Return the session token
        return $this->sessionToken;
    }

    /**
     * Make an API request
     *
     * @param  string $operation The operation
     * @param  string $params    The parameters
     * @return string            The API response
     */
    public function request($operation, $params)
    {
        // Get the session token
        $sessionToken = $this->getSessionToken();
        // Get the app key
        $appKey = $this->configuration['appKey'];
        // Initialize the CURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::REQUEST_ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Application: ' . $appKey,
            'X-Authentication: ' . $sessionToken,
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        // Add the POST data
        $postData = '[{"jsonrpc": "2.0", "method": "SportsAPING/v1.0/' . $operation . '", "params" :' . $params . ', "id": 1}]';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        // Get the response
        $response = json_decode(curl_exec($ch));
        // Close the connection
        curl_close($ch);
        // If there was an error, clear the session token cache and throw an exception
        if (isset($response->error) || isset($response[0]->error)) {
            $this->sessionToken = null;
        }
        if (isset($response->error)) {
            throw new Exception($response->error->message, $response->error->code);
        } elseif (isset($response[0]->error)) {
            throw new Exception($response[0]->error->message, $response[0]->error->code);
        }
        // Return the response
        return $response;
    }
	private function sportsApingRequest($operation, $params)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.betfair.com/exchange/betting/json-rpc/v1");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:',
			'X-Application: ' . $this->configuration['appKey'],
			'X-Authentication: ' . $this->sessionToken,
			'Accept: application/json',
			'Content-Type: application/json'
		));
		$postData =	'[{ "jsonrpc": "2.0", "method": "SportsAPING/v1.0/' . $operation . '", "params" :' . $params . ', "id": 1}]';
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		if (isset($response[0]->error)) {
			echo 'Call to api-ng failed: ' . "\n";
			echo  'Response: ' . json_encode($response);
			exit(-1);
		} else {
			return $response;
		}
	}
	public function getAllEventTypes()
	{
		$jsonResponse = $this->sportsApingRequest('listEventTypes', '{"filter":{}}');
		return $jsonResponse[0]->result;
	}
	public function getCompetitions ()
	{
		$jsonResponse = $this->sportsApingRequest('listCompetitions', '{"filter":{}}');
		return $jsonResponse[0]->result;
	}
	public function getEventsList()
	{
		$jsonResponse = $this->sportsApingRequest('listEvents', '{"filter":{}}');
		return $jsonResponse[0]->result;
	}
	public function getMarketTypes()
	{
		$jsonResponse = $this->sportsApingRequest('listMarketTypes', '{"filter":{}}');
		return $jsonResponse[0]->result;
	}
	public function getCountries()
	{
		$jsonResponse = $this->sportsApingRequest('listCountries', '{"filter":{}}');
		return $jsonResponse[0]->result;
	}
	public function getVenues()
	{
		$jsonResponse = $this->sportsApingRequest('listVenues', '{"filter":{}}');
		return $jsonResponse[0]->result;
	}
	public function getMarketProfitAndLoss($marketId)
	{
		$params = '{"marketIds":["' . $marketId . '"]}';
		$jsonResponse = $this->sportsApingRequest('listMarketProfitAndLoss', $params);
		return $jsonResponse[0]->result;
	}
	public function extractEventTypeId($eventName)
	{
		$allEventTypes = $this->getAllEventTypes();
		foreach ($allEventTypes as $eventType) {
			if ($eventType->eventType->name == $eventName) {
				return '"'.$eventType->eventType->id.'"';
			}
		}
	}
	public function getNextRacingMarket($countries='', $wp='"WIN"', $type="all")
	{
		switch($type) {
			case "dog":
				$eventTypeIds = $this->extractEventTypeId('Horse Racing');
				break;
			case "horse":
				$eventTypeIds = $this->extractEventTypeId('Greyhound Racing');
				break;
			default:
				$eventTypeIds = $this->extractEventTypeId('Horse Racing').','.$this->extractEventTypeId('Greyhound Racing');
				break;
		}
		if($countries==''){
			$params = '{"filter":{"eventTypeIds":['.$eventTypeIds.'],
				  "marketTypeCodes":['.$wp.'],
				  "marketStartTime":{"from":"' . date('c') . '"}},
				  "sort":"FIRST_TO_START",
				  "maxResults":"1",
				  "marketProjection":["RUNNER_DESCRIPTION"]}';
		} else {
			$params = '{"filter":{"eventTypeIds":['.$eventTypeIds.'],
					  "marketCountries":['.$countries.'],
					  "marketTypeCodes":['.$wp.'],
					  "marketStartTime":{"from":"' . date('c') . '"}},
					  "sort":"FIRST_TO_START",
					  "maxResults":"1",
					  "marketProjection":["RUNNER_DESCRIPTION"]}';			
		}
		$jsonResponse = $this->sportsApingRequest('listMarketCatalogue', $params);
		return $jsonResponse[0]->result[0];
	}
	public function getMarketBook($marketId)
	{
		$params = '{"marketIds":["' . $marketId . '"], "priceProjection":{"priceData":["EX_BEST_OFFERS"]}}';
		$jsonResponse = $this->sportsApingRequest('listMarketBook', $params);
		if(isset($jsonResponse[0]->result[0])){
			return $jsonResponse[0]->result[0];			
		} else {
			var_dump($marketId);exit;
		}
	}
	public function getRunnerBook($marketId)
	{
		$params = '{"marketIds":["' . $marketId . '"], "priceProjection":{"priceData":["EX_BEST_OFFERS"]}}';
		$jsonResponse = $this->sportsApingRequest('listRunnerBook', $params);
		return $jsonResponse[0]->result[0];
	}
	public function placeBet($marketId, $selectionId, $betamount)
	{
		$params = '{"marketId":"' . $marketId . '",
					"instructions":
						 [{"selectionId":"' . $selectionId . '",
						   "handicap":"0",
						   "side":"BACK",
						   "orderType":
						   "LIMIT",
						   "limitOrder":{"size":"'.$betamount.'",
										"price":"3"}
						   }], "customerRef":"fsdf"}';
	 
		$jsonResponse = $this->sportsApingRequest('placeOrders', $params);
		return $jsonResponse[0]->result;
	}
}