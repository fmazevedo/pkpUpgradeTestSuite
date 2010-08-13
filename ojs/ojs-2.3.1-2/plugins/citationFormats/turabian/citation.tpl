{**
 * citation.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Article reading tools -- Capture Citation
 *
 * $Id: citation.tpl,v 1.9 2009/05/26 01:31:17 mcrider Exp $
 *}
<div class="separator"></div>

<div id="citation">
{assign var=authors value=$article->getAuthors()}
{assign var=authorCount value=$authors|@count}
{foreach from=$authors item=author name=authors key=i}
	{assign var=firstName value=$author->getFirstName()}
	{$author->getLastName()|escape}, {$firstName|escape}{if $i==$authorCount-2}, {translate key="rt.context.and"} {elseif $i<$authorCount-1}, {else}.{/if}
{/foreach}

"{$article->getLocalizedTitle()|strip_unsafe_html}" <em>{$journal->getLocalizedTitle()|escape}</em> [{translate key="rt.captureCite.online"}], {translate key="issue.volume"} {if $issue}{$issue->getVolume()|escape} {translate key="issue.number"} {$issue->getNumber()|escape} {/if}({$article->getDatePublished()|date_format:'%e %B %Y'|trim})
</div>
