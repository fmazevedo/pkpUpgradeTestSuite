<?php

/**
 * CurrencyDAO.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package currency
 *
 * Class for Currency DAO.
 * Operations for retrieving and modifying Currency objects.
 *
 * $Id: CurrencyDAO.inc.php,v 1.3 2005/07/14 22:01:28 alec Exp $
 */

import('subscription.Currency');

class CurrencyDAO extends DAO {

	/**
	 * Constructor.
	 */
	function CurrencyDAO() {
		parent::DAO();
	}

	/**
	 * Retrieve a currency by currency ID.
	 * @param $currencyId int
	 * @return Currency
	 */
	function &getCurrency($currencyId) {
		$result = &$this->retrieve(
			'SELECT * FROM currencies WHERE currency_id = ?', $currencyId
		);

		$returner = null;
		if ($result->RecordCount() != 0) {
			$returner = &$this->_returnCurrencyFromRow($result->GetRowAssoc(false));
		}
		$result->Close();
		return $returner;
	}

	/**
	 * Retrieve an array of all currencies.
	 * @return array of Currencies
	 */
	function &getCurrencies() {
		$result = &$this->retrieve(
			'SELECT * FROM currencies ORDER BY name'
		);
	
		$currencies = array();
		
		while (!$result->EOF) {
			$currencies[] = &$this->_returnCurrencyFromRow($result->GetRowAssoc(false));
			$result->moveNext();
		}
		$result->Close();
	
		return $currencies;
	}

	/**
	 * Internal function to return a Currency object from a row.
	 * @param $row array
	 * @return Currency
	 */
	function &_returnCurrencyFromRow(&$row) {
		$currency = &new Currency();
		$currency->setCurrencyId($row['currency_id']);
		$currency->setName($row['name']);
		$currency->setCodeAlpha($row['code_alpha']);
		$currency->setCodeNumeric($row['code_numeric']);
		
		return $currency;
	}
}

?>
