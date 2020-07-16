<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class findRestaurantController extends Controller
{
    //

    public function searchRestaurants(){
    	try{
    
        	// From URL to get webpage contents. 
    		$url = "https://developers.zomato.com/api/v2.1/search?entity_id=104485&entity_type=subzone"; 
    
        	$client = new \GuzzleHttp\Client();
                    
            $result = $client->request('GET',$url, [
                'headers' => [
                    'user-key' => '584259ba90f2abf4a743e2956bfb524e'
                ],  
            ]);
    
            if($result->getStatusCode() == "200"){
              	//$res = json_decode($result->getBody()->getContents(),true);
               /*	echo '<pre>';
    			echo '<b>Listed '.$res->results_found.' restaurants : </b> <br/>';
    			$j=1;
    			// SHOW 0 to 20 counts
    			foreach ($res->restaurants as $key => $value) {
    			 	echo $j.' - '.$value->restaurant->name.'<br/>';
    			 	$j++;
    			}*/
    			return $result->getBody()->getContents();
            }
    
    
        }catch (\GuzzleHttp\Exception\ClientException $e) { 
    
            if($e->getResponse()->getStatusCode() == '404'){
                $email_error = "Error Please Contact us!!";
            }
        }
    }

    public function searchCities(Request $req){
        
        try{
    
            // From URL to get webpage contents. 
            $url = "https://www.zomato.com/php/liveSuggest.php?type=locality&q=".$req['q']; 
    		
            $client = new \GuzzleHttp\Client();
            dd($url);     
            $result = $client->get($url);
    
            if($result->getStatusCode() == "200"){
                //$res = json_decode($result->getBody()->getContents(),true);
               /*   echo '<pre>';
                echo '<b>Listed '.$res->results_found.' restaurants : </b> <br/>';
                $j=1;
                // SHOW 0 to 20 counts
                foreach ($res->restaurants as $key => $value) {
                    echo $j.' - '.$value->restaurant->name.'<br/>';
                    $j++;
                }*/
                echo ($result->getBody());exit;
                return $result->getBody()->getContents();
            }
    
    
        }catch (\GuzzleHttp\Exception\ClientException $e) { 
    
            if($e->getResponse()->getStatusCode() == '404'){
                $email_error = "Error Please Contact us!!";
            }
        }
    }
}
