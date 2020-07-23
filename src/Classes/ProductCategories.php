<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the ProductCategories requests
 */

class ProductCategories extends Authentication{

	/** @const entity api url */
	const ENTITY = '/productCategories/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/** Product Categories array data structure
	$pc = [
		'category_id' => 0,//int required ON UPDATE only $this->getProductCategories(0)
		'parent_id' => 0,//int required $this->getProductCategories(0)
		'name' => 'category name', //string required
		'description' => 'This category is amazing...', //string
		'pos_enabled' => 0, //int
	];

	/**
	* List Product Categories in the Company 
	* @param int $parent_id required
	* @return json 
	**/
	public function getProductCategories(array $c = [], int $parent_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, [
			'company_id' => $c['company_id'],
			'parent_id' => $parent_id
		]);
	}

	/**
	* Update Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=190
	**/
	public function updateProductCategories(array $c = [], array $pc = [])
	{
		$url = $c['url'].''.static::ENTITY.'update'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, [
			'company_id' => $c['company_id'],	
			'category_id' => $pc['category_id'],
			'parent_id' => $pc['parent_id'],
			'name' => $pc['name'],
			'description' => $pc['description'],
			'pos_enabled' => $pc['pos_enabled']
		]);
	}

	/**
	* Delete Product Categories from the Company 
	* @param int $product_categories_id // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function deleteProductCategories(array $c = [], int $category_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, [
			'company_id' => $c['company_id'], 
			'category_id' => $category_id
		]);
	}

	/**
	* Create Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=189
	**/
	public function setProductCategories(array $c = [], array $pc = [])
	{
		$url = $c['url'].''.static::ENTITY.'insert'.static::ACCESS.''.$c['token']['access_token'];
		return parent::curl($url, [
			'company_id' => $c['company_id'], 	
			'parent_id' => $pc['parent_id'],
			'name' => $pc['name'],
			'description' => $pc['description'],
			'pos_enabled' => $pc['pos_enabled']
		]);
	}

}