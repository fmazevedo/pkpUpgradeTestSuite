{**
 * suppFiles.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Article reading tools -- supplementary files page.
 *
 * $Id: suppFiles.tpl,v 1.13 2006/06/12 23:26:32 alec Exp $
 *}

{assign var=pageTitle value="rt.suppFiles"}

{include file="rt/header.tpl"}

<h3>{$article->getArticleTitle()|strip_unsafe_html}</h3>

{foreach from=$article->getSuppFiles() item=suppFile key=key}
<h4>{$key+1}. {$suppFile->getTitle()|escape}</h4>
<table class="data" width="100%">
<tr valign="top">
	<td class="label" width="20%">{translate key="common.subject"}</td>
	<td class="value" width="80%">
		{$suppFile->getSubject()|escape}
	</td>
</tr>
<tr valign="top">
	<td class="label" width="20%">{translate key="common.type"}</td>
	<td class="value" width="80%">
		{if $suppFile->getType()|escape}
			{$suppFile->getType()}
		{elseif $suppFile->getTypeOther()}
			{$suppFile->getTypeOther()|escape}
		{else}
			{translate key="common.other"}
		{/if}
	</td>
</tr>
<tr valign="top">
	<td class="label" width="20%">&nbsp;</td>
	<td class="value" width="80%">
		<a href="{url page="article" op="downloadSuppFile" path=$articleId|to_array:$suppFile->getBestSuppFileId($currentJournal)}" class="action">{if $suppFile->isInlineable()}{translate key="common.view"}{else}{translate key="common.download"}{/if}</a> ({$suppFile->getNiceFileSize()})&nbsp;&nbsp;&nbsp;&nbsp;<a href="{url op="suppFileMetadata" path=$articleId|to_array:$galleyId:$suppFile->getSuppFileId()}" class="action">{translate key="rt.suppFiles.viewMetadata"}</a>
	</td>
</tr>
</table>

{/foreach}

{include file="rt/footer.tpl"}
