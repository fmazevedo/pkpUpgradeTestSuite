{**
 * proofGalleyHTML.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Frame displaying an HTML galley.
 *
 * $Id: proofGalleyHTML.tpl,v 1.4.2.1 2005/09/21 19:09:03 alec Exp $
 *}

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset={$defaultCharset}" />
	<title>{translate key=$pageTitle}</title>
	<link rel="stylesheet" href="{$baseUrl}/styles/common.css" type="text/css" />
	{foreach from=$stylesheets item=cssFile}
	<link rel="stylesheet" href="{$baseUrl}/styles/{$cssFile}" type="text/css" />
	{/foreach}
	{if $pageStyleSheet}
	<link rel="stylesheet" href="{$publicFilesDir}/{$pageStyleSheet.uploadName}" type="text/css" />
	{/if}
	{if $galley->getStyleFileId()}
	<link rel="stylesheet" href="{$requestPageUrl}/viewFile/{$galley->getArticleId()}/{$galley->getGalleyId()}/{$galley->getStyleFileId()}" type="text/css" />
	{/if}
</head>
<body>
	{$galley->getHTMLContents("$requestPageUrl/viewFile")}
</body>
</html>
