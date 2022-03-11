<?php
session_start();


include_once 'modules/functions/mod-functions.php';
$current_page = "admin";
$current_page_title = "Admin";

$passgenerator = "";

if(LoggedIn())
{
    $page_type = "admin";

    if(isset($_GET['view']))
    {
        if($_GET['view'] == "story")
        {
            $page_type = "story";
        }
    }
}
else
{
    $page_type = "login";

}

if($page_type == "story")
{
    if(!isset($_GET['id']))
    {
        AddAlert("No post set", "danger");
        header("location: ./admin.php");
        die();
    }

    $postid = $_GET['id'];

    if(!($post = SELECT_GetPostById($postid)))
    {
        AddAlert("No post found", "danger");
        header("location: ./admin.php");
        die();
    }
}

//page specific script variables
$loginUsername = $loginPassword = "";
$usernameError = $passwordError = $loginError = $genericError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "login")
{
    $usernameError = $passwordError = $loginError = $genericError = "";
    //Check variables set
    if(!isset($_POST['loginUsername'])){
        $usernameError = "Introdu numele de utilizator sau e-mailul!";
        die();
    }
    if(!isset($_POST['loginPassword'])){
        $passwordError = "Introdu parola!";
        die();
    }
    
    // grab variables from thing
    
    //var_dump($_POST);
    $loginUsername = trim($_POST['loginUsername']);
    $loginPassword = trim($_POST['loginPassword']);

    //Check not blank
    if($loginUsername == "")
    {
        $usernameError = "Add a username";
    }
    if($loginPassword == "")
    {
        $passwordError = "Add a password!";
    }

    //query database for username
    if($usernameError === "" && $passwordError === "")
    {
        $sqlq = "SELECT id, username, password FROM admins WHERE username = ?";

        if($stmt = $conn->prepare($sqlq))
        {
            $paramUsername = $loginUsername;
            $stmt->bind_param("s", $paramUsername);

            if($stmt->execute())
            {
                $stmt->store_result();

                if($stmt->num_rows == 1)
                {
                    $stmt->bind_result($id, $loginUsername, $hashPassword);
                    if($stmt->fetch())
                    {
                        if(password_verify($loginPassword, $hashPassword))
                        {

                            $_SESSION["loggedin"] = true;
                            $_SESSION["userid"] = $id;
                            $_SESSION["username"] = $loginUsername;
                            AddAlert("Admin connection successful", "success");
                           
                            header("location: ./admin.php");
                            die();
                        }
                        else
                        {
                            $loginError = "Password is not correct";
                        }
                    }
                    else
                    {
                        $genericError = "An error has occured ".$conn->error;
                    }
                }
                else
                {
                    $loginError = "No username found!";
                }
            }
            else
            {
                $genericError = "An error has occured ".$conn->error;
            }
        }
        else
        {
            $genericError = "An error has occured ".$conn->error;
        }
        $stmt->close();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "delete")
{
    if(!DELETE_ClearFile($_POST['postimagename']))
    {
        AddAlert("Couldn't delete file", "danger");
        header("location: ./index.php");
        die();
    }
    if(!DELETE_PostById($_POST['postid']))
    {
        AddAlert("Couldn't delete", "danger");
        header("location: ./admin.php");
        die();
    }
    AddAlert("Deletion successful", "success");
    header("location: ./admin.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "password")
{
    $passgenerator = password_hash($_POST['password'], PASSWORD_DEFAULT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "deleteimage")
{

    if(!DELETE_ClearFile($_POST['postimagename']))
    {
        AddAlert("Couldn't delete file", "danger");
        header("location: ./admin.php");
        die();
    }

    if(!DELETE_RemovePostImage($_POST['id']))
    {
        AddAlert("Couldn't delete imagename", "danger");
        header("location: ./admin.php");
        die();
    }

    AddAlert("Success!", "success");
    header("location: ./admin.php?view=story&id=".$_POST['id']);
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "setfeatured")
{
    if(!UPDATE_SetActiveStory($_POST['postid'], "featured"))
    {
        AddAlert("Error.", "danger");
        header("location: ./admin.php");
        die();
    }

    AddAlert("Success!", "success");
    header("location: ./admin.php?view=story&id=".$_POST['postid']);
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "setactive")
{
    if(!UPDATE_SetActiveStory($_POST['postid'], "active"))
    {
        AddAlert("Error.", "danger");
        header("location: ./admin.php");
        die();
    }

    AddAlert("Success!", "success");
    header("location: ./admin.php?view=story&id=".$_POST['postid']);
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['postaction'] == "sethidden")
{
    if(!UPDATE_SetActiveStory($_POST['postid'], "hidden"))
    {
        AddAlert("Error.", "danger");
        header("location: ./admin.php");
        die();
    }

    AddAlert("Success!", "success");
    header("location: ./admin.php?view=story&id=".$_POST['postid']);
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


<?php if($page_type == "login") { ?>
<div class = "container">
<form method = "post">
        <div class = "mt-2">
            <label for = "loginUsername" class = "form-label"> Username </label>
            <input type = "text" class = "form-control" name = "loginUsername" id = "loginUsername" value = "<?=$loginUsername?>" required>
            <span> <?=$usernameError?> </span>
        </div>
        <div class = "mt-2">
            <label for = "loginPassword" class = "form-label"> Password </label>
            <input type = "password" class = "form-control" name = "loginPassword" id = "loginPassword" required>
            <span> <?=$passwordError?> </span>
        </div>
        <div class = "mt-2">
            <?=$loginError?>
        </div>
        <div class = "mt-2">
            <button type = "submit" class = "btn btn-outline-primary d-inline-block me-3"> Log in </button>
            <div> <?=$genericError?></div>
        </div>

        <input type = "hidden" name = "postaction" value = "login">
        
    </form>
</div>
<?php }
else if ($page_type == 'admin')
{
$posts = SELECT_GetAllPosts(); 
if(count($posts) != 0)
{
?>

<div class = "container">
    <table class = "table">
        <thead>
            <tr>
                <th style = "width:5%;"> # </th>
                <th style = "width:5%;"> id </th>
                <th style = "width:20%;"> Name </th>
                <th style = "width:5%;"> State </th>
                <th style = "width:45%;"> Desc </th>
                <th style = "width:10%;"> Contact </th>
                <th style = "width:10%;"> Delete </th>
            </tr>
        </thead>

        <tbody>
        <?php
        $index = 0;
        foreach($posts as $post)
        {
            $index += 1;
            ?>
            <tr>
                <td><?=$index?></td>
                <td><?=htmlspecialchars($post['id'])?></td>
                <td><a href = "./admin.php?view=story&id=<?=$post['id']?>"> <?=htmlspecialchars($post['name'])?> </a></td>
                <td><?=htmlspecialchars($post['active'])?></td>
                <td><?=nl2br(htmlspecialchars($post['story']))?></td>
                <td><?=nl2br(htmlspecialchars($post['contact']))?></td>
                <td>
                    <form method = "post">
                        <input type = "hidden" name = "postid" value = "<?=$post['id']?>">
                        <input type = "hidden" name = "postimagename" value = "<?=$post['imagename']?>">
                        <input type = "hidden" name = "postaction" value = "delete">
                        <button type = "submit" class = "btn btn-outline-danger"> Delete </button> 
                    </form>
                </td>
            </tr>
            <?php
        }
    }

        ?>

        </tbody>
    </table>
</div>

<div class = "container my-3">
    <p>Password generator</p>
    <form method = "post">
        <input type = "hidden" name = "postaction" value = "password">
        <input type = "text" class = "form-control" name = "password" placeholder = "Transform text to sha" value = "<?=$passgenerator?>">
        <button type = "submit" class = "d-block mt-2 btn btn-outline-primary"> Go </button> 
    </form>
</div>
<?php } 
else if($page_type == "story")
{ ?>
    <div class = "container my-5">
    <?=ShowPostIndex($post)?>

    </div>

<?php } ?>

<?php include "modules/html/mod-footer.php"; ?>
<?php include "modules/html/mod-scripts.php"; ?>
</body>
</html>