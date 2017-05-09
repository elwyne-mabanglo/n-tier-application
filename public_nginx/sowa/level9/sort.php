<?php

require("../common/functions.php");

# Get XML data
$url = 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level4/level4WebService.php?bedroom=' . $_GET['bedroom'] . '&min=' . $_GET['min'] . '&max=' . $_GET['max'] . '&location=' . $_GET['location'] . '&propertyId=' . $_GET['propertyId'];
$xml1 = file_get_contents($url);
$xmlDom1 = new DOMDocument();
$xmlDom1->loadXML($xml1);

# Convert Simple XML
$xml = simplexml_load_string($xml1, "SimpleXMLElement", LIBXML_NOCDATA);

# Sort Array - https://stackoverflow.com/questions/15744106/how-to-sort-simplexmlelement-on-php
$arr = array();
foreach ($xml->property as $aproperty) {
    $temp = $aproperty;
    $temp->propertyId = $aproperty['propertyId'];
    $temp->db = $aproperty['db'];
    foreach ($aproperty->image as $image) {
        $temp->imageId[] = $image['imageId'];
    }
    $arr[] = $temp;
}

# Get current location
$getCurrentLocation = $_GET['currentLocation'];

# Split current location into $latitude & $longitude
$getCurrentLocationSliced = explode(',', $getCurrentLocation);
$latitude = $getCurrentLocationSliced[0];
$longitude = $getCurrentLocationSliced[1];

# Calculate Distance between two positions - http://www.geodatasource.com/developers/php
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

# Instantiate DOM container
$xmlDom = new DOMDocument();
$xmlDom->appendChild($xmlDom->createElement('HolidayAccomodation'));
$xmlRoot = $xmlDom->documentElement;

# Get page size & page number
$ps = $_GET['pageSize'];
$pn = $_GET['pageNumber'];

# Add rows from the result 
foreach ($arr as $aproperty) {

    # Get distance value
    if ($_GET['currentLocation'] != "") {
        $distance = distance((float) $latitude, (float) $longitude, (float) $aproperty->addtionalDetails->latitude, (float) $aproperty->addtionalDetails->longitude, "N");
    } else {
        $distance = "";
    }

    # Append row below distance limit
    if ($distance <= $_GET['distanceLimit']) {

        $xmlProperty = $xmlDom->createElement($aproperty->getName());

        $xmlpropertyId = $xmlDom->CreateAttribute($aproperty->propertyId->getName());
        $xmlpropertyId->value = (string) $aproperty->propertyId;
        $xmlProperty->appendChild($xmlpropertyId);

        $xmldb = $xmlDom->CreateAttribute($aproperty->db->getName());
        $xmldb->value = (string) $aproperty->db;
        $xmlProperty->appendChild($xmldb);

        $xmlProperty->appendChild(createElement($aproperty->price->getName(), (string) $aproperty->price, $xmlDom));
        $xmlProperty->appendChild(createElement($aproperty->location->getName(), (string) $aproperty->location, $xmlDom));
        $xmlProperty->appendChild(createElement($aproperty->address->getName(), (string) $aproperty->address, $xmlDom));
        $xmlProperty->appendChild(createElement($aproperty->bedroom->getName(), (string) $aproperty->bedroom, $xmlDom));
        $xmlProperty->appendChild(createElement($aproperty->title->getName(), (string) $aproperty->title, $xmlDom));
        $xmlProperty->appendChild(createElement($aproperty->description->getName(), (string) $aproperty->description, $xmlDom));
        $xmlProperty->appendChild(createElement("distance", (string) $distance, $xmlDom));

        $xmluser = $xmlDom->createElement($aproperty->user->getName());

        $xmluser->appendChild(createElement($aproperty->user->username->getName(), (string) $aproperty->user->username, $xmlDom));
        $xmluser->appendChild(createElement($aproperty->user->email->getName(), (string) $aproperty->user->email, $xmlDom));

        $xmlProperty->appendChild($xmluser);

        foreach ($aproperty->image as $inner) {

            $xmlimage = $xmlDom->createElement($inner->getName());

            $xmlimageId = $xmlDom->CreateAttribute("imageId");
            $xmlimageId->value = $aproperty->imageId;
            $xmlimage->appendChild($xmlimageId);

            $xmlimage->appendChild(createElement($inner->imageType->getName(), (string) $inner->imageType, $xmlDom));
            $xmlimage->appendChild(createElement($inner->imageName->getName(), (string) $inner->imageName, $xmlDom));
            $xmlimage->appendChild(createElement($inner->imageData->getName(), (string) $inner->imageData, $xmlDom));

            $xmlProperty->appendChild($xmlimage);
        }
        $xmlRoot->appendChild($xmlProperty);
    }
}

# Output results
header('Content-type:  text/xml');
echo $xmlDom->saveXML();

