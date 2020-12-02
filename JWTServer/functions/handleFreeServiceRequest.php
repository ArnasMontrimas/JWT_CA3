<?php

/**
 * 
 */
function handleFreeServiceRequest(Array $token, String $secret, int $created, int $user_id, PDO $conn, String $userModel, String $servicesModel) {
    //First check if 24 hours have passed since token creation
    if(time() - $created > (24 * 60 * 60)) {
        //Reset the count to 0
        if($userModel::updateUsage($user_id, $conn, -($userModel::checkUsage($user_id, $conn)))) {
            //Increment the count by 1
            if($userModel::updateUsage($user_id, $conn)) {
                //Update Token
                $token['created'] = time();
                $updatedJwt = JWT::encode($token, $secret);

                //execute query
                $games = $servicesModel::getAllGames($conn);

                //Put all data into array
                $data = array(
                    "games" => $games,
                    "api_key" => $updatedJwt
                );

                return json_encode($data);
            }
            else return json_encode(array(
                "message" => "Something went wrong"
            ));
            
        }
        else return json_encode(array(
            "message" => "Something went wrong"
        ));
    }
    else { 
        if($userModel::checkUsage($user_id, $conn) == 10) {
            //Tell the user he has reached his limit and has to wait a certain amount of hours
            $timeLeftToWait = (($created - time()) - (24 * 60 * 60));
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
                    "api_key" => null
                );

                return json_encode($data);
            }
            else {
                return json_encode(array(
                    "message" => "Something went wrong"
                ));
            }

        }

    }
}