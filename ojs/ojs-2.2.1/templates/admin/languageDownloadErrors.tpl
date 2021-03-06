{**
 * languageDownloadErrors.tpl
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Display error messages associated with a failed language download.
 *
 * $Id: languageDownloadErrors.tpl,v 1.2 2008/06/11 18:55:18 asmecher Exp $
 *}
{assign var="pageTitle" value="common.languages"}
{include file="common/header.tpl"}

<h3>{translate key="admin.languages.downloadLocales"}</h3>

<p>{translate key="admin.languages.downloadFailed"}</p>
<ul>
	{foreach from=$errors item=error}<li>{$error}</li>{/foreach}
</ul>

<a href="{url op="languages"}" class="action">{translate key="common.languages"}</a>

{include file="common/footer.tpl"}
