{**
 * site.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * About the Journal site.
 *
 * $Id: site.tpl,v 1.11 2006/06/12 23:26:26 alec Exp $
 *}

{assign var="pageTitle" value="about.aboutSite"}
{include file="common/header.tpl"}
{if !empty($about)}
	<p>{$about|nl2br}</p>
{/if}

<h3>{translate key="journal.journals"}</h3>
<ul class="plain">
{iterate from=journals item=journal}
	<li>&#187; <a href="{url journal=`$journal->getPath()` page="about" op="index"}">{$journal->getTitle()|escape}</a></li>
{/iterate}
</ul>

<a href="{url op="aboutThisPublishingSystem"}">{translate key="about.aboutThisPublishingSystem"}</a>

{include file="common/footer.tpl"}
