<?php
require_once 'config.php';

/**
 * Sends an API request to the specified endpoint with the given data.
 *
 * @param string $endpoint The API endpoint to send the request to.
 * @param array $data The data to be sent in the request body.
 * @return array The response from the API.
 */
function apiRequest($endpoint, $data) {
    $url = API_URL . $endpoint;


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Response is returned as a string with this set
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "token: " . API_TOKEN
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // encode and set the request data

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true); // return decoded assoc array
}

/**
 * Sends lead data to the API.
 *
 * @param string $firstName The first name of the lead.
 * @param string $lastName The last name of the lead.
 * @param string $phone The phone number of the lead.
 * @param string $email The email address of the lead.
 * @return array The response from the API.
 */
function addLead($firstName, $lastName, $phone, $email) {
    
    $ip = $_SERVER['REMOTE_ADDR']; // Get the IP address
    $landingUrl = $_SERVER['HTTP_HOST']; // Get the domain name

    $data = [
        "firstName" => $firstName,
        "lastName" => $lastName,
        "phone" => $phone,
        "email" => $email,
        "countryCode" => COUNTRY_CODE,
        "box_id" => BOX_ID,
        "offer_id" => OFFER_ID,
        "landingUrl" => $landingUrl,
        "ip" => $ip,
        "password" => PASSWORD,
        "language" => LANGUAGE
    ];

    // Log the sent data for debugging purposes
    file_put_contents("logs.txt", date("Y-m-d H:i:s") . " - Sent Data: " . json_encode($data) . "\n\n", FILE_APPEND);

    return apiRequest('addlead', $data);
}

/**
 * Gets lead statuses from the API based on the provided date range.
 *
 * @param string $date_from The start date for the filter.
 * @param string $date_to The end date for the filter.
 * @return array The response from the API containing lead statuses.
 */
function getLeadStatuses($date_from, $date_to) {
    $data = [
        "date_from" => $date_from,
        "date_to" => $date_to,
        "page" => 0,
        "limit" => 100
    ];

    return apiRequest('getstatuses', $data);
}
