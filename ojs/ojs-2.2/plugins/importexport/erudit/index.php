<?php

/**
 * @file index.php
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Wrapper for Erudit XML export plugin.
 *
 * @package plugins.importexport.erudit
 *
 * $Id: index.php,v 1.6 2007/07/24 18:18:51 asmecher Exp $
 */

require_once('EruditExportPlugin.inc.php');

return new EruditExportPlugin();

?>
