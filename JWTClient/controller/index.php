<?php

//Reqiure the Database class
require_once "../model/database.php";

//Check if the "$action" variable is set if not set to null
$action = isset($_GET['action']) ? $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) : $action = null;

/*  
* Check if the user session is set, by default before user logs in the session will not be set,
* we will direct the user to the log in page
* from the log in page the user may navigate to the registration page
*/
session_start();
if(isset($_SESSION['user'])) {
    //If the user is logedin but action was not set, set it to home (default)
    if(!isset($action)) $action = "home";

    //Handle logedin users requests
    switch($action) {
        //Home page for a logedin user
        case "home":
            require_once "../views/head.html";
            require_once "../views/home.php";
            require_once "../views/footer.html";
            break;
        case "request_api_key":
            if(isset($_POST['membership'])) {
                $url = "localhost/JWT_CA3/JWTServer/index.php?action=generate_key";

                $data = array(
                    "password" => password_hash($_SESSION['user']['password'], PASSWORD_DEFAULT),
                    "id" => $_SESSION['user']['id'],
                    "membership" => filter_input(INPUT_POST, "membership", FILTER_SANITIZE_STRING),
                );
                
                $api_key = getApiKey($url, $data);

                if(!empty($api_key)) {
                    $_SESSION['api_key'] = $api_key;
                    $_SESSION['success'] = "Api key set";
                    //TODO: Set the api_key column for that particular user who requested the api key bro!
                    header("Location: index.php?action=home");
                }
                else {
                    $_SESSION['api_key'] = $api_key;
                    $_SESSION['error'] = "Api key could not be set";
                    header("Location: index.php?action=home");
                }
                
            }
            break;
        case "logout":
            session_unset();
            session_destroy();
            header("Location: index.php");
        default:
            //TODO ADD A 404 ERROR PAGE TO BE DISPLAYED WHEN ACTION IS INVALID
            echo "<h1>404 NOT FOUND</h1>";
    }

}
else {
    //Handle a not logein users requests
    switch($action) {
        //Here the user is presented with the registration form
        case "register_form":
            require_once "../views/head.html";
            require_once "../views/register_form.php";
            require_once "../views/footer.html";
            break;
        //Default switch case presents user with a login form
        default:
            require_once "../views/head.html";
            require_once "../views/login_form.php";
            require_once "../views/footer.html";
    }    
}

//Helper function
function getApiKey($url, $payload) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}