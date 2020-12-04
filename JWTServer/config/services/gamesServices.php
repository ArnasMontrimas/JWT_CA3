<?php

/**
 * GamesServices class
 */
class GamesServices {
    /**
     * This method gets all games from the database
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return String|null
     */
    public static function getAllGames(PDO $conn) {
        $query = "SELECT * FROM games;";

        $statement = $conn->prepare($query);

        try {
            $statement->execute();
        } catch (PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }
        $games = $statement->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($games);
    }

    /**
     * This method searches for a game by name and returns the game if found
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return String|null
     */
    public static function getGamesByName(String $name, PDO $conn) {
        $query = "SELECT * FROM games WHERE name = :name;";

        $statement = $conn->prepare($query);
        $statement->bindValue(":name", $name);

        try {
            $statement->execute();
        } catch(PDOException $ex) {
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }
        $games = $statement->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($games);
    }

    /**
     * This method searches for games which contain platform and/or genre provided
     * @param String $platform the platform of the game
     * @param String $genre the genre of the game
     * @param PDO $conn database connection object
     * @throws PDOException $ex
     * @return String|null
     */
    public static function getGamesByPlatformAndGenre(String $platform, String $genre, PDO $conn) {
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
            echo json_encode(array(
                "message" => "Error occurred: " . $ex->getMessage() 
            ));
        }
        $games = $statement->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($games);
    }
}
