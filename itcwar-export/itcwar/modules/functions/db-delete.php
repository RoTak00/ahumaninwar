<?php

function DELETE_PostById($id)
{
    $sqlq = "DELETE
    FROM posts
    WHERE id = ?";

    global $conn;

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    $stmt->bind_param("i", $id);
        
    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    return true;
}

function DELETE_ClearFile($filename)
{
    if($filename == "")
        return true;
    //AddAlert("./images/".$filename, "success");

    if(!unlink("./images/".$filename))
        return false;
    return true;
}

function DELETE_RemovePostImage($id)
{
    $sqlq = "UPDATE posts SET imagename = ''
    WHERE id = ?";

    global $conn;

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    $stmt->bind_param("i", $id);
        
    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    return true;
}
?>