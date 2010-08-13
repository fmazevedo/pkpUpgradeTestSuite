<?php

/**
 * @file CustomLocaleAction.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocaleAction
 * @ingroup plugins_generic_customLocale
 *
 * @brief Perform various tasks related to customization of locale strings.
 */

// $Id: CustomLocaleAction.inc.php,v 1.3.2.1 2009/04/08 19:43:16 asmecher Exp $


class CustomLocaleAction {

	function getLocaleFiles($locale) {
		if (!Locale::isLocaleValid($locale)) return null;

		$localeFiles = array(Locale::getMainLocaleFilename($locale));
		$plugins =& PluginRegistry::loadAllPlugins();
		foreach (array_keys($plugins) as $key) {
			$plugin =& $plugins[$key];
			$localeFile = $plugin->getLocaleFilename($locale);
			if (!empty($localeFile)) $localeFiles[] = $localeFile;
			unset($plugin);
		}
		return $localeFiles;
	}

	function isLocaleFile($locale, $filename) {
		if (in_array($filename, CustomLocaleAction::getLocaleFiles($locale))) return true;
		return false;
	}

}
?>
