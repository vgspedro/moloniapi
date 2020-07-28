<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
 * A class which CRUD the Product requests
 */

class Product extends Authentication{

	/** @const entity api url */
	const ENTITY = '/products/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/** Payment array data structure
	[
        'product_id' => 0,// int required ON UPDATE only $this->getProducts()
        'category_id' => 2518332,// int required $moloni->getProductCategories()
        'type' => 1,// int required [1 => Produto , 2 => Serviço , 3 => Outros]
        'name' => 'Prduct name',// string required
        'summary' => 'A product summary',// string 
        'reference' => '#123',//string required should be unique
        'ean' => '1234',// string
        'price' => 5.1,// float required
        'unit_id' => 1222821 ,// int required $moloni->getMeasurementunits()
        'has_stock' => 0,// int required
        'stock' => 0.0,//float required
        'minimum_stock' => 0.0,// float
        'pos_favorite' => 0,// int
        'at_product_category' => '',// string [M: mercadorias, P: matérias-primas, subsidiárias e de consumo, A: produtos acabados e intermédios, S: subprodutos, desperdícios e refugos, T: produtos e trabalhos em curso]
        'exemption_reason' => '',// string required
        'taxes' => [ //array not required 
            'tax_id' => 1999735,// int required
            'value' => 1.0, //float required
            'order' => 1,// int required
            'cumulative' => 1,// int required
        ],
        'suppliers' => [ //array not required 
                'supplier_id' => 0,// int required $moloni->getSuppliers()
                'cost_price'=> 4.1 , // float required
                'referenceint' => 0, //int 
        ],  
        'properties' => [ //array not required 
            'property_id' => 0,// int required
            'value' => '',// string required
        ]
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

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    private $with_invisible;

    public function getWithInvisible()
    {
        return $this->with_invisible;
    }

    public function setWithInvisible(int $with_invisible = 0)
    {
        $this->with_invisible = $with_invisible;
    }
    
    private $reference;

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference(string $reference = null)
    {
        $this->reference = $reference;
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
    
    private $ean;

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan(string $ean = null)
    {
        $this->ean = $ean;
    }

    private $pos_favorite;

    public function getPosFavorite()
    {
        return $this->pos_favorite;
    }

    public function setPosFavorite(int $pos_favorite = 0)
    {
        $this->pos_favorite = $pos_favorite;
    }

 	private $category_id;

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id = 0)
    {
        $this->category_id = $category_id;
    }
    
    private $type;

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type = null)
    {
        $this->type = $type;
    }

    private $summary;

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary(string $summary = null)
    {
        $this->summary = $summary;
    }

