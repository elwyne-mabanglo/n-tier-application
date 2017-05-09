<?php

# PHP 5 Form Validation - https://www.w3schools.com/php/php_form_validation.asp
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

# Add Element to DOMDocument
function createElement($name, $value, DOMDocument $xml) {
    $element = $xml->createElement($name);
    $elementValue = $xml->createTextNode($value);
    $element->appendChild($elementValue);
    return $element;
}