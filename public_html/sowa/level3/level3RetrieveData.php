<?php

require("../common/functions.php");

if (isset($_POST['search'])) {

    # Validate input
    $location = test_input($_POST['location']);
    $min = test_input($_POST['min']);
    $max = test_input($_POST['max']);
    $bedroom = test_input($_POST['bedroom']);
    $propertyId = test_input($_POST['propertyId']);
    $pageSize = test_input($_POST['pageSize']);
    $pageNumber = test_input($_POST['pageNumber']);

    $isNumber = array($min, $max, $bedroom, $propertyId, $pageSize, $pageNumber);

    # Check are numbers are numeric
    foreach ($isNumber as $element) {
        if (!is_numeric($element) && $element != "") {
            echo "'{$element}' is NOT numeric", PHP_EOL;
            die('<directory/>');
        }
    }

    # Check valid characters
    if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $location) && $location != "") {
        echo "'{$location}' is NOT numeric", PHP_EOL;
        die('<directory/>');
    }

    # http_build_query - Generate URL-encoded query string - http://php.net/manual/en/function.http-build-query.php
    $args = array(
        'min' => $min,
        'max' => $max,
        'location' => $location,
        'propertyId' => $propertyId,
        'bedroom' => $bedroom,
        'pageSize' => $pageSize,
        'pageNumber' => $pageNumber
    );

    $queryString = http_build_query($args);

    $url = 'http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3WebService.php?' . $queryString;
    $xmlDom = new DOMDocument();
    $xmlDom->load($url);

    # Validate XML using a custom DTD in PHP - http://stackoverflow.com/questions/101935/validate-xml-using-a-custom-dtd-in-php 
    $root = 'HolidayAccomodation';

    $creator = new DOMImplementation;
    $doctype = $creator->createDocumentType($root, null, 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/dtd.dtd');
    $new = $creator->createDocument(null, null, $doctype);
    $new->encoding = "utf-8";

    # Append dtd to xml 
    $oldNode1 = $xmlDom->getElementsByTagName($root)->item(0);
    $newNode1 = $new->importNode($oldNode1, true);
    $new->appendChild($newNode1);

    # Check xml is valid against dtd 
    if ($new->validate()) {
        header('Content-type:  text/xml');
        echo $xmlDom->saveXML();
    } else {
        echo "dtd not valid";
    }
}