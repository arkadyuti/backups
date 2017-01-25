<?php
    // Specify API URL
    define('HASOFFERS_API_URL', 'https://api.hasoffers.com/Apiv3/json');
 
    // Specify method arguments
    $args = array(
        'NetworkId' => 'vcm',
        'Target' => 'Affiliate_Report',
        'Method' => 'getAffiliateCommissions',
        'api_key' => '59d617b249a0d11e35646154e97903d7e836059ff74772d37ed9ce36d8c20d29',
        'fields' => array(
            'ReferredAffiliate.company'
        )
    );
 
    // Initialize cURL
    $curlHandle = curl_init();
 
    // Configure cURL request
    curl_setopt($curlHandle, CURLOPT_URL, HASOFFERS_API_URL . '?' . http_build_query($args));
 
    // Make sure we can access the response when we execute the call
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
 
    // Execute the API call
    $jsonEncodedApiResponse = curl_exec($curlHandle);
 
    // Ensure HTTP call was successful
    if($jsonEncodedApiResponse === false) {
        throw new \RuntimeException(
            'API call failed with cURL error: ' . curl_error($curlHandle)
        );
    }
 
    // Clean up the resource now that we're done with cURL
    curl_close($curlHandle);
 
    // Decode the response from a JSON string to a PHP associative array
    $apiResponse = json_decode($jsonEncodedApiResponse, true);
 
    // Make sure we got back a well-formed JSON string and that there were no
    // errors when decoding it
    $jsonErrorCode = json_last_error();
    if($jsonErrorCode !== JSON_ERROR_NONE) {
        throw new \RuntimeException(
            'API response not well-formed (json error code: ' . $jsonErrorCode . ')'
        );
    }
 
    // Print out the response details
    if($apiResponse['response']['status'] === 1) {
        // No errors encountered
        echo 'API call successful';
        echo PHP_EOL;
        echo 'Response Data: ' . print_r($apiResponse['response']['data'], true);
        echo PHP_EOL;
    }
    else {
        // An error occurred
        echo 'API call failed (' . $apiResponse['response']['errorMessage'] . ')';
        echo PHP_EOL;
        echo 'Errors: ' . print_r($apiResponse['response']['errors'], true);
        echo PHP_EOL;
    }