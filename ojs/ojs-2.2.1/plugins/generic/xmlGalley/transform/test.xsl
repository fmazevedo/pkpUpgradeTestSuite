<?xml version="1.0"?>

<!--
  * test.xsl
  *
  * Copyright (c) 2003-2008 John Willinsky
  * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
  *
  * Test XSL stylesheet for external XSLT using the XML Galleys plugin.
  *
  * $Id: test.xsl,v 1.2 2008/06/13 20:16:46 asmecher Exp $
  -->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="text" omit-xml-declaration="yes"/>
<xsl:strip-space elements="*"/>

	<xsl:template match="/root">
		<xsl:apply-templates/>
	</xsl:template>
	
	<xsl:template match="level_1">
		<xsl:value-of select="level_2"/>
		<xsl:apply-templates/>

		<xsl:variable name="test"> Success</xsl:variable>
		<xsl:value-of select="$test"/>
	</xsl:template>

	<xsl:template match="level_2"/>
</xsl:stylesheet>