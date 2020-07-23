<?php

namespace VgsPedro\MoloniApi\Classes;

use \VgsPedro\MoloniApi\Authentication;

/**
* A class for CRUD the Taxes requests
*/

class TestTaxes extends Authentication{

	/** @const entity api url */
	const ENTITY = '/taxes/';
	/** @const access api url */
	const ACCESS = '/?access_token=';

	/** @var int id*/
	private $id;

	/** @var array $c*/
	private $c;

	/**
	 * Sets id
	 *
	 * @param int id
	 *
	 * @return \Classes\Taxes
	 */
	public function setId(int $id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * Gets tax id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	public function setCredencials(array $c) {
		$this->c = $c;
		return $this;
	}

	/**
	 * Gets tax id
	 *
	 * @return int
	 */
	public function getCredencials() {
		return $this->$c;
	}


	/**
	* Delete a Tax from the Company 
	* @param int $tax_id // $this->getTaxes($c) required
	* @return json
	* https://www.moloni.pt/dev/index.php?action=getApiDocDetail&id=265
	**/
	public function deleteTax()
	{

		$this->getCredencials()['token']['access_token'];

		$url = $this->getCredencials()['url'].''.static::ENTITY.'delete'.static::ACCESS.''.$this->getCredencials()['token']['access_token'];

		return parent::curl($url, ['company_id' => $this->getCredencials()['company_id'], 'tax_id' => $this->getId()]);
	}

}