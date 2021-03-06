<?php

/**
 * @file classes/core/Handler.inc.php
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class Handler
 * @ingroup handler
 *
 * @brief Base request handler application class
 */


import('handler.PKPHandler');
import('handler.validation.HandlerValidatorJournal');
import('handler.validation.HandlerValidatorRoles');
import('handler.validation.HandlerValidatorSubmissionComment');

class Handler extends PKPHandler {
	function Handler() {
		parent::PKPHandler();

		$journal =& Request::getJournal();
		$page = Request::getRequestedPage();
		if ( $journal && $journal->getSetting('restrictSiteAccess')) { 
			$this->addCheck(new HandlerValidatorCustom($this, true, null, null, create_function('$page', 'if (!Validation::isLoggedIn() && !in_array($page, Handler::getLoginExemptions())) return false; else return true;'), array($page)));
		}
	}
}

?>
