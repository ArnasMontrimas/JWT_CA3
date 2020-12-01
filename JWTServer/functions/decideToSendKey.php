<?php

/**
 * This function will decide wether to send the user an api key
 * @param int $id users id number
 * @param String $password users password
 * @param String $membership users type
 * @param PDO $conn database connection object
 * @param User $model the user class
 * @return String|null
 */
function decideToSendKey(int $id, String $password, String $membership, PDO $conn, String $model, String $jwt) {
    if($model::checkIfUserExists($id, $conn)) {
        if($model::checkUserType($id, $conn) == $membership) $result = false;
        else $result = $model::updateUserType($id, $membership, $conn);
    }
    else $result = $model::registerUser($id, $password, $membership, $conn);

    if($result) return $jwt;
    else return null;
}