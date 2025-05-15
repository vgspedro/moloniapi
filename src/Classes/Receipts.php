<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Receipts requests
*/

class Receipts extends Authentication{

	/** @const entity api url */
	const ENTITY = '/receipts/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	Receipts array data structure
	[
		'document_id' => // int required ON UPDATE only
		'date' => '2020-07-30', // date required
		'document_set_id' => 0, // int required
		'customer_id' => 0, // int required
		'alternate_address_id' => 0, // int
        'net_value' => 0.0, //float required
        'associated_documents'  => [ // array
            'associated_id int' => 0.0, // int required
            'value' => 0.0, // float required
            ],
		'related_documents_notes' => 'doc notes', // string
        'payments' => [ //array required
            'payment_method_id' => 0, // int required
            'date' => '2020-07-30 00:00:01', // datetime required
            'value ' => 0.0, // float required
            'notes' => 'p notes', // string
        ],
        exchange_currency_id => 0, // int
        exchange_rate => 0.0, //float
        notes => 'some notes', // string
        status => 1 int
	]
	*/

 	private $document_id;

    public function getDocumentId(): ?int
    {
        return $this->document_id;
    }

    public function setDocumentId(int $value = 0): self
    {
        $this->document_id = $value;
        return $this;
    }

    private $date;

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $value = null): self
    {
        $this->date = $value;
        return $this;
    }

    private $document_set_id;

    public function getDocumentSetId(): ?int
    {
        return $this->document_set_id;
    }

    public function setDocumentSetId(int $value = 0): self
    {
        $this->document_set_id = $value;
        return $this;
    }
    
    private $customer_id;

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $value): self
    {
        $this->customer_id = $value;
        return $this;
    }

    private $alternate_address_id;

    public function getAlternateAddressId(): ?int
    {
        return $this->alternate_address_id;
    }

    public function setAlternateAddressId(?int $value = null): self
    {
        $this->alternate_address_id = $value;
        return $this;
    }

 	private $net_value;

    public function getNetValue(): ?float
    {
        return $this->net_value;
    }

    public function setNetValue(float $value = 0.0): self
    {
        $this->net_value = $value;
        return $this;
    }

    private $associated_documents;

    public function getAssociatedDocuments(): ?array
    {
        return $this->associated_documents;
    }

    public function setAssociatedDocuments(array $value = []): self
    {
        $this->associated_documents = $value;
        return $this;
    }
    
    private $related_documents_notes;

    public function getRelatedDocumentsNotes(): ?string
    {
        return $this->related_documents_notes;
    }

    public function setRelatedDocumentsNotes(string $value = null): self
    {
        $this->related_documents_notes = $value;
        return $this;
    }

    private $payments;

    public function getPayments(): ?array 
    {
        return $this->payments;
    }

    public function setPayments(array $value = []): self
    {
        $this->payments = $value;
        return $this;
    }

    private $exchange_currency_id;

    public function getExchangeCurrencyId(): ?int
    {
        return $this->exchange_currency_id;
    }

    public function setExchangeCurrencyId(?int $value = null): self
    {
        $this->exchange_currency_id = $value;
        return $this;
    }

    private $exchange_rate;

    public function getExchangeRate(): ?float
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate(?float $value = null): self
    {
        $this->exchange_rate = $value;
        return $this;
    }

    private $notes;

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $value = null): self
    {
        $this->notes = $value;
        return $this;
    }

    private $status;

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $value = null): self
    {
        $this->status = $value;
        return $this;
    }

    /**
    To querie
    **/

    private $our_reference;

    public function getOurReference(): ?string
    {
        return $this->our_reference;
    }

    public function setOurReference(string $value = null): self
    {
        $this->our_reference = $value;
        return $this;
    }

    private $your_reference;

    public function getYourReference(): ?string
    {
        return $this->your_reference;
    }

    public function setYourReference(string $value = null): self
    {
        $this->your_reference = $value;
        return $this;
    }

    private $year;

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $value = 0): self
    {
        $this->year = $value;
        return $this;
    }

 	private $qty;

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $value = 0): self
    {
        $this->qty = $value;
        return $this;
    }

    private $offset = 0;

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(int $value = 0): self
    {
        $this->offset = $value;
        return $this;
    }

    private $number;

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $value = 0): self
    {
        $this->number = $value;
        return $this;
    }

    /**
    * Create Receipts in the Company
    * @return json
    * https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=376
    **/
    public function insert()
    {
        $required = [
            'company_id' => parent::getCompanyId(), //int required
            'date' => $this->getDate(), // date required
            'document_set_id' => $this->getDocumentSetId(), // int required
            'customer_id' => $this->getCustomerId(), // int required
            'net_value' => $this->getNetValue(),
            'payments' => $this->getPayments()
        ];

        $optional = [];
        if($this->getAlternateAddressId()!== null)
            $optional['alternate_address_id'] = $this->getAlternateAddressId();
        if(!empty($this->getAssociatedDocuments()))
            $optional['associated_documents'] = $this->getAssociatedDocuments();
        if($this->getRelatedDocumentsNotes() !== null)
            $optional['related_documents_notes'] = $this->getRelatedDocumentsNotes();
        if($this->getExchangeCurrencyId() !== null)
            $optional['exchange_currency_id'] = $this->getExchangeCurrencyId();
        if($this->getExchangeRate() !== null)
            $optional['exchange_rate'] = $this->getExchangeRate();
        if($this->getNotes() !== null)
            $optional['notes'] = $this->getNotes();// int
        if($this->getStatus() !== null)
            $optional['status'] = $this->getStatus();// int

        if(!empty($optional))
            $required = array_merge($required, $optional);

        return parent::curl(parent::getPath('insert'), $required);
    }

	/**
	* Count Receipts of the Company
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=379
	**/
	public function getCounter()
	{
		return parent::curl(parent::getPath('count'), [
			'company_id' => parent::getCompanyId(),
        	'customer_id' => $this->getCustomerId(), // int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

    /**
    * List Receipts of Company
    * @return json
    * https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=374
    **/
    public function getAll()
    {

        $params = ['company_id' => parent::getCompanyId(), //int required
            'qty' => $this->getQty(), //int
            'offset' => $this->getOffset() ?? 0, //int
        ];

        if(!is_null($this->getCustomerId()))
            $params['customer_id'] = $this->getCustomerId(); // int
        if(!is_null($this->getDocumentSetId()))
            $params['document_set_id'] = $this->getDocumentSetId(); // int
        if(!is_null($this->getNumber()))
            $params['number'] = $this->getNumber(); //int
        if(!is_null($this->getDate()))
            $params['date'] = $this->getDate(); // date
        if(!is_null($this->getYear()))
            $params['year'] = $this->getYear(); // int
        if(!is_null($this->getYourReference()))
            $params['your_reference'] = $this->getYourReference(); // string
        if(!is_null($this->getOurReference()))
            $params['our_reference'] = $this->getOurReference(); // string

        return parent::curl(parent::getPath('getAll'), $params);
    }

	/**
	* Get a Receipt
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=375
	**/
	public function getOne()
	{
		return  parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(), //int required
			'document_id' => $this->getId(), //int
			'customer_id' => $this->getCustomerId(), // int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* Update Receipts by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=377
	**/
	public function update()
	{
        $required = [
            'company_id' => parent::getCompanyId(), //int required
            'document_id' => $this->getDocumentId(), // int required
            'date' => $this->getDate(), // date required
            'document_set_id' => $this->getDocumentSetId(), // int required
            'customer_id' => $this->getCustomerId(), // int required
            'net_value' => $this->getNetValue(),
            'payments' => $this->getPayments()
        ];

        $optional = [];
        if($this->getAlternateAddressId()!== null)
            $optional['alternate_address_id'] = $this->getAlternateAddressId();
        if(!empty($this->getAssociatedDocuments()))
            $optional['associated_documents'] = $this->getAssociatedDocuments();
        if($this->getRelatedDocumentsNotes() !== null)
            $optional['related_documents_notes'] = $this->getRelatedDocumentsNotes();
        if($this->getExchangeCurrencyId() !== null)
            $optional['exchange_currency_id'] = $this->getExchangeCurrencyId();
        if($this->getExchangeRate() !== null)
            $optional['exchange_rate'] = $this->getExchangeRate();
        if($this->getNotes() !== null)
             $optional['notes'] = $this->getNotes();// int
        if($this->getStatus() !== null)
             $optional['status'] = $this->getStatus();// int

        if(!empty($optional))
            $required = array_merge($required, $optional);

        return parent::curl(parent::getPath('update'), $required);
	}

	/**
	* Delete a Receipt from the Company
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=378
	**/
	public function delete()
	{
		return  parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(), // int required
			'document_id' => $this->getId() // int required
		]);
	}
}