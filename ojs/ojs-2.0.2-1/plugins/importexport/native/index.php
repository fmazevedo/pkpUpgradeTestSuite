<?php

/**
 * index.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package plugins
 *
 * Wrapper for native XML import/export plugin.
 *
 * $Id: index.php,v 1.1 2005/06/08 00:14:50 alec Exp $
 */

require('NativeImportExportPlugin.inc.php');

return new NativeImportExportPlugin();

?>
