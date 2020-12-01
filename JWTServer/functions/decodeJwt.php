<?php

/**
 * 
 */
function decodeJwt(String $api_key, String $secret) {
    try {
        $token = JWT::decode($api_key, $secret);
    } catch(UnexpectedValueException $ex) {
        echo json_encode(array(
            "message" => $ex->getMessage()
        ));
    } catch(DomainException $ex) {
        echo json_encode(array(
            "message" => $ex->getMessage()
        ));
    }

    return (array) $token;
}