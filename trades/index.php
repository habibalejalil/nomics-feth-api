<?php
header('Content-Type: application/json');

// Get market parameter from URL
$market = isset($_GET['market']) ? str_replace('-', '_', $_GET['market']) : 'BTC_USDT';

// Define URLs with market parameter
$urls = [
    [
        'url' => 'https://www.example.exchange/api/v2/trade/coingecko/historical_trades?ticker_id=' . $market . '&type=buy&limit=1000&start_time=2020%2F1%2F1&end_time=2026%2F2%2F22',
        'side' => 'buy'
    ],
    [
        'url' => 'https://www.example.exchange/api/v2/trade/coingecko/historical_trades?ticker_id=' . $market . '&type=sell&limit=1000&start_time=2020%2F1%2F1&end_time=2026%2F2%2F22',
        'side' => 'sell'
    ]
];

$output = [];

foreach ($urls as $url_data) {
    // Fetch API data
    $data = file_get_contents($url_data['url']);

    // Decode JSON response
    $response = json_decode($data, true);

    // Transform trades array
    $transformed_trades = array_map(function($trade) use ($url_data) {
        return [ 
            'id' => $trade['trade_id'], 
            'timestamp' => gmdate('Y-m-d\TH:i:s\.u\Z', $trade['trade_timestamp'] / 1000), // convert milliseconds to seconds and format as ISO 8601
            'price' => number_format((float)$trade['price'], 4, '.', ''), // convert to string with 8 decimal places
            'amount' => number_format((float)$trade['base_volume'], 6, '.', ''), // convert to string with 2 decimal places
            'amount_quote' => number_format((float)$trade['target_volume'], 11, '.', ''), // convert to string with 11 decimal places
            'side' => $url_data['side']
        ];
    }, $response[$url_data['side']]);

    // Add transformed trades to output array
    $output = array_merge($output, $transformed_trades);
}

// Sort output array by timestamp
usort($output, function($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});

// Encode the output array as a JSON string with JSON_PRETTY_PRINT
$outputJson = json_encode($output, JSON_PRETTY_PRINT);

// Print the output as JSON string
echo $outputJson;
?>
