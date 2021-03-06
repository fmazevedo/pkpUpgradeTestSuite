<?php

/**
 * SubmissionProofreadHandler.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.proofreader
 *
 * Handle requests for proofreader submission functions. 
 *
 * $Id: SubmissionProofreadHandler.inc.php,v 1.4 2005/07/27 20:04:47 alec Exp $
 */

class SubmissionProofreadHandler extends ProofreaderHandler {

	/**
	 * Submission - Proofreading view
	 */
	function submission($args) {
		$articleId = isset($args[0]) ? (int)$args[0] : 0;

		list($journal, $submission) = SubmissionProofreadHandler::validate($articleId);
		parent::setupTemplate(true, $articleId);

		$useProofreaders = $journal->getSetting('useProofreaders');

		$authorDao = &DAORegistry::getDAO('AuthorDAO');
		$authors = $authorDao->getAuthorsByArticle($articleId);

		ProofreaderAction::proofreaderProofreadingUnderway($submission);
		$useLayoutEditors = $journal->getSetting('useLayoutEditors');

		$templateMgr = &TemplateManager::getManager();
		
		$templateMgr->assign('useProofreaders', $useProofreaders);
		$templateMgr->assign('authors', $authors);
		$templateMgr->assign('submission', $submission);
		$templateMgr->assign('proofAssignment', $submission->getProofAssignment());
		$templateMgr->assign('useLayoutEditors', $useLayoutEditors);
		$templateMgr->assign('helpTopicId', 'editorial.proofreadersRole.proofreading');		
		$templateMgr->display('proofreader/submission.tpl');
	}

	/**
	 * Sets proofreader completion date
	 */
	function completeProofreader($args) {
		$articleId = Request::getUserVar('articleId');

		SubmissionProofreadHandler::validate($articleId);
		parent::setupTemplate(true);

		if (ProofreaderAction::proofreadEmail($articleId,'PROOFREAD_COMPLETE', Request::getUserVar('send')?'':'/proofreader/completeProofreader')) {
			Request::redirect(sprintf('proofreader/submission/%d', $articleId));	
		}		
	}

	/**
	 * Validate that the user is the assigned proofreader for the submission.
	 * Redirects to proofreader index page if validation fails.
	 */
	function validate($articleId) {
		parent::validate();
		
		$isValid = false;
		
		$journal = &Request::getJournal();
		$user = &Request::getUser();
		
		$proofreaderDao = &DAORegistry::getDAO('ProofreaderSubmissionDAO');
		$submission = &$proofreaderDao->getSubmission($articleId, $journal->getJournalId());

		if (isset($submission)) {
			$proofAssignment = &$submission->getProofAssignment();
			if ($proofAssignment->getProofreaderId() == $user->getUserId()) {
				$isValid = true;
			}			
		}
		
		if (!$isValid) {
			Request::redirect(Request::getRequestedPage());
		}

		return array($journal, $submission);
	}
	
	//
	// Misc
	//
	
	/**
	 * Download a file.
	 * @param $args array ($articleId, $fileId, [$revision])
	 */
	function downloadFile($args) {
		$articleId = isset($args[0]) ? $args[0] : 0;
		$fileId = isset($args[1]) ? $args[1] : 0;
		$revision = isset($args[2]) ? $args[2] : null;

		list($journal, $submission) = SubmissionProofreadHandler::validate($articleId);
		if (!ProofreaderAction::downloadProofreaderFile($submission, $fileId, $revision)) {
			Request::redirect(sprintf('%s/submission/%d', Request::getRequestedPage(), $articleId));
		}
	}

	/**
	 * Proof / "preview" a galley.
	 * @param $args array ($articleId, $galleyId)
	 */
	function proofGalley($args) {
		$articleId = isset($args[0]) ? (int) $args[0] : 0;
		$galleyId = isset($args[1]) ? (int) $args[1] : 0;
		list($journal, $submission) = SubmissionProofreadHandler::validate($articleId);
		
		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign('articleId', $articleId);
		$templateMgr->assign('galleyId', $galleyId);
		$templateMgr->display('submission/layout/proofGalley.tpl');
	}
	
	/**
	 * Proof galley (shows frame header).
	 * @param $args array ($articleId, $galleyId)
	 */
	function proofGalleyTop($args) {
		$articleId = isset($args[0]) ? (int) $args[0] : 0;
		$galleyId = isset($args[1]) ? (int) $args[1] : 0;
		list($journal, $submission) = SubmissionProofreadHandler::validate($articleId);
		
		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign('articleId', $articleId);
		$templateMgr->assign('galleyId', $galleyId);
		$templateMgr->assign('backHandler', 'submission');
		$templateMgr->display('submission/layout/proofGalleyTop.tpl');
	}
	
	/**
	 * Proof galley (outputs file contents).
	 * @param $args array ($articleId, $galleyId)
	 */
	function proofGalleyFile($args) {
		$articleId = isset($args[0]) ? (int) $args[0] : 0;
		$galleyId = isset($args[1]) ? (int) $args[1] : 0;
		list($journal, $submission) = SubmissionProofreadHandler::validate($articleId);
		
		$galleyDao = &DAORegistry::getDAO('ArticleGalleyDAO');
		$galley = &$galleyDao->getGalley($galleyId, $articleId);
		
		import('file.ArticleFileManager'); // FIXME
		
		if (isset($galley)) {
			if ($galley->isHTMLGalley()) {
				$templateMgr = &TemplateManager::getManager();
				$templateMgr->assign('galley', $galley);
				$templateMgr->display('submission/layout/proofGalleyHTML.tpl');
				
			} else {
				// View non-HTML file inline
				SubmissionProofreadHandler::viewFile(array($articleId, $galley->getFileId()));
			}
		}
	}
	
	/**
	 * View a file (inlines file).
	 * @param $args array ($articleId, $fileId, [$revision])
	 */
	function viewFile($args) {
		$articleId = isset($args[0]) ? $args[0] : 0;
		$fileId = isset($args[1]) ? $args[1] : 0;
		$revision = isset($args[2]) ? $args[2] : null;

		list($journal, $submission) = SubmissionProofreadHandler::validate($articleId);
		if (!ProofreaderAction::viewFile($articleId, $fileId, $revision)) {
			Request::redirect(sprintf('%s/submission/%d', Request::getRequestedPage(), $articleId));
		}
	}

}

?>
