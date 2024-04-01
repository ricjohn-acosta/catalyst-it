<?php
//echo print_r($argv);

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

    echo "Invalid command!";
}

