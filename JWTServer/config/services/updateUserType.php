<?php


function updateUserType(int $id, PDO $conn) {
    $query = "UPDATE users SET type = 'premium' WHERE user_id = :id";

    $statement = $conn->prepare($query);

    $statement->bindValue(":id", $id);

    try {
        $statement->execute();
    } catch(PDOException $ex) {
        return false;
    }

    if($statement->rowCount() == 1) return true;
    else return false;
}