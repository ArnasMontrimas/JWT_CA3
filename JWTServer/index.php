<?php

//Require database
require_once "config/database.php";
require_once "config/services/register.php";

//JWT helper class
require_once "JWT_class.php";

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
            
            //Register user on the server
            //TODO::Register User on the server!

            //Set up token
            $token = array();

            //Store the current time as a Unix timestamp
            $token['created'] = time();
            $token['id'] = $id;
            $token['password'] = $password;
            $token['type'] = $membership;
            $jwt = JWT::encode($token, $secret);
            
            $result = registerUser($id, $password, $membership, $conn);

            if($result) echo $jwt;
            else echo null;
        }
        else {
            echo "Data was not set";
        }
        break;
    case "service1":
        //HERE YOU DO VALIDATION OF JWT CHECK THE USAGE AND ALL THAT EXECUTE SERVICE RETURN RESPONSE
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