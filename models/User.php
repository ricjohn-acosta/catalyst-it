<?php

class User {

    private PDO $pdo;

    public function __construct()
    {
        global $db;
        $db->connect();
        $this->pdo = $db->getPDO();
    }

    public function add($name, $surname, $email)
    {
        try {
            $result = $this->pdo->exec(
                '
                USE catalyst;
                INSERT INTO users (name, surname, email)
                VALUES ( "'.$name.'", "'.$surname.'", "'.$email.'");
            '
            );

            if ($result === 0) {
                echo "Successfully uploaded user!\n";
            }

        } catch (PDOException $exception) {
            echo "\n{$exception->getMessage()}\n\n";
        }
    }
}
