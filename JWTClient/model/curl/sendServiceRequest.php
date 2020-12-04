<?php

/**
 * Helper function to send request to server from client
 * @param String $url the url to which the request will be sent
 * @param Array $payload the data we send with the request
 * @return String the response
 */
function sendServiceRequest(String $url, Array $payload) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}