<?php

namespace VgsPedro\MoloniApi\Classes;

use VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the ProductCategories requests
 */

class ProductCategories extends Authentication{
	/**
	* Get list of Product Categories in the Company 
	* @param int $parent_id required
	* @return json 
	**/
	public function getProductCategories(array $c, int $parent_id = 0)
	{

		$token = $this->login($c);
		if($token['status'] == 0)
			return $token;

		$url = $c['url']."/productCategories/getAll/?access_token=".$token['data']->access_token;
		
		$response = $this->curl($url, ['company_id' => $c['company_id'], 'parent_id' => $parent_id]);
		return $response;
	}

	/**
	* Update Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=190
	**/
	public function updateProductCategories(array $pc = [])
	{
		$m = new Moloni();
		return $m->updateProductCategories($this->credencials, $pc);
	}

	/**
	* Delete Product Categories from the Company 
	* @param int $product_categories_id // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function deleteProductCategories(int $product_categories_id = 0)
	{
		$m = new Moloni();
		return $m->deleteProductCategories($this->credencials, $product_categories_id);
	}

	/**
	* Create Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=189
	**/
	public function setProductCategories(array $pc = [])
	{
		$m = new Moloni();
		return $m->setProductCategories($this->credencials, $pc);
	}


}