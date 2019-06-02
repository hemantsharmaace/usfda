<?php

class Datasource
{
    private $CI;

    private $apiUrl;

    private $baseApiUrl = "https://api.nal.usda.gov/ndb/";

    private $format = "json";

    private $sort = 'n';

    private $max = 10;

    private $offset = 0;

    const API_KEY =  'aoS1GX7zWSBcjxgMMxfdQHsckVQfVDB9zMOfMIVg';
 
    public function __construct(){
        $this->CI = get_instance();
    }

    public function apiRequest($params,$type,$method="GET"){
    	$data = array();
    	switch ($type) {
    		case 'reports':
    			$this->apiUrl = $this->baseApiUrl.'reports'; 
    			$data = array('format'=>$this->format,'type'=>'f','api_key'=>Datasource::API_KEY);
    			$data = array_merge($data,$params);
    			break;    		
    		default:
    			$this->apiUrl = $this->baseApiUrl.'search'; 
    			$data = array('format'=>$this->format,'sort'=>$this->sort,'max'=>$this->max,'offset'=>$this->offset,'api_key'=>Datasource::API_KEY);
    			$data = array_merge($data,$params);
    			break;
    	}

 		//call curl
 		$response = $this->callAPI($method,$this->apiUrl,$data);
 		return $response;
    }
 

	    
	// Method: POST, PUT, GET etc
	// Data: array("param" => "value") ==> index.php?param=value
	private function callAPI($method, $url, $data = false, $cookie = false, $header = false, $follow_location = false, $referer=false,$proxy=false)	{ 
 	     $curl = curl_init(); 	    
 	    switch ($method){
	        case "POST":
	            curl_setopt($curl, CURLOPT_POST, 1);

	            if ($data)
	                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	            break;
	        case "PUT":
	            curl_setopt($curl, CURLOPT_PUT, 1);
	            break;
	        default:
	            if ($data)
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	    }

	    curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);	    
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_FAILONERROR, true);
	    curl_setopt($curl, CURLOPT_REFERER, $referer);
	    curl_setopt($curl, CURLOPT_HEADER, $header);
	    curl_setopt($curl, CURLOPT_PROXY, $proxy);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $follow_location);
	    if ($cookie) {
	        curl_setopt ($curl, CURLOPT_COOKIE, $cookie);
	    }	    
	    $response = curl_exec ($curl);	    
	    curl_close($curl);
	    return $response; 	    

	}


}

?>