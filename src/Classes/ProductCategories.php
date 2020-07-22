<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the ProductCategories requests
 */

class ProductCategories extends Authentication{

	/** @const entity api url */
	const ENTITY = '/productCategories/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	* List Product Categories in the Company 
	* @param int $parent_id required
	* @return json 
	**/
	public function getProductCategories(array $c = [], int $parent_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id'], 'parent_id' => $parent_id]);
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
		return $this->curl($url, ['company_id' => $c['company_id'], 'product_categories_id' => $product_categories_id]);
	}

	/**
	* Delete Product Categories from the Company 
	* @param int $product_categories_id // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function deleteProductCategories(array $c = [], int $product_categories_id = 0)
	{
		$url = $c['url'].''.static::ENTITY.'getAll'.static::ACCESS.''.$c['token']['access_token'];
		return $this->curl($url, ['company_id' => $c['company_id'], 'product_categories_id' => $product_categories_id]);
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
		return $this->curl($url, ['company_id' => $c['company_id'], 'product_categories_id' => $product_categories_id]);
	}


}