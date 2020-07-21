<?php

namespace VgsPedro\MoloniApi;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Moloni
{

 	private $company_id; // Company ID, Provided by Moloni
 	private $client_id; // Client ID, Provided by Moloni
 	private $client_secret; // Client Secret, Provided by Moloni

 	private $username; // Username, that allows access to Moloni (login page)
 	private $password; // Password, that allows access to Moloni (login page)
    
    private $url; // Url to make request, sandbox or live (sandbox APP_ENV=dev or test) (live APP_ENV=prod)
	private $opendoc; // On generate invoice set to provisory or definitiv
    
    public function __construct(ParameterBagInterface $environment){

		if($environment->get("kernel.environment") == 'prod'){
			$this->company_id = 5; //Change according to specific user 
		 	$this->url = 'https://api.moloni.pt/v1';	
		}
		else{
			$this->company_id = 5; //test mode Company id
		 	$this->url = 'https://api.moloni.pt/sandbox';
		}
    	$this->opendoc = true;
    	$this->username =''; // Username, that allows access to Moloni (login page)
 		$this->password = ''; // Password, that allows access to Moloni (login page)
    }

	/**
	* Get Tokens to allow data transaction of Company 
	* @return json 
	* https://www.moloni.pt/dev/?action=getApiTxtDetail&id=3
	**/
	public function login()
	{
		$url = $this->url.'/grant/?grant_type=password&client_id='.$this->client_id.'&client_secret='.$this->client_secret.'&username='.$this->username.'&password='.$this->password;

		return $this->curl($url);
	}

	/**
	* Get all Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomerCount(){
	
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/customers/count/?access_token=".$token['data']->access_token;
		
		return $this->curl($url);
	}

	/**
	* Create a new Customer in the Company 
	* @param array $a Customer information 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function setCustomer(array $a)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/customers/insert/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'vat' => $a['vat'], //NIPC
			'number' => $a['cid'], //SNC
			'language_id' => $a['language_id'],
			'name' => $a['name'],
			'address' => $a['address'],
			'city' => $a['city'],
			'zip_code' => $a['zip_code'], //if country_id = 1 then 0000-000
			'discount' => $a['discount'],
			'credit_limit' => $a['credit_limit'],
			'payment_day' => $a['payment_day'],
			'country_id' => $a['country_fiscal_id'],
			'maturity_date_id' => $a['maturity_date_id'], 
			'qty_copies_document' => $a['qty_copies_document'],
			'payment_method_id' => $a['payment_method_id'],
			'copies'=> [
				'document_type_id' => $a['copies']['document_type_id'],
				'copies' => $a['copies']['copies'],
			],
			'delivery_method_id' => $a['delivery_method_id'],
			'salesman_id' => $a['salesman_id']
		]);

		return $response;
	}

	/**
	* Get Customer by Id
	* @param int $id Customer Id // $this->getCustomerByVat(string $vat)
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(int $id)
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;
		
		$url = $this->url."/customers/getOne/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $this->company_id, 'customer_id' => $id]);

		return $response;
	}

	/**
	* Get Customer by Vat
	* @param string $vat Customer Vat // '123456789'
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	public function getCustomerByVat(string $vat)
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/customers/getByVat/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $this->company_id, 'vat' => $vat]);

		return $response;
	}

	/**
	* Update Customer by Id
	* @param array $a Customer information //test set customer_id =  30259661
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function updateCustomerById(array $a)
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/customers/update/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'customer_id' => 30259661,
			'vat' => $a['vat'], //NIPC
			'number' => $a['cid'], //SNC
			'language_id' => $a['language_id'], //1=>PT, 2=>EN, 3=>ES
			'name' => $a['name'],
			'address' => $a['address'],
			'city' => $a['city'],
			'zip_code' => $a['zip_code'], //if country_id = 1 then 0000-000
			'discount' => $a['discount'],
			'credit_limit' => $a['credit_limit'],
			'payment_day' => $a['payment_day'],
			'country_id' => $a['country_fiscal_id'],
			'maturity_date_id' => $a['maturity_date_id'], //18253 PP || 18252 30d || 18254 60d || 18255 90d
			'qty_copies_document' => $a['qty_copies_document'],
			'payment_method_id' => $a['payment_method_id'], //17236 cash || xxxx paypal
			'copies'=> [
				'document_type_id' => $a['copies']['document_type_id'],
				'copies' => $a['copies']['copies'],
			],
			'delivery_method_id' => $a['delivery_method_id'],
			'salesman_id' => $a['salesman_id']
		]);

		return $response;
	}

	/**
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes()
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/taxes/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $this->company_id]);
		return $response;
	}

	/**
	* Create Tax in the Company 
	* @param array $t tax information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax(array $t = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/taxes/insert/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'], //$this->getFiscalZones($id)
			'active_by_default' => $t['active_by_default']
		]);

		return $response;
	}


	/**
	* Update Tax by Id
	* @param array $t Tax information // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=264
	**/
	public function updateTax(array $t = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/taxes/update/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $this->company_id,
			'tax_id' => 1999147,
			'name' => $t['name'], 
			'value' => $t['value'],
			'type' => $t['type'],
			'saft_type' => $t['saft_type'],
			'vat_type' => $t['vat_type'],
			'stamp_tax' => $t['stamp_tax'],
			'exemption_reason' => $t['exemption_reason'],
			'fiscal_zone' => $t['fiscal_zone'], //$this->getFiscalZones($id)
			'active_by_default' => $t['active_by_default']
		]);

		return $response;
	}

	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTax(int $tax_id)
	{

		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/taxes/delete/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $this->company_id, 'tax_id' => $tax_id]);
		return $response;
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
	public function getMeasurementUnits()
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $this->url."/measurementUnits/getAll/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, ['company_id' => $this->company_id]);
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

	private function curl(string $url, $post = null)
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
	        	'data' => $r
	    ];

	  	return [
	  		'status' => 1,
	        'data' => $r
	    ];
	}

}