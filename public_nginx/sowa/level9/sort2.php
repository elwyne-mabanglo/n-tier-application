<?php

require("../common/functions.php");

# Get XML data
$url = 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level9/sort.php?'
        . 'bedroom=' . $_GET['bedroom']
        . '&min=' . $_GET['min']
        . '&max=' . $_GET['max']
        . '&location=' . $_GET['location']
        . '&propertyId=' . $_GET['propertyId']
        . '&pageNumber=' . $_GET['pageNumber']
        . '&orderby=' . $_GET['orderby']
        . '&sortby=' . $_GET['sortby']
        . '&pageSize=' . $_GET['pageSize']
        . '&currentLocation=' . $_GET['currentLocation']
        . '&distanceLimit=' . $_GET['distanceLimit'];
$xml1 = file_get_contents($url);
$xmlDom1 = new DOMDocument();

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

# Sort functions
if ($_GET['sortby'] == "propertyId") {
    if ($_GET['orderby'] == "ascending") {
        usort($arr, function($a, $b) {
            return $a->propertyId - $b->propertyId;
        });
    } else if ($_GET['orderby'] == "descending") {
        usort($arr, function($a, $b) {
            return $b->propertyId - $a->propertyId;
        });
    }
} else if ($_GET['sortby'] == "title") {
    if ($_GET['orderby'] == "ascending") {
        usort($arr, function($a, $b) {
            return $a->title - $b->title;
        });
    } else if ($_GET['orderby'] == "descending") {
        usort($arr, function($a, $b) {
            return $b->title - $a->title;
        });
    }
} else if ($_GET['sortby'] == "price") {
    if ($_GET['orderby'] == "ascending") {
        usort($arr, function($a, $b) {
            return $a->price - $b->price;
        });
    } else if ($_GET['orderby'] == "descending") {
        usort($arr, function($a, $b) {
            return $b->price - $a->price;
        });
    }
} else if ($_GET['sortby'] == "bedroom") {
    if ($_GET['orderby'] == "ascending") {
        usort($arr, function($a, $b) {
            return $a->bedroom - $b->bedroom;
        });
    } else if ($_GET['orderby'] == "descending") {
        usort($arr, function($a, $b) {
            return $b->bedroom - $a->bedroom;
        });
    }
} else if ($_GET['sortby'] == "distance") {
    if ($_GET['orderby'] == "ascending") {
        usort($arr, function($a, $b) {
            return $a->distance - $b->distance;
        });
    } else if ($_GET['orderby'] == "descending") {
        usort($arr, function($a, $b) {
            return $b->distance - $a->distance;
        });
    }
}

# Instantiate DOM container
$xmlDom = new DOMDocument();
$xmlDom->appendChild($xmlDom->createElement('HolidayAccomodation'));
$xmlRoot = $xmlDom->documentElement;

# Get page size & page number
$ps = $_GET['pageSize'];
$pn = $_GET['pageNumber'];

# Get start and end element
if ($pn == 1) {
    $end = $ps * $pn;
    $start = $end - $ps;
} else {
    $end = $ps * $pn;
    $start = ($end - $ps) + 1;
}

$b = 0;

foreach ($arr as $aproperty) {

    $b++;

    # Pagination   
    if (($b >= $start && $b <= $end)) {

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
        $xmlProperty->appendChild(createElement($aproperty->distance->getName(), (string) $aproperty->distance, $xmlDom));

        $xmluser = $xmlDom->createElement($aproperty->user->getName());
        
        $xmluser->appendChild(createElement($aproperty->user->username->getName(), (string) $aproperty->user->username, $xmlDom));
        $xmluser->appendChild(createElement($aproperty->user->email->getName(), (string) $aproperty->user->email, $xmlDom));
   
        $xmlProperty->appendChild($xmluser);


        foreach ($aproperty->image as $inner) {

            $xmlimage = $xmlDom->createElement($inner->getName());

            $xmlimageId = $xmlDom->CreateAttribute("imageId");
            $xmlimageId->value = (string) $inner->imageId;
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

