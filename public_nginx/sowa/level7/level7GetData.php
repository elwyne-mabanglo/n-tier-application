<?php
# php_form_validation - https://www.w3schools.com/php/php_form_validation.asp
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

# Get data & test input
$location = test_input($_GET['location']);
$orderby = test_input($_GET['orderby']);
$sortby = test_input($_GET['sortby']);
$min = test_input($_GET['min']);
$max = test_input($_GET['max']);
$bedroom = test_input($_GET['bedroom']);
$propertyId = test_input($_GET['propertyId']);
$pageSize = test_input($_GET['pageSize']);
$pageNumber = test_input($_GET['pageNumber']);

# Add data to array
$isNumber = array($min, $max, $bedroom, $propertyId, $pageSize, $pageNumber);
$isString = array($location, $orderby, $sortby);

# Check are numbers are numeric
foreach ($isNumber as $element) {
    if (!is_numeric($element) && $element != "") {
        echo "'{$element}' is NOT numeric", PHP_EOL;
        die('<directory/>');
    }
}

# Check valid characters
foreach ($isString as $element) {
    if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $element) && $element != "") {
        echo "'{$element}' is NOT numeric", PHP_EOL;
        die('<directory/>');
    }
}

# http_build_query - Generate URL-encoded query string - http://php.net/manual/en/function.http-build-query.php
$args = array(
    'min' => $min,
    'max' => $max,
    'location' => $location,
    'propertyId' => $propertyId,
    'bedroom' => $bedroom,
    'propertyId' => $propertyId,
    'orderby' => $orderby,
    'sortby' => $sortby,
    'pageSize' => $pageSize,
    'pageNumber' => $pageNumber
);

# Apend args
$queryString = http_build_query($args);
$url = 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/sort.php?' . $queryString;

# Get XML
$xml1 = file_get_contents($url);
$xmlDom1 = new DOMDocument();
$xmlDom1->loadXML($xml1);

# Transform XML to XSLT
$xslt = new XSLTProcessor();
$xslDoc = new DOMDocument();
$xslDoc->load('http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/level6xsl.xsl', LIBXML_NOCDATA);
$xslt->importStylesheet($xslDoc);

# Print results
echo $xslt->transformToXML($xmlDom1);
