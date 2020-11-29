<?php

//Function to set users api_key column in the database
function setUserApiKey(String $api_key, PDO $conn, int $id) :bool {
    $query = "UPDATE users SET api_key = :api_key WHERE id = :id;";

    $statement = $conn->prepare($query);

    $statement->bindValue(":api_key", $api_key);
    $statement->bindValue(":id", $id);

    try {
        $statement->execute();
    } catch(PDOException $ex) {
        return false;
    }

    if($statement->rowCount() === 1) return true;
    else return false;
}