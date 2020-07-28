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
	[
		'category_id' => 0,//int required ON UPDATE only $this->getProductCategories(0)
		'parent_id' => 0,//int required $this->getProductCategories(0)
		'name' => 'category name', //string required
		'description' => 'This category is amazing...', //string
		'pos_enabled' => 0, //int
	];
	*/
	
	private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id = 0)
    {
        $this->id = $id;
    }

	private $parent_id;

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id = 0)
    {
        $this->parent_id = $parent_id;
    }

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    private $description;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

	private $pos_enabled;

    public function getPosEnabled()
    {
        return $this->pos_enabled;
    }

    public function setPosEnabled(int $pos_enabled = 0)
    {
        $this->pos_enabled = $pos_enabled;
    }


	/**
	* List Product Categories in the Company 
	* @return json 
	**/
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId(),
			'parent_id' => $this->getParentId()
		]);
	}

	/**
	* Update Product Categories by Id
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=190
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),	
			'category_id' => $this->getId(),
			'parent_id' => $this->getParentId(),
			'name' => $this->getName(),
			'description' => $this->getDescription(),
			'pos_enabled' => $this->getPosEnabled()
		]);
	}

	/**
	* Delete Product Categories from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(), 
			'category_id' => $this->getId(),
		]);
	}

	/**
	* Create Product Categories by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=189
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(), 	
			'parent_id' => $this->getParentId(),
			'name' => $this->getName(),
			'description' => $this->getDescription(),
			'pos_enabled' => $this->getPosEnabled()
		]);
	}

}