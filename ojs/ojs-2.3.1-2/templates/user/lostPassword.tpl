{**
 * lostPassword.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Password reset form.
 *
 * $Id: lostPassword.tpl,v 1.15 2009/04/08 19:54:53 asmecher Exp $
 *}
{strip}
{assign var="registerOp" value="register"}
{assign var="registerLocaleKey" value="user.login.registerNewAccount"}
{include file="core:user/lostPassword.tpl"}
{/strip}