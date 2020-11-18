<?php

/**
 * Class Database
 */
class Database {
    //Database parameters
    /**
     * @var string
     */
    private $host = "localhost";

    /**
     * @var string
     */
    private $dbname = "jwtclient";

    /**
     * @var string
     */
    private $username = "root";
    
    /**
     * @var string
     */
    private $password = "";

    /**
     * This will represent our connection
     * @var pdo
     */
    private $conn;

    /**
     * Destructor
     * Closes the connection to the database
     */
    public function __destruct()
    {
        $this -> conn = null;
    }

    /**
     * Create a method that connects to the database and returns the connection
     * @return PDO|null
     */
    public function connect() {
        //Set connection to null
        $this -> conn = null;

        //Connect through the PDO Object
        try {
            $this -> conn = new PDO("mysql:host=" . $this -> host . ";dbname=" . $this -> dbname, $this ->username, $this -> password);
            //Set Error mode attribute to get exceptions
            $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo "Error with Database connection: " . $ex -> getMessage();
        }
        return $this -> conn;
    }
}