<?php

/**
 * Currency.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package currency 
 *
 * Currency class.
 * Basic class describing a currency.
 *
 * $Id: Currency.inc.php,v 1.2 2006/06/12 23:25:56 alec Exp $
 */

class Currency extends DataObject {

	function Currency() {
		parent::DataObject();
	}
	
	//
	// Get/set methods
	//
	
	/**
	 * Get the ID of the currency.
	 * @return int
	 */
	function getCurrencyId() {
		return $this->getData('currencyId');
	}
	
	/**
	 * Set the ID of the currency.
	 * @param $currencyId int
	 */
	function setCurrencyId($currencyId) {
		return $this->setData('currencyId', $currencyId);
	}

	/**
	 * Get the name of the currency.
	 * @return string
	 */
	function getName() {
		return $this->getData('name');
	}
	
	/**
	 * Set the name of the currency.
	 * @param $name string
	 */
	function setName($name) {
		return $this->setData('name', $name);
	}

	/**
	 * Get currency alpha code.
	 * @return string 
	 */
	function getCodeAlpha() {
		return $this->getData('codeAlpha');
	}
	
	/**
	 * Set currency alpha code.
	 * @param $alphaCode string
	 */
	function setCodeAlpha($codeAlpha) {
		return $this->setData('codeAlpha', $codeAlpha);
	}

	/**
	 * Get currency numeric code.
	 * @return int 
	 */
	function getCodeNumeric() {
		return $this->getData('codeNumeric');
	}
	
	/**
	 * Set currency numeric code.
	 * @param $codeNumeric string
	 */
	function setCodeNumeric($codeNumeric) {
		return $this->setData('codeNumeric', $codeNumeric);
	}

}

?>
