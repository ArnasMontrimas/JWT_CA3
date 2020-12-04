<?php

/**
 * The user class
 */
class User {
    /**
     * This function will check if a user exists and if he dose he will be loggedin
     * @param PDO $conn database connection object
     * @param String $model the user class
     * @throws PDOException $ex
     * @return String url to which send the user to
     */
    public static function login(PDO $conn, String $model) {
        $location = null;

        if(isset($_POST['email'], $_POST['password'])) {
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
                    $data = $model::getUserIdAndType($conn, $email, $password);
        
                    //Store success in session array
                    $_SESSION['success'] = "Login successful welcome";
        
                    //Store user information in the session
                    $_SESSION['user'] = array("email" => $email, "password" => $password, "id" => $data['id'], "type" => $data['membership']);
                    
                    //Store api_key in SESSION variable if present
                    $_SESSION['api_key'] = $model::getUserApiKey($conn, $data['id']);
        
                    //Redirect the user back with success message
                    $location = "Location: ../controller/index.php?action=home";
                }
                else {
                    //Store error in session array
                    $_SESSION['error'] = "No user was found";
        
                    //Redirect back with errors
                    $location = "Location: ../controller/index.php";
                }
            } catch(PDOException $ex) {
                //Store error in session array
                $_SESSION['error'] = "Internal Server Error, Return at a later date" . $ex->getMessage();
        
                //Redirect the user back with errors
                $location = "Location: ../controller/index.php";
            }
        
        }
        else {
            //Store error in session array
            $_SESSION['error'] = "All data needs to be provided";
            
            //Redirect the user back with errors
            $location = "Location: ../controller/index.php";
        }

        return $location;
    }
    /**
     * This function will register the user on the client
     * @param PDO $conn database connection object
     * @param String $model the user class
     * @throws PDOException $ex
     * @return String url to which send the user to
     */
    public static function register(PDO $conn, String $model) {
        $location = null;

        if(isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['email'])) {            
            //Assing user data to variables & sanitazie the data
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
            $password_confirm = filter_input(INPUT_POST, "password_confirm", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        
            //Check of email is unique
            if($model::checkIfEmailUnique($email, $conn)) {
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
                        $location = "Location: ../controller/index.php";
                    } catch(PDOException $ex) {
                        //Store error in session array
                        $_SESSION['error'] = "Internal Server Error, Return at a later stage";
        
                        //Redirect user back with errors
                        $location = "Location: ../controller/index.php?action=register_form";
                    }
                } else{
                    //Store error in session array
                    $_SESSION['error'] = "Passwords did not match";
        
                    //Redirect user back with errors
                    $location = "Location: ../controller/index.php?action=register_form";
                } 
            } 
            else {
                //Store error in session array
                $_SESSION['error'] = "Email address is taken";
                
                //Redirect the user back with errors
                $location = "Location: ../controller/index.php?action=register_form";
            }
        
        }
        else {
            //Store error in session array
            $_SESSION['error'] = "All data needs to be provided";
            
            //Redirect the user back with errors
            $location = "Location: ../controller/index.php?action=register_form";
        }

        return $location;
    }
    /**
     * This function will check if a user email is unique if its not registration will not be allowed
     * @param String $email users email address
     * @param PDO $conn
     * @throws PDOException $ex
     * @return bool
     */
    public static function checkIfEmailUnique(String $email, PDO $conn) {
        $query = "SELECT COUNT(email) FROM users WHERE email = :email";
    
        $stm = $conn->prepare($query);
        $stm->bindValue(":email", $email);
    
        try {
            $stm->execute();
        } catch(PDOException $ex) {
            return false;
        }
    
        if($stm->fetchColumn() != 0) return false;
        else return true; 
    }
    /**
     * This function will get the users api key
     * @param PDO $conn database connection object
     * @param int $id users id number
     * @throws PDOException $ex
     * @return String/false
     */
    public static function getUserApiKey(PDO $conn, int $id) {
        $query = "SELECT api_key FROM users WHERE id = :id";
    
        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            return false;
        }
    
        $data = $statement->fetchColumn();
        return $data;
    }
    /**
     * This function will return ann assoc array which will contain the user id and type we can do this using email since it is unique to each user and password for extra assurance
     * @param PDO $conn database connection object
     * @param String $email users email address
     * @param String $password users password
     * @throws PDOException $ex
     * @return Array/false/null
     */
    public static function getUserIdAndType(PDO $conn, String $email, String $password) {
        $query = "SELECT id, membership FROM users WHERE email = :email AND password = :password;";
    
        $stm = $conn->prepare($query);
        
        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $password);
        
        try {
            $stm->execute();
        } catch(PDOException $ex) {
            return false;
        }
        
        $data = $stm->fetch(PDO::FETCH_ASSOC);
    
        return $data;
    }
    /**
     * This function will set the users api key
     * @param String $api_key the key to be set
     * @param PDO $conn database connection object
     * @param int $id users id number
     * @throws PDOException $ex
     * @return bool
     */
    public static function setUserApiKey(String $api_key, PDO $conn, int $id) {
        $query = "UPDATE users SET api_key = :api_key WHERE id = :id;";
    
        $statement = $conn->prepare($query);
    
        $statement->bindValue(":api_key", $api_key);
        $statement->bindValue(":id", $id);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            return false;
        }
    
        if($statement->rowCount() == 1) return true;
        else return false;
    }
    /**
     * This function will update the users type(membership)
     * @param int $id users id number
     * @param String $mebership users membership type
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return bool
     */
    public static function updateUserType(int $id, String $mebership, PDO $conn) {
        $query = "UPDATE users SET membership = :membership WHERE id = :id";
    
        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
        $statement->bindValue(":membership", $mebership);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            return false;
        }
    
        if($statement->rowCount() == 1) return true;
        else return false;
    }
}