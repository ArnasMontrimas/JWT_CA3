<?php

//Require database
//require_once "config/database.php";

//JWT helper class
require_once "JWT_class.php";

$secret = "asdhag2ygd17dgagsdxzg8721gxzig";


//Check if the "$action" variable is set if not set to null
$action = isset($_GET['action']) ? $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) : $action = null;


switch($action) {
    case "generate_key":
        //Check if the data was set
        if(isset($_POST['id'], $_POST['password'], $_POST['membership'])) {
            
            //Extract variables from array
            extract($_POST);
            
            //Register user on the server
            //TODO::Register User on the server!

            //Set up token
            $token = array();
            $token['id'] = $id;
            $token['password'] = $password;
            $token['membership'] = $membership;
            $jwt = JWT::encode($token, $secret);
            echo $jwt;
        }
        else {
            echo "Data was not set";
        }
        break;
}