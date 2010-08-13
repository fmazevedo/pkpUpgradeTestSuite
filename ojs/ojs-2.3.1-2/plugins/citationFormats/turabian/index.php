<?php

/**
 * @defgroup plugins_citationFormats_turabian
 */
 
/**
 * @file plugins/citationFormats/turabian/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_citationFormats_turabian
 * @brief Wrapper for Turabian citation plugin.
 *
 */

// $Id: index.php,v 1.6 2009/04/08 19:54:38 asmecher Exp $


require_once('TurabianCitationPlugin.inc.php');

return new TurabianCitationPlugin();

?>
