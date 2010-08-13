<?php

/**
 * @defgroup plugins_blocks_information
 */
 
/**
 * @file plugins/blocks/information/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_blocks_information
 * @brief Wrapper for information block plugin.
 *
 */

// $Id: index.php,v 1.5.2.1 2009/04/08 19:43:10 asmecher Exp $


require_once('InformationBlockPlugin.inc.php');

return new InformationBlockPlugin();

?> 
