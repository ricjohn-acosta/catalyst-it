<?php

class User {

    private PDO $pdo;

    public function __construct()
    {
        global $db;
        $db->connect();
        $this->pdo = $db->getPDO();
    }

    public function add($name, $surname, $email, $dry_run): void
    {
        if (!$this->validate_email($email)) {
            fwrite(STDOUT, "\nFailed to upload user {$surname}. Invalid email - {$email}.\n");
            return;
        }

        try {
            $result = $this->pdo->exec(
                '
                USE catalyst;
                INSERT INTO users (name, surname, email)
                VALUES ( "'.$this->sanitize_name($name).'", "'.$this->sanitize_name($surname).'", "'.$this->sanitize_email($email).'");
            '
            );

            if ($query_result === 0 || $dry_run) {
                echo "\nSuccessfully uploaded user {$name}\n";
            }

        } catch (PDOException $exception) {
            fwrite(STDOUT, "\n{$exception->getMessage()}\n");
        }
    }

    private function validate_email($email)
    {
        $pattern = "/^[\w.-]+@([\w-]+\.)+[\w-]{2,4}$/";
        return preg_match($pattern, $email) === 1 && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function sanitize_name($name)
    {
        $lowercased_name = strtolower($name);
        return ucfirst($lowercased_name);
    }

    private function sanitize_email($email)
    {
        return strtolower($email);
    }
}
