<?php
$accessKey = 'enter key here';
/*offset	
The zero-based offset that indicates the number of search results to skip before returning results. 
The default is 0. The offset should be less than (totalEstimatedMatches - count).
Use this parameter along with the count parameter to page results. 
For example, if your user interface displays 10 search results per page, 
set count to 10 and offset to 0 to get the first page of results. 
For each subsequent page, increment offset by 10 (for example, 0, 10, 20). 
it is possible for multiple pages to include some overlap in results. */
$offset = 0;
$count = 10; //max=50
$endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/search?count=' . $count . '&offset=' . $offset;
$query = 'Microsoft Cognitive Services';

function BingWebSearch($url, $key, $query)
{
    $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
    $options = array('http' => array(
        'header' => $headers,
        'method' => 'GET'
    ));
    $context = stream_context_create($options);
    $result = file_get_contents($url . "&q=" . urlencode($query), false, $context);
    $headers = array();
    foreach ($http_response_header as $k => $v) {
        $h = explode(":", $v, 2);
        if (isset($h[1]))
            if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0]))
                $headers[trim($h[0])] = trim($h[1]);
    }
    return array($headers, $result);
}

if (strlen($accessKey) == 32) {
    print "Searching the Web for: " . $query . "\n";
    list($headers, $json) = BingWebSearch($endpoint, $accessKey, $query);
    print "\nRelevant Headers:\n\n";
    foreach ($headers as $k => $v) {
        print $k . ": " . $v . "\n";
    }
    print "\nJSON Response:\n\n";
    echo json_encode(json_decode($json), JSON_PRETTY_PRINT);
} else {
    print("Invalid Bing Search API subscription key!\n");
    print("Please paste yours into the source code.\n");
}
