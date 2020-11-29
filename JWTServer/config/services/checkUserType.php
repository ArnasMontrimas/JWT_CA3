<?php

//Helper function
function checkUserType(int $id, PDO $conn) {
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