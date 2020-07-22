<?php

namespace VgsPedro\MoloniApi;

class Authentication
{
	/**
	* Get Tokens to allow data transaction of Company
	* @param array $credencials
	* @return json 
	* https://www.moloni.pt/dev/?action=getApiTxtDetail&id=3
	**/
	public function login(array $c)
	{
		$url = $c['url'].'/grant/?grant_type=password&client_id='.$c['client_id'].'&client_secret='.$c['client_secret'].'&username='.$c['username'].'&password='.$c['password'];
		return $this->curl($url);
	}


	public function curl(string $url, $post = null)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		if (is_array($post)){
			$fields = (is_array($post)) ? http_build_query($post) : $post;
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		}

		// Check if any error occurred
		if (curl_errno($ch)){

			$err = curl_error($ch);
			curl_close($ch);

		   	return [
		   		'status' => 0,
		   		'data' => $err,
		   	];
		}

		$result = curl_exec($ch);
		
		curl_close($ch);
 		
 		$r = json_decode($result);

		//Check if user validation is wrong
		if (isset($r->error))
		 	return [
	  			'status' => 0,
	        	'data' => $r,
	    ];

	  	return [
	  		'status' => 1,
	        'data' => $r,
	    ];
	}

}