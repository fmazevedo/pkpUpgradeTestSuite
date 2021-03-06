<?php

/**
 * @defgroup pages_comment
 */
 
/**
 * @file pages/comment/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup pages_comment
 * @brief Handle requests for comment functions. 
 *
 */

// $Id: index.php,v 1.10 2009/12/10 00:57:45 asmecher Exp $

switch ($op) {
	case 'view':
	case 'add':
	case 'delete':
		define('HANDLER_CLASS', 'CommentHandler');
		import('pages.comment.CommentHandler');
		break;
}

?>
