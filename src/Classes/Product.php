<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the Product requests
 */

class Product extends Authentication{

	/**
	* Get Product by Id
	* @param int $product_id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getProductById(array $c, int $product_id, int $with_invisible = 0)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;
		
		$url = $c['url']."/products/getOne/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
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
	public function getProductsByReference(array $c, string $reference, int $qty = 0, int $offset = 0)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;
		
		$url = $c['url']."/products/getByReference/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
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
	public function getProductsByEan(array $c, string $ean, int $qty = 0, int $offset = 0)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;
		
		$url = $c['url']."/products/getByEAN/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
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
	public function getProductsByName(array $c, string $name, int $qty = 0, int $offset = 0)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;
		
		$url = $c['url']."/products/getByName/?access_token=".$token['data']->access_token;
		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
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
	public function getProducts(array $c, int $category_id, int $qty = 0, int $offset = 0, int $with_invisible = 0)
	{
		$token = $this->login($c);

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/products/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
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
	public function setProduct(array $c, array $p = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/products/insert/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [
			'company_id' => $c['company_id'],
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
	public function updateProduct(array $c, array $p = [])
	{
		$token = $this->login();

		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/products/update/?access_token=".$token['data']->access_token;

		$response = $this->curl($url, [

			'company_id' => $c['company_id'],
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

}