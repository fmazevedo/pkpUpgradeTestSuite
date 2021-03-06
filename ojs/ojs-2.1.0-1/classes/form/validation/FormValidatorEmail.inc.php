<?php

/**
 * FormValidatorEmail.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package form.validation
 *
 * Form validation check for email addresses.
 *
 * $Id: FormValidatorEmail.inc.php,v 1.4 2005/12/21 19:30:51 alec Exp $
 */

import('form.validation.FormValidatorRegExp');

class FormValidatorEmail extends FormValidatorRegExp {
	function getRegexp() {
		return	'/^' .
			'[A-Z0-9]+([\-_\+\.][A-Z0-9]+)*' .	// Username
			'@' .
			'[A-Z0-9]+([\-_\.][A-Z0-9]+)*' .	// Domain name (excluding TLD)
			'\.' .
			'[A-Z]{2,}' .						// TLD
			'$/i';
	}

	/**
	 * Constructor.
	 * @see FormValidatorRegExp::FormValidatorRegExp()
	 */
	function FormValidatorEmail(&$form, $field, $type, $message) {
		parent::FormValidatorRegExp($form, $field, $type, $message, FormValidatorEmail::getRegexp());
	}
	
}

?>
