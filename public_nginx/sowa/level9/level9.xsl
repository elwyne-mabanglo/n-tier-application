<?xml version="1.0"?>
<xsl:stylesheet version= "1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>             
                <xsl:for-each select="HolidayAccomodation/property">
                    <table class="table">   
                        <tr>                        
                            <td rowspan="6" width="10%">
                                <img>
                                    <xsl:attribute name="alt">
                                        <xsl:value-of select="image/imageName"/>
                                    </xsl:attribute>
                                    <xsl:attribute name="src">
                                        <xsl:value-of select="image/imageData"/>
                                    </xsl:attribute>                                      
                                    <xsl:attribute name="width">200px</xsl:attribute>
                                    <xsl:attribute name="length">200px</xsl:attribute>
                                </img>
                            </td>
                        </tr>                    
                        <tr>
                            <th colspan="2">
                                <xsl:value-of select="title"/>
                            </th>
                        </tr>
                        <tr>                  
                            <td>
                                <b>Property ID : </b>
                                <xsl:value-of select="@propertyId"/>
                            </td>
                        </tr>
                        <tr>                  
                            <td>
                                <b>Database : </b>
                                <xsl:value-of select="@db"/>
                            </td>                                                
                        </tr> 
                        <tr>                  
                            <td>
                                <b>Address : </b>
                                <xsl:value-of select="address"/>
                            </td>                                                
                        </tr> 
                        <tr>
                            <td>
                                <b>Price £: </b>
                                <xsl:value-of select="price"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Location : </b>
                                <xsl:apply-templates select="location" />
                            </td>
                            <td>
                                <b>No. Bedroom : </b>                        
                                <xsl:apply-templates select="bedroom" />
                            </td>
                        </tr>
                        <xsl:choose>
                            <xsl:when test="distance != ''">
                                <tr>
                                    <td colspan="3">                               
                                        <b>Distance From Current Location : </b>
                                        <xsl:value-of select="distance"/>miles                                                                                                              
                                    </td> 
                                </tr>   
                            </xsl:when>
                        </xsl:choose>                    
                        <tr>
                            <td colspan="3">
                                <b>Description : </b>                          
                                <xsl:apply-templates select="description" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="btn btn-default" onclick="moreInformation('{@propertyId}','{@db}'); myMap();">More Information!</button>
                            </td>
                        </tr>
                    </table>                      
                </xsl:for-each>            
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>