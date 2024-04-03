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
            fwrite(STDOUT, "\nFailed to upload user {$name}. Invalid email - {$email}.\n");
            return;
        }

        try {

            $query_result = NULL;
            if (!$dry_run) {
                $query_result = $this->pdo->exec('
                    USE catalyst;
                    INSERT INTO users (name, surname, email)
                    VALUES ( "'.$this->sanitize_name($name).'", "'.$this->sanitize_name($surname).'", "'.$this->sanitize_email($email).'");
                '
                );
            }

            if ($query_result === 0 || $dry_run) {
                echo "\nSuccessfully uploaded user {$name}\n";
            }

        } catch (PDOException $exception) {
            fwrite(STDOUT, "\n{$exception->getMessage()}\n");
        }
    }

    private function validate_email($email): bool
    {
        $pattern = "/^[\w.-]+@([\w-]+\.)+[\w-]{2,4}$/";
        // Here we make sure that the email is in a legal format as well as if it is a valid email.
        return preg_match($pattern, $email) === 1 && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function sanitize_name($name): string
    {
        $lowercased_name = strtolower($name);
        return ucfirst($lowercased_name);
    }

    private function sanitize_email($email): string
    {
        return strtolower($email);
    }
}
