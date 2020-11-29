<?php

function checkIfUserExists(int $id, PDO $conn) {
    $query = "SELECT COUNT(*) FROM users WHERE user_id = :id";

    $statement = $conn->prepare($query);

    $statement->bindValue(":id", $id);

    try {
        $statement->execute();
    } catch(PDOException $ex) {
        return false;
    }

    if($statement->fetchColumn() == 1) return true;
    else return false;
}