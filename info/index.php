<?php

// Set headers to allow access from any origin
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Define the exchange object
$exchange = array(
    "name" => "Exchange Name",
    "description" => "An exchange description of at least 1000 characters in plain text (no html)",
    "location" => "Country Name",
    "logo" => "https://example.com/exchange-logo.png",
    "website" => "https://example.com",
    "twitter" => "example",
    "version" => "1.0",
    "capability" => array(
        "markets" => true,
        "trades" => true,
        "ordersSnapshot" => true,
        "candles" => false,
        "ticker" => false
    )
);

// Encode the exchange object as JSON with pretty print
$json = json_encode($exchange, JSON_PRETTY_PRINT);

// Send the JSON response
echo $json;