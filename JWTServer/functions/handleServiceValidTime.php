<?php

/**
 * This function will assing valid time to users based on their user type(membership)
 * @param String $membership users membership type
 * @param int $id users id number
 * @param int $day 1 day representaion in unix timecode
 * @param int $month 1 month representation in unix timecode
 * @param PDO $conn database connection object
 * @param String $model the user class
 */
function handleServiceValidTime(String $membership, int $id, int $day, int $month, PDO $conn, String $model) {
    if($membership == "premium") {
        //Reset usage when switched to premium user
        $model::updateUsage($id, $conn, -($model::checkUsage($id, $conn)));
        
        //Set end date to current time plus 30 days
        if($model::setValidTime($id, (time()+$month), $conn)) {
            $validTime = $model::getValidTime($id, $conn);
        }

    }
    if($membership == "free") {
        //Set end date to current time plus 1 day
        if($model::setValidTime($id, (time()+$day), $conn)) {
            $validTime = $model::getValidTime($id, $conn);
        }
    }
}