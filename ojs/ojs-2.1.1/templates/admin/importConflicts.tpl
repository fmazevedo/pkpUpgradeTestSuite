{**
 * importConflicts.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Migration conflicts list
 *
 * $Id: importConflicts.tpl,v 1.2 2006/06/12 23:26:26 alec Exp $
 *}

{include file="common/header.tpl"}

<p>{translate key="admin.journals.importOJS1.conflict.desc"}</p>

<ul>
{foreach from=$conflicts item=conflict}
	{assign var=firstUser value=$conflict[0]}
	{assign var=secondUser value=$conflict[1]}
	<li>{translate|escape key="admin.journals.importOJS1.conflict" firstUsername=$firstUser->getUsername() firstName=$firstUser->getFullName() secondUsername=$secondUser->getUsername() secondName=$secondUser->getFullName()}</li>
{/foreach}
</ul>

<p>&#187; <a href="{url op="editJournal" path=$journalId}">{translate key="admin.journals.importOJS1.editMigratedJournal"}</a></p>

{include file="common/footer.tpl"}
