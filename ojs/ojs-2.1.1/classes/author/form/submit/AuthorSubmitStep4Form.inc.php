<?php

/**
 * AuthorSubmitStep4Form.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package author.form.submit
 *
 * Form for Step 4 of author article submission.
 *
 * $Id: AuthorSubmitStep4Form.inc.php,v 1.6 2006/06/12 23:25:49 alec Exp $
 */

import("author.form.submit.AuthorSubmitForm");

class AuthorSubmitStep4Form extends AuthorSubmitForm {
	
	/**
	 * Constructor.
	 */
	function AuthorSubmitStep4Form($article) {
		parent::AuthorSubmitForm($article, 4);
	}
	
	/**
	 * Display the form.
	 */
	function display() {
		$templateMgr = &TemplateManager::getManager();
		
		// Get supplementary files for this article
		$suppFileDao = &DAORegistry::getDAO('SuppFileDAO');
		$templateMgr->assign_by_ref('suppFiles', $suppFileDao->getSuppFilesByArticle($this->articleId));

		parent::display();
	}
	
	/**
	 * Save changes to article.
	 */
	function execute() {
		$articleDao = &DAORegistry::getDAO('ArticleDAO');
		
		// Update article
		$article = &$this->article;
		if ($article->getSubmissionProgress() <= $this->step) {
			$article->stampStatusModified();
			$article->setSubmissionProgress($this->step + 1);
		}
		$articleDao->updateArticle($article);
		
		return $this->articleId;
	}
	
}

?>
