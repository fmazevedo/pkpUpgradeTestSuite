<?php 

/**
 * @defgroup plugins_generic_translator
 */
 
/**
 * @file plugins/generic/translator/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_generic_translator
 * @brief Wrapper for translation maintenance plugin.
 *
 */

// $Id: index.php,v 1.8.2.1 2009/04/08 19:43:19 asmecher Exp $


require_once('TranslatorPlugin.inc.php');

return new TranslatorPlugin(); 

?> 
