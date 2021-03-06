<?php

/**
 * @file classes/admin/form/SiteSettingsForm.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class SiteSettingsForm
 * @ingroup admin_form
 * @see PKPSiteSettingsForm
 *
 * @brief Form to edit site settings.
 */

// $Id: SiteSettingsForm.inc.php,v 1.27 2009/05/12 14:34:53 asmecher Exp $


import('admin.form.PKPSiteSettingsForm');

class SiteSettingsForm extends PKPSiteSettingsForm {

	/**
	 * Constructor.
	 */
	function SiteSettingsForm() {
		parent::PKPSiteSettingsForm();
	}

	/**
	 * Display the form.
	 */
	function display() {
		$journalDao =& DAORegistry::getDAO('JournalDAO');
		$journals =& $journalDao->getJournalTitles();
		$templateMgr =& TemplateManager::getManager();
		$templateMgr->assign('redirectOptions', $journals);
		return parent::display();
	}
}

?>
