<?php

require_once "functions/handleServiceValidTime.php";

/**
 * This function will decide wether to send the user an api key
 * @param int $id users id number
 * @param String $membership users type
 * @param PDO $conn database connection object
 * @param User $model the user class
 * @return String
 */
function decideToSendKey(int $id, String $membership, PDO $conn, String $model, String $jwt, int $month, int $day) {
    if($model::checkIfUserExists($id, $conn)) {
        if($model::checkUserType($id, $conn) == $membership) {
            if($membership == "premium") {
                //Set end date to current time plus 30 days
                if($model::setValidTime($id, $month, $conn, true)) {
                    $validTime = $model::getValidTime($id, $conn);
                }
                return "premiumAdded";
            }
            else return "-1";
        }
        else {
            handleServiceValidTime($membership, $id, $day, $month, $conn, $model);
            $model::updateUserType($id, $membership, $conn);        
            $result = true;
        }
    }
    else {
        $result = $model::registerUser($id, $membership, $conn);
        handleServiceValidTime($membership, $id, $day, $month, $conn, $model);
    }
    if($result) return $jwt;
}