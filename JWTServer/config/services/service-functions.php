<?php

function getAllGames() :String {
    global $conn;

    $query = "SELECT * FROM games;";

    $statement = $conn->prepare($query);

    try {
        $statement->execute();
    } catch (PDOException $ex) {
        echo "Error occurred: " . $ex->getMessage();
        die();
    }
    $games = $statement->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($games);
}


function getGamesByName(String $name) :String {
    global $conn;

    $query = "SELECT * FROM games WHERE name = :name;";

    $statement = $conn->prepare($query);
    $statement->bindValue(":name", $name);

    try {
        $statement->execute();
    } catch(PDOException $ex) {
        echo "Error occurred: " . $ex->getMessage();
        die();
    }
    $games = $statement->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($games);
}


function getGamesByPlatformAndGenre(String $platform, String $genre) :String {
    global $conn;

    //If all inputs are left black i dont want to return all games this prevents that from happening
    if($platform == "" && $genre == "") {
        $platform = "-1";
        $genre = "-1";
    }

    $query = "SELECT * FROM games WHERE platform LIKE :platform AND genre LIKE :genre;";
    
    $statement = $conn->prepare($query);
    $statement->bindValue(":platform", "%".$platform."%");
    $statement->bindValue(":genre", "%".$genre."%");

    try {
        $statement->execute();
    } catch(PDOException $ex) {
        echo "Error occurred: " . $ex->getMessage();
        die();
    }
    $games = $statement->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($games);
}
