<?php

require("../common/functions.php");

if (isset($_POST['search'])) {

    # Validate input
    $location = test_input($_POST['location']);
    $min = test_input($_POST['min']);
    $max = test_input($_POST['max']);
    $bedroom = test_input($_POST['bedroom']);
    $propertyId = test_input($_POST['propertyId']);
    $pageSize = test_input($_POST['pageSize']) / 2;
    $pageNumber = test_input($_POST['pageNumber']);

    $isNumber = array($min, $max, $bedroom, $propertyId, $pageSize, $pageNumber);

    # Check are numbers are numeric
    foreach ($isNumber as $element) {
        if (!is_numeric($element) && $element != "") {
            echo "'{$element}' is NOT numeric", PHP_EOL;
            die('<directory/>');
        }
    }

    if ($pageSize == "") {
        $pageSize = 5;
    }

    if ($pageNumber == "") {
        $pageNumber = 1;
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

    $url = 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level4/level4WebService.php?' . $queryString;
    $xml = file_get_contents($url);
    $xmlDom1 = new DOMDocument();
    $xmlDom1->loadXML($xml);

    header('Content-type:  text/xml');
    echo $xmlDom1->saveXML();
}