<?php

/**
 * @file FormValidatorRegExp.inc.php
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package form.validation
 * @class FormValidatorRegExp
 *
 * Form validation check using a regular expression.
 *
 * $Id: FormValidatorRegExp.inc.php,v 1.8 2007/09/19 00:04:32 asmecher Exp $
 */

import ('form.validation.FormValidator');

class FormValidatorRegExp extends FormValidator {

	/** The regular expression to match against the field value */
	var $regExp;

	/**
	 * Constructor.
	 * @see FormValidator::FormValidator()
	 * @param $regExp string the regular expression (PCRE form)
	 */
	function FormValidatorRegExp(&$form, $field, $type, $message, $regExp) {
		parent::FormValidator($form, $field, $type, $message);
		$this->regExp = $regExp;
	}

	/**
	 * Check if field value is valid.
	 * Value is valid if it is empty and optional or matches regular expression.
	 * @return boolean
	 */
	function isValid() {
		return $this->isEmptyAndOptional() || String::regexp_match($this->regExp, $this->form->getData($this->field));
	}

}

?>
