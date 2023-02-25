<?php

// Get market parameter from URL
$market = isset($_GET['market']) ? $_GET['market'] : 'BTC_USDT';
// Get depth parameter from URL (default to 2 if not provided)
$depth = isset($_GET['depth']) ? $_GET['depth'] : 2;

// Define the API URL with the market and depth parameters
$url = 'https://www.fubthk.com/api/v2/trade/coinmarketcap/orderbook/' . $market . '?depth=' . $depth;

// Make the API request and retrieve the response
$apiResponse = file_get_contents($url);

// Parse the API response as an array
$responseArray = json_decode($apiResponse, true);

// Extract the relevant data from the response
$bids = $responseArray["bids"];
$asks = $responseArray["asks"];
$timestamp = gmdate('Y-m-d\TH:i:s\.u\Z', $responseArray["timestamp"] / 1000);

// Convert the bids and asks arrays to the desired format
$bidsFormatted = array_map(function($bid) {
    return [floatval($bid[0]), floatval($bid[1])];
}, $bids);

$asksFormatted = array_map(function($ask) {
    return [floatval($ask[0]), floatval($ask[1])];
}, $asks);

// Construct the formatted response as an associative array
$formattedResponse = array(
  "bids" => $bidsFormatted,
  "asks" => $asksFormatted,
  "timestamp" => $timestamp
);

// Encode the formatted response as a JSON string with JSON_PRETTY_PRINT
$formattedResponseJson = json_encode($formattedResponse, JSON_PRETTY_PRINT);

// Print the formatted response JSON string
echo $formattedResponseJson;

?>
