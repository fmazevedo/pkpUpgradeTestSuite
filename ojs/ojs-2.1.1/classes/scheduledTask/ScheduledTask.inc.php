<?php

/**
 * ScheduledTask.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package core
 *
 * Base class for executing scheduled tasks.
 * All scheduled task classes must extend this class and implement execute().
 *
 * $Id: ScheduledTask.inc.php,v 1.3 2006/06/12 23:25:52 alec Exp $
 */

class ScheduledTask {

	/** @var array task arguments */
	var $args;

	function ScheduledTask($args = array()) {
		$this->args = $args;
	}

	/**
	 * Fallback method in case task does not implement execute method.
	 */
	function execute() {
		fatalError("ScheduledTask does not implement execute()!\n");
	}
		
}
?>
