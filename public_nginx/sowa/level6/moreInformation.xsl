<?xml version="1.0"?>
<xsl:stylesheet version= "1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html"/>
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
                                <b>Addtional Information</b>                                           
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                
                                <table style="width: 100%; height: auto;">
                                    <tr>
                                        <td>
                                            <b>Kitchen : </b>    
                                            <xsl:apply-templates select="addtionalDetails/kitchen" />   
                                        </td>
                                        <td>
                                            <b>Bathroom : </b>    
                                            <xsl:apply-templates select="addtionalDetails/bathroom" />      
                                        </td>
                                        <td>
                                            <b>Living Room : </b>    
                                            <xsl:apply-templates select="addtionalDetails/livingRoom" />   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Garage : </b>    
                                            <xsl:apply-templates select="addtionalDetails/garage" />   
                                        </td>
                                        <td colspan="2">
                                            <b>Carpet : </b>    
                                            <xsl:apply-templates select="addtionalDetails/carpet" />    
                                        </td>
                                    </tr>
                                </table>
                            </td>
        
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>Addtional Images</b>                                           
                            </td>
                        </tr>                
                        <tr>
                            <td colspan="3">
                                <xsl:for-each select="//image">
                                    <img>
                                        <xsl:attribute name="alt">
                                            <xsl:value-of select="imageName"/>
                                        </xsl:attribute>
                                        <xsl:attribute name="src">
                                            <xsl:value-of select="imageData"/>
                                        </xsl:attribute>                                      
                                        <xsl:attribute name="width">200px</xsl:attribute>
                                        <xsl:attribute name="length">200px</xsl:attribute>
                                    </img>          
                                </xsl:for-each>
                            </td>
                        </tr>                     
                        <tr>
                            <td colspan="3">
                                <b>Map</b>                                           
                            </td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">
                                <img style="width: 100%; height: auto;" src='https://maps.googleapis.com/maps/api/staticmap?center={address}&amp;zoom=15&amp;size=800x200&amp;maptype=roadmap&amp;markers=size:mid%7Ccolor:red%7C{address}'></img>                           
                            </td>
                        </tr>         
                        <tr>
                            <td colspan="3">
                                <b>Contact Details</b>                                           
                            </td>
                        </tr>     
                        <tr>
                            <td colspan="3">
                                <p>
                                    <b>Username : </b>
                                    <xsl:value-of select="user/username"/>
                                </p>
                                <p>
                                    <b>Email : </b> 
                                    <xsl:value-of select="user/email"/>
                                </p>
                                
                            </td>
                        </tr>                    
                    </table>                      
                </xsl:for-each>            
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
