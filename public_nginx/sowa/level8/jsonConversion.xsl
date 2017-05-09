<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="text" encoding="UTF-8" media-type="text/plain"/>
    <xsl:template match="/">
        {"properties":[
        <xsl:for-each select="HolidayAccomodation/property">
            {
                "propertyId":"<xsl:value-of select="@propertyId"/>",
                "db":"<xsl:value-of select="@db"/>",
                "price":"<xsl:value-of select="price"/>",
                "location":"<xsl:value-of select="location"/>",
                "address":"<xsl:value-of select="address"/>",
                "bedroom":"<xsl:value-of select="bedroom"/>",
                "title":"<xsl:value-of select="title"/>",
                "description":"<xsl:value-of select="description"/>",
                "username":"<xsl:value-of select="user/username"/>",
                "email":"<xsl:value-of select="user/email"/>",
                "kitchen":"<xsl:value-of select="addtionalDetails/kitchen"/>",
                "bathroom":"<xsl:value-of select="addtionalDetails/bathroom"/>",
                "livingRoom":"<xsl:value-of select="addtionalDetails/livingRoom"/>",
                "garage":"<xsl:value-of select="addtionalDetails/garage"/>",
                "carpet":"<xsl:value-of select="addtionalDetails/carpet"/>",
                "latitude":"<xsl:value-of select="addtionalDetails/latitude"/>",
                "longitude":"<xsl:value-of select="addtionalDetails/longitude"/>",

                "images":[
                <xsl:for-each select="image">
                    { 
                        "imageId":"<xsl:value-of select="@imageId"/>",
                        "imageType":"<xsl:value-of select="imageType"/>",
                        "imageName":"<xsl:value-of select="imageName"/>",
                        "imageData":"<xsl:value-of select="imageData"/>"

                    }
                    <xsl:if test="position() != last()">,</xsl:if>
                </xsl:for-each>
                ]
            }
            <xsl:if test="position() != last()">,</xsl:if>
        </xsl:for-each>     
        ]}
    </xsl:template>
</xsl:stylesheet>