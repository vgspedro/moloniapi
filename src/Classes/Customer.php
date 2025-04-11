<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class for CRUD the Customer requests
 */

class Customer extends Authentication{

	/** @const entity api url */
	const ENTITY = '/customers/';
	/** @const access api url */
	const ACCESS = '/?access_token=';
	
	/**
	Customer array data structure
	[
		'customer_id' => 0, // int required ON UPDATE only $this->getAll()
		'vat' => '100200300', //string required
		'number' => 'our client reference', // string (max 20) required
		'name' => 'Name of fiscal number owner', //string required
		'language_id' => 1, // int required 1=>PT, 2=>EN, 3=>ES
		'address' => 'Fiscal Address', // string required
		'zip_code' => 'Fiscal zip code', // string if country_id = 1 then 0000-000
		'city' => 'Fiscal City', //string required
		'country_id' =>  0, // int required GlobalData->getCountries()
		'email' => '',// string
		'website' => '',// string
		'phone' => '',// string
		'fax' => '',// string
		'contact_name' => '',// string
		'contact_email' => '',// string
		'contact_phone' => '',// string
		'notes' => '',// string
		'salesman_id' => 0, // int
		'price_class_id' => 0 , // int
		'maturity_date_id' => 0, // int required MaturityDates->getAll()
		'payment_day' => 0, // int
		'discount' => 0.0, // float
		'credit_limit' => 0.0, // float,
		'copies'=> [
			'document_type_id' => 0, // int required DocumentType->getAll()
			'copies' => 3, // int required
		],
		'payment_method_id' =>  0, // int required PaymentMethod->getAll()
		'delivery_method_id' => 0, // int,
		'field_notes' => '',// string
	]
	**/

