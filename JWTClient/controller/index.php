<?php

//Reqiure the Database class
require_once "../model/database.php";

//Check if the "$action" variable is set if not set to null
$action = isset($_GET['action']) ? $action = $_GET['action'] : $action = null;

/*  
* Check if the user session is set, by default before user logs in the session will not be set,
* we will direct the user to the log in page
* from the log in page the user may navigate to the registration page if he does not have an account
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

