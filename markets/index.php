<?php

// Set API endpoint URL
$url = 'https://www.example.com/api/v2/trade/public/markets';

// Initialize cURL session
$curl = curl_init($url);

// Set cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request and store response in $response variable
$response = curl_exec($curl);

// Close cURL session
curl_close($curl);

// Decode the JSON response into an associative array
$data = json_decode($response, true);

// Loop through each market in the data array and format it
foreach ($data as $market) {
    $formattedMarket = [
        'id' => str_replace('/', '_', $market['name']),
        'type' => 'spot',
        'base' => $market['base_unit'],
        'quote' => $market['quote_unit']
    ];

    // Encode the formatted market as a JSON object
    $json = json_encode($formattedMarket);

    // Output the JSON object on a new line with a line break character
    echo $json . "\n";
}
