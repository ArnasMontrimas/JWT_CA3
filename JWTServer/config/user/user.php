<?php

/**
 * User class
 */
class User {
    /**
     * This method checks wether a user exists in the database
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @return bool
     */
    public static function checkIfUserExists(int $id, PDO $conn) {
        $query = "SELECT COUNT(*) FROM users WHERE user_id = :id";

        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode("Exception Occurred: " . $ex->getMessage());
            die();
        }
    
        if($statement->fetchColumn() == 1) return true;
        else return false;
    }

    /**
     * This method checks the users api key usage count
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @return int
     */
    public static function checkUsage(int $id, PDO $conn) {
        $query = "SELECT `usage` FROM users WHERE user_id = :id;";

        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode("Error Occurred: " . $ex->getMessage());
        }
    
        $data = $statement->fetchColumn();
        return $data;
    
    }

    /**
     * This method updates the users type
     * @param int $id users id number
     * @param String $type users new type
     * @param PDO $conn database connection object
     * @return bool
     */
    public static function updateUserType(int $id, String $type, PDO $conn) {
        $query = "UPDATE users SET type = :type WHERE user_id = :id";

        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
        $statement->bindValue(":type", $type);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            return false;
        }
    
        if($statement->rowCount() == 1) return true;
        else return false;
    
    }

    /**
     * This method updates the users api key usage count
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @param int $amount the number by which to update the count
     * @return bool
     */
    public static function updateUsage(int $id, PDO $conn, int $amount = 1) {
        $query = "UPDATE users SET `usage` = (`usage` + :amount) WHERE user_id = :id";

        $statement = $conn->prepare($query);
    
        
        $statement->bindValue(":id", $id);
        $statement->bindValue(":amount", $amount);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode("Error Occurred: " . $ex->getMessage());
            die();
        }
    
        if($statement->rowCount() == 1) return true;
        else return false;
    
    }

    /**
     * This method registers the user on the server
     * @param int $id users id number
     * @param String $password users password
     * @param String $type the users type
     * @param PDO $conn database connection object
     * @return bool
     */
    public static function registerUser(int $id, String $password, String $type, PDO $conn) {        
        $query = "INSERT INTO users (id, user_id, password, type) VALUES (null, :user_id, :password, :type);";
        $statement = $conn->prepare($query);

        $statement->bindValue(":user_id", $id);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":type", $type);

        try {
            $statement->execute();
        } catch(PDOException $ex) {
            return false;
        }

        if($statement->rowCount() === 1) return true;
        else return false;
    }

    /**
     * This method gets the type of the user
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @return String
     */
    public static function checkUserType(int $id, PDO $conn) {
        $query = "SELECT type FROM users WHERE user_id = :id;";

        $statement = $conn->prepare($query);

        $statement->bindValue(":id", $id);

        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo "Error Occurred: " . $ex->getMessage();
        }

        $data = $statement->fetchColumn();
        return $data;
    }
}
















