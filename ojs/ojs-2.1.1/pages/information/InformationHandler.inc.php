<?php

/**
 * InformationHandler.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.information
 *
 * Display journal information.
 *
 * $Id: InformationHandler.inc.php,v 1.3 2006/06/12 23:26:08 alec Exp $
 */

class InformationHandler extends Handler {

	/**
	 * Display the information page for the journal..
	 */
	function index($args) {
		parent::validate();
		$journal = Request::getJournal();

		if ($journal == null) {
			Request::redirect('index');
			return;
		}

		switch(isset($args[0])?$args[0]:null) {
			case 'readers':
				$content = $journal->getSetting('readerInformation');
				$pageTitle = 'navigation.infoForReaders.long';
				$pageCrumbTitle = 'navigation.infoForReaders';
				break;
			case 'authors':
				$content = $journal->getSetting('authorInformation');
				$pageTitle = 'navigation.infoForAuthors.long';
				$pageCrumbTitle = 'navigation.infoForAuthors';
				break;
			case 'librarians':
				$content = $journal->getSetting('librarianInformation');
				$pageTitle = 'navigation.infoForLibrarians.long';
				$pageCrumbTitle = 'navigation.infoForAuthors';
				break;
			default:
				Request::redirect($journal->getPath());
				return;
		}

		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign('pageCrumbTitle', $pageCrumbTitle);
		$templateMgr->assign('pageTitle', $pageTitle);
		$templateMgr->assign('content', $content);
		$templateMgr->display('information/information.tpl');
	}

	function readers() {
		InformationHandler::index(array('readers'));
	}

	function authors() {
		InformationHandler::index(array('authors'));
	}

	function librarians() {
		InformationHandler::index(array('librarians'));
	}
}

?>
