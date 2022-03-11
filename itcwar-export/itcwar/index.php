<?php
session_start();


include_once 'modules/functions/mod-functions.php';
$current_page = "index";
$current_page_title = "Home";


// Set number of tasks to load per ajax call
$postsperload = 5;
if(isset($_GET['ppp']))
    $postsperload = $_GET['ppp'];

if(Select_CountActivePosts() == 0)
{
    $noposts = true;
}
else
{
$featured_posts = SELECT_GetFeaturedPosts();
//print_r($featured_posts);

$first_post_load = $postsperload - count($featured_posts);
if($first_post_load > 0)
{ 
$page_posts = SELECT_GetPosts(0, $first_post_load);
}
else
    $page_posts = [];
$noposts = false;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>

<?php include "modules/html/mod-head.php"; ?>

</head>
<body style = "background-color: #ededed;">
<?php include "modules/html/mod-navbar.php"; ?>

<div class = "container">
<div class = "jumbotron p-3 mt-2 mb-5">
<div >
<h2 class = "display-2 text-center"> A Human in War </h2>
</div>
<p class = "lead text-center" style = "font-size: 17px;">Because what's going on is more than what's seen on the news.<br>Hear the stories of brave people from today's war-riddled regions and how they're managing life. </p>
</div>
</div>


<?php
if($noposts == false)
{ ?>
<div class = "container">
<div class = "row">
<div class = "col-12 col-md-2"> </div>
<div class = "col-12 col-md-8" id = "container-posts">
    <?php
// output collected tasks
foreach($featured_posts as $post)
    ShowPostIndex($post);
foreach($page_posts as $post)
    ShowPostIndex($post);

    ?>
</div>
<div class = "col-12 col-md-2"> </div>
</div>
</div>

<!-- loadmore button in case scrollign doesn't work -->
<div class = "container my-5" id = "container-btn-loadmore">
    <button id = "btn-loadmore" class = "btn btn-outline-dark d-block mx-auto text-center"> More.. </button>
</div>

<!-- input for ajax numbering -->
<input type = "hidden" id = "data-row-number" value = "<?=$postsperload?>">
<input type = "hidden" id = "data-postsperload" value = "<?=$postsperload?>"> 
<?php
}
else
{ ?>

<div class = "container mt-2">
    <p class = "lead px-5 text-center" style = "font-size: 20px;"> <strong>There are no stories on the website yet.</strong></p>
    <a role = "button" class = "w-50 mx-auto mt-1 d-block btn btn-outline-dark" href = "./your-story.php" style = "background-color: #dcdcde; font-size: 20px;" >Be the first to add one!</a>
</div>
<?php }
?>
<?php include "modules/html/mod-footer.php"; ?>
<?php include "modules/html/mod-scripts.php"; ?>
<script type = "text/javascript" src = "js/load-posts.js"></script>
</body>
</html>