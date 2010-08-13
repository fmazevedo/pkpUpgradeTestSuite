<?php

/**
 * @defgroup plugins_blocks_notification
 */
 
/**
 * @file plugins/blocks/notification/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_blocks_notification
 * @brief Wrapper for "notification" block plugin.
 *
 */

// $Id: index.php,v 1.2 2009/04/08 19:54:35 asmecher Exp $


require_once('NotificationBlockPlugin.inc.php');

return new NotificationBlockPlugin();

?> 