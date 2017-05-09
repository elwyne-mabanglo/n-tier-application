<?php

header('Content-type:  text/xml');

if (isset($_REQUEST['location'])) {
    $location = trim($_REQUEST['location']);
    if ($location != "") {
        if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $location)) {
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['min'])) {
    $min = trim($_REQUEST['min']);
    if ($min != "") {
        if (!is_numeric($min)) {
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['max'])) {
    $max = trim($_REQUEST['max']);
    if ($max != "") {
        if (!is_numeric($max)) {
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['bedroom'])) {
    $bedroom = trim($_REQUEST['bedroom']);
    if ($bedroom != "") {
        if (!is_numeric($bedroom)) {
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['propertyId'])) {
    $propertyId = trim($_REQUEST['propertyId']);
    if ($propertyId != "") {
        if (!is_numeric($propertyId)) {
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['pageSize'])) {
    $pageSize = trim($_REQUEST['pageSize']);
    if ($pageSize != "") {
        if (!is_numeric($pageSize)) {
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['pageNumber'])) {
    $pageNumber = trim($_REQUEST['pageNumber']);
    if ($pageNumber != "") {
        if (!is_numeric($pageNumber)) {
            die('<directory/>');
        }
    }
}


$url = 'http://stuiis.cms.gre.ac.uk/me324/sowa/level2.asmx/level2?subBedroom='. $_REQUEST['bedroom'] .'&subMin='. $_REQUEST['min'] .'&subMax='. $_REQUEST['max'] .'&subLocation='. $_REQUEST['location'] .'&subPropertyId='. $_REQUEST['propertyId'] .'&pageNumber='. $_REQUEST['pageNumber'] .'&pageSize='. $_REQUEST['pageSize'];
$xml = file_get_contents($url);
$xmlDom1 = new DOMDocument();
$xmlDom1->loadXML($xml, LIBXML_NOBLANKS);

$root = 'HolidayAccomodation';

$creator1 = new DOMImplementation;
$doctype1 = $creator1->createDocumentType($root, null, 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/dtd.dtd');
$new1 = $creator1->createDocument(null, null, $doctype1);
$new1->encoding = "utf-8";

$oldNode1 = $xmlDom1->getElementsByTagName($root)->item(0);
$newNode1 = $new1->importNode($oldNode1, true);
$new1->appendChild($newNode1);

if ($new1->validate()) {
    echo $xmlDom1->saveXML();
} else {
    echo "dtd not valid";
}

