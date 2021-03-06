<?php

/**
 * index.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Front controller for OJS site. Loads required files and dispatches requests to the appropriate handler. 
 *
 * $Id: index.php,v 1.15 2006/06/12 23:25:48 alec Exp $
 */

/**
 * Handle a new request.
 */
function handleRequest() {
	if (!Config::getVar('general', 'installed') && pageRequiresInstall()) {
		// Redirect to installer if application has not been installed
		Request::redirect(null, 'install');
		
	}

	// Determine the handler for this request
	$page = Request::getRequestedPage();
	$op = Request::getRequestedOp();
	$sourceFile = sprintf('pages/%s/index.php', $page);

	// If a hook has been registered to handle this page, give it the
	// opportunity to load required resources and set HANDLER_CLASS.
	if (!HookRegistry::call('LoadHandler', array(&$page, &$op, &$sourceFile))) {
		if (file_exists($sourceFile)) require($sourceFile);
		else require('pages/index/index.php');
	}

	if (!defined('SESSION_DISABLE_INIT')) {
		// Initialize session
		$sessionManager = &SessionManager::getManager();
		$session = &$sessionManager->getUserSession();
	}

	$methods = array_map('strtolower', get_class_methods(HANDLER_CLASS));

	if (in_array(strtolower($op), $methods)) {
		// Call a specific operation
		call_user_func(array(HANDLER_CLASS, $op), Request::getRequestedArgs());
		
	} else {
		// Call the selected handler's index operation
		call_user_func(array(HANDLER_CLASS, 'index'), Request::getRequestedArgs());
	}
}

// Initialize system and handle the current request
require('includes/driver.inc.php');
initSystem();
handleRequest();

?>
