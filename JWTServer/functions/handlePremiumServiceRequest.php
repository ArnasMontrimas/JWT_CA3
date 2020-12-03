<?php

/**
 * 
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
        
        $message = "Your Subscription has ended please purchase again";

        $data = array(
            "games" => null,
            "message" => $message
        );

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