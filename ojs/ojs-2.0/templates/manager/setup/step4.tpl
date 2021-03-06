{**
 * step4.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Step 4 of journal setup.
 *
 * $Id: step4.tpl,v 1.12 2005/03/14 00:37:39 kevin Exp $
 *}

{assign var="pageTitle" value="manager.setup.managingTheJournal}
{include file="manager/setup/setupHeader.tpl"}

<form method="post" action="{$pageUrl}/manager/saveSetup/4">
{include file="common/formErrors.tpl"}

<h3>4.1 {translate key="manager.setup.publicationScheduling"}</h3>

<h4>{translate key="manager.setup.publicationSchedule"}</h4>

<p>{translate key="manager.setup.publicationScheduleDescription"}</p>

<p><textarea name="pubFreqPolicy" rows="12" cols="60" class="textArea">{$pubFreqPolicy|escape}</textarea></p>

<h4>{translate key="manager.setup.publicationFormat"}</h4>

<p>{translate key="manager.setup.publicationFormatDescription"}</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="publicationFormat" id="publicationFormat[1]" value="1"{if (!$publicationFormat || $publicationFormat == 1)} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="publicationFormat[1]">{translate key="manager.setup.publicationFormatIssue"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="publicationFormat" id="publicationFormat[2]" value="2"{if ($publicationFormat == 2)} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="publicationFormat[2]">{translate key="manager.setup.publicationFormatVolume"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="publicationFormat" id="publicationFormat[3]" value="3"{if ($publicationFormat == 3)} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="publicationFormat[3]">{translate key="manager.setup.publicationFormatYear"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="publicationFormat" id="publicationFormat[4]" value="4"{if ($publicationFormat == 4)} checked="checked"{/if} /></td>
		<td width="95%" class="value">
			<label for="publicationFormat[4]">{translate key="manager.setup.publicationFormatTitle"}</label>
			<br />
			<span class="instruct">{translate key="manager.setup.publicationFormatTitleDescription"}</span>
		</td>
	</tr>
</table>

<h4>{translate key="manager.setup.frequencyOfPublication"}</h4>

<p>{translate key="manager.setup.frequencyOfPublicationDescription"}</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="initialNumber" key="issue.number"}</td>
		<td width="80%" class="data"><input type="text" name="initialNumber" id="initialNumber" value="{$initialNumber|escape}" size="5" maxlength="8" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="initialVolume" key="issue.volume"}</td>
		<td width="80%" class="data"><input type="text" name="initialVolume" id="initialVolume" value="{$initialVolume|escape}" size="5" maxlength="8" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="initialYear" key="issue.year"}</td>
		<td width="80%" class="data"><input type="text" name="initialYear" id="initialYear" value="{$initialYear|escape}" size="5" maxlength="8" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="issuePerVolume" key="manager.setup.issuePerVolume"}</td>
		<td width="80%" class="data"><input type="text" name="issuePerVolume" id="issuePerVolume" value="{if $issuePerVolume}{$issuePerVolume|escape}{/if}" size="5" maxlength="8" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="volumePerYear" key="manager.setup.volumePerYear"}</td>
		<td width="80%" class="data"><input type="text" name="volumePerYear" id="volumePerYear" value="{if $volumePerYear}{$volumePerYear|escape}{/if}" size="5" maxlength="8" class="textField" /></td>
	</tr>
</table>

<p>{translate key="manager.setup.frequencyOfPublicationNote"}</p>


<div class="separator"></div>


<h3>4.2 {translate key="manager.setup.publicIdentifier"}</h3>

<h4>{translate key="manager.setup.uniqueIdentifier"}</h4>

<p>{translate key="manager.setup.uniqueIdentifierDescription"}</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enablePublicIssueId" id="enablePublicIssueId" value="1"{if $enablePublicIssueId} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="enablePublicIssueId">{translate key="manager.setup.enablePublicIssueId"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enablePublicArticleId" id="enablePublicArticleId" value="1"{if $enablePublicArticleId} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="enablePublicArticleId">{translate key="manager.setup.enablePublicArticleId"}</label></td>
	</tr>
</table>

<br />

<h4>{translate key="manager.setup.pageNumberIdentifier"}</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enablePageNumber" id="enablePageNumber" value="1"{if $enablePageNumber} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="enablePageNumber">{translate key="manager.setup.enablePageNumber"}</label></td>
	</tr>
</table>


<div class="separator"></div>


<h3>4.3 {translate key="manager.setup.subscription"}</h3>

<p>{translate key="manager.setup.subscriptionDescription"}</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enableSubscriptions" id="enableSubscriptions" value="1"{if $enableSubscriptions} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="enableSubscriptions">{translate key="manager.setup.enableSubscriptions"}</label></td>
	</tr>
</table>

