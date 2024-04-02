<?php
require_once "db.php";
require_once "./controllers/user_upload.php";

global $db;

if (isset($argv)) {
    if (in_array("--help", $argv)) {
        echo "help!";
        return;
    }

    if (in_array("--file", $argv)) {
        $filename = NULL;

        foreach ($argv as $arg) {
            if (str_contains($arg, "csv")) {
                $filename = $arg;
            }
        }

        if ($filename) {
            $uploader = new User_upload();
            $uploader->upload($filename);
        } else {
            echo "Incorrect usage. (e.g: --file users.csv)";
        }
        return;
    }

    if (in_array("--create_table", $argv)) {
        $db->create();
        return;
    }

    echo "Invalid command!";
}

