<?php

if (isset($_REQUEST['location'])) {
    $location = trim($_REQUEST['location']);
    if ($location != "") {
        if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $location)) {
            header("Location: level2Scaffolding.php");
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['min'])) {
    $min = trim($_REQUEST['min']);
    if ($min != "") {
        if (!is_numeric($min)) {
            header("Location: level2Scaffolding.php");
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['max'])) {
    $max = trim($_REQUEST['max']);
    if ($max != "") {
        if (!is_numeric($max)) {
            header("Location: level2Scaffolding.php");
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['bedroom'])) {
    $bedroom = trim($_REQUEST['bedroom']);
    if ($bedroom != "") {
        if (!is_numeric($bedroom)) {
            header("Location: level2Scaffolding.php");
            die('<directory/>');
        }
    }
}

if (isset($_REQUEST['propertyId'])) {
    $propertyId = trim($_REQUEST['propertyId']);
    if ($propertyId != "") {
        if (!is_numeric($propertyId)) {
            header("Location: level2Scaffolding.php");
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

// read XML data into a DOM object 
$url = 'http://stuiis.cms.gre.ac.uk/me324/sowa/level2.asmx/level2?subBedroom='. $_REQUEST['bedroom'] .'&subMin='. $_REQUEST['min'] .'&subMax='. $_REQUEST['max'] .'&subLocation='. $_REQUEST['location'] .'&subPropertyId='. $_REQUEST['propertyId'] .'&pageNumber='. $_REQUEST['pageNumber'] .'&pageSize='. $_REQUEST['pageSize'];
$xml = file_get_contents($url);
$xmlDom1 = new DOMDocument();
$xmlDom1->loadXML($xml, LIBXML_NOBLANKS);

// instantiate an XSLT processor and import XSL file into it 
$xslt = new XSLTProcessor();
$xslDom = new DOMDocument();
$xslDom->load('http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/jsonConversion.xsl', LIBXML_NOCDATA);
$xslt->importStylesheet($xslDom);

// return the transformed XML
header('Content-Type: application/json');
echo $xslt->transformToXML($xmlDom1);

