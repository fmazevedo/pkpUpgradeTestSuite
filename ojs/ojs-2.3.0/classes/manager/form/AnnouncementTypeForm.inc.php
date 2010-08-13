<?php

/**
 * @file classes/manager/form/AnnouncementTypeForm.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class AnnouncementTypeForm
 * @ingroup manager_form
 * @see AnnouncementType
 *
 * @brief Form for journal managers to create/edit announcement types.
 */

// $Id: AnnouncementTypeForm.inc.php,v 1.14 2009/05/12 16:57:21 asmecher Exp $

import('manager.form.PKPAnnouncementTypeForm');

class AnnouncementTypeForm extends PKPAnnouncementTypeForm {
	/**
	 * Constructor
	 * @param typeId int leave as default for new announcement type
	 */
	function AnnouncementTypeForm($typeId = null) {
		parent::PKPAnnouncementTypeForm($typeId);
	}

	/**
	 * Display the form.
	 */
	function display() {
		$templateMgr =& TemplateManager::getManager();
		$templateMgr->assign('helpTopicId', 'journal.managementPages.announcements');

		parent::display();
	}

	/**
	 * Helper function to assign the AssocType and the AssocId
	 * @param Announcement the announcement to be modified
	 */
	function _setAnnouncementTypeAssocId(&$announcementType) {
		$journal =& Request::getJournal();
		$announcementType->setAssocType(ASSOC_TYPE_JOURNAL);
		$announcementType->setAssocId($journal->getJournalId());
	}
}

?>
