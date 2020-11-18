<?php

//Start the session, this is where eorror and success messages will be stored
session_start();

//Include the databse & function to check if provided email is unique
require_once "../database.php";
require_once "checkIfEmailUnique.php";

//Check if all required information has been sent
if(isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['email'])) {
    //Set up database connection
    $db = new Database();
    $conn = $db->connect();
    
    //Assing user data to variables & sanitazie the data
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $password_confirm = filter_input(INPUT_POST, "password_confirm", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    //Check of email is unique
    if(checkIfEmailUnique($email, $conn)) {
        //Check if passwords match
        if($password == $password_confirm) {
            //Insert user into the database query
            $query = "INSERT INTO users (id,username,password,email) VALUES (null,:username,:password,:email);";

            //Prepare my query
            $stm = $conn->prepare($query);

            //Bind all paramters to query
            $stm->bindValue(":username", $username);
            $stm->bindValue(":password", $password);
            $stm->bindValue(":email", $email);

            //Try executing the query catch any exceptions that may arise
            try {
                //Execute the query
                $stm->execute();
                
                //Store success in session array
                $_SESSION['success'] = "Registration Successful";

                //Redirect the user back with success message
                header("Location: ../../controller/index.php");
            } catch(PDOException $ex) {
                //Store error in session array
                $_SESSION['error'] = "Internal Server Error, Return at a later stage";

                //Redirect user back with errors
                header("Location: ../../controller/index.php?action=register_form");
            }
        } else{
            //Store error in session array
            $_SESSION['error'] = "Passwords did not match";

            //Redirect user back with errors
            header("Location: ../../controller/index.php?action=register_form");
        } 
    } 
    else {
        //Store error in session array
        $_SESSION['error'] = "Email address is taken";
        
        //Redirect the user back with errors
        header("Location: ../../controller/index.php?action=register_form");
    }

}
else {
    //Store error in session array
    $_SESSION['error'] = "All data needs to be provided";
    
    //Redirect the user back with errors
    header("Location: ../../controller/index.php?action=register_form");
}