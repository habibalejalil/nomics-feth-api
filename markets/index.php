<?php
$url = 'https://www.example.com/api/v2/trade/public/markets';
$apiResponse = file_get_contents($url);
$markets = json_decode($apiResponse, true);

$result = array();
foreach ($markets as $market) {
  $base = strtoupper($market['base_unit']);
  $quote = strtoupper($market['quote_unit']);
  $id = $base . '_' . $quote;

  $entry = array(
    'id' => $id,
    'type' => 'spot',
    'base' => $base,
    'quote' => $quote
  );
  array_push($result, $entry);
}
$json = json_encode($result, JSON_PRETTY_PRINT);
echo nl2br($json);
?>
