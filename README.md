
# Moloni V1 API PHP Wrapper Library

## Work in progress.

## How to use

This library is installed via [Composer](http://getcomposer.org/).

composer require vgspedro/moloniapi

## Symfony framework

#### Create the Route

# config/routes.yaml

```
invoice:
    path: /admin/invoice
    controller: App\Controller\InvoiceController::index
```

#### Create the Controler

# src/Controler/InvoicingController.php

```php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Service\InvoiceMoloni;

class InvoicingController extends AbstractController
{

    public function index(InvoiceMoloni $moloni)
    {
      return $this->render('admin/payment/native.html', [
      	
		//Call the methods from the Service $moloni;

      	'moloni' => [
      		'moloni_get_taxes' => $moloni->getTaxes(),
      		'moloni_set_taxes' => $moloni->setTax($tax),
      		'moloni_update_taxes' => $moloni->updateTax($tax_up),
      		'moloni_delete_tax' => $moloni->deleteTax(2000939),
      		'moloni_get_countries' => $moloni->getCountries(),
      		'moloni_get_languages' => $moloni->getLanguages(),
      		'moloni_get_currencies' => $moloni->getCurrencies(),
      		'moloni_get_fiscal_zones' => $moloni->getFiscalZones(1)
            ]
        ]);
    }
}

```

#### Create the Service

# src/Service/InvoiceMoloni.php

```php
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
use \VgsPedro\MoloniApi\Classes\Documents;
use \VgsPedro\MoloniApi\Classes\InvoiceReceipts;
use \VgsPedro\MoloniApi\Classes\Suppliers;
use \VgsPedro\MoloniApi\Classes\DocumentSets;
use \VgsPedro\MoloniApi\Classes\IdentificationTemplates;

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
		
		$auth = new Authentication();

		$auth->setClientId($this->credencials['client_id']);
		$auth->setPassword($this->credencials['password']);
		$auth->setUsername($this->credencials['username']);
		$auth->setClientSecret($this->credencials['client_secret']);
		$auth->setCompanyId($this->credencials['company_id']);
		$auth->setUrl($this->credencials['url']);

		$token = $auth->login();
		
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
		if($this->start()){
			$t = new Taxes();
			$t->setCompanyId($this->credencials['company_id']);
			$t->setAccessToken($this->credencials['token']['access_token']);
			$t->setUrl($this->credencials['url']);
	
			return $t->getAll();
		}
		else
			return false;
	}

	/**
	* Create Tax in the Company 
	* @param array $t tax information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=263
	**/
	public function setTax(array $t = [])
	{
		if($this->start()){
			$t = new Taxes();
			$t->setCompanyId($this->credencials['company_id']);
			$t->setAccessToken($this->credencials['token']['access_token']);
			$t->setUrl($this->credencials['url']);
			$t->setName($t['name']);
			$t->setValue($t['value']);
			$t->setType($t['type']);
			$t->setSaftType($t['saft_type']);
			$t->setVatType($t['vat_type']);
			$t->setStampTax($t['stamp_tax']);
			$t->setExemptionReason($t['exemption_reason']);
			$t->setFiscalZone($t['fiscal_zone']);
			$t->setActivByDefault($t['active_by_default']);

			return $t->insert();
		}
		else
			return false;
	}

	/**
	* Update Tax by Id
	* @param array $t Tax information // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=264
	**/
	public function updateTax(array $t = [])
	{
		if($this->start()){
			$t = new Taxes();
			$t->setCompanyId($this->credencials['company_id']);
			$t->setAccessToken($this->credencials['token']['access_token']);
			$t->setUrl($this->credencials['url']);
			$t->setId($t['tax_id']);
			$t->setName($t['name']);
			$t->setValue($t['value']);
			$t->setType($t['type']);
			$t->setSaftType($t['saft_type']);
			$t->setVatType($t['vat_type']);
			$t->setStampTax($t['stamp_tax']);
			$t->setExemptionReason($t['exemption_reason']);
			$t->setFiscalZone($t['fiscal_zone']);
			$t->setActivByDefault($t['active_by_default']);

			return $t->update();
		}
		else
			return false;
	}

	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function delete(int $tax_id = 0)
	{
		if($this->start()){
			$t = new Taxes();
			$t->setCompanyId($this->credencials['company_id']);
			$t->setAccessToken($this->credencials['token']['access_token']);
			$t->setUrl($this->credencials['url']);
			$t->setId($t['tax_id']);

			return $t->delete();
		}
		else
			return false;
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
		if($this->start()){
			$g = new GlobalData();
			$g->setAccessToken($this->credencials['token']['access_token']);
			$g->setUrl($this->credencials['url']);

			return $g->getCountries();
		}
		else
			return false;
	}

	/**
	* List Languages available in Moloni
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=70
	**/
	public function getLanguages()
	{
		if($this->start()){
			$g = new GlobalData();
			$g->setAccessToken($this->credencials['token']['access_token']);
			$g->setUrl($this->credencials['url']);

			return $g->getLanguages();
		}
		else
			return false;
	}

	/**
	* List Currencies available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=101
	**/
	public function getCurrencies()
	{
		if($this->start()){
			$g = new GlobalData();
			$g->setAccessToken($this->credencials['token']['access_token']);
			$g->setUrl($this->credencials['url']);

			return $g->getCurrencies();
		}
		else
			return false;
	}

	/**
	* List of Fiscal Zones available in Moloni
	* @param int $id country_id  // $this->getCountries()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=69
	**/
	public function getFiscalZones(int $id = 0)
	{
		if($this->start()){
			$g = new GlobalData();
			$g->setAccessToken($this->credencials['token']['access_token']);
			$g->setUrl($this->credencials['url']);
			$g->setCountryId($id);

			return $g->getFiscalZones();
		}
		else
			return false;
	}

	/**
	* List Tax Exemptions available in Moloni
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=261
	**/
	public function getTaxExemptions()
	{
		if($this->start()){
			$g = new GlobalData();
			$g->setAccessToken($this->credencials['token']['access_token']);
			$g->setUrl($this->credencials['url']);

			return $g->getTaxExemptions();
		}
		else
			return false;
	}






	#####
	## CUSTOMERS METHODS
	#####

	/**
	* Count Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomerCount()
	{
		if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);

			return $c->getCounter();
		}
		else
			return false;
	}


	/**
	* List Customers of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=306
	**/
	public function getCustomers()
	{
		if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);

			return $c->getAll();
		}
		else
			return false;
	}


	/**
	* Get Customer by Id
	* @param int $id Customer Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=199 
	**/
	public function getCustomerById(int $id = 0)
	{
		if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);
			$c->setId($id);

			return $c->getById();
		}
		else
			return false;
	}


	/**
	* Get Customer by Vat
	* @param string $vat Customer Vat // '123456789'
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=201
	**/
	public function getCustomerByVat(string $vat = null)
	{
		if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);
			$c->setVat($vat);
			
			return $c->getByVat();
		}
		else
			return false;
	}

	/**
	* Update Customer by Id
	* @param array $a Customer information
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=205
	**/
	public function updateCustomerById(array $a = [])
	{
		if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);
			$c->setId($a['id']);
			$c->setVat($a['vat']);
			$c->setNumber($a['number']);
			$c->setName($a['name']);
			$c->setLanguageId($a['language_id']);
			$c->setAddress($a['address']);
			$c->setZipCode($a['zip_code']);
			$c->setCity($a['city']);
			$c->setCountryId($a['country_id']);
			$c->setEmail($a['email']);
			$c->setWebsite($a['website']);
			$c->setPhone($a['phone']);
			$c->setFax($a['fax']);
			$c->setContactName($a['contact_name']);
			$c->setContactEmail($a['contact_email']);
			$c->setContactPhone($a['contact_phone']);
			$c->setNotes($a['notes']);
			$c->setSalesmanId($a['salesman_id']);
			$c->setPriceClassId($a['price_class_id']);
			$c->setMaturityDateId($a['maturity_date_id']);
			$c->setPaymentDay($a['payment_day']);
			$c->setDiscount($a['discount']);
			$c->setCreditLimit($a['credit_limit']);
			$c->setCopiesDocumentTypeId($a['copies']['document_type_id']);
			$c->setCopiesCopies($a['copies']['copies']);
			$c->setPaymentMethodId($a['payment_method_id']);
			$c->setDeliveryMethodId($a['delivery_method_id']);
			$c->setFieldNotes($a['field_notes']);

			return $c->update();
		}

		else
			return false;
	}

	/**
	* Create Customer in the Company 
	* @param array $a Customer information 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=204
	**/
	public function setCustomer(array $a = []){
		if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);
			$c->setVat($a['vat']);
			$c->setNumber($a['number']);
			$c->setName($a['name']);
			$c->setLanguageId($a['language_id']);
			$c->setAddress($a['address']);
			$c->setZipCode($a['zip_code']);
			$c->setCity($a['city']);
			$c->setCountryId($a['country_id']);
			$c->setEmail($a['email']);
			$c->setWebsite($a['website']);
			$c->setPhone($a['phone']);
			$c->setFax($a['fax']);
			$c->setContactName($a['contact_name']);
			$c->setContactEmail($a['contact_email']);
			$c->setContactPhone($a['contact_phone']);
			$c->setNotes($a['notes']);
			$c->setSalesmanId($a['salesman_id']);
			$c->setPriceClassId($a['price_class_id']);
			$c->setMaturityDateId($a['maturity_date_id']);
			$c->setPaymentDay($a['payment_day']);
			$c->setDiscount($a['discount']);
			$c->setCreditLimit($a['credit_limit']);
			$c->setCopiesDocumentTypeId($a['copies']['document_type_id']);
			$c->setCopiesCopies($a['copies']['copies']);
			$c->setPaymentMethodId($a['payment_method_id']);
			$c->setDeliveryMethodId($a['delivery_method_id']);
			$c->setFieldNotes($a['field_notes']);

			return $c->insert();
		}
		
		else
			return false;
	}

	/**
	* Delete Customer from the Company 
	* @param int $customer_id // $this->getCustomers()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=206
	**/
	public function deleteCustomer(int $id = 0)
	{
			if($this->start()){
			$c = new Customer();
			$c->setAccessToken($this->credencials['token']['access_token']);
			$c->setUrl($this->credencials['url']);
			$c->setCompanyId($this->credencials['company_id']);
			$c->setId($id);
			
			return $c->delete();
		}
		else
			return false;
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
		if($this->start()){
			$pm = new PaymentMethods();
			$pm->setCompanyId($this->credencials['company_id']);
			$pm->setAccessToken($this->credencials['token']['access_token']);
			$pm->setUrl($this->credencials['url']);
	
			return $pm->getAll();
		}
		else
			return false;
	}

	/**
	* Delete Payment Methods from the Company 
	* @param int $payment_method_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=239
	**/
	public function deletePaymentMethods(int $id = 0)
	{
		if($this->start()){
			$pm = new PaymentMethods();
			$pm->setCompanyId($this->credencials['company_id']);
			$pm->setAccessToken($this->credencials['token']['access_token']);
			$pm->setUrl($this->credencials['url']);
			$pm->setId($id);
	
			return $pm->delete();
		}
		else
			return false;
	}

	/**
	* Create Payment Methods
	* @param array $p Payment Methods
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function setPaymentMethods(array $p = [])
	{
		if($this->start()){
			$pm = new PaymentMethods();
			$pm->setCompanyId($this->credencials['company_id']);
			$pm->setAccessToken($this->credencials['token']['access_token']);
			$pm->setUrl($this->credencials['url']);
			$pm->setName($p['name']);
			$pm->setIsMumeric($p['is_numeric(var)']);
	
			return $pm->insert();
		}
		else
			return false;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $pm PaymentMethods // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=237
	**/
	public function updatePaymentMethods(array $p = [])
	{
		if($this->start()){
			$pm = new PaymentMethods();
			$pm->setCompanyId($this->credencials['company_id']);
			$pm->setAccessToken($this->credencials['token']['access_token']);
			$pm->setUrl($this->credencials['url']);
			$pm->setId($p['id']);
			$pm->setName($p['name']);
			$pm->setIsMumeric($p['is_numeric(var)']);
	
			return $pm->update();
		}
		else
			return false;
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
		if($this->start()){
			$md = new MaturityDates();
			$md->setCompanyId($this->credencials['company_id']);
			$md->setAccessToken($this->credencials['token']['access_token']);
			$md->setUrl($this->credencials['url']);
	
			return $md->getAll();
		}
		else
			return false;
	}

	/**
	* Delete Maturity Dates from the Company 
	* @param int $maturity_dates_id // $this->getPaymentMethods()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=243
	**/
	public function deleteMaturityDates(int $id = 0)
	{
		if($this->start()){
			$md = new MaturityDates();
			$md->setCompanyId($this->credencials['company_id']);
			$md->setAccessToken($this->credencials['token']['access_token']);
			$md->setUrl($this->credencials['url']);
			$md->setId($id);
	
			return $md->delete();
		}
		else
			return false;
	}

	/**
	* Update PaymentMethods by Id
	* @param array $p MaturityDates // $this->getMaturityDates()
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=242
	**/
	public function updateMaturityDates(array $p = [])
	{
		if($this->start()){
			$md = new MaturityDates();
			$md->setCompanyId($this->credencials['company_id']);
			$md->setAccessToken($this->credencials['token']['access_token']);
			$md->setUrl($this->credencials['url']);
			$md->setId($id);
			$md->setName($p['name']);  //string required
			$md->setDays($p['days']);  //int required
			$md->setAssociatedDiscount($p['associated_discount']); // float required
	
			return $md->update();
		}
		else
			return false;
			false;
	}

	/**
	* Update MaturityDates by Id
	* @param array $p MaturityDates // $this->getMaturityDates()
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=241
	**/
	public function setMaturityDates(array $p = [])
	{
		if($this->start()){
			$md = new MaturityDates();
			$md->setCompanyId($this->credencials['company_id']);
			$md->setAccessToken($this->credencials['token']['access_token']);
			$md->setUrl($this->credencials['url']);
			$md->setName($p['name']);  //string required
			$md->setDays($p['days']);  //int required
			$md->setAssociatedDiscount($p['associated_discount']); // float required
	
			return $md->insert();
		}
		else
			return false;
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
		if($this->start()){
			$dm = new DeliveryMethods();
			$dm->setCompanyId($this->credencials['company_id']);
			$dm->setAccessToken($this->credencials['token']['access_token']);
			$dm->setUrl($this->credencials['url']);
	
			return $dm->getAll();
		}
		else
			return false;
	}

/**
	* Delete Delivery Methods from the Company 
	* @param int $delivery_methods_id // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=252
	**/
	public function deleteDeliveryMethods(int $id = 0)
	{
		if($this->start()){
			$dm = new DeliveryMethods();
			$dm->setCompanyId($this->credencials['company_id']);
			$dm->setAccessToken($this->credencials['token']['access_token']);
			$dm->setUrl($this->credencials['url']);
			$dm->setId($id);
	
			return $dm->delete();
		}
		else
			return false;
	}

	/**
	* Update Delivery Methods by Id
	* @param array $p Delivery Methods // $this->getDeliveryMethods() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=251
	**/
	public function updateDeliveryMethods(array $p = [])
	{
		if($this->start()){
			$dm = new DeliveryMethods();
			$dm->setCompanyId($this->credencials['company_id']);
			$dm->setAccessToken($this->credencials['token']['access_token']);
			$dm->setUrl($this->credencials['url']);
			$dm->setId($p['id']);
			$dm->setName($p['name']);

			return $dm->update();
		}
		else
			return false;
	}

	/**
	* Create Delivery Methods by Id
	* @param array $p Delivery Methods // $this->getDeliveryMethods() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=250
	**/
	public function setDeliveryMethods(array $p = [])
	{
		if($this->start()){
			$dm = new DeliveryMethods();
			$dm->setCompanyId($this->credencials['company_id']);
			$dm->setAccessToken($this->credencials['token']['access_token']);
			$dm->setUrl($this->credencials['url']);
			$dm->setName($p['name']);
			
			return $dm->insert();
		}
		else
			return false;
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
		if($this->start()){
			$pc = new ProductCategories();
			$pc->setCompanyId($this->credencials['company_id']);
			$pc->setAccessToken($this->credencials['token']['access_token']);
			$pc->setUrl($this->credencials['url']);
			$pc->setParentId($parent_id);
	
			return $pc->getAll();
		}
		else
			return false;
	}

	/**
	* Delete Product Categories from the Company 
	* @param int $product_categories_id // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=191
	**/
	public function deleteProductCategories(int $id = 0)
	{
		if($this->start()){
			$pc = new ProductCategories();
			$pc->setCompanyId($this->credencials['company_id']);
			$pc->setAccessToken($this->credencials['token']['access_token']);
			$pc->setUrl($this->credencials['url']);
			$pc->setId($id);
	
			return $pc->delete();
		}
		else
			return false;
	}

	/**
	* Update Product Categories by Id
	* @param array $p ProductCategories // $this->getProductCategories() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=190
	**/
	public function updateProductCategories(array $p = [])
	{
		if($this->start()){
			$pc = new ProductCategories();
			$pc->setCompanyId($this->credencials['company_id']);
			$pc->setAccessToken($this->credencials['token']['access_token']);
			$pc->setUrl($this->credencials['url']);
			$pc->setId($p['id']);
			$pc->setParentId($p['parent_id']);
			$pc->setName($p['name']);
			$pc->setDescription($p['description']);
			$pc->setPosEnabled($p['pos_enabled']);
	
			return $pc->update();
		}
		else
			return false;
	}


	/**
	* Create Product Categories by Id
	* @param array $p ProductCategories // $this->getProductCategories() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=189
	**/
	public function setProductCategories(array $p = [])
	{
		if($this->start()){
			$pc = new ProductCategories();
			$pc->setCompanyId($this->credencials['company_id']);
			$pc->setAccessToken($this->credencials['token']['access_token']);
			$pc->setUrl($this->credencials['url']);
			$pc->setParentId($p['parent_id']);
			$pc->setName($p['name']);
			$pc->setDescription($p['description']);
			$pc->setPosEnabled($p['pos_enabled']);
	
			return $pc->update();
		}
		else
			return false;
	}

	#####
	## PRODUCT METHODS
	#####

	/**
	* Get Product by Id
	* @param int $id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getProductById(int $id = 0, int $with_invisible = 0)
	{
		if($this->start()){
			$p = new Product();
			$p->setId($id);
			$p->setCompanyId($this->credencials['company_id']);
			$p->setAccessToken($this->credencials['token']['access_token']);
			$p->setUrl($this->credencials['url']);
			$p->setWithInvisible($with_invisible);

			return $p->getById();
		}
		else
			return false;

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
		if($this->start()){
			$p = new Product();
			$p->setCompanyId($this->credencials['company_id']);
			$p->setAccessToken($this->credencials['token']['access_token']);
			$p->setUrl($this->credencials['url']);
			$p->setReference($reference);
			$p->setQty($qty);
			$p->setOffset($offset);

			return $p->getByReference();
		}
		else
			return false;
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
		if($this->start()){
			$p = new Product();
			$p->setCompanyId($this->credencials['company_id']);
			$p->setAccessToken($this->credencials['token']['access_token']);
			$p->setUrl($this->credencials['url']);
			$p->setEan($ean);
			$p->setQty($qty);
			$p->setOffset($offset);

			return $p->getByEan();
		}
		else
			return false;
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
		if($this->start()){
			$p = new Product();
			$p->setCompanyId($this->credencials['company_id']);
			$p->setAccessToken($this->credencials['token']['access_token']);
			$p->setUrl($this->credencials['url']);
			$p->setName($name);
			$p->setQty($qty);
			$p->setOffset($offset);

			return $p->getByName();
		}
		else
			return false;
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
		if($this->start()){
			$p = new Product();
			$p->setCompanyId($this->credencials['company_id']);
			$p->setAccessToken($this->credencials['token']['access_token']);
			$p->setUrl($this->credencials['url']);
			$p->setCategory($category_id);
			$p->setWithInvisible($with_invisible);
			$p->setQty($qty);
			$p->setOffset($offset);

			return $p->getAll();
		}
		else
			return false;
	}

	/**
	* Delete Product from the Company 
	* @param int $id // $this->getProducts() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=196
	**/
	public function deleteProduct(int $id = 0)
	{
		if($this->start()){
			$p = new Product();
			$p->setId($id);
			$p->setCompanyId($this->credencials['company_id']);
			$p->setAccessToken($this->credencials['token']['access_token']);
			$p->setUrl($this->credencials['url']);

			return $p->delete();
		}
		else
			return false;
	}


	/**
	* Create Product in the Company 
	* @param array $product product required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=194
	**/
	public function setProduct(array $p = [])
	{
		if($this->start()){
			$pr = new Product();
			$pr->setCompanyId($this->credencials['company_id']);
			$pr->setAccessToken($this->credencials['token']['access_token']);
			$pr->setUrl($this->credencials['url']);
			$pr->setId($p['id']);
		    $pr->setCategoryId($p['category_id']);
		    $pr->setType($p['type']);
		    $pr->setName($p['name']);
		    $pr->setSummary($p['summary']); 
		    $pr->setReference($p['reference']);
		    $pr->setEan($p['ean']);
		    $pr->setPrice($p['price']);
		    $pr->setUnitId($p['unit_id']);
		    $pr->setHasStock($p['has_stock']);
		    $pr->setStock($p['stock']);
		    $pr->setMinimumStock($p['minimum_stock']);
		    $pr->setPosFavorite($p['pos_favorite']);
		    $pr->setAtProductCategory($p['at_product_category']);
		    $pr->setExemptionReason($p['exemption_reason']);
		    $pr->setTaxesTaxId(isset($p['tax_id']) ? $p['tax_id'] : 0);
			$pr->setTaxesValue(isset($p['tax_value']) ? $p['tax_value'] : 0.0);
			$pr->setTaxesOrder(isset($p['tax_order']) ? $p['tax_order'] : 0);
			$pr->setTaxesCumulative(isset($p['tax_cumulative']) ? $p['tax_cumulative'] : 0);
			$pr->setSuppliersSupplierId(isset($p['supplier_id']) ? $p['supplier_id'] : 0);
            $pr->setSuppliersCostPrice(isset($p['cost_price']) ? $p['cost_price'] : 0.0);
            $pr->setSuppliersReferenceInt(isset($p['referenceint']) ? $p['referenceint'] : 0);
			$pr->setPropertiesValue(isset($p['properties_value']) ? $p['properties_value'] : '');
			$pr->setPropertiesPropertyId(isset($p['properties_property_id']) ? $p['properties_property_id'] : 0);

			return $pr->insert();
		}
		else
			return false;
	}

	/**
	* Update Product in the Company 
	* @param array $p product required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=195
	**/
	public function updateProduct(array $p = [])
	{
		if($this->start()){
			$pr = new Product();
			$pr->setCompanyId($this->credencials['company_id']);
			$pr->setAccessToken($this->credencials['token']['access_token']);
			$pr->setUrl($this->credencials['url']);
			$pr->setId($p['id']);
		    $pr->setCategoryId($p['category_id']);
		    $pr->setType($p['type']);
		    $pr->setName($p['name']);
		    $pr->setSummary($p['summary']); 
		    $pr->setReference($p['reference']);
		    $pr->setEan($p['ean']);
		    $pr->setPrice($p['price']);
		    $pr->setUnitId($p['unit_id']);
		    $pr->setHasStock($p['has_stock']);
		    $pr->setStock($p['stock']);
		    $pr->setMinimumStock($p['minimum_stock']);
		    $pr->setPosFavorite($p['pos_favorite']);
		    $pr->setAtProductCategory($p['at_product_category']);
		    $pr->setExemptionReason($p['exemption_reason']);
		    $pr->setTaxesTaxId(isset($p['tax_id']) ? $p['tax_id'] : 0);
			$pr->setTaxesValue(isset($p['tax_value']) ? $p['tax_value'] : 0.0);
			$pr->setTaxesOrder(isset($p['tax_order']) ? $p['tax_order'] : 0);
			$pr->setTaxesCumulative(isset($p['tax_cumulative']) ? $p['tax_cumulative'] : 0);
			$pr->setSuppliersSupplierId(isset($p['supplier_id']) ? $p['supplier_id'] : 0);
            $pr->setSuppliersCostPrice(isset($p['cost_price']) ? $p['cost_price'] : 0.0);
            $pr->setSuppliersReferenceInt(isset($p['referenceint']) ? $p['referenceint'] : 0);
			$pr->setPropertiesValue(isset($p['properties_value']) ? $p['properties_value'] : '');
			$pr->setPropertiesPropertyId(isset($p['properties_property_id']) ? $p['properties_property_id'] : 0);

			return $pr->update();
		}
		else
			return false;
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

		if($this->start()){
			$mu = new MeasurementUnits();
			$mu->setCompanyId($this->credencials['company_id']);
			$mu->setAccessToken($this->credencials['token']['access_token']);
			$mu->setUrl($this->credencials['url']);

			return $mu->getAll();
		}
		else
			return false;
	}

	/**
	* Delete Measurement Units in the Company 
	* @param int $unit_id Measurement Unit Id $this->getMeasumentUnits() required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=269
	**/
	public function deleteMeasurementUnits(int $id = 0)
	{
		if($this->start()){
			$mu = new MeasurementUnits();
			$mu->setCompanyId($this->credencials['company_id']);
			$mu->setAccessToken($this->credencials['token']['access_token']);
			$mu->setUrl($this->credencials['url']);
			$mu->setId($id);

			return $mu->delete();
		}
		else
			return false;
	}

	/**
	* Create Measurement Units in the Company 
	* @param array $p Measurement Units required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=267
	**/
	public function setMeasurementUnits(array $p = [])
	{
		if($this->start()){
			$mu = new MeasurementUnits();
			$mu->setCompanyId($this->credencials['company_id']);
			$mu->setAccessToken($this->credencials['token']['access_token']);
			$mu->setUrl($this->credencials['url']);
			$mu->setName($p['name']);// string required
			$mu->setShortName($p['short_name']);// string required

			return $mu->insert();
		}
		else
			return false;
	}

	/**
	* Update Measurement Units in the Company 
	* @param array $p Measurement Units required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=268
	**/
	public function updateMeasurementUnits(array $p = [])
	{
		if($this->start()){
			$mu = new MeasurementUnits();
			$mu->setCompanyId($this->credencials['company_id']);
			$mu->setAccessToken($this->credencials['token']['access_token']);
			$mu->setUrl($this->credencials['url']);
			$mu->setName($p['name']);// string required
			$mu->setShortName($p['short_name']);// string required
			$mu->setId($id);

			return $mu->update();
		}
		else
			return false;
	}

	#####
	## INVOICE RECEIPTS
	#####

	/**
	* Count InvoucesReceipts of the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=379
	**/
	public function getInvoicesReceiptsCount(array $p = [])
	{
		if($this->start()){
			$ir = new InvoiceReceipts();
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setUrl($this->credencials['url']);
			$ir->setCompanyId($this->credencials['company_id']);
			
			if (count($p) > 0){
				$ir->getCustomerId($p['customer_id']); // int
	       		$ir->getSupplierId($p['supplier_id']); // int
	        	$ir->getSalesmanId($p['salesman_id']); //int
	        	$ir->getDocumentSetId($p['document_set_id']); // int
	        	$ir->getNumber($p['number']); //int
	        	$ir->getDate($p['date']); // date
	        	$ir->getExpirationDate($p['expiration_date']); // date
	        	$ir->getYear($p['year']); // int
	        	$ir->getYourReference($p['your_reference']); // string
	    		$ir->getOurReference($p['our_reference']); // string
			}

			return $ir->getCounter();
		}
		else
			return false;
	}

	/**
	* List Invoice Receipts in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=374
	**/
	public function getInvoiceReceipts(array $p = [])
	{
		if($this->start()){
			$ir = new InvoiceReceipts();
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setUrl($this->credencials['url']);
			$ir->setCompanyId($this->credencials['company_id']);
			
			if (count($p) > 0){
				$ir->setQty($p['qty']); //int
				$ir->setOffset($p['offset']); //int
				$ir->getCustomerId($p['customer_id']); // int
	       		$ir->getSupplierId($p['supplier_id']); // int
	        	$ir->getSalesmanId($p['salesman_id']); //int
	        	$ir->getDocumentSetId($p['document_set_id']); // int
	        	$ir->getNumber($p['number']); //int
	        	$ir->getDate($p['date']); // date
	        	$ir->getExpirationDate($p['expiration_date']); // date
	        	$ir->getYear($p['year']); // int
	        	$ir->getYourReference($p['your_reference']); // string
	    		$ir->getOurReference($p['our_reference']); // string
			}

			return $ir->getAll();
		}
		else
			return false;
	}

	/**
	* Get Invoice Receipt by Id 
	* @param int $document_id // $this->getInvoiceReceipts() required
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=
	**/
	public function getInvoiceReceipt(int $document_id = 0)
	{
		if($this->start()){
			$ir = new InvoiceReceipts();
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setUrl($this->credencials['url']);
			$ir->setCompanyId($this->credencials['company_id']);
			$ir->setId($document_id);
			
			if (count($p) > 0){
				$ir->getCustomerId($p['customer_id']); // int
	       		$ir->getSupplierId($p['supplier_id']); // int
	        	$ir->getSalesmanId($p['salesman_id']); //int
	        	$ir->getDocumentSetId($p['document_set_id']); // int
	        	$ir->getNumber($p['number']); //int
	        	$ir->getDate($p['date']); // date
	        	$ir->getExpirationDate($p['expiration_date']); // date
	        	$ir->getYear($p['year']); // int
	        	$ir->getYourReference($p['your_reference']); // string
	    		$ir->getOurReference($p['our_reference']); // string
			}

			return $ir->getById();
		}
		else
			return false;
	}

	/**
	* Delete Invoice Receipt in the Company 
	* @param int $id Invoice Receipt required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=378
	**/
	public function deleteInvoiceReceipt(int $id = 0)
	{
		if($this->start()){
			$ir = new MeasurementUnits();
			$ir->setCompanyId($this->credencials['company_id']);
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setUrl($this->credencials['url']);
			$ir->setId($id);

			return $ir->delete();
		}
		else
			return false;
	}

	/**
	* Delete Invoice Receipt in the Company 
	* @param array $p Invoice Receipt required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=378
	**/
	public function generateMBReference(array $p = [])
	{
		if($this->start()){
			$ir = new MeasurementUnits();
			$ir->setCompanyId($this->credencials['company_id']);
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setValue($p['value']);
			$ir->setId($p['id']);

			return $ir->generateMBReference();
		}
		else
			return false;
	}


	/**
	* Create Invoice Receipt in the Company 
	* @param array $p InvoiceReceipt required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=376
	**/
	public function setInvoiceReceipt(array $p = [])
	{
		if($this->start()){
			$ir = new InvoiceReceipt();
			$ir->setCompanyId($this->credencials['company_id']);
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setUrl($this->credencials['url']);
			$ir->setName($p['name']);// string required
			$ir->setShortName($p['short_name']);// string required

			return $ir->insert();
		}
		else
			return false;
	}

	/**
	* Update Invoice Receipt in the Company 
	* @param array $p InvoiceReceipt required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=377
	**/
	public function updateInvoiceReceipt(array $p = [])
	{
		if($this->start()){
			$ir = new InvoiceReceipt();
			$ir->setCompanyId($this->credencials['company_id']);
			$ir->setAccessToken($this->credencials['token']['access_token']);
			$ir->setUrl($this->credencials['url']);
			$ir->setName($p['name']);// string required
			$ir->setShortName($p['short_name']);// string required
			$ir->setId($p['$id']); // int required

			return $ir->update();
		}
		else
			return false;
	}

	#####
	## DOCUMENTS  METHODS
	#####

	/**
	* List of All Document Types in the Company 
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=226
	**/
	public function getAllDocumentTypes()
	{
		if($this->start()){
			$d = new Documents();
			$d->setCompanyId($this->credencials['company_id']);
			$d->setAccessToken($this->credencials['token']['access_token']);
			$d->setUrl($this->credencials['url']);
			$d->setLanguageId(1);

			return $d->getAllDocumentTypes();
		}
		else
			return false;
	}


	#####
	## DOCUMENTSETS METHODS
	#####
	/**
	* List DocumentSets
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=274
	**/
	public function getDocumentSets()
	{
		if($this->start()){
			$ds = new DocumentSets();
			$ds->setCompanyId($this->credencials['company_id']);
			$ds->setAccessToken($this->credencials['token']['access_token']);
			$ds->setUrl($this->credencials['url']);

			return $d->getAll();
		}
		else
			return false;
	}



	/**
	* Update DocumentSets in the Company 
	* @param array $d DocumentSets required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=276
	**/
	public function updateDocumentSets(array $d = [])
	{
		if($this->start()){
			$ds = new DocumentSets();
			$ds->setCompanyId($this->credencials['company_id']);
			$ds->setAccessToken($this->credencials['token']['access_token']);
			$ds->setUrl($this->credencials['url']);
			$ds->setName($d['name']);// string required
		    $ds->getCashVatSchemeIndicator($d['cash_vat_scheme_indicator']);
            $ds->getTemplateId($d['template_id']);
          	$ds->getActiveByDefault($d['active_by_default']);
			$ds->setId($p['id']); // int required

			return $ds->update();
		}
		else
			return false;
	}

	/**
	* Insert DocumentSets in the Company 
	* @param array $d DocumentSets required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=275
	**/
	public function insertDocumentSets(array $d = [])
	{
		if($this->start()){
			$ds = new DocumentSets();
			$ds->setCompanyId($this->credencials['company_id']);
			$ds->setAccessToken($this->credencials['token']['access_token']);
			$ds->setUrl($this->credencials['url']);
			$ds->setName($d['name']);// string required
		    $ds->getCashVatSchemeIndicator($d['cash_vat_scheme_indicator']);
            $ds->getTemplateId($d['template_id']);
          	$ds->getActiveByDefault($d['active_by_default']);

			return $ds->insert();
		}
		else
			return false;
	}

	/**
	* Delete DocumentSets in the Company 
	* @param int $id DocumentSets required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=277
	**/
	public function deleteDocumentSets(int $id = 0)
	{
		if($this->start()){
			$ds = new DocumentSets();
			$ds->setCompanyId($this->credencials['company_id']);
			$ds->setAccessToken($this->credencials['token']['access_token']);
			$ds->setUrl($this->credencials['url']);
			$ds->setId($id);

			return $ds->delete();
		}
		else
			return false;
	}

	#####
	## INDENTIFICATIONTEMPLATES METHODS
	#####
	/**
	* List IdentificationTemplates
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocSub&s_id=270
	**/
	public function getIdentificationTemplates()
	{
		if($this->start()){
			$it = new IdentificationTemplates();
			$it->setCompanyId($this->credencials['company_id']);
			$it->setAccessToken($this->credencials['token']['access_token']);
			$it->setUrl($this->credencials['url']);

			return $d->getAll();
		}
		else
			return false;
	}


	/**
	* Update IdentificationTemplates in the Company 
	* @param array $d IdentificationTemplates required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=272
	**/
	public function updateIdentificationTemplates(array $d = [])
	{
		if($this->start()){
			$it = new IdentificationTemplates();
			$it->setCompanyId($this->credencials['company_id']);
			$it->setAccessToken($this->credencials['token']['access_token']);
			$it->setUrl($this->credencials['url']);
			$it->setName($d['name']);
			$it->getBusinessName($d['business_name']);
            $it->getEmail($d['email']);
            $it->getAddress($d['address']);
            $it->getCity($d['city']);
            $it->getZipCode($d['zip_code']);
            $it->getCountryId($d['country_id']);
            $it->getPhone($d['phone']);
            $it->getFax($d['fax']);
            $it->getWebsite($d['website']);
            $it->getNotes($d['notes']);
            $it->getDocumentsFootnote($d['documents_footnote']);
            $it->getEmailSenderName($d['email_sender_name']);
            $it->getEmailSenderAddress($d['email_sender_address']);
            $it->setId($d['template_id']);

			return $it->update();
		}
		else
			return false;
	}

	/**
	* Insert IdentificationTemplates in the Company 
	* @param array $d IdentificationTemplates required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=271
	**/
	public function insertIdentificationTemplates(array $d = [])
	{
		if($this->start()){
			$it = new IdentificationTemplates();
			$it->setCompanyId($this->credencials['company_id']);
			$it->setAccessToken($this->credencials['token']['access_token']);
			$it->setUrl($this->credencials['url']);
			$it->setName($d['name']);
			$it->getBusinessName($d['business_name']);
            $it->getEmail($d['email']);
            $it->getAddress($d['address']);
            $it->getCity($d['city']);
            $it->getZipCode($d['zip_code']);
            $it->getCountryId($d['country_id']);
            $it->getPhone($d['phone']);
            $it->getFax($d['fax']);
            $it->getWebsite($d['website']);
            $it->getNotes($d['notes']);
            $it->getDocumentsFootnote($d['documents_footnote']);
            $it->getEmailSenderName($d['email_sender_name']);
            $it->getEmailSenderAddress($d['email_sender_address']);
		 
			return $it->insert();
		}
		else
			return false;
	}

	/**
	* Delete IdentificationTemplates in the Company 
	* @param int $id IdentificationTemplates required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=273
	**/
	public function deleteIdentificationTemplates(int $id = 0)
	{
		if($this->start()){
			$it = new IdentificationTemplates();
			$it->setCompanyId($this->credencials['company_id']);
			$it->setAccessToken($this->credencials['token']['access_token']);
			$it->setUrl($this->credencials['url']);
			$it->setId($id);

			return $it->delete();
		}
		else
			return false;
	}

}

```


#### Create the Template

# templates/admin/payment/native.html

```html
<h2>Result</h2>
{{dump(moloni)}}

```
