<?php

//Require database
require_once "config/database.php";
require_once "config/services/register.php";

//JWT helper class
require_once "JWT_class.php";

//Helper function
require_once "config/services/checkUserType.php";
require_once "config/services/checkIfUserExists.php";
require_once "config/services/updateUserType.php";

$secret = "asdhag2ygd17dgagsdxzg8721gxzig";


//Check if the "$action" variable is set if not set to null
$action = isset($_GET['action']) ? $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) : $action = null;


switch($action) {
    case "generate_key":
        //Check if the data was set
        if(isset($_POST['id'], $_POST['password'], $_POST['membership'])) {
            //Set up database connection
            $db = new Database();
            $conn = $db->connect();

            //Extract variables from array
            extract($_POST);
            
            //Set up token
            $token = array();

            //Store the current time as a Unix timestamp
            $token['created'] = time();
            $token['id'] = $id;
            $token['password'] = $password;
            $token['type'] = $membership;
            
            $jwt = JWT::encode($token, $secret);
            
            if($membership == "free") {
                $result = registerUser($id, $password, $membership, $conn);
            }
            if($membership == "premium") {
                if(checkIfUserExists($id, $conn)) {
                    if(checkUserType($id, $conn) == "premium") {
                         $result = false;
                    }
                    else {
                        if(updateUserType($id, $conn)) $result = true;
                        else $result = false;
                    }
                }
                else {
                    $result = registerUser($id, $password, $membership, $conn);
                }
            }
            
            if($result) echo JWT::jsonEncode($jwt);
            else echo null;
        }
        else {
            echo json_encode("Data was not set");
        }
        break;
    case "service1":
        //First check if the api_key was sent with the request
        if(isset($_POST['api_key'])) {
            $api_key = $_POST['api_key'];

            //Set a default value incase decoding fails
            $token = " Server Error Occurred";

            //Extract information stored in the key
            try {
                $token = JWT::decode($api_key, $secret);
            } catch(UnexpectedValueException $ex) {
                echo "Token is invalid";
            } catch(DomainException $ex) {
                echo "Empty Algorithm";
            }
            
            //Type cast object to array
            $token = (array) $token;

            //Assing user data to separate variables
            $user_id = $token['id'];
            $password = $token['password'];
            $type = $token['type'];
            $created = $token['created'];

            //Check if the user exists in the servers database
            if(checkIfUserExists($user_id, $type)) {
                //Check what type the user is this will determine wether i have to limit his access to the service
                if($type === "free") {
                    //First check if 24 hours have passed since token creation
                    if($created - time() > (24 * 60 * 60)) {
                        //Reset the usage number
                    }
                    else {
                        //Now check if the usage is not equal to 10

                    }
                }
                else {
                    //TODO:: HERE YOU WILL NEED TO CHECK IF HE IS PAID UP TO DATE
                }
            }
            else {
                echo "You are not authorized to use this service";
            }
        }
        else {
            echo "You are not authorized to use this service";
        }
        break;
        /*
            ************************************** MAKE SURE TO REUSE YOUR SOAP FUNCTIONS THIS WILL MAKE YOUR LIFE ALOT EASIER BRO ******************************************

            FIRST HANDLE THE FREE USER AFTER DONE MOVE ON TO HANDLING THE PREMIUM USER
            LETS HAVE (2 FREE SERVICES & 2 PREMIUM SERVICES) Also remember that premium user can access all services and there will be no limit

            WHEN CREATING THE TOKEN STORE THE DATE OF CREATION FOR THE TOKEN (This will allow you to compare date of creation with the current day)
            ALSO INCLUDE SOME MESSAGE FOR WHEN USER IS RESTRICTED (EX access blocked you can use this service again tomorrow or in "X" amount of hours (up to you what you go for))

            FOR LIMITING ACCESS TO A SERVICE TO 10 TIMES PER DAY FOR A USER
            - Check if the user is free or premium if he is free then: (Premium user will be handled later first do free user)
                - Check if current day is the day of creation if true:
                    - if first time accessing the service on this day create a session variable in which we will store how many times the user has accessed the service today
                    - if not first time increment the varaible by one 
                        - if the number incremented is equals to 10 then his access of the service will be blocked until the next day
                        - else allow to use service until 10 times usage is reached
                - else
                    - then the user can use the token 10 times for the current day (steps on how to check and limit the daily usage more in detail above...)

            ************************************** MAKE SURE TO REUSE YOUR SOAP FUNCTIONS THIS WILL MAKE YOUR LIFE ALOT EASIER BRO ******************************************
        */
}