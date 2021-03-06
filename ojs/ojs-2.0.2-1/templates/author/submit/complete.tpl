{**
 * complete.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Generic message page.
 * Displays a simple message and (optionally) a return link.
 *
 * $Id: complete.tpl,v 1.3 2005/03/26 23:05:42 alec Exp $
 *}

{include file="common/header.tpl"}

<p>{translate key="author.submit.submissionComplete" journalTitle=$journal->getTitle()}</p>

{if $backLink}
<p>&#187; <a href="{$backLink}">{translate key="$backLinkLabel"}</a></p>
{/if}

{include file="common/footer.tpl"}
