<?php

// Define the API URL
$url = 'https://www.example.com/api/v2/trade/coingecko/tickers';

// Make the API request and retrieve the response
$apiResponse = file_get_contents($url);

// Parse the API response as an array
$responseArray = json_decode($apiResponse, true);

// Define an array to hold the converted data
$convertedData = array();

// Loop through each ticker in the response
foreach ($responseArray as $ticker) {
  // Extract the base and target currencies from the ticker_id
  $tickerId = $ticker["ticker_id"];
  $currencies = explode("_", $tickerId);
  $baseCurrency = $currencies[0];
  $quoteCurrency = $currencies[1];

  // Construct the market name in the desired format
  $market = $baseCurrency . "-" . $quoteCurrency;

  // Extract the relevant data from the ticker and add it to the converted data array
  $convertedData[] = array(
    "market" => $market,
    "base" => $baseCurrency,
    "quote" => $quoteCurrency,
    "price_quote" => $ticker["last_price"],
    "volume_base" => $ticker["base_volume"]
  );
}

// Encode the converted data as a JSON string with JSON_PRETTY_PRINT
$convertedDataJson = json_encode($convertedData, JSON_PRETTY_PRINT);

// Print the converted data with each array in a new line
echo nl2br($convertedDataJson);

?>
