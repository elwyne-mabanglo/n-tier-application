<?php
header('Content-type:  text/xml');

if ( isset($_REQUEST['name']) ) {
   $nq = trim($_REQUEST['name']);
   if ( preg_match("/[^a-zA-Z0-9 \-']|^$/",$nq) )die ('<directory/>');
} else {
   die ('<directory><error>incompatible search term</error></directory>');
}

# database details
$user = "me324";
$password = "me324";
$host = "mysql.cms.gre.ac.uk";
$dbName = "me324";

$link = mysqli_connect($host, $user, $password, $dbName) or die ('<directory><error>'.mysqli_error().'</error></directory>');
$query = '
SELECT
property.propertyId, property.price, property.typeProperty, property.address, property.bedroom, property.title, property.description, property.location, users.username, users.email 
FROM property
INNER JOIN users
ON property.userId=users.id LIMIT 10';
$result = mysqli_query($link,$query) or die ('<directory><error>'.mysqli_error($link).'</error></directory>');

// instantiate DOM container
$xmlDom = new DOMDocument();
$xmlDom->appendChild($xmlDom->createElement('HolidayAccomodation'));
$xmlRoot = $xmlDom->documentElement;

// add rows from the result 
while ( $row = mysqli_fetch_assoc($result) ) {
	$xmlproperty = $xmlDom->createElement('property');

	$xmlpropertyId = $xmlDom->createElement('propertyId');
	$xmlTxt = $xmlDom->createTextNode($row['propertyId']);
	$xmlpropertyId->appendChild($xmlTxt);
	$xmlproperty->appendChild($xmlpropertyId);
    
	$xmlprice = $xmlDom->createElement('price');
	$xmlTxt = $xmlDom->createTextNode($row['price']);
	$xmlprice->appendChild($xmlTxt);
	$xmlproperty->appendChild($xmlprice);
    
	$xmltypeProperty = $xmlDom->createElement('typeProperty');
	$xmlTxt = $xmlDom->createTextNode($row['typeProperty']);
	$xmltypeProperty->appendChild($xmlTxt);
	$xmlproperty->appendChild($xmltypeProperty);
    
	$xmlRoot->appendChild($xmlproperty);
}

// return result
echo $xmlDom->saveXML();
?>