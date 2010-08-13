{**
 * index.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Layout editor index.
 *
 * $Id: index.tpl,v 1.10 2005/02/13 22:27:56 jasonc Exp $
 *}

{assign var="pageTitle" value="common.queue.long.$pageToDisplay"}
{include file="common/header.tpl"}

<ul class="menu">
	<li{if ($pageToDisplay == "active")} class="current"{/if}><a href="{$pageUrl}/layoutEditor/index/active">{translate key="common.queue.short.active"}</a></li>
	<li{if ($pageToDisplay == "completed")} class="current"{/if}><a href="{$pageUrl}/layoutEditor/index/completed">{translate key="common.queue.short.completed"}</a></li>
</ul>

<br />

{include file="layoutEditor/$pageToDisplay.tpl"}

{include file="common/footer.tpl"}
