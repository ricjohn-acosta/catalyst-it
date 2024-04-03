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
            CREATE TABLE users (id int primary key auto_increment ,email varchar(255) UNIQUE, name varchar(255), surname varchar(255))
        ");
            echo "users table created";
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

    }

    public function getPDO(): PDO {
        return $this->pdo;
    }

    public function getDbUsername(): string
    {
        return $this->dbUsername;
    }

    public function getDbPassword(): string
    {
        return $this->dbPassword;
    }

    public function getDbHost(): string
    {
        return $this->dbHost;
    }
}

$db = new DB();
$db->connect();