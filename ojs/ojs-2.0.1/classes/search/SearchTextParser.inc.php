<?php

/**
 * SearchTextParser.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package search
 *
 * Class to extract text from a plain-text file.
 *
 * $Id: SearchTextParser.inc.php,v 1.2 2005/04/25 20:38:11 alec Exp $
 */

import('search.SearchFileParser');

class SearchTextParser extends SearchFileParser {

	function toText() {
		if (function_exists('file_get_contents')) {
			return file_get_contents($this->getFilePath());
			
		} else {
			return join('', file($this->getFilePath()));
		}
	}
	
}

?>
