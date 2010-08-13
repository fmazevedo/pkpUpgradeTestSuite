<?php

/**
 * @file ClassicNavyThemePlugin.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ClassicNavyThemePlugin
 * @ingroup plugins_themes_classicNavy
 *
 * @brief "ClassicNavy" theme plugin
 */

// $Id: ClassicNavyThemePlugin.inc.php,v 1.7 2009/04/08 19:54:49 asmecher Exp $


import('classes.plugins.ThemePlugin');

class ClassicNavyThemePlugin extends ThemePlugin {
	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'ClassicNavyThemePlugin';
	}

	function getDisplayName() {
		return 'ClassicNavy Theme';
	}

	function getDescription() {
		return 'Classic navy layout';
	}

	function getStylesheetFilename() {
		return 'classicNavy.css';
	}

	function getLocaleFilename($locale) {
		return null; // No locale data
	}
}

?>
