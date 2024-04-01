<?php
echo print_r($argv);

if (isset($argv)) {
    if (in_array("--help", $argv)) {
        echo "help!";
        return;
    }

    echo "Invalid command!";
}

