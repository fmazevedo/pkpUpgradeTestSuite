{**
 * formErrors.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * List errors that occurred during form processing.
 *
 * $Id: formErrors.tpl,v 1.9.2.1 2009/04/08 19:43:31 asmecher Exp $
 *}
{if $isError}
<p>
	<a name="formErrors"></a>
	<span class="formError">{translate key="form.errorsOccurred"}:</span>
	<ul class="formErrorList">
	{foreach key=field item=message from=$errors}
		<li>{$message}</li>
	{/foreach}
	</ul>
</p>
<script type="text/javascript">
{literal}
<!--
// Jump to form errors.
window.location.hash="formErrors";
// -->
{/literal}
</script>
{/if}
