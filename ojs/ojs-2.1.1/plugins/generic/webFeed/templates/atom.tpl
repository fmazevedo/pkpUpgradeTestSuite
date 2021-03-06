<?xml version="1.0" encoding="{$defaultCharset}"?>
<feed xmlns="http://www.w3.org/2005/Atom">
	{* required elements *}
	<id>{$journal->getUrl()}/issue/feed</id>
	<title>{$journal->getTitle()|strip_tags|escape:"html"}</title>
	<updated>{$issue->getDatePublished()|date_format:"%Y-%m-%dT%T%z"}</updated>

	{* recommended elements *}
	{if $journal->getSetting('contactName')}
	<author>
		<name>{$journal->getSetting('contactName')}</name>
		{if $journal->getSetting('contactEmail')}
		<email>{$journal->getSetting('contactEmail')}</email>
		{/if}
	</author>
	{/if}
	<link rel="alternate" href="{$journal->getUrl()}" />
	<link rel="self" type="application/atom+xml" href="{$journal->getUrl()}/issue/feed" />

	{* optional elements *}
	{* <category/> *}
	{* <contributor/> *}
	<generator url="http://pkp.sfu.ca/ojs/" version="{$ojsVersion}">Open Journal Systems</generator>
	{if $journal->getDescription()}
		{assign var="description" value=$journal->getDescription()}
	{elseif $journal->getSetting('journalDescription')}
		{assign var="description" value=$journal->getSetting('journalDescription')}
	{elseif $journal->getSetting('searchDescription')}
		{assign var="description" value=$journal->getSetting('searchDescription')}
	{/if}
    {if $journal->getSetting('copyrightNotice')}
    <rights>{$journal->getSetting('copyrightNotice')|strip_tags|strip|escape:"html"}</rights>
    {/if}
	<subtitle>{$description|strip_tags|strip|escape:"html"}</subtitle>


{foreach name=sections from=$publishedArticles item=section key=sectionId}
{foreach from=$section.articles item=article}
	<entry>
		{* required elements *}
		<id>{url page="article" op="view" path=$article->getBestArticleId($currentJournal)}</id>
		<title>{$article->getArticleTitle()|strip_tags|escape:"html"}</title>
		<updated>{$article->getLastModified()|date_format:"%Y-%m-%dT%T%z"}</updated>

		{* recommended elements *}
        {foreach from=$article->getAuthors() item=author name=authorList}
	  	<author>
			<name>{$author->getFullName()|strip_tags|escape:"html"}</name>
			<email>{$author->getEmail()|strip_tags|escape:"html"}</email>
        </author>
		{/foreach}
		<link rel="alternate" href="{url page="article" op="view" path=$article->getBestArticleId($currentJournal)}" />
        {if $article->getAbstract()}
		<summary type="html" xml:base="{url page="article" op="view" path=$article->getBestArticleId($currentJournal)}">{$article->getAbstract()|strip|escape:"html"}</summary>
        {/if}

		{* optional elements *}
		{* <category/> *}
		{* <contributor/> *}
		<published>{$article->getDatePublished()|date_format:"%Y-%m-%dT%T%z"}</published>
		{* <source/> *}
		{* <rights/> *}
	</entry>
{/foreach}
{/foreach}

</feed>
