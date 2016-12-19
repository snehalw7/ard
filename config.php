<?php

    /**
     * config.php
     *
     * Computer Science 50
     *
     * Configures pages.
     */

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    //requirements
    require("functions.php");

    // connect to database
    $user_name = "root";
    $password = "";
    $database = "ARD";
    $host_name = "localhost";

    $conn = mysqli_connect($host_name, $user_name,$password,$database);

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    // enable sessions
    session_start();

    // require authentication for most pages
    if (!preg_match("{(?:index|logout|forgotpassword|recoverpassword)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["UserName"]))
        {
            redirect("index.php");
        }
    }

?>
