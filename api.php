<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urlToCheck = $_POST['url'];

    // Set the API endpoint
    $apiEndpoint = 'https://api.api-aries.online/v1/checkers/safe-url/';

    // Set the cURL headers
    $headers = array(
        'Type: 2',        // token type used (free)
        'APITOKEN: WFVD-HNK2-X8AG-2IZU-VJON'   // API token
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
