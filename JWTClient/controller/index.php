<?php

//Reqiure the Database class
require_once "../model/database.php";

//Reqiure a helper function
require_once "../model/helpers/getApiKey.php";

//Require external function
require_once "../model/user/setUserApiKey.php";
require_once "../model/user/updateUserType.php";

//Helper function
require_once "../model/helpers/service1CurlRequest.php";


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
                
                $api_key = json_decode($api_key);

                if(!empty($api_key)) {
                    $_SESSION['api_key'] = $api_key;
                    $_SESSION['success'] = "Api key set";

                    $db = new Database();
                    $conn = $db->connect();

                    if(setUserApiKey($api_key, $conn, $_SESSION['user']['id'])) { 
                        if(updateUserType($_SESSION['user']['id'], $conn)) {
                            $_SESSION['user']['type'] = "premium";
                            header("Location: index.php?action=home");
                        }
                        else {
                            header("Location: index.php?action=-1"); 
                        }
                    } else header("Location: index.php?action=-1");
                }
                else {
                    $_SESSION['api_key'] = $api_key;
                    $_SESSION['error'] = "Api key could not be set";
                    header("Location: index.php?action=home");
                }
                
            }
            else header("Location: index.php?action=-1");
            break;
        case "service1":
            require_once "../views/head.html";
            require_once "../views/service1.php";
            require_once "../views/footer.html";
            break;
        case "execute_service1": 
            if(isset($_SESSION['api_key'])) {
                $url = "localhost/JWT_CA3/JWTServer/index.php?action=service1";

                $data = array(
                    "api_key" => $_SESSION['api_key']
                );

                $response = service1CurlRequest($url, $data);
                //Type cast php object to array
                (array) $response = json_decode($response);
                
                print_r($response);
            }
            break;
        case "logout":
            session_unset();
            session_destroy();
            header("Location: index.php");
        default:
            //TODO Some examples 404 - NotFound, SomeotherCode - Bad Request, and Bad page blablalbla
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