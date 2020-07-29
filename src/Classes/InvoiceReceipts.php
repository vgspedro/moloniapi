<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Invoice Receipts requests
*/

class InvoiceReceipts extends Authentication{

	/** @const entity api url */
	const ENTITY = '/invoiceReceipts/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/**
	InvoiceReceipts array data structure
	[
		'document_id' => // int required ON UPDATE only
		'date' => '2020-07-30', // date required
		'expiration_date' => '2020-07-30', // date required
		'maturity_date_id' => 0,// int
		'document_set_id' => 0, // int required
		'customer_id' => 0, // int required
		'alternate_address_id' => 0, // int
		'our_reference string' => 'ref', // string
		'your_reference string' => 0, // string
		'financial_discount' => 0.0, // float
		'eac_id' => 0, // int
		'salesman_id' => 0, // int
		'salesman_commission' => 0.0, // float
		'special_discount' => 0.0, // float float
		'associated_documents'  => [ // array
			'associated_id int' => 0.0, // int required
			'value' => 0.0, // float required
			],
		'related_documents_notes' => 'doc notes', // string

		'products' => [ // array required
			'product_id' => 0, // int required
			'name' => 'name', // string required
			'summary' => 'summary', // string
			'qty' => 0.0, // float required
			'price' => 5.0, // float required
			'discount' => 5.0, // float
			'deduction_id' => 0, //int
			'order' => 0, //int
			'origin_id' => 0, //int
			'exemption_reason' => 0, // string
			'warehouse_id' => 0, //int

			'taxes' => [ //array
				'tax_id' => 0, //int required
				'value' => 0.0, // float
				'order' => 0, //int
				'cumulative' => 0, //int
			],
			
            //NOT DONE START

            'child_products' => [ //array
				'product_id' => 0, //int required
				'name' => 'name', // string required
				'summary' => 'c_p summary', // string
				'qty' => 0.0, // float required
				'price float' => 0.0, // float required
				'discount' => 0.0, // float
				'deduction_id' => 0, // int
				'order' => 0, // int
				'origin_id' => 0, // int
				'exemption_reason' => '', // string
				'warehouse_id' => 0, // int
				
				'properties' => [ //array
					'title' => '', // string
					'value' => '', // string
				],
				'taxes' => [ // array
					'tax_id' => 0, // int required
					'value' => 0.0, // float
					'order' => 0, // int
					'cumulative' => 0, // int
				]
			],
            
            //NOT DONE END
        
        ],

		'payments' => [ //array required
			'payment_method_id' => 0, // int required
			'date' => '2020-07-30 00:00:01', // datetime required
			'value ' => 0.0, // float required
			'notes' => 'p notes', // string
		],
		'exchange_currency_id' => 0, //  int
		'exchange_rate' => 0.0, //  float
		'delivery_method_id' => 0, //  int
		'delivery_datetime' => '2020-07-30', //  date
		'delivery_departure_address' => '', //  string
		'delivery_departure_city' => '', //  string
		'delivery_departure_zip_code' => '', //  string
		'delivery_departure_country' => 0, //  int
		'delivery_destination_address' => '', //  string
		'delivery_destination_city' => '', //  string
		'delivery_destination_zip_code' => '', //  string
		'delivery_destination_country' => 0, //  int
		'vehicle_id' => 0, //  int
		'vehicle_name' => 0, //  string
		'vehicle_number_plate' => '00-00-TT', //  string
		'notes' => '', //  string
		'status' => '', //  int
		'generate_mb_reference' => '', // int
	]
	*/

    private $products_taxes_tax_id;
    
    public function getProductsTaxesTaxId()
    {
        return $this->products_taxes_tax_id;
    }

    public function setProductsTaxesTaxId(int $products_taxes_tax_id = 0)
    {
        $this->products_taxes_tax_id = $products_taxes_tax_id;
    }

    private $products_taxes_value;
    
    public function getProductsTaxesValue()
    {
        return $this->products_taxes_value;
    }

    public function setProductsTaxesValue(float $products_taxes_value = 0.0)
    {
        $this->products_taxes_value = $products_taxes_value;
    }


