{**
 * site.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * About the Journal site.
 *
 * $Id: site.tpl,v 1.15.2.1 2009/04/08 19:43:30 asmecher Exp $
 *}
{assign var="pageTitle" value="about.aboutSite"}
{include file="common/header.tpl"}
{if !empty($about)}
	<p>{$about|nl2br}</p>
{/if}

<h3>{translate key="journal.journals"}</h3>
<ul class="plain">
{iterate from=journals item=journal}
	<li>&#187; <a href="{url journal=`$journal->getPath()` page="about" op="index"}">{$journal->getJournalTitle()|escape}</a></li>
{/iterate}
</ul>

<a href="{url op="aboutThisPublishingSystem"}">{translate key="about.aboutThisPublishingSystem"}</a>

{include file="common/footer.tpl"}
