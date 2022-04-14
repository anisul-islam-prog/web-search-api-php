<?php

//Neccessary vars
$query_param = "cars hero"; //put your query
$api_key = ""; // your api key
$search_engine_id = ""; //your search engine id
$start = 0; // change this variable to get next 10 results 11,21,31.......
// set HTTP header
// $headers = array('Content-Type: application/json',);

// the url of the API you are contacting to 'consume' 

$uri = "https://www.googleapis.com/customsearch/v1?key=" . $api_key . "&cx=" . $search_engine_id . "&start=" . $start."&q=";
$url = $uri . urlencode($query_param);
// var_dump($url);die;

// Open connection
$ch = curl_init();

// Set the url, number of GET vars, GET data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute request
$result = curl_exec($ch);
$json_result = json_decode($result);


// Print the result for test
echo "<pre>";
print_r($json_result);
echo "</pre>";
die;

// Close connection
curl_close($ch);

// return $json_result;
