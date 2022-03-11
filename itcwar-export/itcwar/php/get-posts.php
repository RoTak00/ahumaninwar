<?php
session_start();

// functions and db connection
include_once "../modules/functions/mod-functions.php";
include_once "../modules/db-config.php";
include_once "../modules/functions/db-select.php";
include_once "../modules/html/db-output.php";
include_once "../modules/functions/general.php";

// post variables out of the ajax call
if(isset($_POST['php_row_number']))
    $row_number = $_POST['php_row_number'];

if(isset($_POST['php_postsperload']))
    $postsperload = $_POST['php_postsperload'];

$posts = SELECT_GetPosts($row_number, $postsperload);

// echo show tasks
foreach($posts as $post)
{
ShowPostIndex($post);
}

// if result empty, output ARR_EMPTY for 'error' handle
if(empty($posts))
    echo "ARR_EMPTY";

// exit script
exit();

?>