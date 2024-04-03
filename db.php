<?php
class DB {
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbHost = "localhost";
    private $dsn = "mysql:host=localhost";
    private PDO $pdo;

    public function __construct($dbUsername = "root", $dbPassword = "", $dbHost = "localhost")
    {
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dsn = "mysql:host={$dbHost}";
    }

    public function connect(): PDO
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->dbUsername, $this->dbPassword);
        } catch (PDOException $exception) {
            echo 'Connection failed: ' . $exception->getMessage();
        }
        return $this->pdo;
    }

    public function create(): void
    {
        try {
            $this->pdo->exec("
            CREATE DATABASE IF NOT EXISTS catalyst;
            USE catalyst;
            DROP TABLE IF EXISTS users;
            CREATE TABLE users (id int primary key auto_increment ,email varchar(255) UNIQUE, name varchar(255), surname varchar(255))
        ");
            echo "users table created";
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

    }

    public function getPDO(): PDO
    {
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

    public function database_exists(): bool
    {
        $result = $this->pdo->query(
            "
                SHOW DATABASES LIKE 'catalyst';
            "
        )->fetchAll();

        return sizeof($result) !== 0;
    }
}

$db = new DB();
$db->connect();