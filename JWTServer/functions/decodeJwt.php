<?php

/**
 * This function will decode the jwt token and catch any errors it also type casts token to array
 * @param String $api_key
 * @param String $secret
 * @throws UnexpectedValueException/DomainException 
 * @return Array
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