<?php

/**
 * InstallHandler.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.install
 *
 * Handle installation requests. 
 *
 * $Id: InstallHandler.inc.php,v 1.3 2004/07/21 09:19:19 kevin Exp $
 */

/* Prevent classes from trying to initialize the session manager (and thus the database connection) */
define('SESSION_DISABLE_INIT', 1);

import('install.form.InstallForm');

class InstallHandler extends Handler {

	/**
	 * If no journal is selected, display list of journals.
	 * Otherwise, display the index page for the selected journal.
	 */
	function index() {
		InstallHandler::validate();
		
		if (($setLocale = Request::getUserVar('setLocale')) != null && Locale::isValidLocale($setLocale)) {
			Request::setCookieVar('currentLocale', $setLocale);
		}
		
		$installForm = &new InstallForm();
		$installForm->initData();
		$installForm->display();
	}
	
	/**
	 * Redirect to index if system has already been installed.
	 */
	function validate() {
		if (Config::getVar('general', 'installed')) {
			Request::redirect('index');	
		}
	}
	
	function install() {
		InstallHandler::validate();
		
		$installForm = &new InstallForm();
		$installForm->readInputData();
		
		if ($installForm->validate()) {
			$installForm->execute();
			
		} else {
			$installForm->display();
		}
	}
	
}

?>
