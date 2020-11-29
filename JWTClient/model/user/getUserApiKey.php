<?php

//Helper function
function getUserApiKey(PDO $conn, int $id) {
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