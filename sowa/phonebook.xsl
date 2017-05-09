<?xml version= "1.0" encoding= "UTF-8" ?>
<xsl:stylesheet version= "1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <table cellpadding="3">
    <thead>
	<tr>
      <th>username</th><th>email</th>
    </tr>
	</thead>
	<tbody>
    <xsl:for-each select="//users">
    <xsl:sort order="ascending" select="username" />
      <tr>
        <xsl:apply-templates select="username" />
        <xsl:apply-templates select="email" />
      </tr>
    </xsl:for-each>
    </tbody>
  </table>
</xsl:template>
<xsl:template match="*" >
  <td> <xsl:value-of select="." /> </td>
  </xsl:template>
</xsl:stylesheet>
