<?php

//Register the user on the server
function registerUser(int $id, String $password, String $type, PDO $conn) :bool {

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