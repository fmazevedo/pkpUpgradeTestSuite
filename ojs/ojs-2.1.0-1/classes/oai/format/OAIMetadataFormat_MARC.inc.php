<?php

/**
 * OAIMetadataFormat_MARC.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package oai.format
 *
 * OAI metadata format class -- MARC.
 *
 * $Id: OAIMetadataFormat_MARC.inc.php,v 1.4 2005/07/23 09:21:55 kevin Exp $
 */

class OAIMetadataFormat_MARC extends OAIMetadataFormat {

	/**
	 * @see OAIMetadataFormat#toXML
	 */
	function toXML(&$record) {
		$response = "<oai_marc status=\"c\" type=\"a\" level=\"m\" encLvl=\"3\" catForm=\"u\"\n" .
			"\txmlns=\"http://www.openarchives.org/OAI/1.1/oai_marc\"\n" .
			"\txmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
			"\txsi:schemaLocation=\"http://www.openarchives.org/OAI/1.1/oai_marc\n" .
			"\thttp://www.openarchives.org/OAI/1.1/oai_marc.xsd\">\n" .
			"\t<fixfield id=\"008\">\"" . date('ymd', strtotime($record->date)) . ' ' . date('Y', strtotime($record->date)) . '												eng  "</fixfield>' . "\n" .
			$this->formatElement('042', ' ', ' ', 'a', 'dc') .
			$this->formatElement('245', '0', '0', 'a', $record->title) .
			$this->formatElement('720', ' ', ' ', 'a', $record->creator) .
			$this->formatElement('653', ' ', ' ', 'a', $record->subject) .
			$this->formatElement('520', ' ', ' ', 'a', $record->description) .
			$this->formatElement('260', ' ', ' ', 'b', $record->publisher) .
			$this->formatElement('720', ' ', ' ', 'a', $record->contributor) .
			$this->formatElement('260', ' ', ' ', 'c', $record->date) .
			$this->formatElement('655', ' ', '7', 'a', $record->type) .
			$this->formatElement('856', ' ', ' ', 'q', $record->format) .
			$this->formatElement('856', '4', '0', 'u', $record->url) .
			$this->formatElement('786', '0', ' ', 'n', $record->source) .
			$this->formatElement('546', ' ', ' ', 'a', $record->language) .
			$this->formatElement('787', '0', ' ', 'n', $record->relation) .
			$this->formatElement('500', ' ', ' ', 'a', $record->coverage) .
			$this->formatElement('540', ' ', ' ', 'a', $record->rights) .
			"</oai_marc>\n";
			
		return $response;
	}
	
	/**
	 * Format XML for single MARC element.
	 * @param $id string
	 * @param $i1 string
	 * @param $i2 string
	 * @param $label string
	 * @param $value mixed
	 */
	function formatElement($id, $i1, $i2, $label, $value) {
		if (!is_array($value)) {
			$value = array($value);
		}
		
		$response = '';
		foreach ($value as $v) {
			$response .= "\t<varfield id=\"$id\" i1=\"$i1\" i2=\"$i2\">\n" .
				"\t\t<subfield label=\"$label\">" . $this->oai->prepOutput($v) . "</subfield>\n" .
				"\t</varfield>\n";
		}
		return $response;
	}
	
}

?>
