<?php

/**
 * @file ClassicBrownThemePlugin.inc.php
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ClassicBrownThemePlugin
 * @ingroup plugins_themes_classicBrown
 *
 * @brief "ClassicBrown" theme plugin
 */

// $Id: ClassicBrownThemePlugin.inc.php,v 1.6 2008/07/01 01:16:14 asmecher Exp $


import('classes.plugins.ThemePlugin');

class ClassicBrownThemePlugin extends ThemePlugin {
	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'ClassicBrownThemePlugin';
	}

	function getDisplayName() {
		return 'ClassicBrown Theme';
	}

	function getDescription() {
		return 'Classic brown layout';
	}

	function getStylesheetFilename() {
		return 'classicBrown.css';
	}

	function getLocaleFilename($locale) {
		return null; // No locale data
	}
}

?>
