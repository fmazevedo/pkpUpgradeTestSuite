{**
 * journals.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * RTAdmin journal list
 *
 * $Id: journals.tpl,v 1.11.2.1 2009/04/08 19:43:33 asmecher Exp $
 *}
{assign var="pageTitle" value="rt.readingTools"}
{include file="common/header.tpl"}

<h3>{translate key="user.myJournals"}</h3>

<ul class="plain">
{foreach from=$journals item=journal}
<li>&#187; <a href="{url journal=$journal->getPath() page="rtadmin"}">{$journal->getJournalTitle()|escape}</a></li>
{/foreach}
</ul>

{include file="common/footer.tpl"}
