{**
 * futureIssues.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Listings of future (unpublished) issues.
 *
 * $Id: futureIssues.tpl,v 1.8 2005/05/16 01:56:53 kevin Exp $
 *}

{assign var="pageTitle" value="editor.issues.futureIssues"}
{assign var="currentUrl" value="$pageUrl/editor/issues"}
{include file="common/header.tpl"}

<ul class="menu">
        <li><a href="{$pageUrl}/editor/createIssue">{translate key="editor.navigation.createIssue"}</a></li>
        <li><a href="{$pageUrl}/editor/schedulingQueue">{translate key="common.queue.short.submissionsInScheduling"}</a></li>
        <li class="current"><a href="{$pageUrl}/editor/futureIssues">{translate key="editor.navigation.futureIssues"}</a></li>
        <li><a href="{$pageUrl}/editor/backIssues">{translate key="editor.navigation.issueArchive"}</a></li>
</ul>

<br/>

<table width="100%" class="listing">
	<tr>
		<td colspan="3" class="headseparator">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="80%">{translate key="issue.issue"}</td>
		<td width="15%">{translate key="editor.issues.numArticles"}</td>
		<td width="5%" align="right">{translate key="common.action"}</td>
	</tr>
	<tr>
		<td colspan="3" class="headseparator">&nbsp;</td>
	</tr>
	{iterate from=issues item=issue}
	<tr valign="top">
		<td><a href="{$requestPageUrl}/issueToc/{$issue->getIssueId()}" class="action">{$issue->getIssueIdentification()}</a></td>
		<td>{$issue->getNumArticles()}</td>
		<td align="right"><a href="{$requestPageUrl}/removeIssue/{$issue->getIssueId()}" onclick="return confirm('{translate|escape:"javascript" key="editor.issues.confirmDelete"}')" class="action">{translate key="common.delete"}</a></td>
	</tr>
	<tr>
		<td colspan="3" class="{if $issues->eof()}end{/if}separator">&nbsp;</td>
	</tr>
{/iterate}
{if $issues->wasEmpty()}
	<tr>
		<td colspan="3" class="nodata">{translate key="issue.noIssues"}</td>
	</tr>
	<tr>
		<td colspan="3" class="endseparator">&nbsp;</td>
	</tr>
{else}
	<tr>
		<td colspan="1" align="left">{page_info iterator=$issues}</td>
		<td colspan="2" align="right">{page_links name="issues" iterator=$issues}</td>
	</tr>
{/if}
</table>

{include file="common/footer.tpl"}
