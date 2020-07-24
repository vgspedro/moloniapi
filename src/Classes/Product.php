<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the Product requests
 */

class Product extends Authentication{

	/** @const entity api url */
	const ENTITY = '/products/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/** Payment array data structure
	$p = [
        'product_id' => 0,// int required ON UPDATE only $this->getProducts()
        'category_id' => 2518332,// int required $moloni->getProductCategories()
        'type' => 1,// int required [1 => Produto , 2 => Serviço , 3 => Outros]
        'name' => 'Prduct name',// string required
        'summary' => 'A product summary',// string 
        'reference' => '#123',//string required should be unique
        'ean' => '1234',// string
        'price' => 5.1,// float required
        'unit_id' => 1222821 ,// int required $moloni->getMeasurementunits()
        'has_stock' => 0,// int required
        'stock' => 0.0,//float required
        'minimum_stock' => 0.0,// float
        'pos_favorite' => 0,// int
        'at_product_category' => '',// string [M: mercadorias, P: matérias-primas, subsidiárias e de consumo, A: produtos acabados e intermédios, S: subprodutos, desperdícios e refugos, T: produtos e trabalhos em curso]
        'exemption_reason' => '',// string required
        'taxes' => [ //array not required 
            'tax_id' => 1999735,// int $moloni->getTaxes()
            'value' => 1.0, //float required
            'order' => 1,// int required
            'cumulative' => 1,// int required
        ],
        'suppliers' => [ //array not required 
                'supplier_id' => 0,// int required $moloni->getSuppliers()
                'cost_price'=> 4.1 , // float required
                'referenceint' => 0, //int 
        ],  
        'properties' => [ //array not required 
            'property_id' => 0,// int required
            'value' => '',// string required
        ]
    ];

	/**
	* Get Product by Id
	* @param int $product_id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getProductById(array $c = [], int $product_id = 0, int $with_invisible = 0)
	{

		$url = $c['url'].''.static::ENTITY.'getOne'.static::ACCESS.''.$c['token']['access_token'];
		
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'product_id' => $product_id,
			'with_invisible' => $with_invisible
		]);
	}

	/**
	* List Products by Reference
	* @param string $reference required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=298
	**/
	public function getProductsByReference(array $c = [], string $reference = null, int $qty = 0, int $offset = 0)
	{
		
		$url = $c['url'].''.static::ENTITY.'getByReference'.static::ACCESS.''.$c['token']['access_token'];

		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'reference' => $reference,
			'qty' => $qty,
			'offset' => $offset
		]);
	}

	/**
	* List Products by EAN
	* @param string $ean required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=299
	**/
	public function getProductsByEan(array $c = [], string $ean = null, int $qty = 0, int $offset = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getByEAN'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'ean' => $ean,
			'qty' => $qty,
			'offset' => $offset
		]);
	}

	/**
	* List Products by name
	* @param string $name required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=297
	**/
	public function getProductsByName(array $c = [], string $name = null, int $qty = 0, int $offset = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getByName'.static::ACCESS.''.$c['token']['access_token'];
		
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'name' => $name,
			'qty' => $qty,
			'offset' => $offset
		]);
	}

	/**
	* List of Products in the Company
	* @param int $category_id required // $this->getProductCategories()
	* @param int $qty 
	* @param int $offset
	* @param int $with_invisible
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=192
	**/
	public function getProducts(array $c = [], int $category_id = 0, int $qty = 0, int $offset = 0, int $with_invisible = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'category_id' => $category_id,
			'qty' => $qty,
			'offset' => $offset,
			'with_invisible' => $with_invisible
		]);
	}

	/**
	* Create Product in the Company 
	* @param array $p product
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=194
	**/
	public function setProduct(array $c = [], array $p = [])
	{

		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];

		$response = parent::curl($url, [
			'company_id' => $c['company_id'],
		    'category_id' => $p['category_id'],
		    'type' => $p['type'],
		    'name' => $p['name'],
		    'summary' => $p['summary'], 
		    'reference' => $p['reference'],
		    'ean' => $p['ean'],
		    'price' => $p['price'],
		    'unit_id' => $p['unit_id'] ,
		    'has_stock' => $p['has_stock'],
		    'stock' => $p['stock'],
		    'minimum_stock' => $p['minimum_stock'],
		    'pos_favorite' => $p['pos_favorite'],
		    'at_product_category' => $p['at_product_category'],
		    'exemption_reason' => $p['exemption_reason'],
		    'taxes' => [],//$p['taxes'],
		    'suppliers' => [],// $p['suppliers'],  
		    'properties' => []// $p['properties']
		]);

		return $response;
	}

	/**
	* UpdateProduct in the Company 
	* @param array $p product
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=195
	**/
	public function updateProduct(array $c = [], array $p = [])
	{
		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];

		$response = parent::curl($url, [
			'company_id' => $c['company_id'],
			'category_id' => $p['category_id'],
			'product_id' => $p['product_id'],
		    'type' => $p['type'],
		    'name' => $p['name'],
		    'summary' => $p['summary'], 
		    'reference' => $p['reference'],
		    'ean' => $p['ean'],
		    'price' => $p['price'],
		    'unit_id' => $p['unit_id'] ,
		    'has_stock' => $p['has_stock'],
		    'stock' => $p['stock'],
		    'minimum_stock' => $p['minimum_stock'],
		    'pos_favorite' => $p['pos_favorite'],
		    'at_product_category' => $p['at_product_category'],
		    'exemption_reason' => $p['exemption_reason'],
		    'taxes' => [],// $p['taxes'],
		    'suppliers' => [],// $p['suppliers'],  
		    'properties' => [] //$p['properties']
		]);
		
		return $response;
	}


	/**
	* Delete Product by Id
	* @param int $product_id required // $this->getProducts()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=196
	**/
	public function deleteProduct(array $c = [], int $product_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'product_id' => $product_id,
		]);
	}

}