
# Moloni V1 API PHP Wrapper Library

## Work in progress.

## How to use

This library is installed via [Composer](http://getcomposer.org/).

composer require vgspedro/moloniapi:dev-master

## Symfony framework

#### Create the Controler

# src/Controler/InvoicingController.php

```php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Service\InvoiceMoloni;

class InvoicingController extends AbstractController
{
    public function index(InvoiceMoloni $moloni)
    {

        return $this->render('admin/payment/native.html', [
            'moloni' => $moloni->getTaxes(),
            'sf_v' => \Symfony\Component\HttpKernel\Kernel::VERSION,
        ]);
    }

}

```

#### Create the Service

# src/Service/InvoiceMoloni.php

```php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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

    public function __construct(ParameterBagInterface $environment){

		$this->credencials = [];

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
    	$this->credencials['username'] = 'email@mail.com'; // Username, that allows access to Moloni (login page)
 		$this->credencials['password'] = 'pass'; // Password, that allows access to Moloni (login page)
    }

	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomerCount(){
		return (new Customer())
			->getCustomerCount($this->credencials);
	}

	/**
	* Create Customer in the Company 
	* @param array $a Customer information 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function setCustomer(array $a = []){
		return (new Customer())
			->setCustomer($this->credencials, $a);
	}

	/**
	* Get Customer by Id
	* @param int $id Customer Id // $this->getCustomerByVat(string $vat)
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(int $id = 0)
	{
		return (new Customer())
			->getCustomerById($this->credencials, $id);
	}

	/**
	* Get Customer by Vat
	* @param string $vat Customer Vat // '123456789'
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	
	public function getCustomerByVat(string $vat = null)
	{
		return (new Customer())
			->getCustomerByVat($this->credencials, $vat);
	}

	/**
	* Update Customer by Id
	* @param array $a Customer information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function updateCustomerById(array $a = [])
	{
		return (new Customer())
			->updateCustomerById($this->credencials, $a);
	}

	/**
	* List Taxes of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=262
	**/
	public function getTaxes()
	{
		return (new Taxes())
			->getTaxes($this->credencials);
	}

	/**
	* Create Tax in the Company 
	* @param array $t tax information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax(array $t = [])
	{
		return (new Taxes())
			->setTaxes($this->credencials, $t);
	}

	/**
	* Update Tax by Id
	* @param array $t Tax information // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=264
	**/
	public function updateTax(array $t = [])
	{
		return (new Taxes())
			->updateTax($this->credencials, $t);
	}

	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTax(int $tax_id = 0)
	{
		return (new Taxes())
			->deleteTax($this->credencials, $tax_id);
	}

	/**
	* List Countries available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=68
	**/
	public function getCountries()
	{
		return (new GlobalData())
			->getCountries($this->credencials);
	}

	/**
	* List Languages available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=70
	**/
	public function getLanguages()
	{
		return (new GlobalData())
			->getLanguages($this->credencials);
	}

	/**
	* List Currencies available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=101
	**/
	public function getCurrencies()
	{
		return (new GlobalData())
			->getCurrencies($this->credencials);
	}

	/**
	* Get list of Fiscal Zones available in Moloni
	* @param int $id country_id  // $this->getCountries()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=69
	**/
	public function getFiscalZones(int $id = 0)
	{
		return (new GlobalData())
			->getFiscalZones($this->credencials, $id);
	}

	/**
	* List Payment Methods of Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=236
	**/
	public function getPaymentMethods()
	{
		return (new PaymentMethods())
			->getPaymentMethods($this->credencials);
	}

	/**
	* Create Payment Methods
	* @param array $pm Payment Methods
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function setPaymentMethods(array $pm = [])
	{
		return (new PaymentMethods())
			->setPaymentMethods($this->credencials, $pm);
	}

	/**
	* Delete Payment Methods from the Company 
	* @param int $payment_method_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=239
	**/
	public function deletePaymentMethods(int $payment_method_id = 0)
	{
		return (new PaymentMethods())
			->deletePaymentMethods($this->credencials, $payment_method_id);
	}

	/**
	* Update PaymentMethods by Id
	* @param array $pm PaymentMethods // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function updatePaymentMethods(array $pm = [])
	{
		return (new PaymentMethods())
			->updatePaymentMethods($this->credencials, $pm);
	}

	/**
	* List MaturityDates in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=240
	**/
	public function getMaturityDates()
	{
		return (new MaturityDates())
			->getMaturityDates($this->credencials);
	}

	/**
	* Update PaymentMethods by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function updateMaturityDates(array $md = [])
	{
		return (new MaturityDates())
			->updateMaturityDates($this->credencials, $md);
	}

	/**
	* Delete Maturity Dates from the Company 
	* @param int $maturity_dates_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function deleteMaturityDates(int $maturity_dates_id = 0)
	{
		return (new MaturityDates())
			->deleteMaturityDates($this->credencials, $maturity_dates_id);
	}

	/**
	* Update MaturityDates by Id
	* @param array $md MaturityDates // $this->getMaturityDates()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function setMaturityDates(array $md = [])
	{
		return (new MaturityDates())
			->setMaturityDates($this->credencials, $md);
	}

	/**
	* List Delivery Methods in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=249
	**/
	public function getDeliveryMethods()
	{
		return (new DeliveryMethods())
			->getDeliveryMethods($this->credencials);
	}

	/**
	* Update Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=251
	**/
	public function updateDeliveryMethods(array $dm = [])
	{
		return (new DeliveryMethods())
			->updateDeliveryMethods($this->credencials, $dm);
	}

	/**
	* Delete Delivery Methods from the Company 
	* @param int $delivery_methods_id // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=252
	**/
	public function deleteDeliveryMethods(int $delivery_methods_id = 0)
	{
		return (new DeliveryMethods())
			->deleteDeliveryMethods($this->credencials, $delivery_methods_id);
	}

	/**
	* Create Delivery Methods by Id
	* @param array $dm Delivery Methods // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=250
	**/
	public function setDeliveryMethods(array $dm = [])
	{
		return (new DeliveryMethods())
			->setDeliveryMethods($this->credencials, $dm);
	}

	/**
	* List of Product Categories in the Company 
	* @param int $parent_id required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=188
	**/
	public function getProductCategories(int $parent_id = 0)
	{
		$m = new Moloni();
		return (new DeliveryMethods())
			->getProductCategories($this->credencials, $parent_id);
	}
	/**
	* Update Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=190
	**/
	public function updateProductCategories(array $pc = [])
	{
		return (new ProductCategories())
			->updateProductCategories($this->credencials, $pc);
	}

	/**
	* Delete Product Categories from the Company 
	* @param int $product_categories_id // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function deleteProductCategories(int $product_categories_id = 0)
	{
		return (new ProductCategories())
			->deleteProductCategories($this->credencials, $product_categories_id);
	}

	/**
	* Create Product Categories by Id
	* @param array $pc ProductCategories // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=189
	**/
	public function setProductCategories(array $pc = [])
	{
		return (new ProductCategories())
			->setProductCategories($this->credencials, $pc);
	}

	/**
	* Get Product by Id
	* @param int $product_id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getProductById(int $product_id = 0, int $with_invisible = 0)
	{
		return (new Product())
			->getProductById($this->credencials, $product_id, $with_invisible);
	}

	/**
	* Get list of Products by Reference
	* @param string $reference required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=298
	**/
	public function getProductsByReference(string $reference, int $qty = 0, int $offset = 0)
	{
		return (new Product())
			->getProductsByReference($this->credencials, $reference, $qty, $offset);
	}

	/**
	* Get list of Products by EAN
	* @param string $ean required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=299
	**/
	public function getProductsByEan(string $ean, int $qty = 0, int $offset = 0)
	{
		return (new Product())
			->getProductsByEan($this->credencials, $ean, $qty, $offset);
	}

	/**
	* Get list of Products by name
	* @param string $name required // $this->getProductCategories(0)
	* @param int $qty 
	* @param int $offset
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=297
	**/
	public function getProductsByName(string $name, int $qty = 0, int $offset = 0)
	{
		return (new Product())
			->getProductsByName($this->credencials, $name, $qty, $offset);
	}

	/**
	* Get list of Products in the Company
	* @param int $category_id required // $this->getProductCategories()
	* @param int $qty 
	* @param int $offset
	* @param int $with_invisible
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=192
	**/
	public function getProducts(int $category_id, int $qty = 0, int $offset = 0, int $with_invisible = 0)
	{
		return (new Product())
			->getProducts($this->credencials, $category_id, $qty, $offset, $with_invisible);
	}

	/**
	* Create Product in the Company 
	* @param array $p product required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=194
	**/
	public function setProduct(array $p = [])
	{
		return (new Product())
			->setProduct($this->credencials, $p);
	}

	/**
	* Update Product in the Company 
	* @param array $p product required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=195
	**/
	public function updateProduct(array $p = [])
	{
		return (new Product())
			->updateProduct($this->credencials, $p);
	}

	/**
	* List of Measurement Units in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=266
	**/
	public function getMeasurementUnits(){
		return (new MeasurementUnits())
			->getMeasurementUnits($this->credencials);
	}

	/**
	* Create Measurement Units in the Company 
	* @param array $mu Measurement Units required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits(array $mu = [])
	{
		return (new MeasurementUnits())
			->setMeasurementUnits($this->credencials, $mu);
	}

	/**
	* Update Measurement Units in the Company 
	* @param array $mu Measurement Units required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits(array $mu = [])
	{
		return (new MeasurementUnits())
			->updateMeasurementUnits($this->credencials, $mu);
	}

	/**
	* Delete Measurement Units in the Company 
	* @param int $unit_id Measurement Unit Id required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits(int $unit_id = 0)
	{
		return (new MeasurementUnits())
			->deleteMeasurementUnits($this->credencials, $unit_id);
	}

}

```

#### Create a Customer, Tax, Product

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