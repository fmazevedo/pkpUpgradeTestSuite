{**
 * viewPage.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * View issue: This adds the header and footer code to view.tpl.
 *
 * $Id: viewPage.tpl,v 1.3 2005/11/29 23:28:12 alec Exp $
 *}

{if $issue->getPublished()}
	{assign var="pageTitleTranslated" value=$issueTitle}
{else}
	{translate|assign:"previewText" key="editor.issues.preview"}
	{assign var="pageTitleTranslated" value="$issueTitle $previewText"}
{/if}

{assign var="pageCrumbTitleTranslated" value=$issueCrumbTitle}
{include file="common/header.tpl"}

{include file="issue/view.tpl"}

{include file="common/footer.tpl"}
