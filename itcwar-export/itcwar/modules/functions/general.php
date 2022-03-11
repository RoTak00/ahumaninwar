<?php
function AddAlert($text, $type)
{
    if(! isset($_SESSION['alerts']))
        $_SESSION['alerts'] = [];
        
    $alert = array(
        "text" => $text,
        "type" => $type
    );
    $_SESSION['alerts'][] = $alert;

 }

function ShowAlert()
{
    //print_r ($_SESSION);
    if(! isset($_SESSION['alerts']))
    {
        return;
    }
    ?>
    <div class="container py-3">
        <?php
        foreach($_SESSION['alerts'] as $alert)
        {
        ?>
            <div class="alert alert-<?=$alert['type']?>" role = "alert">
                <?=htmlspecialchars($alert['text'])?>
            </div>
        <?php
        }
        unset($_SESSION['alerts']);
        ?>
    </div>
    <?php
}

function ArrayToInQuery($arr)
{
    $rez = "(";
    $iteration = 0;
    foreach($arr as $el)
    {
        $rez .= ($iteration ? ", " : "");
        $iteration++;
        $rez .= $el;
    }
    $rez .= ")";
    return $rez;
}

function NameToAlias($name)
{
    $rez = iconv("UTF-8", "ASCII//IGNORE", $name);
    $rez = strtolower($rez);
    $rez = str_replace(" ", "-", $rez);

    return $rez;
}
    

function IsImage($filename)
    {
        /// returneaza true sau false dupa cum $nume_fisier are sau nu extensie de imagine
        $arr = explode(".", $filename);
        $ext = strtolower(end($arr));
        return in_array($ext , ['jpg', 'jpeg', 'webp', 'png', 'gif', 'bmp' ]);
    }

    function FileNewName($filename)
    {
        $arr = explode(".", $filename);
        $ext = strtolower(end($arr));
        return sha1($filename.time().rand(1,1000000000)).".".$ext;
    }


    function LoggedIn()
    {
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
            return $_SESSION['userid'];
        else
            return 0;
    }
    ?>