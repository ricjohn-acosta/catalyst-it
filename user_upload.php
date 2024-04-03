<?php
require_once "db.php";
require_once "./controllers/user_upload.php";

global $db;

if (isset($argv)) {
    if (in_array("--help", $argv)) {
        echo "
         ########################################################################################
         
            Welcome to CatalystCRM! Your one stop shop for your user uploading needs!
            
            You may use the following flags:
            
            --file [csv file name]  = upload users into the database
            --create_table          = creates a users table in mysql  
            --dry_run               = to be used in conjunction with --file flag to run the application without modifying the database
            -u                      = display mysql username
            -p                      = display mysql password
            -h                      = display mysql host
            --help                  = display help menu
         
         ########################################################################################
        ";
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

