<?php
//echo print_r($argv);
require_once "db.php";

global $db;

if (isset($argv)) {
    if (in_array("--help", $argv)) {
        echo "help!";
        return;
    }

    if (in_array("--file", $argv)) {
        $file = NULL;
        foreach ($argv as $arg) {
            if (str_contains($arg, "csv")) {
                $file = $arg;
            }
        }
        echo $file ? "Importing {$file}.." : "Incorrect usage. (e.g: --file users.csv)";
        return;
    }

    if (in_array("--create_table", $argv)) {
        $db->create();
        return;
    }

    echo "Invalid command!";
}

