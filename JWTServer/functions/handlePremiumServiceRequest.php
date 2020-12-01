<?php

/**
 * 
 */
function handlePremiumServiceRequest(Array $token, String $secret, int $created, PDO $conn, String $service, String $servicesModel) {
    if($service == "service2") {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    }
    elseif($service == "service3") {
        $genre = filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_STRING);
        $platform = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
    }
    
    //Check if 30 days passed since subscription activation (token creation)
    if(time() - $created > (30 * 24 * 60 * 60)) {
        //Let the user know his subscription has been activated automatically
        //If he wants to stop that he should change to free user
        $message = "Your subscription was renewed to opt out change to free user on the home page";

        switch($service) {
            case "service1":
                $games = $servicesModel::getAllGames($conn);
                break;
            case "service2":
                $games = $servicesModel::getGamesByName($name, $conn);
                break;
            case "service3":
                $games = $servicesModel::getGamesByPlatformAndGenre($genre, $platform, $conn);
                break;
        }

        //Update Token
        $token['created'] = time();
        $updatedJwt = JWT::encode($token, $secret);

        $data = array(
            "games" => $games,
            "api_key" => $updatedJwt,
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
            "api_key" => null
        );

        return json_encode($data);
    }
}