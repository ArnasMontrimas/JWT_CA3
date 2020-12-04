<?php

//Reqiure the Database class
require_once "../model/database.php";

//Reqiure a CURL request functions
require_once "../model/curl/getApiKey.php";
require_once "../model/curl/sendServiceRequest.php";

//Require functions (Tese functions will make my code in index.php shorter)
require_once "../model/functions/setUserKeyAndType.php";

//Require User class
require_once "../model/user/user.php";


//Set up database connection
$db = new Database();
$conn = $db->connect();

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
        case "home":
            require_once "../views/head.html";
            require_once "../views/home.php";
            require_once "../views/footer.html";
            break;
        case "request_api_key":
            if(isset($_POST['membership'])) {
                $url = "localhost/JWT_CA3/JWTServer/index.php?action=generate_key";

                $membership = filter_input(INPUT_POST, "membership", FILTER_SANITIZE_STRING);

                //Data we will send to the server to make our token
                $data = array(
                    "id" => $_SESSION['user']['id'],
                    "membership" => $membership
                );
                
                //Send request and decode response
                $api_key = getApiKey($url, $data);
                $api_key = json_decode($api_key);

                //Handle different types of responses
                switch($api_key) {
                    case "premiumAdded":
                        $_SESSION['success'] = "You have added 30 Days to your subscription";
                        header("Location: index.php?action=home");
                        break;
                    case "-1":
                        $_SESSION['error'] = "You cant purchase free package twice";
                        header("Location: index.php?action=home");
                        break;
                    default:
                        if(setUserKeyAndType($api_key, $membership, User::class, $conn)) {
                            $_SESSION['user']['type'] = $_POST['membership'];
                            $_SESSION['success'] = "Package Changed Successfully";
                            header("Location: index.php?action=home");
                        }
                        else {
                            $_SESSION['error'] = "Key and membership could not be set";
                            header("Location: index.php?action=home");
                        }
                }
            }
            else {
                $_SESSION['error'] = "You must choose a membership type";
                header("Location: index.php?action=home");
            }
            break;
        case "service1":
            require_once "../views/head.html";
            require_once "../views/service1.php";
            require_once "../views/footer.html";
            break;
        case "execute_service1": 
            if(isset($_SESSION['api_key'])) {
                $url = "localhost/JWT_CA3/JWTServer/index.php?action=service1";
                
                //Here we will store our response
                $result = array(
                    "games" => null,
                    "message" => null    
                );

                //Data we send to the server
                $data = array(
                    "api_key" => $_SESSION['api_key']
                );

                //Send request and decode response
                $response = sendServiceRequest($url, $data);
                $response = json_decode($response, true);

                //Set result array based on the response
                if(isset($response['games'])) {
                    $result['games'] = $response['games'];
                }
                if(isset($response['message'])) {
                    $result['message'] = $response['message'];
                }

                echo json_encode($result);

            }
            else {
                echo json_encode(array(
                    "message" => "You are not authorized to use this service"
                ));
            }
            break;
        case "service2":
            require_once "../views/head.html";
            require_once "../views/service2.php";
            require_once "../views/footer.html";
            break;
        case "execute_service2": 
            if(isset($_SESSION['api_key'])) {
                if(isset($_POST['name'])) {
                    $url = "localhost/JWT_CA3/JWTServer/index.php?action=service2";
                    
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

                    //Here we will store response
                    $result = array(
                        "games" => null,
                        "message" => null    
                    );

                    //Data we send to the server
                    $data = array(
                        "api_key" => $_SESSION['api_key'],
                        "name" => $name
                    );
            
                    //Send request and decode response
                    $response = sendServiceRequest($url, $data);
                    $response = json_decode($response, true);
                        
                    //Set result array based on the response
                    if(isset($response['games'])) {
                        $result['games'] = $response['games'];
                    }
                    if(isset($response['message'])) {
                        $result['message'] = $response['message'];
                    }

                    echo json_encode($result);
                }
                else echo json_encode(array(
                    "message" => "You must enter a game name or leave it blank"
                ));
            }
            else echo json_encode(array(
                "message" => "You are not authorized to use this service"
            ));
            break;
        case "service3":
            require_once "../views/head.html";
            require_once "../views/service3.php";
            require_once "../views/footer.html";
            break;
        case "execute_service3": 
            if(isset($_SESSION['api_key'])) {
                if(isset($_POST['genre'])) {
                    $genre = filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['platform'])) {
                    $platform = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
                }
                if(!isset($_POST['genre'], $_POST['platform'])) {
                    $platform = "";
                    $genre = "";
                }

                $url = "localhost/JWT_CA3/JWTServer/index.php?action=service3";
                
                //Here we will store response
                $result = array(
                    "games" => null,
                    "message" => null    
                );

                //Data we send to the server
                $data = array(
                    "api_key" => $_SESSION['api_key'],
                    "platform" => $platform,
                    "genre" => $genre
                );

                //Send request and deocde response
                $response = sendServiceRequest($url, $data);
                $response = json_decode($response, true);
                    
                //Set result array based on the response
                if(isset($response['games'])) {
                    $result['games'] = $response['games'];
                }
                if(isset($response['message'])) {
                    $result['message'] = $response['message'];
                }

                echo json_encode($result);
            }
            else echo json_encode(array(
                "message" => "You are not authorized to use this service"
            ));
            break;
        case "logout":
            session_unset();
            session_destroy();
            header("Location: index.php");
            break;
        default:
            //If the action is not found just redirect to home page
            header("Location: index.php?action=home");
    }

}
else {
    //Handle a non logged in users requests
    switch($action) {
        case "register_form":
            require_once "../views/head.html";
            require_once "../views/register_form.php";
            require_once "../views/footer.html";
            break;
        case "login":
            header(User::login($conn, User::class));
            break;
        case "register":
            header(User::register($conn, User::class));
            break;
        //If no action provided or no action found display login form page
        default:
            require_once "../views/head.html";
            require_once "../views/login_form.php";
            require_once "../views/footer.html";
    }    
}