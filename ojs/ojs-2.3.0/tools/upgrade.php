<?php

/**
 * @file tools/upgrade.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class upgradeTool
 * @ingroup tools
 *
 * @brief CLI tool for upgrading OJS.
 *
 * Note: Some functions require fopen wrappers to be enabled.
 */

// $Id: upgrade.php,v 1.21 2009/04/08 19:54:53 asmecher Exp $


define('INDEX_FILE_LOCATION', dirname(dirname(__FILE__)) . '/index.php');
require(dirname(dirname(__FILE__)) . '/lib/pkp/classes/cliTool/CliTool.inc.php');

import('cliTool.UpgradeTool');

class OJSUpgradeTool extends UpgradeTool {
	/**
	 * Constructor.
	 * @param $argv array command-line arguments
	 */
	function OJSUpgradeTool($argv = array()) {
		parent::UpgradeTool($argv);
	}
}

$tool = new OJSUpgradeTool(isset($argv) ? $argv : array());
$tool->execute();

?>
