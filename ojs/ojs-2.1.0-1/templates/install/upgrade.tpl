{**
 * upgrade.tpl
 *
 * Copyright (c) 2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Upgrade form.
 *
 * $Id: upgrade.tpl,v 1.2 2005/11/26 19:45:36 alec Exp $
 *}

{assign var="pageTitle" value="installer.ojsUpgrade"}
{include file="common/header.tpl"}

{translate key="installer.upgradeInstructions" version=$version->getVersionString() baseUrl=$baseUrl}


<div class="separator"></div>


<form method="post" action="{url op="installUpgrade"}">
{include file="common/formErrors.tpl"}

{if $isInstallError}
<p>
	<span class="formError">{translate key="installer.installErrorsOccurred"}:</span>
	<ul class="formErrorList">
		<li>{if $dbErrorMsg}{translate key="common.error.databaseError" error=$dbErrorMsg}{else}{translate key=$errorMsg}{/if}</li>
	</ul>
</p>
{/if}


<p><input type="submit" value="{translate key="installer.upgradeOJS"}" class="button defaultButton" /> <input type="submit" name="manualInstall" value="{translate key="installer.manualUpgrade"}" class="button" /></p>

</form>

{include file="common/footer.tpl"}
