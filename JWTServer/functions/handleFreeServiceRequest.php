<?php

/**
 * This function will handle free user service requests it will limit users requests to 10 per day and reset valid time if 24 hours passed since his last valid time
 * @param Array $token jwt token used as api key
 * @param String $secret token secret
 * @param int $validTime users valid time to use service
 * @param int $user_id users id number
 * @param PDO $conn database connection object
 * @param String $userModel the user class
 * @param String $servicesModel gamesServices class
 * @return JSON
 */
function handleFreeServiceRequest(Array $token, String $secret, int $validTime, int $user_id, PDO $conn, String $userModel, String $servicesModel) {    
    //First check if current time is greater than end_date of free service which is whatever date they registered plus 1 day
    if(time() > $validTime) {
        if($userModel::checkUsage($user_id, $conn) != 0) {
            //Reset the count to 0
            if($userModel::updateUsage($user_id, $conn, -($userModel::checkUsage($user_id, $conn)))) {
                //Increment the count by 1
                if($userModel::updateUsage($user_id, $conn)) {
                    //Update validTime
                    $userModel::setValidTime($user_id, (time()+(24 * 60 * 60)), $conn);

                    //execute query
                    $games = $servicesModel::getAllGames($conn);

                    //Put all data into array
                    $data = array(
                        "games" => $games,
                    );

                    return json_encode($data);
                }
                else return json_encode(array(
                    "message" => "Something went wrong1"
                ));
                
            }
            else return json_encode(array(
                "message" => "Something went wrong2"
            ));
        }
        else {
            //Increment the count by 1
            if($userModel::updateUsage($user_id, $conn)) {
            //Update validTime
            $userModel::setValidTime($user_id, (time()+(24 * 60 * 60)), $conn);

            //execute query
            $games = $servicesModel::getAllGames($conn);

            //Put all data into array
            $data = array(
                "games" => $games,
            );

            return json_encode($data);
            }
            else return json_encode(array(
                "message" => "Something went wrong1"
            ));
        }
    }
    else { 
        if($userModel::checkUsage($user_id, $conn) == 10) {
            //Tell the user he has reached his limit and has to wait a certain amount of hours
            $timeLeftToWait = ($validTime - time());
            $timeLeftToWait = gmdate("H:i", $timeLeftToWait);
            return json_encode(array(
                "games" => null,
                "message" => $timeLeftToWait
            ));
        }
        else {
            if($userModel::updateUsage($user_id, $conn)) {
                //execute query
                $games = $servicesModel::getAllGames($conn);
                
                $data = array(
                    "games" => $games,
                );

                return json_encode($data);
            }
            else {
                return json_encode(array(
                    "message" => "Something went wrong3"
                ));
            }

        }

    }
}