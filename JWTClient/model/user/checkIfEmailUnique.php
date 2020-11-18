<?php

//Simple function which will check if an email address is unique.
function checkIfEmailUnique($email, $conn) {
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