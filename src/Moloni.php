<?php

namespace VgsPedro\MoloniApi;

class Moloni
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

	/**
	* List Countries available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=68
	**/
	public function getCountries()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/countries/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url);

		return $response;
	}

	/**
	* List Languages available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=70
	**/
	public function getLanguages()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/languages/getAll/?access_token=".$token['data']->access_token;

		$response = $this->curl($url);

		return $response;
	}


	/**
	* List Currencies available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=101
	**/
	public function getCurrencies()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/currencies/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url);

		return $response;
	}


	/**
	* Get list of Fiscal Zones available in Moloni
	* @param int $id country_id  // $this->getCountries()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=69
	**/
	public function getFiscalZones(int $id)
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/fiscalZones/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url,['country_id' => $id]);

		return $response;
	}

	/**
	* List Payment Methods of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=236
	**/
	public function getPaymentMethods()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/paymentMethods/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $this->company_id]);

		return $response;
	}

	/**
	* Create Payment Methods
	* @param array $pm Payment Methods
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function setPaymentMethods(array $pm = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/paymentMethods/insert/?access_token=".$token['data']->access_token;
	
		$response = $this->curl($url,[
			'company_id' => $this->company_id,
			'name' => $pm['name'], //string required
			'is_numeric' => $pm['is_numeric'] //int
		]);

		return $response;

	}


	/**
	* Delete Payment Methods from the Company 
	* @param int $payment_method_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=239
	**/
	public function deletePaymentMethods(int $payment_method_id)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/paymentMethods/delete/?access_token=".$token['data']->access_token;
	
		$response = $this->curl($url,[
			'company_id' => $this->company_id,
			'payment_method_id' => 0,//int required $this->getPaymentMethods()
		]);

		return $response;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $pm PaymentMethods // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function updatePaymentMethods(array $pm = [])
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/paymentMethods/update/?access_token=".$token['data']->access_token;
	
		$response = $this->curl($url,[
			'company_id' => $this->company_id,
			'payment_method_id' => 0,//int required $this->getPaymentMethods()
			'name' => $pm['name'], //string required
			'is_numeric' => $pm['is_numeric'], //int
		]);

		return $response;
	}





	/**
	* Get list of MaturityDates in the Company 
	* @return json 
	**/
	public function getMaturityDates()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/maturityDates/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $this->company_id]);

		return $response;
	}

	/**
	* Get list of Delivery Methods in the Company 
	* @return json 
	**/
	public function getDeliveryMethods()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/deliveryMethods/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $this->company_id]);

		return $response;
	}


	/**
	* Get list of Product Categories in the Company 
	* @param int $parent_id required
	* @return json 
	**/
	public function getProductCategories(int $parent_id = 0)
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/productCategories/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $this->company_id, 'parent_id' => $parent_id]);

		return $response;
	}



	/**
	* Get Product by Id
	* @param int $product_id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getProductById(int $product_id, int $with_invisible = 0)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;
		
		$url = $this->url."/products/getOne/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'product_id' => $product_id,
			'with_invisible' => $with_invisible
		]);

		return $response;
	}


	/**
	* Get list of Products by Reference
	* @param string $reference required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=298
	**/
	public function getProductsByReference(string $reference, int $qty = 0, int $offset = 0)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;
		
		$url = $this->url."/products/getByReference/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'reference' => $reference,
			'qty' => $qty,
			'offset' => $offset
		]);

		return $response;
	}


	/**
	* Get list of Products by EAN
	* @param string $ean required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=299
	**/
	public function getProductsByEan(string $ean, int $qty = 0, int $offset = 0)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;
		
		$url = $this->url."/products/getByEAN/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'ean' => $ean,
			'qty' => $qty,
			'offset' => $offset
		]);

		return $response;
	}

	/**
	* Get list of Products by name
	* @param string $name required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=297
	**/
	public function getProductsByName(string $name, int $qty = 0, int $offset = 0)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;
		
		$url = $this->url."/products/getByName/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'name' => $name,
			'qty' => $qty,
			'offset' => $offset
		]);

		return $response;
	}

	/**
	* Get list of Products in the Company
	* @param int $category_id required // $this->getProductCategories()
	* @param int $qty 
	* @param int $offset
	* @param int $with_invisible
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=192
	**/
	public function getProducts(int $category_id, int $qty = 0, int $offset = 0, int $with_invisible = 0)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/products/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'category_id' => $category_id,
			'qty' => $qty,
			'offset' => $offset,
			'with_invisible' => $with_invisible
		]);

		return $response;
	}


	/**
	* Create Product in the Company 
	* @param array $p product
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=194
	**/
	public function setProduct(array $p = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/products/insert/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'category_id' => $p['category_id'],//int required $this->getProductCategories
			'type' => $p['type'],//int required
			'name' => $p['name'],//string required
			'summary' => $p['summary'],// string
			'reference' => $p['reference'],// string required
			'ean' => $p['ean'],// string
			'price' => $p['price'], //float required
			'unit_id' => $p['unit_id'], //int required
			'has_stock' => $p['has_stock'], //int required
			'stock' => $p['stock'], //float required
			'minimum_stock' => $p['minimum_stock'], //float required
			'pos_favorite' => $p['pos_favorite'], //int
			'at_product_category' => $p['at_product_category'], //string  [M: mercadorias, P: matérias-primas, subsidiárias e de consumo, A: produtos acabados e intermédios, S: subprodutos, desperdícios e refugos, T: produtos e trabalhos em curso]
			'exemption_reason' => $p['exemption_reason'], //string
			'taxes' => [],
/*				'tax_id' => $p['taxes']['tax_id'], //int required $this->getTaxes()
 				'value' => $p['taxes']['value'], //float required
				'order' => $p['taxes']['order'], //int required
				'cumulative' => $p['taxes']['cumulative'] //int required
			],*/
			'suppliers' => [],
			'properties' => [],
			'wharehouses' => []
		]);

		return $response;
	}


	/**
	* UpdateProduct in the Company 
	* @param array $p product
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=195
	**/
	public function updateProduct(array $p = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/products/update/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [

			'company_id' => $this->company_id,
			'category_id' => $p['category_id'],//int required $this->getProductCategories
			'product_id' => 58320720, // int required //$this->getPoducts()
			'type' => $p['type'],// int required
			'name' => $p['name'],// string required
			'summary' => $p['summary'],// string
			'reference' => $p['reference'],// string required
			'ean' => $p['ean'],// string
			'price' => $p['price'],// float required
			'unit_id' => $p['unit_id'],// int required
			'has_stock' => $p['has_stock'],// int required
			'stock' => $p['stock'],// float required
			'minimum_stock' => $p['minimum_stock'],// float required
			'pos_favorite' => $p['pos_favorite'],// int
			'at_product_category' => $p['at_product_category'],// string  [M: mercadorias, P: matérias-primas, subsidiárias e de consumo, A: produtos acabados e intermédios, S: subprodutos, desperdícios e refugos, T: produtos e trabalhos em curso]
			'exemption_reason' => $p['exemption_reason'],// string
			'taxes' => [
				'tax_id' => $p['taxes']['tax_id'], //int required $this->getTaxes()
 				'value' => $p['taxes']['value'], //float required
				'order' => $p['taxes']['order'], //int required
				'cumulative' => $p['taxes']['cumulative'] //int required
			],
			'suppliers' => [],
			'properties' => [],
			'wharehouses' => []
		]);

		return $response;
	}


	/**
	* Get list of Measurement Units in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=266
	**/
	public function getMeasurementUnits($c)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/measurementUnits/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $c['company_id']]);
		return $response;
	}

	/**
	* Create Measurement Units in the Company 
	* @param array $mu Measurement Units
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits(array $mu = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/measurementUnits/insert/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [

			'company_id' => $this->company_id,
			'name' => $mu['name'],// string required
			'short_name' => $mu['short_name'],// string required
		]);

		return $response;
	}

	/**
	* Update Measurement Units in the Company 
	* @param array $mu Measurement Units
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits(array $mu = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/measurementUnits/update/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'unit_id' => 0,// int required $this->getgetMeasurementUnits()
			'name' => $mu['name'],// string required
			'short_name' => $mu['short_name'],// string required
		]);

		return $response;
	}

	/**
	* Delete Measurement Units in the Company 
	* @param int $unit_id Measurement Unit sid
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits(int $unit_id)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/measurementUnits/delete/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'unit_id' => 0,// int required $this->getgetMeasurementUnits()
		]);

		return $response;
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