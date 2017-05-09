<?php

if (isset($_POST['search'])) {
    if (isset($_POST['location'])) {
        $location = trim($_POST['location']);
        if ($location != "") {
            if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $location)) {
                header("Location: level2Scaffolding.php");
                die('<directory/>');
            }
        }
    }

    if (isset($_POST['min'])) {
        $min = trim($_POST['min']);
        if ($min != "") {
            if (!is_numeric($min)) {
                header("Location: level2Scaffolding.php");
                die('<directory/>');
            }
        }
    }

    if (isset($_POST['max'])) {
        $max = trim($_POST['max']);
        if ($max != "") {
            if (!is_numeric($max)) {
                header("Location: level2Scaffolding.php");
                die('<directory/>');
            }
        }
    }

    if (isset($_POST['bedroom'])) {
        $bedroom = trim($_POST['bedroom']);
        if ($bedroom != "") {
            if (!is_numeric($bedroom)) {
                header("Location: level2Scaffolding.php");
                die('<directory/>');
            }
        }
    }

    if (isset($_POST['propertyId'])) {
        $propertyId = trim($_POST['propertyId']);
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

    $url = 'http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3WebService.php?min=' . $min . '&max=' . $max . '&location=' . $location . '&propertyId=' . $propertyId . '&pageSize=' . $pageSize . '&pageNumber=' . $pageNumber . '&bedroom=' . $bedroom . '&orderBy=propertyId';
    $xmlDom2 = new DOMDocument();
    $xmlDom2->load($url);

    # Instantiate an XSLT processor and import XSL file into it 
    $xslt = new XSLTProcessor();
    $xslDom = new DOMDocument();
    $xslDom->load('http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/jsonConversion.xsl', LIBXML_NOCDATA);
    $xslt->importStylesheet($xslDom);

    # Return the transformed XML
    header('Content-Type: application/json');
    echo $xslt->transformToXML($xmlDom2);
}