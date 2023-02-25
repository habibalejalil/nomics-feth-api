<?php

// Set headers to allow access from any origin
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Define the exchange object
$exchange = array(
    "name" => "Example Exchange",
    "description" => "Example Exchange is a Centralized Exchange.",
    "location" => "Turkey",
    "logo" => "https://www.example.exchange/static/media/icon-gif.7121d96a.png",
    "website" => "https://example.exchange",
    "twitter" => "https://twitter.com/Example",
    "version" => "2.7.0",
    "capability" => array(
        "markets" => true,
        "trades" => true,
        "ordersSnapshot" => true,
        "candles" => false,
        "ticker" => false
    )
);

// Encode the exchange object as JSON without escaping forward slashes
$json = json_encode($exchange, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);


// Send the JSON response
echo $json;