	private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id = 0)
    {
        $this->id = $id;
    }

    private $vat;

    public function getVat()
    {
        return $this->vat;
    }

    public function setVat(string $vat = null)
    {
        $this->vat = $vat;
    }

    private $number;

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber(string $number = null)
    {
        $this->number = $number;
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

    private $language_id;

    public function getLanguageId()
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id = 1)
    {
        $this->language_id = $language_id;
    }

    private $address;

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address = null)
    {
        $this->address = $address;
    }

    private $zip_code;

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code = '0000-000')
    {
        $this->zip_code = $zip_code;
    }

    private $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(string $city = null)
    {
        $this->city = $city;
    }

    private $country_id;

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id = 1)
    {
        $this->country_id = $country_id;
    }

    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email = null)
    {
        $this->email = $email;
    }

    private $website;

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite(string $website = null)
    {
        $this->website = $website;
    }

    private $phone;

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;
    }

    private $fax;

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax(string $fax = null)
    {
        $this->fax = $fax;
    }

	private $contact_name;

    public function getContactName()
    {
        return $this->contact_name;
    }

    public function setContactName(string $contact_name = null)
    {
        $this->contact_name = $contact_name;
    }

	private $contact_email;

    public function getContactEmail()
    {
        return $this->contact_email;
    }

    public function setContactEmail(string $contact_email = null)
    {
        $this->contact_email = $contact_email;
    }

	private $contact_phone;

    public function getContactPhone()
    {
        return $this->contact_phone;
    }

    public function setContactPhone(string $contact_phone = null)
    {
        $this->contact_phone = $contact_phone;
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

	private $salesman_id;

    public function getSalesmanId()
    {
        return $this->salesman_id;
    }

    public function setSalesmanId(int $salesman_id = 0)
    {
        $this->salesman_id = $salesman_id;
    }

	private $price_class_id;

    public function getPriceClassId()
    {
        return $this->price_class_id;
    }

    public function setPriceClassId(int $price_class_id = 0)
    {
        $this->price_class_id = $price_class_id;
    }

	private $maturity_date_id;

    public function getMaturityDateId()
    {
        return $this->maturity_date_id;
    }

    public function setMaturityDateId(int $maturity_date_id = 0)
    {
        $this->maturity_date_id = $maturity_date_id;
    }

	private $payment_day;

    public function getPaymentDay()
    {
        return $this->payment_day;
    }

    public function setPaymentDay(int $payment_day = 0)
    {
        $this->payment_day = $payment_day;
    }

	private $discount;

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount(float $discount = 0.0)
    {
        $this->discount = $discount;
    }

	private $credit_limit;

    public function getCreditLimit()
    {
        return $this->credit_limit;
    }

    public function setCreditLimit(float $credit_limit = 0.0)
    {
        $this->credit_limit = $credit_limit;
    }

	private $copies_document_type_id;

    public function getCopiesDocumentTypeId()
    {
        return $this->copies_document_type_id;
    }

    public function setCopiesDocumentTypeId(int $copies_document_type_id = 0)
    {
        $this->copies_document_type_id = $copies_document_type_id;
    }

	private $copies_copies;

    public function getCopiesCopies()
    {
        return $this->copies_copies;
    }

    public function setCopiesCopies(int $copies_copies = 3)
    {
        $this->copies_copies = $copies_copies;
    }

	private $payment_method_id;

    public function getPaymentMethodId()
    {
        return $this->payment_method_id;
    }

    public function setPaymentMethodId(int $payment_method_id = 0)
    {
        $this->payment_method_id = $payment_method_id;
    }

	private $delivery_method_id;

    public function getDeliveryMethodId()
    {
        return $this->delivery_method_id;
    }

    public function setDeliveryMethodId(int $delivery_method_id = 0)
    {
        $this->delivery_method_id = $delivery_method_id;
    }

	private $field_notes;

    public function getFieldNotes()
    {
        return $this->field_notes;
    }

    public function setFieldNotes(string $field_notes = null)
    {
        $this->field_notes = $field_notes;
    }

    private $search;

    public function getSearch()
    {
        return $this->search;
    }

    public function setSearch(string $search = null )
    {
        $this->search = $search;
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

    private $offset;

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset(int $offset = 0)
    {
        $this->offset = $offset;
    }

	/**
	* Count all Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCounter()
    {	
		return parent::curl(parent::getPath('count'), [
            'company_id' => parent::getCompanyId()
        ]);
	}
	
	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getAll()
    {
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId()
		]); 
	}

	/**
	* Create a new Customer in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
			'vat' => $this->getVat(), 
			'number' => $this->getNumber(),
			'name' => $this->getName(),
			'language_id' => $this->getLanguageId(),
			'address' => $this->getAddress(),
			'zip_code' => $this->getZipCode(),
			'city' => $this->getCity(),
			'country_id' => $this->getCountryId(),
			'email' => $this->getEmail(),
			'website' => $this->getWebsite(),
			'phone' => $this->getPhone(),
			'fax' => $this->getFax(),
			'contact_name' => $this->getContactName(),
			'contact_email' => $this->getContactEmail(),
			'contact_phone' => $this->getContactPhone(),
			'notes' => $this->getNotes(),
			'salesman_id' => $this->getSalesmanId(),
			'price_class_id' => $this->getPriceClassId(),
			'maturity_date_id' => $this->getMaturityDateId(),
			'payment_day' => $this->getPaymentDay(),
			'discount' => $this->getDiscount(),
			'credit_limit' => $this->getCreditLimit(),
			'copies'=> [
				'document_type_id' => $this->getCopiesDocumentTypeId(),
				'copies' => $this->getCopiesCopies()
			],
			'payment_method_id' => $this->getPaymentMethodId(),
			'delivery_method_id' => $this->getDeliveryMethodId(),
			'field_notes' => $this->getFieldNotes()
		]);
	}

	/**
	* Get Customer by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getById()
	{
		return parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $this->getId()
		]);
	}

	/**
	* Get Customer by Vat
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	public function getByVat()
	{
		return parent::curl(parent::getPath('getByVat'), [
			'company_id' => parent::getCompanyId(),
			'vat' => $this->getVat()
		]);
	}

    /**
    * Get Customer by number, fiscal number or name
    * @return json 
    * https://www.moloni.pt/dev/entities/customers/getbysearch/
    **/
    public function getBySearch()
    {
        $params = ['company_id' => parent::getCompanyId(), //int required
            'qty' => $this->getQty(),
            'offset' => $this->getOffset() ?? 0
        ];

        if(!is_null($this->getSearch()))
            $params['search'] = $this->getSearch();

        return parent::curl(parent::getPath('getBySearch'), $params);
    }

	/**
	* Update Customer by Id
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $this->getId(),
			'vat' => $this->getVat(), 
			'number' => $this->getNumber(),
			'name' => $this->getName(),
			'language_id' => $this->getLanguageId(),
			'address' => $this->getAddress(),
			'zip_code' => $this->getZipCode(),
			'city' => $this->getCity(),
			'country_id' => $this->getCountryId(),
			'email' => $this->getEmail(),
			'website' => $this->getWebsite(),
			'phone' => $this->getPhone(),
			'fax' => $this->getFax(),
			'contact_name' => $this->getContactName(),
			'contact_email' => $this->getContactEmail(),
			'contact_phone' => $this->getContactPhone(),
			'notes' => $this->getNotes(),
			'salesman_id' => $this->getSalesmanId(),
			'price_class_id' => $this->getPriceClassId(),
			'maturity_date_id' => $this->getMaturityDateId(),
			'payment_day' => $this->getPaymentDay(),
			'discount' => $this->getDiscount(),
			'credit_limit' => $this->getCreditLimit(),
			'copies'=> [
				'document_type_id' => $this->getCopiesDocumentTypeId(),
				'copies' => $this->getCopiesCopies()
			],
			'payment_method_id' => $this->getPaymentMethodId(),
			'delivery_method_id' => $this->getDeliveryMethodId(),
			'field_notes' => $this->getFieldNotes()
		]);
	}

	/**
	* Delete Customer by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=206
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'customer_id' => $this->getId()
		]);
	}

}