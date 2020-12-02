<?php

//Require database
require_once "config/database.php";

//JWT class for making and dealing with JWTs
require_once "JWT_class.php";

//Rquire the user class
require_once "config/user/user.php";

//Require the services class
require_once "config/services/gamesServices.php";

//Require functions (Tese functions will make my code in index.php shorter)
require_once "functions/decideToSendKey.php";
require_once "functions/handleFreeServiceRequest.php";
require_once "functions/handlePremiumServiceRequest.php";
require_once "functions/decodeJwt.php";

//Set up database connection
$db = new Database();
$conn = $db->connect();

//The secret with which to encode the JWT
$secret = "asdhag2ygd17dgagsdxzg8721gxzig";

//Check if the "$action" variable is set if not set to null
$action = isset($_GET['action']) ? $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) : $action = null;

switch($action) {
    case "generate_key":
        if(isset($_POST['id'], $_POST['password'], $_POST['membership'])) {
            extract($_POST);
            
            /**
             * #1 Make a field in the database "created_at" there you will store time of creation
             * #2 then somehow let user keep buying time 
             * (also have frontend when they buy premium show box with a selection of subscriptions 
             * like 1month, 3month, 6month (dont allow to puchase the same more than 1 time 
             * but let them go higer until 6months then prevent them for buying more also 
             * maybe have option to select reccurring buy 
             * all this could be maybe done with a switch statement i dunno)
             * also let select 1 minute for testing)
             */
            $token = array();
            $token['created'] = time();
            $token['id'] = $id;
            $token['password'] = $password;
            $token['type'] = $membership;
            
            $jwt = JWT::encode($token, $secret);
            
            //Reset usage when switched to premium user
            if($membership == "premium") User::updateUsage($id, $conn, -(User::checkUsage($id, $conn)));

            echo json_encode(
                decideToSendKey($id, $password, $membership, $conn, User::class, $jwt)
            );
            
        }
        else echo json_encode("Data was not set");
        break;
    case "service1":
        //First check if the api_key was sent with the request
        if(isset($_POST['api_key'])) {
            $api_key = $_POST['api_key'];

            $token = decodeJwt($api_key, $secret);

            //Assing user data to separate variables
            $user_id = $token['id'];
            $password = $token['password'];
            $type = $token['type'];
            $created = $token['created'];

            //Check if the user exists in the servers database
            if(User::checkIfUserExists($user_id, $conn)) {
                //Check what type the user is this will determine wether i have to limit his access to the service
                if($type == "free") echo handleFreeServiceRequest(
                    $token, 
                    $secret, 
                    $created, 
                    $user_id, 
                    $conn, 
                    User::class, 
                    GamesServices::class
                );
                elseif($type == "premium") echo handlePremiumServiceRequest(
                    $token,
                    $secret,
                    $created,
                    $conn,
                    "service1",
                    GamesServices::class
                );
            }
            else echo json_encode(array(
                    "message" => "You are not authorized to use this service"
                ));
        }
        else echo json_encode(array(
                "message" => "You are not authorized to use this service"
            ));
        break;
    case "service2":
        if(isset($_POST['api_key'], $_POST['name'])) {
            $api_key = $_POST['api_key'];
            /**
             * 
             * 
             */
            $token = decodeJwt($api_key, $secret);

            //Assing user data to separate variables
            $user_id = $token['id'];
            $password = $token['password'];
            $type = $token['type'];
            $created = $token['created'];

            //Check if the user exists in the servers database
            if(User::checkIfUserExists($user_id, $conn)) {
                //If free user block his access
                if($type == "free") echo json_encode(array(
                    "message" => "This service is for premium users only"
                ));
                //This service is only for premium users
                if($type == "premium") echo handlePremiumServiceRequest(
                    $token,
                    $secret,
                    $created,
                    $conn,
                    "service2",
                    GamesServices::class
                );
            }
            else echo json_encode(array(
                    "message" => "You are not authorized to use this service"
                ));
        }
        else echo json_encode(array(
                "message" => "You are not authorized to use this service"
            ));
        break;
    case "service3":
        if(isset($_POST['api_key'], $_POST['platform'], $_POST['genre'])) {
            $api_key = $_POST['api_key'];

            $token = decodeJwt($api_key, $secret);

            //Assing user data to separate variables
            $user_id = $token['id'];
            $password = $token['password'];
            $type = $token['type'];
            $created = $token['created'];

            //Check if the user exists in the servers database
            if(User::checkIfUserExists($user_id, $conn)) {
                //If free user block his access
                if($type == "free") echo json_encode(array(
                    "message" => "This service is for premium users only"
                ));
                //This service is only for premium users
                if($type == "premium") echo handlePremiumServiceRequest(
                    $token,
                    $secret,
                    $created,
                    $conn,
                    "service3",
                    GamesServices::class
                );
            }
            else echo json_encode(array(
                    "message" => "You are not authorized to use this service"
                ));
        }
        else echo json_encode(array(
                "message" => "You are not authorized to use this service"
            ));
        break;
}