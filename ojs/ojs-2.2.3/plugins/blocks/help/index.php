<?php

/**
 * @defgroup plugins_blocks_help
 */
 
/**
 * @file plugins/blocks/help/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_blocks_help
 * @brief Wrapper for help block plugin.
 *
 */

// $Id: index.php,v 1.5.2.1 2009/04/08 19:43:09 asmecher Exp $


require_once('HelpBlockPlugin.inc.php');

return new HelpBlockPlugin();

?> 
