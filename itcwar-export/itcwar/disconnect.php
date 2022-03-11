<?php
session_start();
include_once 'modules/functions/mod-functions.php';


// Unset session variables to log out
unset($_SESSION['loggedin']);
unset($_SESSION['userid']);
unset($_SESSION['username']);

// redirect to login page
AddAlert("You have been disconnected.", "warning");
header("location: ./");
die();

?>