<?php
session_start();


include_once 'modules/functions/mod-functions.php';
$current_page = "add";
$current_page_title = "Your story";

$errors = [];

$pageaction = "add";
if(isset($_GET['action']))
{
    $pageaction = $_GET['action'];
}

// if posting
if($_SERVER['REQUEST_METHOD'] == "POST")
{


    $postname = $postage = $poststory = $postfilename = $postcontact = "";
    // Checking post data
    if(!isset($_POST['name']))
        {
            AddAlert("Name is not set", "danger");
            header("location: ./your-story.php");
            die();
        }
    $postname = $_POST['name'];

    if(!isset($_POST['story']))
        {
            AddAlert("Description is not set", "danger");
            header("location: ./your-story.php");
            die();
        }
    $poststory = $_POST['story'];
    
    if(isset($_POST['age']))
    {
        $postage = $_POST['age'];
    }
    if(isset($_POST['contact']))
    {
        $postcontact = $_POST['contact'];
    }

    if($postname == "" || $poststory == "")
    {
        AddAlert("Name and description cannot be empty", "danger");
        header("location: ./your-story.php");
        die();
    }


    // Adding image to server

    //print_r( basename($_FILES['image']['name']));
    

    if(!file_exists("images"))
    {
        if(!mkdir("images"))
            $errors[] = "Cannot create image folder.";
    }
    else
        if(! is_writable("images") || !is_dir("images"))
            $errors[] = "Cannot write image folder";

    if(count($errors) ==  0)
    {
        if(isset($_FILES['image']) && $_FILES['image']['name'] != "")
        {
            var_dump($_FILES['image']);
            /// AfisareVariabila($_FILES['imagine']);
            if($_FILES['image']['error'] != 0)
                $errors[] = "Upload Error.";
            else
            {
                if(!IsImage($_FILES['image']['name']))
                    $errors[] = "File loaded is not image.";
                else
                {
                    if($_FILES['image']['size'] > 4 * 1024 * 1024)
                        $errors[] = "File loaded is too big.";
                    else
                    {
                        $postfilename = FileNewName($_FILES['image']['name']);
                        if(! move_uploaded_file($_FILES['image']['tmp_name'] , "images/{$postfilename}"))
                            $errors[] = "File cannot be moved to server";
                    }
                }
            }
        }
    }

    if(count($errors) != 0)
    {
        foreach($errors as $err)
        {
            AddAlert($err, "danger");
        }
        header("location: ./your-story.php");
        die();
    }

    //var_dump($_POST);

    if(!INSERT_AddPost($postname, $postage, $poststory, $postfilename, $postcontact))
    {
        AddAlert("Error when uploading post", "danger");
        header("location: ./your-story.php");
        die();
    }

    header("location: ./your-story.php?action=success");
    die();

}
?>


<!DOCTYPE html>
<html lang="en">
<head>

<?php include "modules/html/mod-head.php"; ?>

</head>
<body style = "background-color: #ededed;">
<?php include "modules/html/mod-navbar.php"; ?>

<?php 
if($pageaction == "add")
{ ?>
<div class = "container mt-3" id = "container-greet">
<div class = "mt-3">
<h2 class = "display-2 text-center"> Share your story </h2>
</div>
<div class = "my-3">
<p class = "lead text-center" style = "font-size: 17px;">
    Your story is important and should be heard by the whole world.<br>Share your feelings and thoughts in these difficult times for everyone to see, helping to raise awareness.
</p>
</div>
<div class = "container mb-5">
<h3 class = "text-center">
    #WeStandForPeace
</h3>
</div>
<p>
    <!--<?=(count($errors)?print_r($errors):"Success")?>-->
</p>
</div>
<div class = "container mt-3" id = "container-form" >

    
    <form method = "post" enctype="multipart/form-data">

    <!-- name and age -->
    <div class = "d-md-flex d-block">
        <div class = "p-2 flex-md-grow-1 d-block d-md-inline">
            <label for = "name" class = "form-label"> Your name: </label> 
            <input class = "form-control" name = "name" id = "name" placeholder = "Your name or an alias" required>
        </div>
        <div class = "p-2 ms-md-4 ms-0 d-block d-md-inline">
            <label for = "age" class = "form-label"> Your age: </label> 
            <input class = "form-control" style = "min-width:200px;" type = "number" min = "0" max = "120" name = "age" id = "age" placeholder = "Your age (optional)">
        </div>
    </div>

    <!-- story -->
    <div class = "p-2 mt-2">
        <label for = "story" class = "form-label"> Your story: </label>
        <textarea required name = "story" id = "story"
        class = "form-control" style = "resize: none; height:200px"
        placeholder="Tell us about your and your family's reaction to recent events.&#10;Are you safe now?&#10;Where are you now?&#10;What are your feelings?&#10;How do you think the situation is being handled?"></textarea>
    </div>

    <!-- contact -->
    <div class = "p-2 mt-2">
        <label for = "contact" class = "form-label"> Contact Information <small>(Optional)</small> <span class = "d-inline d-md-none"><br></span><strong>(This data will only be visible to the site's administrators)</strong>: </label>
        <textarea name = "contact" id = "contact"
        class = "form-control" style = "resize: none; height:100px"
        placeholder="Allow us to contact you if we can offer any help.&#10;Phone number / E-mail / Instagram / Facebook"></textarea>
    </div>

    <!-- images -->
    <div class = "p-2 mt-2">
    <label for= "images" class = "form-label">Add an image (optional):</label>
    <input class = "d-block form-control-file" type="file" id="image" name="image" accept = "image/png,image/jpg,image/jpeg,image/bmp,image/gif,image/webp">
    </div>

    <!-- submit -->
    <div class = "p-2 mt-2 mb-5">
        <button type = "submit" class = "d-block mx-auto w-25 btn btn-dark"> Submit </button>
    </div>

    </form>
</div>

<?php }
else if ($pageaction == "success")
{ ?>
<div class = "container mt-3" id = "container-success">
    <h2 class = "display-2"> Sucess! </h2>
    <p> Thank you so much for sharing your story. Your post has been submitted and can now be found on the front page! </p>
    <h3> Remember, #weStandForPeace </h3> 
</div>
<?php
}
?>
<?php include "modules/html/mod-footer.php"; ?>
<?php include "modules/html/mod-scripts.php"; ?>
</body>
</html>