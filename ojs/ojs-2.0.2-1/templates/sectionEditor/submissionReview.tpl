{**
 * submissionReview.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Submission review.
 *
 * $Id: submissionReview.tpl,v 1.15 2005/02/13 22:27:56 jasonc Exp $
 *}

{assign_translate var="pageTitleTranslated" key="submission.page.review" id=$submission->getArticleId()}
{assign var="pageCrumbTitle" value="submission.review"}
{include file="common/header.tpl"}

<ul class="menu">
	<li><a href="{$requestPageUrl}/submission/{$submission->getArticleId()}">{translate key="submission.summary"}</a></li>
	<li class="current"><a href="{$requestPageUrl}/submissionReview/{$submission->getArticleId()}">{translate key="submission.review"}</a></li>
	<li><a href="{$requestPageUrl}/submissionEditing/{$submission->getArticleId()}">{translate key="submission.editing"}</a></li>
	<li><a href="{$requestPageUrl}/submissionHistory/{$submission->getArticleId()}">{translate key="submission.history"}</a></li>
</ul>

{include file="sectionEditor/submission/summary.tpl"}

<div class="separator"></div>

{include file="sectionEditor/submission/peerReview.tpl"}

<div class="separator"></div>

{include file="sectionEditor/submission/editorDecision.tpl"}

{include file="common/footer.tpl"}
