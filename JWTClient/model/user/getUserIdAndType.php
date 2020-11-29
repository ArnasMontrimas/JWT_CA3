<?php 

//Helper Function
function getUserIdAndType(PDO $conn, String $email, String $password) {
    $query = "SELECT id, membership FROM users WHERE email = :email AND password = :password;";

    $stm = $conn->prepare($query);
    
    $stm->bindValue(":email", $email);
    $stm->bindValue(":password", $password);
    
    $stm->execute();
    
    $data = $stm->fetch(PDO::FETCH_ASSOC);

    return $data;
}