<p>{translate key="manager.setup.subscriptionContactDescription"}</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="subscriptionName" key="user.name"}</td>
		<td width="80%" class="value"><input type="text" name="subscriptionName" id="subscriptionName" value="{$subscriptionName|escape}" size="30" maxlength="60" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="subscriptionEmail" key="user.email"}</td>
		<td width="80%" class="value"><input type="text" name="subscriptionEmail" id="subscriptionEmail" value="{$subscriptionEmail|escape}" size="30" maxlength="90" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="subscriptionPhone" key="user.phone"}</td>
		<td width="80%" class="value"><input type="text" name="subscriptionPhone" id="subscriptionPhone" value="{$subscriptionPhone|escape}" size="15" maxlength="24" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="subscriptionFax" key="user.fax"}</td>
		<td width="80%" class="value"><input type="text" name="subscriptionFax" id="subscriptionFax" value="{$subscriptionFax|escape}" size="15" maxlength="24" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="subscriptionMailingAddress" key="common.mailingAddress"}</td>
		<td width="80%" class="value"><textarea name="subscriptionMailingAddress" id="subscriptionMailingAddress" rows="3" cols="40" class="textArea">{$subscriptionMailingAddress|escape}</textarea></td>
	</tr>
</table>

<p>{translate key="manager.setup.subscriptionAdditionalInformationDescription"}</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label">{fieldLabel name="subscriptionAdditionalInformation" key="manager.setup.subscriptionAdditionalInformation"}</td>
		<td width="80%" class="value"><textarea name="subscriptionAdditionalInformation" id="subscriptionAdditionalInformation" rows="3" cols="40" class="textArea">{$subscriptionAdditionalInformation|escape}</textarea></td>
	</tr>
</table>


<div class="separator"></div>


<h3>4.4 {translate key="manager.setup.copyediting"}</h3>

<p>{translate key="manager.setup.selectOne"}:</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="useCopyeditors" id="useCopyeditors[1]" value="1"{if $useCopyeditors} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="useCopyeditors[1]">{translate key="manager.setup.useCopyeditors"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="useCopyeditors" id="useCopyeditors[0]" value="0"{if !$useCopyeditors} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="useCopyeditors[0]">{translate key="manager.setup.noUseCopyeditors"}</label></td>
	</tr>
</table>

<h4>{translate key="manager.setup.copyeditInstructions"}</h4>

<p>{translate key="manager.setup.copyeditInstructionsDescription"}</p>

<p>
	<textarea name="copyeditInstructions" id="copyeditInstructions" rows="12" cols="60" class="textArea">{$copyeditInstructions|escape}</textarea>
	<br />
	<span class="instruct">{translate key="manager.setup.htmlSetupInstructions"}</span>
</p>


<div class="separator"></div>


<h3>4.5 {translate key="manager.setup.layoutAndGalleys"}</h3>

<p>{translate key="manager.setup.selectOne"}:</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="useLayoutEditors" id="useLayoutEditors[1]" value="1"{if $useLayoutEditors} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="useLayoutEditors[1]">{translate key="manager.setup.useLayoutEditors"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="useLayoutEditors" id="useLayoutEditors[0]" value="0"{if !$useLayoutEditors} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="useLayoutEditors[0]">{translate key="manager.setup.noUseLayoutEditors"}</label></td>
	</tr>
</table>

<h4>{translate key="manager.setup.layoutInstructions"}</h4>

<p>{translate key="manager.setup.layoutInstructionsDescription"}</p>

<p>
	<textarea name="layoutInstructions" id="layoutInstructions" rows="12" cols="60" class="textArea">{$layoutInstructions|escape}</textarea>
	<br />
	<span class="instruct">{translate key="manager.setup.htmlSetupInstructions"}</span>
</p>


<div class="separator"></div>


<h3>4.6 {translate key="manager.setup.proofreading"}</h3>

<p>{translate key="manager.setup.selectOne"}:</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="useProofreaders" id="useProofreaders[1]" value="1"{if $useProofreaders} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="useProofreaders[1]">{translate key="manager.setup.useProofreaders"}</label></td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="useProofreaders" id="useProofreaders[0]" value="0"{if !$useProofreaders} checked="checked"{/if} /></td>
		<td width="95%" class="value"><label for="useProofreaders[0]">{translate key="manager.setup.noUseProofreaders"}</label></td>
	</tr>
</table>

<h4>{translate key="manager.setup.proofingInstructions"}</h4>

<p>{translate key="manager.setup.proofingInstructionsDescription"}</p>

<p>
	<textarea name="proofInstructions" id="proofInstructions" rows="12" cols="60" class="textArea">{$proofInstructions|escape}</textarea>
	<br />
	<span class="instruct">{translate key="manager.setup.htmlSetupInstructions"}</span>
</p>


<div class="separator"></div>


<p><input type="submit" value="{translate key="common.saveAndContinue"}" class="button defaultButton" /> <input type="button" value="{translate key="common.cancel"}" class="button" onclick="document.location.href='{$pageUrl}/manager/setup'" /></p>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>

</form>

{include file="common/footer.tpl"}
