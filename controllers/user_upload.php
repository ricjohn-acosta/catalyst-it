<?php
require_once "./models/User.php";

class User_upload {

    public User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function upload($filename): void
    {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $name = $data[0];
                $surname = $data[1];
                $email = $data[2];
                $this->user->add($name, $surname, $email);
            }
            fclose($handle);
        }
    }
}