    private $products_taxes_order;
    
    public function getProductsTaxesOrder()
    {
        return $this->products_taxes_order;
    }

    public function setProductsTaxesOrder(int $products_taxes_order = 0)
    {
        $this->products_taxes_order = $products_taxes_order;
    }


    private $products_taxes_cumulative;
    
    public function getProductsTaxesCumulative()
    {
        return $this->products_taxes_cumulative;
    }

    public function setProductsTaxesCumulative(int $products_taxes_cumulative = 0)
    {
        $this->products_taxes_cumulative = $products_taxes_cumulative;
    }



    private $products_warehouse_id;

    public function getProductsWarehouseId()
    {
        return $this->products_warehouse_id;
    }

    public function setProductsWarehouseId(int $products_warehouse_id = 0)
    {
        $this->products_warehouse_id = $products_warehouse_id;
    }

    private $products_exemption_reason;

    public function getProductsExemptionReason()
    {
        return $this->products_exemption_reason;
    }

    public function setProductsExemptionReason(string $products_exemption_reason = null)
    {
        $this->products_exemption_reason = $products_exemption_reason;
    }

    private $products_origin_id;

    public function getProductsOriginId()
    {
        return $this->products_origin_id;
    }

    public function setProductsOriginId(int $products_origin_id = 0)
    {
        $this->products_origin_id = $products_origin_id;
    }

    private $products_order;

    public function getProductsOrder()
    {
        return $this->products_order;
    }

    public function setProductsOrder(int $products_order = 0)
    {
        $this->products_order = $products_order;
    }

    private $products_deduction_id;

    public function getProductsDeductionId()
    {
        return $this->products_deduction_id;
    }

    public function setProductsDeductionId(int $products_deduction_id = 0)
    {
        $this->products_deduction_id = $products_deduction_id;
    }

    private $products_discount;

    public function getProductsDiscount()
    {
        return $this->products_discount;
    }

    public function setProductsDiscount(float $products_discount = 0.0)
    {
        $this->products_discount = $products_discount;
    }

    private $products_price;

    public function getProductsPrice()
    {
        return $this->products_price;
    }

    public function setProductsPrice(float $products_price = 0.0)
    {
        $this->products_price = $products_price;
    }

    private $products_qty;

    public function getProductsQty()
    {
        return $this->products_qty;
    }

    public function setProductsQty(float $products_qty = 0.0)
    {
        $this->products_qty = $products_qty;
    }

    private $products_summary;

    public function getProductsSummary()
    {
        return $this->products_summary;
    }

    public function setProductsSummary(string $products_summary = null)
    {
        $this->products_summary = $products_summary;
    }

    private $products_name;

    public function getProductsName()
    {
        return $this->products_name;
    }

    public function setProductsName(string $products_name = null)
    {
        $this->products_name = $products_name;
    }

    private $products_product_id;

    public function getProductsProductId()
    {
        return $this->products_product_id;
    }

