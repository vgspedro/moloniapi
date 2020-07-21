<?php
namespace VgsPedro\MoloniApi\Classes;

/**
 * A class which creates get taxes request
 */
class Taxes {

	/** @const string Uri to required api */
	//const URI = "/nativecheckout/v2/installments";
	const URI = "/taxes/getAll/";

	/** @const string Request method */
	const METHOD = "POST";

	/** @var int taxId*/
	private $taxId;

	/**
	 * Sets Tax Id
	 *
	 * @param $int $taxId Tax Id
	 *
	 * @return \Transaction\Taxesn
	 */
	public function setTaxId($taxId) {

		if (!is_string($taxId) && !is_int($taxId)) {

			return false;
		}

		$this->taxId = (int) $taxId;

		return $this;
	}

	/**
	 * Gets tax id
	 *
	 * @return int
	 */
	public function geTaxId() {

		return $this->taxId;
	}

	/**
	 * Sends request to api
	 *
	 * @return stdClass
	 */
	public function send() {

		$this->setHeaders(["company_id" => $this->getCompanyId()]);
		$this->setExpectedResult(["maxInstallments" => "Max installments"]);

		return parent::send();
	}
}