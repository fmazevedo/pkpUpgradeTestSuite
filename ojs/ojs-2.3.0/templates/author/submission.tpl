{**
 * submission.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Author's submission summary.
 *
 * $Id: submission.tpl,v 1.36 2009/05/29 23:03:49 asmecher Exp $
 *}
{strip}
{translate|assign:"pageTitleTranslated" key="submission.page.summary" id=$submission->getArticleId()}
{assign var="pageCrumbTitle" value="submission.summary"}
{include file="common/header.tpl"}
{/strip}

<ul class="menu">
	<li class="current"><a href="{url op="submission" path=$submission->getArticleId()}">{translate key="submission.summary"}</a></li>
	<li><a href="{url op="submissionReview" path=$submission->getArticleId()}">{translate key="submission.review"}</a></li>
	<li><a href="{url op="submissionEditing" path=$submission->getArticleId()}">{translate key="submission.editing"}</a></li>
</ul>

{include file="author/submission/management.tpl"}

{if $authorFees}
<div class="separator"></div>

{include file="author/submission/authorFees.tpl"}
{/if}

<div class="separator"></div>

{include file="author/submission/status.tpl"}

<div class="separator"></div>

{include file="submission/metadata/metadata.tpl"}

{include file="common/footer.tpl"}
