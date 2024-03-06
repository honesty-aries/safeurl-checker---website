<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urlToCheck = $_POST['url'];

    // Set the API endpoint
    $apiEndpoint = 'https://api.api-aries.online/v1/checkers/safe-url/';

    // Set the cURL headers
    $headers = array( 
        'Type: 1',        // token type used (free) // learn more: https://support.api-aries.online/hc/articles/1/3/4/safe-url-api
        'APITOKEN: 111-111-111-111'   // API token // learn more: https://support.api-aries.online/hc/articles/1/3/4/safe-url-api
    );

    $curlOptions = array(
        CURLOPT_URL => $apiEndpoint . '?url=' . urlencode($urlToCheck),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    );

    $curl = curl_init();

    curl_setopt_array($curl, $curlOptions);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo json_encode(array('error' => 'Error: ' . curl_error($curl)));
    } else {
     
        $decodedResponse = json_decode($response, true);

        if (isset($decodedResponse['safe'])) {
         
            echo json_encode($decodedResponse);
        } else {
        
            echo json_encode(array('error' => 'Invalid API response.'));
        }
    }

    
    curl_close($curl);
} else {

    echo json_encode(array('error' => 'Invalid request method.'));
}
?>
