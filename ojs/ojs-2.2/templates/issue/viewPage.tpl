{**
 * viewPage.tpl
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * View issue: This adds the header and footer code to view.tpl.
 *
 * $Id: viewPage.tpl,v 1.9 2007/09/04 16:31:45 asmecher Exp $
 *}
{if $issue && !$issue->getPublished()}{translate|assign:"previewText" key="editor.issues.preview"}{assign var="pageTitleTranslated" value="$issueHeadingTitle $previewText"}
{else}{assign var="pageTitleTranslated" value=$issueHeadingTitle}{/if}
{if $issue && $issue->getShowTitle() && $issue->getIssueTitle() && ($issueHeadingTitle != $issue->getIssueTitle())}
{* If the title is specified and should be displayed then show it as a subheading *}
{assign var="pageSubtitleTranslated" value=$issue->getIssueTitle()}
{/if}
{include file="common/header.tpl"}

{include file="issue/view.tpl"}

{include file="common/footer.tpl"}
