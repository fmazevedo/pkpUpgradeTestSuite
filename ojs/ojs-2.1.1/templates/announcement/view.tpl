{**
 * view.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v1. For full terms see the file docs/COPYING.
 *
 * View full announcement text. 
 *
 * $Id: view.tpl,v 1.2 2006/06/12 23:26:26 alec Exp $
 *}

{assign var="pageTitleTranslated" value=$announcementTitle}
{assign var="pageId" value="announcement.view"}
{include file="common/header.tpl"}

<table width="100%">
	<tr>
		<td>{$announcement->getDescription()|nl2br}</td>
	</tr>
</table>

{include file="common/footer.tpl"}
