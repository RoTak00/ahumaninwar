<?php

// your database data
    $servername = "";
    $username = "";
    $password = "";
    $database = "";
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);     


// Create connection
    $conn = new mysqli($servername, $username, $password, $database);

// Check connection
    if ($conn->connect_error) {
        AddAlert("Error connecting to database.", "danger");
    die("Connection failed: " . $conn->connect_error);
    }

?>