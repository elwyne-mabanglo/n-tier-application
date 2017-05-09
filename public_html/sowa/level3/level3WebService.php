<?php

require("../common/functions.php");

$query = '
SELECT 
property.propertyId, property.price, property.typeProperty, property.address, property.bedroom, 
property.title, property.description, property.location, property.kitchen, property.bathroom, property.livingRoom, 
property.garage, property.carpet, property.latitude, property.longitude,
users.username, users.email, property.db
FROM property
INNER JOIN users
ON property.userId=users.id';

# Append query
if ($_REQUEST['min'] || $_REQUEST['max'] != "") {
    if ($_REQUEST['min'] == "") {
        $_REQUEST['min'] = '1';
    }
    if ($_REQUEST['max'] == "") {
        $_REQUEST['max'] = '100000000';
    }
    $query = $query . " WHERE (price BETWEEN " . $_REQUEST['min'] . ' AND ' . $_REQUEST['max'] . ')';
}

if ($_REQUEST['bedroom'] != "") {
    $query = $query . " AND bedroom=" . $_REQUEST['bedroom'];
}

if ($_REQUEST['location'] != "") {
    $query = $query . " AND location LIKE '%" . $_REQUEST['location'] . "%'";
}

if ($_REQUEST['propertyId'] != "") {
    $query = $query . " AND propertyId=" . $_REQUEST['propertyId'];
}

if ($_REQUEST['pageSize'] != "" && $_REQUEST['pageNumber'] != "") {

    $endPage = $_REQUEST['pageSize'];
    if ($_REQUEST['pageNumber'] == 1) {
        $start = $_REQUEST['pageNumber'];
    } else {
        $start = $_REQUEST['pageSize'] * $_REQUEST['pageNumber'];
    }
    $query = $query . " LIMIT " . $start . "," . $endPage;
}

# Database details
$user = "me324";
$password = "me324";
$host = "mysql.cms.gre.ac.uk";
$dbName = "me324";

$link1 = mysqli_connect($host, $user, $password, $dbName) or die('<directory><error>' . mysqli_error() . '</error></directory>');
$result = mysqli_query($link1, $query) or die('<directory><error>' . $query . '</error></directory>');

# Instantiate DOM container
$xmlDom = new DOMDocument();
$xmlDom->appendChild($xmlDom->createElement('HolidayAccomodation'));
$xmlRoot = $xmlDom->documentElement;

# Add rows from the result 
while ($row1 = mysqli_fetch_assoc($result)) {

    $xmlProperty = $xmlDom->createElement('property');

    $xmlpropertyId = $xmlDom->CreateAttribute('propertyId');
    $xmlpropertyId->value = $row1['propertyId'];
    $xmlProperty->appendChild($xmlpropertyId);

    $xmldb = $xmlDom->CreateAttribute('db');
    $xmldb->value = $row1['db'];
    $xmlProperty->appendChild($xmldb);

    $xmlProperty->appendChild(createElement("price", $row1['price'], $xmlDom));
    $xmlProperty->appendChild(createElement("location", $row1['location'], $xmlDom));
    $xmlProperty->appendChild(createElement("address", $row1['address'], $xmlDom));
    $xmlProperty->appendChild(createElement("bedroom", $row1['bedroom'], $xmlDom));
    $xmlProperty->appendChild(createElement("title", $row1['title'], $xmlDom));
    $xmlProperty->appendChild(createElement("description", $row1['description'], $xmlDom));

    $xmluser = $xmlDom->createElement('user');

    $xmluser->appendChild(createElement("username", $row1['username'], $xmlDom));
    $xmluser->appendChild(createElement("email", $row1['email'], $xmlDom));

    $xmlProperty->appendChild($xmluser);

    $link2 = mysqli_connect($host, $user, $password, $dbName) or die('<directory><error>' . mysqli_error() . '</error></directory>');
    $query2 = 'SELECT imageId, imageType, imageName, imageData FROM images WHERE propertyId = ' . $row1['propertyId'];
    $result2 = mysqli_query($link2, $query2) or die('<directory><error>' . mysqli_error($link2) . '</error></directory>');

    while ($row2 = mysqli_fetch_assoc($result2)) {

        $xmlimage = $xmlDom->createElement('image');

        $xmlimageId = $xmlDom->CreateAttribute('imageId');
        $xmlimageId->value = $row2['imageId'];
        $xmlimage->appendChild($xmlimageId);

        $xmlimage->appendChild(createElement("imageType", $row2['imageType'], $xmlDom));
        $xmlimage->appendChild(createElement("imageName", $row2['imageName'], $xmlDom));
        $xmlimage->appendChild(createElement("imageData", $row2['imageData'], $xmlDom));

        $xmlProperty->appendChild($xmlimage);
    }

    $xmladdtionalDetails = $xmlDom->createElement('addtionalDetails');

    $xmladdtionalDetails->appendChild(createElement("kitchen", $row1['kitchen'], $xmlDom));
    $xmladdtionalDetails->appendChild(createElement("bathroom", $row1['bathroom'], $xmlDom));
    $xmladdtionalDetails->appendChild(createElement("livingRoom", $row1['livingRoom'], $xmlDom));
    $xmladdtionalDetails->appendChild(createElement("garage", $row1['garage'], $xmlDom));
    $xmladdtionalDetails->appendChild(createElement("carpet", $row1['carpet'], $xmlDom));
    $xmladdtionalDetails->appendChild(createElement("latitude", $row1['latitude'], $xmlDom));
    $xmladdtionalDetails->appendChild(createElement("longitude", $row1['longitude'], $xmlDom));

    $xmlProperty->appendChild($xmladdtionalDetails);

    $xmlRoot->appendChild($xmlProperty);
}

header('Content-type:  text/xml');
echo $xmlDom->saveXML();
