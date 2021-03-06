<?php

/**
 * SearchHTMLParser.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package search
 *
 * Class to extract text from an HTML file.
 *
 * $Id: SearchHTMLParser.inc.php,v 1.4 2005/08/20 19:39:05 kevin Exp $
 */

import('search.SearchFileParser');

class SearchHTMLParser extends SearchFileParser {

	// From php.net/html_entity_decode
	function unhtmlentities($string) {
		// replace numeric entities
		$string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
		$string = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $string);
		// replace literal entities
		$trans_tbl = get_html_translation_table(HTML_ENTITIES);
		$trans_tbl = array_flip($trans_tbl);
		return strtr($string, $trans_tbl);
	}


	function doRead() {
		$line = fgetss($this->fp, 4096);
		$line = str_replace('&nbsp;', ' ', $line);
		if (function_exists('html_entity_decode')) {
			$line = html_entity_decode($line);
		} else {
			$line = $this->unhtmlentities($line);
		}
		return $line;
	}
	
}

?>
