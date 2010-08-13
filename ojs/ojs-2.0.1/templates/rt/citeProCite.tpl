{**
 * citeReferenceManager.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Reference Manager citation format generator
 *
 * $Id: citeProCite.tpl,v 1.3 2005/06/28 05:43:59 kevin Exp $
 *}

	TY  - JOUR
{foreach from=$article->getAuthors() item=author}
	AU  - {$author->getFullName(true)}
{/foreach}
	PY  - {$article->getDatePublished()|date_format:"%Y"}
	TI  - {$article->getArticleTitle()}
	JF  - {$journal->getTitle()}; {$issue->getIssueIdentification()}
	Y2  - {$article->getDatePublished()|date_format:"%Y"}
	KW  - {$article->getSubject()}
	N2  - {$article->getArticleAbstract()}
	UR  - {$pageUrl}/article/view/{$articleId}/{$galleyId}
	
