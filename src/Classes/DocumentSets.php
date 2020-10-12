<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the DocumentSets requests
*/

class DocumentSets extends Authentication{

	/** @const entity api url */
	const ENTITY = '/documentSets/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	DocumentSets array data structure
    [
    	'qty' => 50, //int,
    	'offset' => 0, //int
    	'document_set_id' => 0, //int ONLY IN $this->getDocument()
        'template_id' => 0, // int required Template->getId()
        'name' => '', //string required
        'cash_vat_scheme_indicator' => '', // string
        'active_by_default' => '',// int
    ];
	*/
    
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

	private $cash_vat_scheme_indicator;

    public function getCashVatSchemeIndicator()
    {
        return $this->cash_vat_scheme_indicator;
    }

    public function setCashVatSchemeIndicator(string $cash_vat_scheme_indicator = null)
    {
        $this->cash_vat_scheme_indicator = $cash_vat_scheme_indicator;
    }
    private $active_by_default;

    public function getActiveByDefault()
    {
        return $this->active_by_default;
    }

    public function setActiveByDefault(int $active_by_default = 0)
    {
        $this->active_by_default = $active_by_default;
    }

	private $template_id;

    public function getTemplateId()
    {
        return $this->template_id;
    }

    public function setTemplateId(int $template_id = 0)
    {
        $this->template_id = $template_id;
    }

	private $offset;

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset(int $offset = 0)
    {
        $this->offset = $offset;
    }

	private $qty;

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty(int $qty = 50)
    {
        $this->qty = $qty;
    }

	private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id = 0)
    {
        $this->id = $id;
    }

	/**
	* List DocumentSets of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=274
	**/
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId(),
			'qty' => $this->getQty(), //int,
    		'offset' => $this->getOffset() //int
		]);
	}


    /**
    * Delete a DocumentSets from the Company 
    * @return json
    * https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=277
    **/
    public function delete()
    {
        return parent::curl(parent::getPath('delete'), [
            'company_id' => parent::getCompanyId(),
            'document_set_id' => $this->getId()
        ]);
    }

    /**
    * Update DocumentSets by Id
    * @return json
    * https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=276
    **/
    public function update()
    {
        return parent::curl(parent::getPath('update'), [
            'company_id' => parent::getCompanyId(),
            'document_set_id' => $this->getId(),
            'name' => $this->getName(), 
            'cash_vat_scheme_indicator' => $this->getCashVatSchemeIndicator(),
            'template_id' => $this->getTemplateId(),
            'active_by_default' => $this->getActiveByDefault()
        ]);

    }


/**
    * Create DocumentSets in the Company 
    * @return json 
    * https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=275
    **/
    public function insert()
    {
        return parent::curl(parent::getPath('insert'), [
            'company_id' => parent::getCompanyId(),
            'name' => $this->getName(), 
            'cash_vat_scheme_indicator' => $this->getCashVatSchemeIndicator(),
            'template_id' => $this->getTemplateId(),
            'active_by_default' => $this->getActiveByDefault()
        ]);

    }



}