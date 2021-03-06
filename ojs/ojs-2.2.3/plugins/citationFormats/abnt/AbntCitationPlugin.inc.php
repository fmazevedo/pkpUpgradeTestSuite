<?php

/**
 * @file plugins/citationFormats/abnt/AbntCitationPlugin.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class AbntCitationPlugin
 * @ingroup plugins_citationFormats_abnt
 *
 * @brief ABNT citation format plugin
 */

// $Id: AbntCitationPlugin.inc.php,v 1.5.2.1 2009/04/08 19:43:11 asmecher Exp $


import('classes.plugins.CitationPlugin');

class AbntCitationPlugin extends CitationPlugin {
	function register($category, $path) {
		$success = parent::register($category, $path);
		$this->addLocaleData();
		return $success;
	}

	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'AbntCitationPlugin';
	}

	function getDisplayName() {
		return Locale::translate('plugins.citationFormats.abnt.displayName');
	}

	function getCitationFormatName() {
		return Locale::translate('plugins.citationFormats.abnt.citationFormatName');
	}

	function getDescription() {
		return Locale::translate('plugins.citationFormats.abnt.description');
	}

}

?>
