<?php

# Get data from chosen property
if (htmlspecialchars($_GET["db"]) == "BH") {
    $url = 'http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3WebService.php?bedroom=&min=&max=&location=&pageNumber=&pageSize=&orderBy=location&propertyId=' . htmlspecialchars($_GET["propertyId"]);
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($url);
} else {
    $url = 'http://stuiis.cms.gre.ac.uk/me324/sowa/level2.asmx/level2?subBedroom=&subMin=&subMax=&subLocation=&pageNumber=&pageSize=&subPropertyId=' . htmlspecialchars($_GET["propertyId"]);
    $xml = file_get_contents($url);
    $xmlDoc = new DOMDocument();
    $xmlDoc->loadXML($xml, LIBXML_NOBLANKS);
}

# Transform XML to XSLT
$xslt = new XSLTProcessor();
$xslDoc = new DOMDocument();
$xslDoc->load('http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/moreInformation.xsl', LIBXML_NOCDATA);
$xslt->importStylesheet($xslDoc);

 # Output results
header('Content-type:  text/xml');
echo $xslt->transformToXML($xmlDoc);
