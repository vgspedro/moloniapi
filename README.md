
# Moloni V1 API PHP Wrapper Library

## Work in progress.

## How to use

This library is installed via [Composer](http://getcomposer.org/).

composer require vgspedro/moloniapi:dev-master

## Symfony framework

#### Create the Controler

# src/Controler/InvoicingController.php

```php
<?php
namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use \VgsPedro\MoloniApi\Authentication;
use \VgsPedro\MoloniApi\Classes\Customer;
use \VgsPedro\MoloniApi\Classes\DeliveryMethods;
use \VgsPedro\MoloniApi\Classes\GlobalData;
use \VgsPedro\MoloniApi\Classes\MaturityDates;
use \VgsPedro\MoloniApi\Classes\MeasurementUnits;
use \VgsPedro\MoloniApi\Classes\PaymentMethods;
use \VgsPedro\MoloniApi\Classes\Product;
use \VgsPedro\MoloniApi\Classes\ProductCategories;
use \VgsPedro\MoloniApi\Classes\Taxes;

class InvoiceMoloni
{

	private $credencials;
	private $session;

    public function __construct(ParameterBagInterface $environment, SessionInterface $session){

		$this->credencials = [];

		$this->session = $session;

		if($environment->get("kernel.environment") == 'prod'){
			$this->credencials['company_id'] = 5 ; //Change according to specific user //  Company ID, Provided by Moloni
		 	$this->credencials['url'] = 'https://api.moloni.pt/v1'; // Url to make request, sandbox or live (sandbox APP_ENV=dev or test) (live APP_ENV=prod)
		}
		
		else{
			$this->credencials['company_id'] = 5 ; //Change according to specific user // Company ID, Provided by Moloni
		 	$this->credencials['url'] = 'https://api.moloni.pt/sandbox'; // Url to make request, sandbox or live (sandbox APP_ENV=dev or test) (live APP_ENV=prod)
		}
		
		$this->credencials['client_id'] = ''; // Client ID, Provided by Moloni
		$this->credencials['client_secret'] = ''; // Client Secret, Provided by Moloni
    	$this->credencials['opendoc'] = true; // On generate invoice set to provisory or definitiv
    	$this->credencials['username'] = 'email@gmail.com'; // Username, that allows access to Moloni (login page)
 		$this->credencials['password'] = 'pass23'; // Password, that allows access to Moloni (login page)
    	$this->credencials['token']['access_token'] = $this->session->get('access_token');
    	$this->credencials['token']['expires_in'] = $this->session->get('expires_in');
    	$this->credencials['token']['refresh_token'] = $this->session->get('refresh_token');
    }

	/**
	* Create a new access token or use the existing one if valid 
	* @return boolean
	* https://www.moloni.pt/dev
	**/
	public function start(){

   		$now = new \DateTime();

		//Access token expired or not
		if($this->credencials['token']['access_token'] && $this->credencials['token']['expires_in'] > $now->format('U'))
			return true;
		
		//Access token expired get a new one
		$token = (new Authentication())
			->login($this->credencials);
		
		if($token['status'] == 0)
			return null;
   		
   		$this->session->set('access_token', $token['data']->access_token);
   		//Removed 5 seconds from the current expire value ( 3600 - 5)
   		//The session expires_in in seconds
   		$this->session->set('expires_in', $now->format('U') + $token['data']->expires_in - 5 );
   		$this->session->set('refresh_token', $token['data']->refresh_token);

		//Set the values on the array, on 1st request is neeeded
		$this->credencials['token']['access_token'] = $this->session->get('access_token');
		$this->credencials['token']['expires_in'] = $this->session->get('expires_in');
    	$this->credencials['token']['refresh_token'] = $this->session->get('refresh_token');
		
		return true;
	}

	#####
	## TAXES METHODS
	#####

	/**
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes()
	{
		return $this->start() 
		? 
			(new Taxes())->getTaxes($this->credencials)
		:
			false;
	}

	/**
	* Create Tax in the Company 
	* @param array $t tax information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax(array $t = [])
	{
		return $this->start() 
		?  
			(new Taxes())->setTaxes($this->credencials, $t)
		:
			false;
	}

	/**
	* Update Tax by Id
	* @param array $t Tax information // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=264
	**/
	public function updateTax(array $t = [])
	{
		return $this->start()
		?  
			(new Taxes())->updateTax($this->credencials, $t)
		:
			false;
	}

	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTax(int $tax_id = 0)
	{
		return $this->start() 
		?  
			(new Taxes())->deleteTax($this->credencials, $tax_id)
		:
			false;
	}

	#####
	## GLOBALDATA METHODS
	#####

	/**
	* List Countries available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=68
	**/
	public function getCountries()
	{
		return $this->start() 
		?
			(new GlobalData())->getCountries($this->credencials)
		:
			false;
	}

	/**
	* List Languages available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=70
	**/
	public function getLanguages()
	{
		return $this->start() 
		?
			(new GlobalData())->getLanguages($this->credencials)
		:
			false;
	}

	/**
	* List Currencies available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=101
	**/
	public function getCurrencies()
	{
		return $this->start() 
		?
			(new GlobalData())->getCurrencies($this->credencials)
		:
			false;
	}

	/**
	* List of Fiscal Zones available in Moloni
	* @param int $id country_id  // $this->getCountries()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=69
	**/
	public function getFiscalZones(int $id = 0)
	{
		return $this->start() 
		?
			(new GlobalData())->getFiscalZones($this->credencials, $id)
		:
			false;
	}

	#####
	## CUSTOMERS METHODS
	#####

	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomerCount(){
		return $this->start() 
		? 
			(new Customer())->getCustomerCount($this->credencials)
		:
			false;
	}

	/**
	* Create Customer in the Company 
	* @param array $a Customer information 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function setCustomer(array $a = []){
		return $this->start() 
		?
			(new Customer())->setCustomer($this->credencials, $a)
		:
			false;
	}

	/**
	* Get Customer by Id
	* @param int $id Customer Id // $this->getCustomerByVat(string $vat)
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(int $id = 0)
	{
		return $this->start() 
		? 
			(new Customer())->getCustomerById($this->credencials, $id)
		:
			false;
	}

	/**
	* Get Customer by Vat
	* @param string $vat Customer Vat // '123456789'
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	
	public function getCustomerByVat(string $vat = null)
	{
		return $this->start() 
		? 
			(new Customer())->getCustomerByVat($this->credencials, $vat)
		:
			false;
	}

	/**
	* Update Customer by Id
	* @param array $a Customer information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function updateCustomerById(array $a = [])
	{
		return $this->start() 
		?
			(new Customer())->updateCustomerById($this->credencials, $a)
		:
			false;
	}


	#####
	## PAYMENTMETHODS METHODS
	#####

	/**
	* List Payment Methods of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=236
	**/
	public function getPaymentMethods()
	{
		return $this->start() 
		?
			(new PaymentMethods())->getPaymentMethods($this->credencials)
		:
			false;
	}

	/**
	* Create Payment Methods
	* @param array $pm Payment Methods
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function setPaymentMethods(array $pm = [])
	{
		return $this->start()
		?
			(new PaymentMethods())->setPaymentMethods($this->credencials, $pm)
		:
			false;
	}

	/**
	* Delete Payment Methods from the Company 
	* @param int $payment_method_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=239
	**/
	public function deletePaymentMethods(int $payment_method_id = 0)
	{
		return $this->start() 
		?
			(new PaymentMethods())->deletePaymentMethods($this->credencials, $payment_method_id)
		:
			false;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $pm PaymentMethods // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function updatePaymentMethods(array $pm = [])
	{
		return $this->start() 
		?
			(new PaymentMethods())->updatePaymentMethods($this->credencials, $pm)
		:
			false;
	}


	#####
	## MATURITYDATES METHODS
	#####

	/**
	* List MaturityDates in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=240
	**/
	public function getMaturityDates()
	{
		return $this->start()
		?
			(new MaturityDates())->getMaturityDates($this->credencials)
		:
			false;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function updateMaturityDates(array $md = [])
	{
		return $this->start() 
		?
			(new MaturityDates())->updateMaturityDates($this->credencials, $md)
		:
			false;
	}

	/**
	* Delete Maturity Dates from the Company 
	* @param int $maturity_dates_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function deleteMaturityDates(int $maturity_dates_id = 0)
	{
		return $this->start() 
		?
			(new MaturityDates())->deleteMaturityDates($this->credencials, $maturity_dates_id)
		:
			false;
	}

	/**
	* Update MaturityDates by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function setMaturityDates(array $md = [])
	{
		return $this->start()
		?
			(new MaturityDates())->setMaturityDates($this->credencials, $md)
		:
			false;
	}

	#####
	## DELIVERYMETHODS METHODS
	#####

	/**
	* List Delivery Methods in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=249
	**/
	public function getDeliveryMethods()
	{
		return $this->start()
		?
			(new DeliveryMethods())->getDeliveryMethods($this->credencials)
		:
			false;
	}

	/**
	* Update Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=251
	**/
	public function updateDeliveryMethods(array $dm = [])
	{
		return $this->start()
		?
			(new DeliveryMethods())->updateDeliveryMethods($this->credencials, $dm)
		:
			false;
	}

	/**
	* Delete Delivery Methods from the Company 
	* @param int $delivery_methods_id // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=252
	**/
	public function deleteDeliveryMethods(int $delivery_methods_id = 0)
	{

		return $this->start()
		?
			(new DeliveryMethods())->deleteDeliveryMethods($this->credencials, $delivery_methods_id)
		:
			false;
	}

	/**
	* Create Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=250
	**/
	public function setDeliveryMethods(array $dm = [])
	{
		return $this->start()
		?
			(new DeliveryMethods())->setDeliveryMethods($this->credencials, $dm)
		:
			false;
	}

	#####
	## PRODUCTCATEGORIES METHODS
	#####

	/**
	* List Product Categories in the Company 
	* @param int $parent_id required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=188
	**/
	public function getProductCategories(int $parent_id = 0)
	{
		return $this->start()
		?
			(new DeliveryMethods())->getProductCategories($this->credencials, $parent_id)
		:
			false;
	}

	/**
	* Update Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=190
	**/
	public function updateProductCategories(array $pc = [])
	{
		return $this->start()
		?
			(new ProductCategories())->updateProductCategories($this->credencials, $pc)
		:
			false;
	}

	/**
	* Delete Product Categories from the Company 
	* @param int $product_categories_id // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function deleteProductCategories(int $product_categories_id = 0)
	{
		return $this->start()
		? 
			(new ProductCategories())->deleteProductCategories($this->credencials, $product_categories_id)
		:
			false;
	}

	/**
	* Create Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=189
	**/
	public function setProductCategories(array $pc = [])
	{
		return $this->start()
		? 
			(new ProductCategories())->setProductCategories($this->credencials, $pc)
		:
			false;
	}

	#####
	## PRODUCT METHODS
	#####

	/**
	* Get Product by Id
	* @param int $product_id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getProductById(int $product_id = 0, int $with_invisible = 0)
	{
		return $this->start()
		? (new Product())
			->getProductById($this->credencials, $product_id, $with_invisible)
		:
			false;
	}

	/**
	* List Products by Reference
	* @param string $reference required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=298
	**/
	public function getProductsByReference(string $reference =  null, int $qty = 0, int $offset = 0)
	{
		return $this->start()
		?
			(new Product())->getProductsByReference($this->credencials, $reference, $qty, $offset)
		:
			false;
	}

	/**
	* List Products by EAN
	* @param string $ean required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=299
	**/
	public function getProductsByEan(string $ean = null, int $qty = 0, int $offset = 0)
	{
		return $this->start()
		?
			(new Product())->getProductsByEan($this->credencials, $ean, $qty, $offset)
		:
			false;
	}

	/**
	* List Products by name
	* @param string $name required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=297
	**/
	public function getProductsByName(string $name = null, int $qty = 0, int $offset = 0)
	{
		return $this->start()
		?
			(new Product())->getProductsByName($this->credencials, $name, $qty, $offset)
		:
			false;
	}

	/**
	* List Products in the Company
	* @param int $category_id required // $this->getProductCategories()
	* @param int $qty 
	* @param int $offset
	* @param int $with_invisible
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=192
	**/
	public function getProducts(int $category_id = 0, int $qty = 0, int $offset = 0, int $with_invisible = 0)
	{
		return $this->start()
		?
			(new Product())->getProducts($this->credencials, $category_id, $qty, $offset, $with_invisible)
		:
			false;
	}

	/**
	* Create Product in the Company 
	* @param array $p product required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=194
	**/
	public function setProduct(array $p = [])
	{
		return $this->start()
		?
			(new Product())->setProduct($this->credencials, $p)
		:
			false;
	}

	/**
	* Update Product in the Company 
	* @param array $p product required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=195
	**/
	public function updateProduct(array $p = [])
	{
		return $this->start()
		?
			(new Product())->updateProduct($this->credencials, $p)
		:
			false;
	}

	#####
	## MEASUREMENT UNITS METHODS
	#####

	/**
	* List of Measurement Units in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=266
	**/
	public function getMeasurementUnits(){
		return $this->start()
		?
			(new MeasurementUnits())->getMeasurementUnits($this->credencials)
		:
			false;
	}

	/**
	* Create Measurement Units in the Company 
	* @param array $mu Measurement Units required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits(array $mu = [])
	{
		return $this->start()
		?
			(new MeasurementUnits())->setMeasurementUnits($this->credencials, $mu)
		:
			false;
	}

	/**
	* Update Measurement Units in the Company 
	* @param array $mu Measurement Units required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits(array $mu = [])
	{
		return $this->start()
		?
			(new MeasurementUnits())->updateMeasurementUnits($this->credencials, $mu)
		:
			false;
	}

	/**
	* Delete Measurement Units in the Company 
	* @param int $unit_id Measurement Unit Id required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits(int $unit_id = 0)
	{
		return $this->start()
		?
			(new MeasurementUnits())->deleteMeasurementUnits($this->credencials, $unit_id)
		:
			false;
	}

}
```

#### Create a Customer, Tax, Product, 

```php
 $customer = [
            'vat' => 123456789,
            'language_id' => 1, //$moloni->getLanguages()
            'cid' => '0',
            'name' => 'Client Name2',
            'address' => 'Client Address',
            'city' => 'Client City',
            'zip_code' => '0000-000',
            'country_fiscal_id' => 1, // $moloni->getCountries()
            'discount' => '0.00',
            'credit_limit'=> '0.00',
            'payment_day' => 0,
            'maturity_date_id' => 871549, //$moloni->getMaturityDates()
            'qty_copies_document' => 3,
            'payment_method_id' => 939112, //$moloni->getPaymentMethods()
            'copies' => [
                'document_type_id' => 1,
                'copies' => 3,
            ],
            'delivery_method_id' => 973451, //$moloni->deliveryMethods()
            'salesman_id' => 0
        ];

        $tax = [
            'name' => 'Tx.Iva Intermédia 13', 
            'value' => 13,
            'type' => 1,
            'saft_type' => 1,
            'vat_type' => 'OUT', // ["RED","INT","NOR","ISE","OUT"]"
            'stamp_tax' => '',
            'exemption_reason' => '',
            'fiscal_zone' => 'PT', //$moloni->getFiscalZones($id)
            'active_by_default' => 0
        ];

        $product = [
            'category_id' => 2502976,//int required $this->getProductCategories()
            'type' => 2,//int required [1 Produto, 2 Serviço, 3 Outro].
            'name' => 'Viagem ao centro da Terra II',//string required
            'summary' => '',// string
            'reference' => '977970041',// string required should be uniq
            'ean' => '561000',// string
            'price' => 368.12, //float required
            'unit_id' => 1218021, //int required
            'has_stock' => 0, //int required
            'stock' => 0.0, //float required
            'minimum_stock' => 0.0, //float required
            'pos_favorite' => 0, //int
            'at_product_category' => '', //string
            'exemption_reason' => 'BK', //string
            'taxes' => [
                'tax_id' => 1997575, //int required $this->getTaxes()
                'value' => 0.84906, //float required
                'order' => 1, //int required
                'cumulative' => 0 //int required
            ],
            'suppliers' => [],
            'properties' => [],
            'wharehouses' => []
        ];
```

#### Create the Template

# templates/admin/payment/native.html

```html

{{dump(moloni)}}

```

#### Add the Routes

# config/routes.yaml

invoice:

    path: /admin/invoice

    controller: App\Controller\InvoiceController::index