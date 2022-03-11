<?php

function PostDateToOutput($added_date)
    {
        
        $interval = time() - $added_date;
        $rez = "";

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
        $month = $week * 30;
        $year = $month * 12;

        if($interval < $minute)
        {
            $rez = "right now";
        }
        else if ($interval <  2 * $minute)
        {
            $rez = "one minute ago";
        }
        else if($interval < $hour)
        {
            $rez = floor($interval / $minute)." minutes ago";
        }
        else if($interval < 2 * $hour)
        {
            $rez = "one hour ago";
        }
        else if($interval < $day)
        {
            $rez = floor($interval / $hour)." hours ago";
        }
        else if($interval < 2 * $day)
        {
            $rez = "one day ago";
        }
        else if($interval < $week)
        {
            $rez = floor($interval / $day)." days ago";
        }
        else if($interval < 2 * $week)
        {
            $rez = "one week ago";
        }
        else if($interval < $month)
        {
            $rez = floor($interval / $week)." weeks ago";
        }
        else if($interval < 2 * $month)
        {
            $rez = "one month ago";
        }
        else if($interval < $year)
        {
            $rez = floor($interval / $month)." months ago";
        }
        else if($interval < 2 * $year)
        {
            $rez = "one year ago";
        }
        else
        {
            $rez = floor($interval / $year)." years ago";
        }
        
        return $rez;
    }

function ShowPostIndex($post)
{
    //var_dump($post);
?>

<div class = "container" style = "border: 1px solid #bdbdbd; margin-bottom: 45px; background-color: #dcdcde;">


<div class = "container py-2">
    <!-- name -->
        <h4 class = "text-center"> Posted by <span style="font-weight: bolder;"><?=htmlspecialchars($post['name'])?></span></h4>
    <!-- if age set age -->
        <?php if(isset($post['age']) && ($post['age'] != 0)) { ?>
        <div class = "container" style = "margin-top: -7px;">
            <p class = "text-center" style = "margin-bottom: 0px;" ><strong><?=htmlspecialchars($post['age'])?></strong> years old</p>
        </div>
        <?php } ?>        
</div>

<!-- phone -->

<div class = "d-block d-md-none mx-auto px-3 pb-3">
    <!-- if image set image -->
<?php
if($post['imagename'] != "")
{ ?>
<img src = "./images/<?=$post['imagename']?>" class = "d-block d-md-none img-fluid">
<?php
}
?>
<div class = "w-100 mx-auto p-2 mt-2 d-block d-md-none">
<?=($post['active'] == "featured" ? '<i title = "Featured Story" class="fas fa-star" style = "color: #f5c92a;"></i>':'')?>    
"<?=nl2br(htmlspecialchars($post['story']))?>"
</div>

</div>

<!-- pc -->

<div class = "d-none d-md-block mx-auto p-3">
    <!-- if image set image -->
<?php
if($post['imagename'] != "")
{ ?>
<img src = "./images/<?=$post['imagename']?>" class = "w-75 mx-auto d-none d-md-block img-fluid">
<?php
}
?>
<div class = "w-100 mx-auto p-2 mt-2 d-none d-md-block">
<?=($post['active'] == "featured" ? '<i title = "Featured Story" class="fas fa-star" style = "color: #f5c92a;"></i>':'')?> 
    "<?=nl2br(htmlspecialchars($post['story']))?>"
</div>

</div>

<!-- date and admin settings -->
<div class = "w-100 mx-auto pe-1 pt-1">
    <!-- date -->
    <p class="text-end"><small>Posted <?=PostDateToOutput($post['added_date'])?></small></p>

    <!-- admin settings -->
    <?php
    if(LoggedIn())
    { ?>
    <!--<small> id <?=$post['id']?> </small><br>-->
    <?php if($post['contact'] != "") { ?>
    <p><strong> Contact: </strong> <br><?=nl2br(htmlspecialchars($post['contact']))?></p>
    <?php } ?>
    <div class = "d-flex">
        <div class = "p-2">
        <a role = "button" class = "btn btn-outline-primary" href = "./admin.php?view=story&id=<?=$post['id']?>"> Admin </a>
        </div>
        <div class = "p-2">
        <form method = "post" action = "./admin.php">
                            <input type = "hidden" name = "postid" value = "<?=$post['id']?>">
                            <input type = "hidden" name = "postimagename" value = "<?=$post['imagename']?>">
                            <input type = "hidden" name = "postaction" value = "delete">
                            <button type = "submit" class = "btn btn-outline-danger"> Delete Post </button> 
                        </form>
        </div>
        <div class = "p-2">
        <?php if($post['imagename'] != '')
        { ?>
        <form method = "post" action = "./admin.php">
        <input type = "hidden" name = "postaction" value = "deleteimage">
        <input type = "hidden" name = "id" value = "<?=$post['id']?>">
        <input type = "hidden" name = "postimagename" value = "<?=$post['imagename']?>">
        <button type = "submit" class = "d-block btn btn-outline-danger"> Delete Image </button>

        </form>

        <?php } ?>
        </div>
    </div>

    <div class = "d-flex">
        <div class = "p-2">
            <?php if($post['active'] == "active") { ?>
            <form method = "post" action = "./admin.php">
                <input type = "hidden" name = "postid" value = "<?=$post['id']?>">
                <input type = "hidden" name = "postaction" value = "setfeatured">
                <button type = "submit" class = "btn btn-outline-primary"> Feature Post </button>
            </form>
            <?php } ?>
            <?php if($post['active'] == "featured") { ?>
            <form method = "post" action = "./admin.php">
                <input type = "hidden" name = "postid" value = "<?=$post['id']?>">
                <input type = "hidden" name = "postaction" value = "setactive">
                <button type = "submit" class = "btn btn-outline-primary"> Unfeature Post </button>
            </form>
            <?php } ?>
        </div>
        <div class = "p-2">
            <?php if($post['active'] != "hidden") { ?>
            <form method = "post" action = "./admin.php">
                <input type = "hidden" name = "postid" value = "<?=$post['id']?>">
                <input type = "hidden" name = "postaction" value = "sethidden">
                <button type = "submit" class = "btn btn-outline-primary"> Hide Post </button>
            </form>
            <?php } ?>
            <?php if($post['active'] == "hidden") { ?>
            <form method = "post" action = "./admin.php">
                <input type = "hidden" name = "postid" value = "<?=$post['id']?>">
                <input type = "hidden" name = "postaction" value = "setactive">
                <button type = "submit" class = "btn btn-outline-primary"> Unhide Post </button>
            </form>
            <?php } ?>
        </div>
    </div>
    <?php }
    ?>
</div>
</div>

<?php
}
?>