<?php

/**
 * ProfileHandler.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.user
 *
 * Handle requests for modifying user profiles. 
 *
 * $Id: ProfileHandler.inc.php,v 1.4 2006/06/12 23:26:16 alec Exp $
 */

class ProfileHandler extends UserHandler {
	
	/**
	 * Display form to edit user's profile.
	 */
	function profile() {
		parent::validate();
		parent::setupTemplate(true);
		
		import('user.form.ProfileForm');
		
		$profileForm = &new ProfileForm();
		$profileForm->initData();
		$profileForm->display();
	}
	
	/**
	 * Validate and save changes to user's profile.
	 */
	function saveProfile() {
		parent::validate();
		
		import('user.form.ProfileForm');
		
		$profileForm = &new ProfileForm();
		$profileForm->readInputData();
		
		if ($profileForm->validate()) {
			$profileForm->execute();
			Request::redirect(null, Request::getRequestedPage());
			
		} else {
			parent::setupTemplate(true);
			$profileForm->display();
		}
	}
	
	/**
	 * Display form to change user's password.
	 */
	function changePassword() {
		parent::validate();
		parent::setupTemplate(true);
		
		import('user.form.ChangePasswordForm');
		
		$passwordForm = &new ChangePasswordForm();
		$passwordForm->initData();
		$passwordForm->display();
	}
	
	/**
	 * Save user's new password.
	 */
	function savePassword() {
		parent::validate();
		
		import('user.form.ChangePasswordForm');
		
		$passwordForm = &new ChangePasswordForm();
		$passwordForm->readInputData();
		
		if ($passwordForm->validate()) {
			$passwordForm->execute();
			Request::redirect(null, Request::getRequestedPage());
			
		} else {
			parent::setupTemplate(true);
			$passwordForm->display();
		}
	}
	
}

?>
