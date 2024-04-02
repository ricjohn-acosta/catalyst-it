<?php
class DB {
    private $dsn = "mysql:host=localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private PDO $pdo;

    public function __construct($dbUsername = "root", $dbPassword = "") {
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
    }

    public function connect(): PDO {
        try {
            $this->pdo = new PDO($this->dsn, $this->dbUsername, $this->dbPassword);
        } catch (PDOException $exception) {
            echo 'Connection failed: ' . $exception->getMessage();
        }
        return $this->pdo;
    }

    public function create() {
        try {
            $this->pdo->exec("
            CREATE DATABASE IF NOT EXISTS catalyst;
            USE catalyst;
            CREATE TABLE users (Email varchar(255) UNIQUE, Name varchar(255), Username varchar(255))
        ");
            echo "users table created";
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

    }

    public function getPDO(): PDO {
        return $this->pdo;
    }
}

$db = new DB();
$db->connect();