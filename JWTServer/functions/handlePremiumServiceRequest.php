<?php

//Require external function
require_once "functions/handleFreeServiceRequest.php";

/**
 * This function will handle premium users requests to use services it will block his request if his valid time has eneded
 * @param Array $token jwt token used as api key
 * @param String $secret token secret
 * @param int $validTime users valid time to use service
 * @param PDO $conn database connection object
 * @param String $userModel the user class
 * @param String $servicesModel gamesServices class
 * @return JSON
 */
function handlePremiumServiceRequest(Array $token, String $secret, int $validTime, PDO $conn, String $service, String $servicesModel, String $userModel) {
    if($service == "service2") {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    }
    elseif($service == "service3") {
        $genre = filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_STRING);
        $platform = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
    }
    //Check if 30 days passed since subscription activation
    if(time() > $validTime) {
        //I wasnt sure if i should renew subscription or make the user buy again
        //But i included automatic renewal just in case

        // Let the user know his subscription has been activated automatically
        // If he wants to stop that he should change to free user
        // $message = "Your subscription was renewed to opt out change to free user on the home page";

        // switch($service) {
        //     case "service1":
        //         $games = $servicesModel::getAllGames($conn);
        //         break;
        //     case "service2":
        //         $games = $servicesModel::getGamesByName($name, $conn);
        //         break;
        //     case "service3":
        //         $games = $servicesModel::getGamesByPlatformAndGenre($genre, $platform, $conn);
        //         break;
        // }

        // //Update validTime
        // $user_id = $token['id'];
        // $userModel::setValidTime($user_id, (time()+(30 * 24 * 60 * 60)), $conn);

        $user_id = $token['id'];
        
        $data = array(
           "games" => null,
           "message" => null
        );
        
        //If premium users subscription has ended limit hiss access to the free service
        //Lets still keep the user as premium this will allow for messages like subscription ended but at the same time treat him as a free user until he adds another 30days to his subscription
        if($service == "service1") { 
            if($userModel::checkUsage($user_id, $conn) == 10) {
                //I'm adding 1 here becasue i want this if statement to only trigger 1 time
                $userModel::updateUsage($user_id, $conn, 1);
                $userModel::setValidTime($user_id, time(), $conn);
            }
            elseif($userModel::checkUsage($user_id, $conn) == 11) {
                $timePassed = ($userModel::getValidTime($user_id, $conn) - time()); 
                if($timePassed > (24 * 60 * 60)) {
                    //Reset usage back to 0
                    $userModel::updateUsage($user_id, $conn, -11);
                }
                else {
                    $data['message'] = gmdate("H:i", $timePassed);
                }
            }
            else {
                $data = json_decode(handleFreeServiceRequest($token, $secret, (time()+(60)), $user_id, $conn, $userModel, $servicesModel)); 
            }
        }
        else {
            $data['games'] = null;
            $data['message'] = "Your Subscription has ended please purchase again";
        }
        
        return json_encode($data);
    }
    else {
        switch($service) {
            case "service1":
                $games = $servicesModel::getAllGames($conn);
                break;
            case "service2":
                $games = $servicesModel::getGamesByName($name, $conn);
                break;
            case "service3":
                $games = $servicesModel::getGamesByPlatformAndGenre($platform, $genre, $conn);
                break;
        }

        $data = array(
            "games" => $games,
        );

        return json_encode($data);
    }
}