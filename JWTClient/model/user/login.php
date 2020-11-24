<?php

//Start the session, this is where eorror and success messages will be stored
session_start();

//Include the databse
require_once "../database.php";

//Check if all required information has been sent
if(isset($_POST['email'], $_POST['password'])) {
    //Set up database connection
    $db = new Database();
    $conn = $db->connect();
    
    //Assing user data to variables & sanitazie the data
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    
    //Check if user exists by counting the rows returned which match email & password
    $query = "SELECT COUNT(*) FROM users WHERE email = :email AND password = :password;";

    //Prepare my query
    $stm = $conn->prepare($query);

    //Bind all parameters to query
    $stm->bindValue(":email", $email);
    $stm->bindValue(":password", $password);

    //Try executing the query catch any exceptions that may arise
    try {
        //Execute the query
        $stm->execute();
        
        if($stm->fetchColumn() == 1) {
            $stm->closeCursor();

            //Get id of the user
            $id = getUserId($conn, $email, $password);

            //Store success in session array
            $_SESSION['success'] = "Login successful welcome";

            //Store user information in the session
            $_SESSION['user'] = array("email" => $email, "password" => $password, "id" => $id);

            //Redirect the user back with success message
            header("Location: ../../controller/index.php?action=home");
        }
        else {
            //Store error in session array
            $_SESSION['error'] = "No user was found";

            //Redirect back with errors
            header("Location: ../../controller/index.php");
        }
    } catch(PDOException $ex) {
        //Store error in session array
        $_SESSION['error'] = "Internal Server Error, Return at a later date" . $ex->getMessage();

        //Redirect the user back with errors
        header("Location: ../../controller/index.php");
    }

}
else {
    //Store error in session array
    $_SESSION['error'] = "All data needs to be provided";
    
    //Redirect the user back with errors
    header("Location: ../../controller/index.php");
}

function getUserId($conn, $email, $password) {
    $query = "SELECT id FROM users WHERE email = :email AND password = :password;";

    $stm = $conn->prepare($query);
    
    $stm->bindValue(":email", $email);
    $stm->bindValue(":password", $password);
    
    $stm->execute();
    
    $data = $stm->fetchColumn();

    return $data;
}