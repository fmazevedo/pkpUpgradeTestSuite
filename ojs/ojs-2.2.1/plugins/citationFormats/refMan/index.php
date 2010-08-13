<?php

/**
 * @defgroup plugins_citationFormats_refMan
 */
 
/**
 * @file plugins/citationFormats/refMan/index.php
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_citationFormats_refMan
 * @brief Wrapper for ReferenceManager citation plugin.
 *
 */

// $Id: index.php,v 1.5 2008/07/01 01:16:13 asmecher Exp $


require_once('RefManCitationPlugin.inc.php');

return new RefManCitationPlugin();

?>
