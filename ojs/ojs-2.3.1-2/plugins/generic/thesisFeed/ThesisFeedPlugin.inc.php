<?php

/**
 * @file ThesisFeedPlugin.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ThesisFeedPlugin
 * @ingroup plugins_generic_thesisFeed
 *
 * @brief Thesis Feed plugin class
 */

// $Id: ThesisFeedPlugin.inc.php,v 1.9 2009/09/22 21:20:37 asmecher Exp $


import('classes.plugins.GenericPlugin');

class ThesisFeedPlugin extends GenericPlugin {
	function register($category, $path) {
		if (parent::register($category, $path)) {
			if ($this->getEnabled()) {
				HookRegistry::register('TemplateManager::display',array(&$this, 'callbackAddLinks'));
				HookRegistry::register('PluginRegistry::loadCategory', array(&$this, 'callbackLoadCategory'));
			}
			$this->addLocaleData();
			return true;
		}
		return false;
	}

	/**
	 * Get the symbolic name of this plugin
	 * @return string
	 */
	function getName() {
		return 'ThesisFeedPlugin';
	}

	/**
	 * Get the display name of this plugin
	 * @return string
	 */
	function getDisplayName() {
		return Locale::translate('plugins.generic.thesisfeed.displayName');
	}

	/**
	 * Get the description of this plugin
	 * @return string
	 */
	function getDescription() {
		return Locale::translate('plugins.generic.thesisfeed.description');
	}   

	/**
	 * Check whether or not this plugin is enabled
	 * @return boolean
	 */
	function getEnabled() {
		$journal =& Request::getJournal();
		$journalId = $journal?$journal->getJournalId():0;
		return $this->getSetting($journalId, 'enabled');
	}

	/**
	 * Register as a block and gateway plugin, even though this is a generic plugin.
	 * This will allow the plugin to behave as a block and gateway plugin
	 * @param $hookName string
	 * @param $args array
	 */
	function callbackLoadCategory($hookName, $args) {
		$category =& $args[0];
		$plugins =& $args[1];
		switch ($category) {
			case 'blocks':
				$this->import('ThesisFeedBlockPlugin');
				$blockPlugin = new ThesisFeedBlockPlugin();
				$plugins[$blockPlugin->getSeq()][$blockPlugin->getPluginPath()] =& $blockPlugin;
				break;
			case 'gateways':
				$this->import('ThesisFeedGatewayPlugin');
				$gatewayPlugin = new ThesisFeedGatewayPlugin();
				$plugins[$gatewayPlugin->getSeq()][$gatewayPlugin->getPluginPath()] =& $gatewayPlugin;
				break;
		}
		return false;
	}

	function callbackAddLinks($hookName, $args) {
		if ($this->getEnabled()) {
			$templateManager =& $args[0];
			$currentJournal =& $templateManager->get_template_vars('currentJournal');

			$thesisPlugin =& PluginRegistry::getPlugin('generic', 'ThesisPlugin');
			$thesisEnabled = $thesisPlugin->getEnabled(); 

			$displayPage = $currentJournal ? $this->getSetting($currentJournal->getJournalId(), 'displayPage') : null;
			$requestedPage = Request::getRequestedPage();

			if ( $thesisEnabled && (($displayPage == 'all') || ($displayPage == 'homepage' && (empty($requestedPage) || $requestedPage == 'index' || $requestedPage == 'thesis')) || ($displayPage == $requestedPage)) ) { 

				// if we have a journal selected, append feed meta-links into the header
				$additionalHeadData = $templateManager->get_template_vars('additionalHeadData');

				$feedUrl1 = '<link rel="alternate" type="application/atom+xml" href="'.$currentJournal->getUrl().'/gateway/plugin/ThesisFeedGatewayPlugin/atom" />';
				$feedUrl2 = '<link rel="alternate" type="application/rdf+xml" href="'.$currentJournal->getUrl().'/gateway/plugin/ThesisFeedGatewayPlugin/rss" />';
				$feedUrl3 = '<link rel="alternate" type="application/rss+xml" href="'.$currentJournal->getUrl().'/gateway/plugin/ThesisFeedGatewayPlugin/rss2" />';

				$templateManager->assign('additionalHeadData', $additionalHeadData."\n\t".$feedUrl1."\n\t".$feedUrl2."\n\t".$feedUrl3);
			}
		}

		return false;
	}

	/**
	 * Display verbs for the management interface.
	 */
	function getManagementVerbs() {
		$verbs = array();
		if ($this->getEnabled()) {
			$verbs[] = array(
				'disable',
				Locale::translate('manager.plugins.disable')
			);
			$verbs[] = array(
				'settings',
				Locale::translate('plugins.generic.thesisfeed.settings')
			);
		} else {
			$verbs[] = array(
				'enable',
				Locale::translate('manager.plugins.enable')
			);
		}
		return $verbs;
	}

 	/*
 	 * Execute a management verb on this plugin
 	 * @param $verb string
 	 * @param $args array
	 * @param $message string Location for the plugin to put a result msg
 	 * @return boolean
 	 */
	function manage($verb, $args, &$message) {
		$returner = true;
		$journal =& Request::getJournal();

		switch ($verb) {
			case 'settings':
				Locale::requireComponents(array(LOCALE_COMPONENT_APPLICATION_COMMON,  LOCALE_COMPONENT_PKP_MANAGER));
				$templateMgr =& TemplateManager::getManager();
				$templateMgr->register_function('plugin_url', array(&$this, 'smartyPluginUrl'));

				$this->import('SettingsForm');
				$form = new SettingsForm($this, $journal->getJournalId());

				if (Request::getUserVar('save')) {
					$form->readInputData();
					if ($form->validate()) {
						$form->execute();
						Request::redirect(null, null, 'plugins');
					} else {
						$form->display();
					}
				} else {
					$form->initData();
					$form->display();
				}
				break;
			case 'enable':
				$this->updateSetting($journal->getJournalId(), 'enabled', true);
				$message = Locale::translate('plugins.generic.thesisfeed.enabled');
				$returner = false;
				break;
			case 'disable':
				$this->updateSetting($journal->getJournalId(), 'enabled', false);
				$message = Locale::translate('plugins.generic.thesisfeed.disabled');
				$returner = false;
				break;	
		}

		return $returner;		
	}
}

?>