    private $price;

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price = 0.0)
    {
        $this->price = $price;
    }

 	private $unit_id;

    public function getUnitId()
    {
        return $this->unit_id;
    }

    public function setUnitId(int $unit_id = 0)
    {
        $this->unit_id = $unit_id;
    }

 	private $has_stock;

    public function getHasStock()
    {
        return $this->has_stock;
    }

    public function setHasStock(int $has_stock = 0)
    {
        $this->has_stock = $has_stock;
    }

    private $stock;

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock(float $stock = 0.0)
    {
        $this->stock = $stock;
    }

    private $minimum_stock;
    
    public function getMinimumStock()
    {
        return $this->minimum_stock;
    }

    public function setMinimumStock(float $minimum_stock = 0.0)
    {
        $this->minimum_stock = $minimum_stock;
    }

 	private $at_product_category;

    public function getAtProductCategory()
    {
        return $this->at_product_category;
    }

    public function setAtProductCategory(string $at_product_category = null)
    {
        $this->at_product_category = $at_product_category;
    }

 	private $exemption_reason;

    public function getExemptionReason()
    {
        return $this->exemption_reason;
    }

    public function setExemptionReason(string $exemption_reason = null)
    {
        $this->exemption_reason = $exemption_reason;
    }

	private $taxes_tax_id;

	public function getTaxesTaxId()
	{
        return $this->taxes_tax_id;
    }
 	public function setTaxesTaxId(int $taxes_tax_id = 0)
    {
        $this->taxes_tax_id = $taxes_tax_id;
    }

	private $taxes_value;

	public function getTaxesValue()
	{
        return $this->taxes_value;
    }

    public function setTaxesValue(float $taxes_value = 0.0)
    {
        $this->taxes_value = $taxes_value;
    }

	private $taxes_order;

	public function getTaxesOrder()
	{
        return $this->taxes_order;
    }

	public function setTaxesOrder(int $taxes_order = 0)
    {
        $this->taxes_order = $taxes_order;
    }

	private $taxes_cumulative;

	public function getTaxesCumulative()
	{
        return $this->taxes_cumulative;
    }

	public function setTaxesCumulative(int $taxes_cumulative = 0)
    {
        $this->taxes_cumulative = $taxes_cumulative;
    }

	private $suppliers_supplier_id;

	public function getSuppliersSupplierId()
	{
        return $this->suppliers_supplier_id;
    }

	public function setSuppliersSupplierId(int $suppliers_supplier_id = 0)
    {
        $this->suppliers_supplier_id = $suppliers_supplier_id;
    }

	private $suppliers_cost_price;

	public function getSuppliersCostPrice()
	{
        return $this->suppliers_cost_price;
    }

	public function setSuppliersCostPrice(float $suppliers_cost_price = 0)
    {
        $this->suppliers_cost_price = $suppliers_cost_price;
    }

	private $suppliers_reference_int;

	public function getSuppliersReferenceInt()
	{
        return $this->suppliers_reference_int;
    }

	public function setSuppliersReferenceInt(int $suppliers_reference_int = 0)
    {
        $this->suppliers_reference_int = $suppliers_reference_int;
    }

	private $properties_property_id;

	public function getPropertiesPropertyId()
	{
        return $this->properties_property_id;
    }

	public function setPropertiesPropertyId(int $properties_property_id = 0)
    {
        $this->properties_property_id = $properties_property_id;
    }

	private $properties_value;

	public function getPropertiesValue()
	{
        return $this->properties_value;
    }

	public function setPropertiesValue(string $properties_value = null)
    {
        $this->properties_value = $properties_value;
    }

    //If the product has Taxes build the array to update or insert
	private function hasTaxes(){
		return $this->getTaxesTaxId() > 0 && $this->getTaxesValue() > 0 && $this->getTaxesOrder() && $this->getTaxesCumulative() > 0 ?
			[
				'tax_id' => $this->getTaxesTaxId(),
            	'value' => $this->getTaxesValue(),
            	'order' => $this->getTaxesOrder(),
            	'cumulative' => $this->getTaxesCumulative()
			]
		:	
			[];
	} 

    //If the product has Suppliers build the array to update or insert
	private function hasSuppliers(){
		
		return $this->getSuppliersSupplierId() > 0 ?
			[
				'supplier_id' => $this->getSuppliersSupplierId(),
            	'cost_price' => $this->getSuppliersCostPrice(),
            	'referenceint' => $this->getSuppliersReferenceInt()
			]
		:	
			[];
	} 

    //If the product has Properties build the array to update or insert
	private function hasProperties(){
		return $this->getPropertiesPropertyId() > 0 ?
			[
   			'property_id' => $this->getPropertiesPropertyId(),
   			 'value' =>  $this->getPropertiesValue()
			]
		:	
			[];
	} 

	/**
	* Get Product by Id
	* @param int $product_id required// $this->getProductCategories(0)
	* @param int $with_invisible
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=193
	**/
	public function getById()
	{
		return parent::curl(parent::getPath('getOne'), [
			'company_id' => parent::getCompanyId(),
			'product_id' => $this->getId(),
			'with_invisible' => $this->getWithInvisible()
		]);
	}

	/**
	* List Products by Reference
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=298
	**/
	public function getByReference()
	{
		return parent::curl(parent::getPath('getByReference'), [
			'company_id' => parent::getCompanyId(),
			'reference' => $this->getReference(),
			'qty' => $this->getQty(),
			'offset' => $this->getOffset()
		]);
	}

	/**
	* List Products by EAN
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=299
	**/
	public function getByEan()
	{
		return parent::curl(parent::getPath('getByEAN'), [
			'company_id' => parent::getCompanyId(),
			'ean' => $this->getEan(),
			'qty' => $this->getQty(),
			'offset' => $this->getOffset()
		]);
	}

	/**
	* List Products by name
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=297
	**/
	public function getByName()
	{
		return parent::curl(parent::getPath('getByName'), [
			'company_id' => parent::getCompanyId(),
			'name' => $this->getName(),
			'qty' => $this->getQty(),
			'offset' => $this->getOffset()
		]);
	}

	/**
	* List of Products in the Company
	* @return json 
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=192
	**/
	public function getAll()
	{
		return parent::curl(parent::getPath('getAll'), [
			'company_id' => parent::getCompanyId(),
			'category_id' => $this->getCategoryId(),
			'qty' => $this->getQty(),
			'offset' => $this->getOffset(),
			'with_invisible' => $this->getWithInvisible()
		]);
	}

	/**
	* Create Product in the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=194
	**/
	public function insert()
	{
		return parent::curl(parent::getPath('insert'), [
			'company_id' => parent::getCompanyId(),
		    'category_id' => $this->getCategoryId(),
		    'type' => $this->getType(),
		    'name' => $this->getName(),
		    'summary' => $this->getSummary(), 
		    'reference' => $this->getReference(),
		    'ean' => $this->getEan(),
		    'price' => $this->getPrice(),
		    'unit_id' => $this->getUnitId(),
		    'has_stock' => $this->getHasStock(),
		    'stock' => $this->getStock(),
		    'minimum_stock' => $this->getMinimumStock(),
		    'pos_favorite' => $this->getPosFavorite(),
		    'at_product_category' => $this->getAtProductCategory(),
		    'exemption_reason' => $this->getExemptionReason(),
		    'taxes' => $this->hasTaxes(),
		    'suppliers' => $this->hasSuppliers(),  
		    'properties' => $this->hasProperties()
		]);
	}

	/**
	* Update Product in the Company 
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=195
	**/
	public function update()
	{
		return parent::curl(parent::getPath('update'), [
			'company_id' => parent::getCompanyId(),
			'category_id' => $this->getCategoryId(),
			'product_id' => $this->getId(),
		    'type' => $this->getType(),
		    'name' => $this->getName(),
		    'summary' => $this->getSummary(), 
		    'reference' => $this->getReference(),
		    'ean' => $this->getEan(),
		    'price' => $this->getPrice(),
		    'unit_id' => $this->getUnitId(),
		    'has_stock' => $this->getHasStock(),
		    'stock' => $this->getStock(),
		    'minimum_stock' => $this->getMinimumStock(),
		    'pos_favorite' => $this->getPosFavorite(),
		    'at_product_category' => $this->getAtProductCategory(),
		    'exemption_reason' => $this->getExemptionReason(),
			'taxes' => $this->hasTaxes(),
		    'suppliers' => $this->hasSuppliers(),  
		    'properties' => $this->hasProperties()
		]);
		
	}

	/**
	* Delete Product by Id
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=196
	**/
	public function delete()
	{
		return parent::curl(parent::getPath('delete'), [
			'company_id' => parent::getCompanyId(),
			'product_id' => $this->getId()
		]);
	}

}