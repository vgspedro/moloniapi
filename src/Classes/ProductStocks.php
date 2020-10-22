<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Product Stocks requests
*/

class ProductStocks extends Authentication{

	/** @const entity api url */
	const ENTITY = '/productStocks/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	Product Stocks array data structure

    $product_stocks = [
        'product_stock_id' => 0 // int required ON UPDATE ONLY
    	'product_id' => 0, //int required
        'movement_date' => ' yyyy-mm-dd hh:mm:mm', //date  required
        'qty' => 1, // int required
        'warehouse_id' => 1, // int
        'document_id_id' => 1, // int
        'notes' => 'comentário', //string
    ];
	*/

    private $product_id;

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id = 0)
    {
        $this->product_id = $product_id;
    }

	private $movement_date;

    public function getMovementDate()
    {
        return $this->movement_date;
    }

    public function setMovementDate(string $movement_date = '0000-00-00 00:00:00')
    {
        $this->movement_date = $movement_date;
    }

	private $qty;

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty(int $qty = 0)
    {
        $this->qty = $qty;
    }

	private $warehouse_id;

    public function getWarehouseId()
    {
        return $this->warehouse_id;
    }

    public function setWarehouseId(int $warehouse_id = 0)
    {
        $this->warehouse_id = $warehouse_id;
    }

    private $document_id;

    public function getDocumentId()
    {
        return $this->document_id;
    }

    public function setDocumentId(int $document_id = 0)
    {
        $this->document_id = $document_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id = 0)
    {
        $this->id = $id;
    }

    private $notes;

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes(string $notes = null)
    {
        $this->notes = $notes;
    }

	/**
	* List Product Stocks of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=580
	**/
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
            'company_id' => parent::getCompanyId()
        ]);
	}

	/**
	* Create Product Stocks in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=581
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
            'product_id' => $this->getProductId(),
            'movement_date' => $this->getMovementDate(),
            'qty' => $this->getQty(),
            'warehouse_id' => $this->getWarehouseId(),
            'document_id' => $this->getDocumentId(),
            'notes' =>$this->getNotes()
		]);

	}

	/**
	* Update Product Stocks by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=586
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'product_stock_id' => $this->getId(),
            'product_id' => $this->getProductId(),
            'movement_date' => $this->getMovementDate(),
            'qty' => $this->getQty(),
            'document_id' => $this->getDocumentId(),
            'warehouse_id' => $this->getWarehouseId(),
            'notes' =>$this->getNotes()
		]);

	}

	/**
	* Delete a Product Stocks from the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=592
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'product_stock_id' => $this->getId()
		]);
	}

}