    public function setProductsProductId(int $products_product_id= 0)
    {
        $this->products_product_id = $products_product_id;
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

 	private $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(float $value = 0.0)
    {
        $this->value = $value;
    }

    private $our_reference;

    public function getOurReference()
    {
        return $this->our_reference;
    }

    public function setOurReference(string $our_reference = null)
    {
        $this->our_reference = $our_reference;
    }

    private $your_reference;

    public function getYourReference()
    {
        return $this->your_reference;
    }

    public function setYourReference(string $your_reference = null)
    {
        $this->your_reference = $your_reference;
    }

    private $year;

    public function getYear()
    {
        return $this->year;
    }

    public function setYear(int $year = 0)
    {
        $this->year = $year;
    }

    private $expiration_date;

    public function getExpirationDate()
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(string $expiration_date = null)
    {
        $this->expiration_date = $expiration_date;
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

    private $date;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string $date = null)
    {
        $this->date = $date;
    }

	private $number;

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber(int $number = 0)
    {
        $this->number = $number;
    }

	private $document_set_id;

    public function getDocumentSetId()
    {
        return $this->document_set_id;
    }

    public function setDocumentSetId(int $document_set_id = 0)
    {
        $this->document_set_id = $document_set_id;
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

	private $supplier_id;

    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    public function setSupplierId(int $supplier_id = 0)
    {
        $this->supplier_id = $supplier_id;
    }

	private $customer_id;

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id = 0)
    {
        $this->customer_id = $customer_id;
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

	private $alternate_address_id;

    public function getAlternateAddressId()
    {
        return $this->alternate_address_id;
    }

    public function setAlternateAddressId(int $alternate_address_id = 0)
    {
        $this->alternate_address_id = $alternate_address_id;
    }

	private $financial_discount;

    public function getFinancialDiscount()
    {
        return $this->financial_discount;
    }

    public function setFinancialDiscount(float $financial_discount = 0.0)
    {
        $this->financial_discount = $financial_discount;
    }

	private $eac_id;

    public function getEacId()
    {
        return $this->eac_id;
    }

    public function setEacId(int $eac_id = 0)
    {
        $this->eac_id = $eac_id;
    }

	private $salesman_commission;

    public function getSalesmanCommission()
    {
        return $this->salesman_commission;
    }

    public function setSalesmanCommission(float $salesman_commission = 0.0)
    {
        $this->salesman_commission = $salesman_commission;
    }

	private $special_discount;

    public function getSpecialDiscount()
    {
        return $this->special_discount;
    }

    public function setSpecialDiscount(float $special_discount = 0.0)
    {
        $this->special_discount = $special_discount;
    }

	private $associated_documents_associated_id;

    public function getAssociatedDocumentsAssociatedId()
    {
        return $this->associated_documents_associated_id;
    }

    public function setAssociatedDocumentsAssociatedId(int $associated_documents_associated_id = 0)
    {
        $this->associated_documents_associated_id = $associated_documents_associated_id;
    }

	private $associated_documents_value;

    public function getAssociatedDocumentsValue()
    {
        return $this->associated_documents_value;
    }

    public function setAssociatedDocumentsValue(float $associated_documents_value = 0.0)
    {
        $this->associated_documents_value = $associated_documents_value;
    }

	private $related_documents_notes;

    public function getRelateDocumentsNotes()
    {
        return $this->related_documents_notes;
    }

    public function setRelatedDocumentsNotes(string $related_documents_notes = null)
    {
        $this->related_documents_notes = $related_documents_notes;
    }

	private $exchange_currency_id;

    public function getExchangeCurrencyId()
    {
        return $this->exchange_currency_id;
    }

    public function setExchangeCurrencyId(int $exchange_currency_id = 0)
    {
        $this->exchange_currency_id = $exchange_currency_id;
    }

	private $exchange_rate;

    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate(float $exchange_rate = 0.0)
    {
        $this->exchange_rate = $exchange_rate;
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

	private $delivery_datetime;

    public function getDeliveryDatetime()
    {
        return $this->delivery_datetime;
    }

    public function setDeliveryDatetime(string $delivery_datetime = null)
    {
        $this->delivery_datetime = $delivery_datetime;
    }

	private $delivery_departure_address;

    public function getDeliveryDepartureAddress()
    {
        return $this->delivery_departure_address;
    }

    public function setDeliveryDepartureAddress(string $delivery_departure_address = null)
    {
        $this->delivery_departure_address = $delivery_departure_address;
    }

	private $delivery_departure_city;

    public function getDeliveryDepartureCity()
    {
        return $this->delivery_departure_city;
    }

    public function setDeliveryDepartureCity(string $delivery_departure_city = null)
    {
        $this->delivery_departure_city = $delivery_departure_city;
    }

	private $delivery_departure_zip_code;

    public function getDeliveryDepartureZipCode()
    {
        return $this->delivery_departure_zip_code;
    }

    public function setDeliveryDepartureZipCode(string $delivery_departure_zip_code = null)
    {
        $this->delivery_departure_zip_code = $delivery_departure_zip_code;
    }

	private $delivery_departure_country;

    public function getDeliveryDepartureCountry()
    {
        return $this->delivery_departure_country;
    }

    public function setDeliveryDepartureCountry(int $delivery_departure_country = 0)
    {
        $this->delivery_departure_country = $delivery_departure_country;
    }

	private $delivery_destination_address;

    public function getDeliveryDestinationAddress()
    {
        return $this->delivery_destination_address;
    }

    public function setDeliveryDestinationAddress(string $delivery_destination_address = null)
    {
        $this->delivery_destination_address = $delivery_destination_address;
    }

	private $delivery_destination_city;

    public function getDeliveryDestinationCity()
    {
        return $this->delivery_destination_city;
    }

    public function setDeliveryDestinationCity(string $delivery_destination_city = null)
    {
        $this->delivery_destination_city = $delivery_destination_city;
    }

	private $delivery_destination_zip_code;

    public function getDeliveryDestinationZipCode()
    {
        return $this->delivery_destination_zip_code;
    }

    public function setDeliveryDestinationZipCode(string $delivery_destination_zip_code = null)
    {
        $this->delivery_destination_zip_code = $delivery_destination_zip_code;
    }

	private $delivery_destination_country;

    public function getDeliveryDestinationCountry()
    {
        return $this->delivery_destination_country;
    }

    public function setDeliveryDestinationCountry(int $delivery_destination_country = 0)
    {
        $this->delivery_destination_country = $delivery_destination_country;
    }

	private $vehicle_id;

    public function getVehicleId()
    {
        return $this->vehicle_id;
    }

    public function setVehicleId(int $vehicle_id = 0)
    {
        $this->vehicle_id = $vehicle_id;
    }

	private $vehicle_name;

    public function getVehicleName()
    {
        return $this->vehicle_name;
    }

    public function setVehicleName(string $vehicle_name = null)
    {
        $this->vehicle_name = $vehicle_name;
    }

	private $vehicle_number_plate;

    public function getVehicleNumberPlate()
    {
        return $this->vehicle_number_plate;
    }

    public function setVehicleNumberPlate(string $vehicle_number_plate = null)
    {
        $this->vehicle_number_plate = $vehicle_number_plate;
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

	private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(int $status = 0)
    {
        $this->status = $status;
    }

	private $generate_mb_reference;

    public function getGenerateMbReference()
    {
        return $this->generate_mb_reference;
    }

    public function setGenerateMbReference(int $generate_mb_reference = 0)
    {
        $this->generate_mb_reference = $generate_mb_reference;
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


	private $payment_date;

    public function getPaymentDate()
    {
        return $this->payment_date;
    }

    public function setPaymentDate(string $payment_date = null)
    {
        $this->payment_date = $payment_date;
    }

	private $payment_value;

    public function getPaymentValue()
    {
        return $this->payment_value;
    }

    public function setPaymentValue(float $payment_value = 0.0)
    {
        $this->payment_value = $payment_value;
    }

	private $payment_notes;

    public function getPaymentNotes()
    {
        return $this->payment_notes;
    }

    public function setPaymentNotes(string $payment_notes = null)
    {
        $this->payment_notes = $payment_notes;
    }


    //If the InvoiveReceipt has Associated Documents build the array to update or insert
	private function hasAssociatedDocuments(){
		return $this->getAssociatedDocumentsAssociatedId() > 0 && $this->getAssociatedDocumentsValue() > 0 ?
	 		[
	 			'associated_id' => $this->getAssociatedDocumentsAssociatedId(),
	 			'value' => $this->getAssociatedDocumentsValue()
	 		]
	 	:
	 		[];
	}
    
    //If the InvoiveReceipt has ProductTaxes build the array to update or insert
    private function hasProductSTaxes(){
        return $this->getProductsTaxesTaxId() > 0 ?
            [
                'tax_id' =>  $this->getProductsTaxesTaxId(), //int required
                'value' =>  $this->getProductsTaxesValue(), // float
                'order' =>  $this->getProductsTaxesOrder(), //int
                'cumulative' =>  $this->getProductsTaxesCumulative() //int
            ]
        :
            [];
    }

	/**
	* Count InvoiceReceipts of the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=379
	**/
	public function getCounter()
	{
		return parent::curl(parent::getPath('count'), [
			'company_id' => parent::getCompanyId(),
        	'customer_id' => $this->getCustomerId(), // int
       		'supplier_id' => $this->getSupplierId(), // int
        	'salesman_id' => $this->getSalesmanId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* List InvoiceReceipts of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=374
	**/
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId(), //int required
			'qty' => $this->getQty(), //int
			'offset' => $this->getOffset(), //int
			'customer_id' => $this->getCustomerId(), // int
       		'supplier_id' => $this->getSupplierId(), // int
        	'salesman_id' => $this->getSalesmanId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* Get a InvoiceReceipt by Id 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=375
	**/
	public function getById()
	{
		return  parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(), //int required
			'document_id' => $this->getId(), //int
			'customer_id' => $this->getCustomerId(), // int
       		'supplier_id' => $this->getSupplierId(), // int
        	'salesman_id' => $this->getSalesmanId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int
        	'number' => $this->getNumber(), //int
        	'date' => $this->getDate(), // date
        	'expiration_date' => $this->getExpirationDate(), // date
        	'year' => $this->getYear(), // int
        	'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference() // string
		]);
	}

	/**
	* Create InvoiceReceipts in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=376
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(), //int required
			'date' => $this->getDate(), // date required
        	'expiration_date' => $this->getExpirationDate(), // date required
        	'maturity_date_id' => $this->getMaturityDateId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int required
        	'customer_id' => $this->getCustomerId(), // int required
			'alternate_address_id' => getAlternateAddressId(), // int
			'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference(), // string
    		'financial_discount' => $this->getFinancialDiscount(), // float
			'eac_id' => $this->getEacId(), // int
			'salesman_id' => $this->getSalesmanId(), // int
			'salesman_commission' => $this->getSalesmanCommission(), // float
			'special_discount' => $this->getSpecialDiscount(), // float
			'associated_documents' => $this->hasAssociatedDocuments(), // array
			'related_documents_notes' => $this->getRelateDocumentsNotes(), // string

            'products' => [ // array required
                'product_id' => $this->getProductsProductId(), // int required
                'name' => $this->getProductsName(), // string required
                'summary' => $this->getProductsSummary(), // string
                'qty' => $this->getProductsQty(), // float required
                'price' => $this->getProductsPrice(), // float required
                'discount' => $this->getProductsDiscount(), // float
                'deduction_id' => $this->getProductsDeductionId(), //int
                'order' => $this->getProductsOrder(), //int
                'origin_id' => $this->getProductsOriginId(), //int
                'exemption_reason' => $this->getProductsExemptionReason(), // string
                'warehouse_id' => $this->getProductsWarehouseId(), //int
                'taxes' => $this->hasProductsTaxes(), //array            
            ],

			'payments' => [ //array required
				'payment_method_id' => $this->getPaymentMethodId(), // int required
				'date' => $this->getPaymentDate(), // datetime required
				'value' => $this->getPaymentValue(), // float required
				'notes' => $this->getPaymentNotes(), // string

			],


			'exchange_currency_id' => $this->getExchangeCurrencyId(), //int
			'exchange_rate' => $this->getExchangeRate(), //float 
			'delivery_method_id' => $this->getDeliveryMethodId(),//int'
			'delivery_datetime' => $this->getDeliveryDatetime(),//datetime'
			'delivery_departure_address' => $this->getDeliveryDepartureAdress(),// string
			'delivery_departure_city' => $this->getDeliveryDepartureCity(), //string
			'delivery_departure_zip_code' => $this->getDeliveryDepartureZipCode(), //string
			'delivery_departure_country' => $this->getDeliveryDepartureCountry(), //string
			'delivery_destination_address' => $this->getDeliveryDestinationAddress(),// string
			'delivery_destination_city' => $this->getDeliveryDestinationCity(), //string
			'delivery_destination_zip_code' => $this->getDeliveryDestinationZipCode(), //string
			'delivery_destination_country' => $this->getDeliveryDestinationCountry(), //string
			'vehicle_id' => $this->getVehicleId(),// int
			'vehicle_name' => $this->getVehicleName(),// string
			'vehicle_number_plate' => $this->getVehicleNumberPlate(),// string
			'notes' => $this->getNotes(), // string
			'status' => $this->getStatus(),// int
			'generate_mb_reference' => $this->getGenerateMbReference()// int

		]);
	}

	/**
	* Update InvoiceReceipts by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=377
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(), // int required
			'document_id' => $this->getId(), // int required
			'date' => $this->getDate(), // date required
        	'expiration_date' => $this->getExpirationDate(), // date required
        	'maturity_date_id' => $this->getMaturityDateId(), //int
        	'document_set_id' => $this->getDocumentSetId(), // int required
        	'customer_id' => $this->getCustomerId(), // int required
			'alternate_address_id' => getAlternateAddressId(), // int
			'your_reference' => $this->getYourReference(), // string
    		'our_reference' => $this->getOurReference(), // string
    		'financial_discount' => $this->getFinancialDiscount(), // float
			'eac_id' => $this->getEacId(), // int
			'salesman_id' => $this->getSalesmanId(), // int
			'salesman_commission' => $this->getSalesmanCommission(), // float
			'special_discount' => $this->getSpecialDiscount(), // float
			'associated_documents' => $this->hasAssociatedDocuments(), // array
			'related_documents_notes' => $this->getRelateDocumentsNotes(), // string

            'products' => [ // array required
                'product_id' => $this->getProductsProductId(), // int required
                'name' => $this->getProductsName(), // string required
                'summary' => $this->getProductsSummary(), // string
                'qty' => $this->getProductsQty(), // float required
                'price' => $this->getProductsPrice(), // float required
                'discount' => $this->getProductsDiscount(), // float
                'deduction_id' => $this->getProductsDeductionId(), //int
                'order' => $this->getProductsOrder(), //int
                'origin_id' => $this->getProductsOriginId(), //int
                'exemption_reason' => $this->getProductsExemptionReason(), // string
                'warehouse_id' => $this->getProductsWarehouseId(), //int
                'taxes' => $this->hasProductsTaxes(), //array
            ],

			'payments' => [ //array required
				'payment_method_id' => $this->getPaymentMethodId(), // int required
				'date' => $this->getPaymentDate(), // datetime required
				'value' => $this->getPaymentValue(), // float required
				'notes' => $this->getPaymentNotes(), // string
			],
			
			'exchange_currency_id' => $this->getExchangeCurrencyId(), //int
			'exchange_rate' => $this->getExchangeRate(), //float 
			'delivery_method_id' => $this->getDeliveryMethodId(),//int'
			'delivery_datetime' => $this->getDeliveryDatetime(),//datetime'
			'delivery_departure_address' => $this->getDeliveryDepartureAdress(),// string
			'delivery_departure_city' => $this->getDeliveryDepartureCity(), //string
			'delivery_departure_zip_code' => $this->getDeliveryDepartureZipCode(), //string
			'delivery_departure_country' => $this->getDeliveryDepartureCountry(), //string
			'delivery_destination_address' => $this->getDeliveryDestinationAddress(),// string
			'delivery_destination_city' => $this->getDeliveryDestinationCity(), //string
			'delivery_destination_zip_code' => $this->getDeliveryDestinationZipCode(), //string
			'delivery_destination_country' => $this->getDeliveryDestinationCountry(), //string
			'vehicle_id' => $this->getVehicleId(),// int
			'vehicle_name' => $this->getVehicleName(),// string
			'vehicle_number_plate' => $this->getVehicleNumberPlate(),// string
			'notes' => $this->getNotes(), // string
			'status' => $this->getStatus(),// int
			'generate_mb_reference' => $this->getGenerateMbReference()// int

		]);

	}

	/**
	* Delete a Tax from the Company 
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

	/**
	* Generates a new ATM reference associated with this document, at the requested amount.
	* You need to have an ATM reference generation system set up in the company, and the document in question must be closed (status = 1).
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=438
	**/
	public function generateMBReference()
	{
		return  parent::curl(parent::getPath('generateMBReference'), [
			'company_id' => parent::getCompanyId(), //int required
			'document_id' => $this->getId(), // int required
			'value' => $this->getValue(), // float required
		]);
	}




}