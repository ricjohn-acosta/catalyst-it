<?php
require_once "db.php";

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

        echo $filename ? "Importing {$filename}.." : "Incorrect usage. (e.g: --file users.csv)";
        return;
    }

    if (in_array("--create_table", $argv)) {
        $db->create();
        return;
    }

    echo "Invalid command!";
}

