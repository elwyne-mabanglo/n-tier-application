<?php

header('Content-type:  text/xml');

$root = 'HolidayAccomodation';

# Set up a first DOM object
$url = 'http://stuiis.cms.gre.ac.uk/me324/sowa/level2.asmx/level2?subBedroom='. $_REQUEST['bedroom'] .'&subMin='. $_REQUEST['min'] .'&subMax='. $_REQUEST['max'] .'&subLocation='. $_REQUEST['location'] .'&subPropertyId='. $_REQUEST['propertyId'] .'&pageNumber='. $_REQUEST['pageNumber'] .'&pageSize='. $_REQUEST['pageSize'] .'';
$xml = file_get_contents($url);
$xmlDom1 = new DOMDocument();
$xmlDom1->loadXML($xml, LIBXML_NOBLANKS);

# Append DTD
$creator1 = new DOMImplementation;
$doctype1 = $creator1->createDocumentType($root, null, 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/dtd.dtd');
$new1 = $creator1->createDocument(null, null, $doctype1);
$new1->encoding = "utf-8";

$oldNode1 = $xmlDom1->getElementsByTagName($root)->item(0);
$newNode1 = $new1->importNode($oldNode1, true);
$new1->appendChild($newNode1);

# Validate XML
if ($new1->validate()) {
    $flagstuiis = 1;
} else {
    $flagstuiis = 0;
}

# Set up a second DOM object
$url = 'http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3WebService.php?bedroom='. $_REQUEST['bedroom'] .'&min='. $_REQUEST['min'] .'&max='. $_REQUEST['max'] .'&location='. $_REQUEST['location'] .'&propertyId='. $_REQUEST['propertyId'] .'&pageSize='. $_REQUEST['pageSize'] .'&pageNumber='. $_REQUEST['pageNumber'];
$xmlDom2 = new DOMDocument();
$xmlDom2->load($url);

# Append DTD
$creator1 = new DOMImplementation;
$doctype1 = $creator1->createDocumentType($root, null, 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/dtd.dtd');
$new1 = $creator1->createDocument(null, null, $doctype1);
$new1->encoding = "utf-8";

$oldNode1 = $xmlDom2->getElementsByTagName($root)->item(0);
$newNode1 = $new1->importNode($oldNode1, true);
$new1->appendChild($newNode1);

# Validate XML
if ($new1->validate()) {
    $flagstuweb = 1;
} else {
    $flagstuweb = 0;
}

if ($flagstuiis && $flagstuweb == 1) {
    # Merge the second DOM object into the first
    $xmlRoot1 = $xmlDom1->documentElement;
    foreach ($xmlDom2->documentElement->childNodes as $node2) {
        $node1 = $xmlDom1->importNode($node2, true);
        $xmlRoot1->appendChild($node1);
    }

    # Return result
    echo $xmlDom1->saveXML();
} else {
    echo "dtd not valid";
}
