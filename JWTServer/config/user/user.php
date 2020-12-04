<?php

/**
 * User class
 */
class User {
    /**
     * This method checks wether a user exists in the database
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return bool
     */
    public static function checkIfUserExists(int $id, PDO $conn) {
        $query = "SELECT COUNT(*) FROM users WHERE user_id = :id";

        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }
    
        if($statement->fetchColumn() == 1) return true;
        else return false;
    }

    /**
     * This method checks the users api key usage count
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return int
     */
    public static function checkUsage(int $id, PDO $conn) {
        $query = "SELECT `usage` FROM users WHERE user_id = :id;";

        $statement = $conn->prepare($query);
    
        $statement->bindValue(":id", $id);
    
        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }
    
        $data = $statement->fetchColumn();
        return $data;
    
    }

    /**
     * This method updates the users type
     * @param int $id users id number
     * @param String $type users new type
     * @param PDO $conn database connection object
     * @throws PDOException $ex
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
     * @throws PDOException $ex
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
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
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
     * @throws PDOException $ex
     * @return bool
     */
    public static function registerUser(int $id, String $type, PDO $conn) {        
        $query = "INSERT INTO users (id, user_id, type) VALUES (null, :user_id, :type);";
        $statement = $conn->prepare($query);

        $statement->bindValue(":user_id", $id);
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
     * @throws PDOException $ex
     * @return String
     */
    public static function checkUserType(int $id, PDO $conn) {
        $query = "SELECT type FROM users WHERE user_id = :id;";

        $statement = $conn->prepare($query);

        $statement->bindValue(":id", $id);

        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }

        $data = $statement->fetchColumn();
        return $data;
    }

    /**
     * This method gets user valid time (Valid time represents the date until which the user can use his services this end_date is stored as a unix timecode)
     * @param int $id users id number
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return int/null
     */
    public static function getValidTime(int $id, PDO $conn) {
        $query = "SELECT valid_time FROM users WHERE user_id = :id";

        $statement = $conn->prepare($query);
        $statement->bindValue(":id", $id);

        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }

        $data = $statement->fetchColumn();
        return $data;
    }

    /**
     * This method will set the users new valid time (Valid time represents the date until which the user can use his services this end_date is stored as a unix timecode)
     * @param int $id users id number
     * @param int $validTime the new valid time (end_date)
     * @param PDO $conn database connection object
     * @param bool $add option
     * @throws PDOException $ex
     * @return bool
     */
    public static function setValidTime(int $id, int $validTime, PDO $conn, bool $add = false) {
        //If add is set to true this will add extra valid time (I have this here for premium users to add extra subscription days)
        //If add is set to false this will set a new valid time, this is for free users so i dont add extra days for them and keep it at a maximum of 1 day
        if($add) $query = "UPDATE users SET valid_time = (valid_time + :validTime) WHERE user_id = :id";
        else $query = "UPDATE users SET valid_time = :validTime WHERE user_id = :id";

        $statement = $conn->prepare($query);
        $statement->bindValue(":validTime", $validTime);
        $statement->bindValue(":id", $id);

        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }

        if($statement->rowCount() == 1) return true;
        else return false;
    }
}
















