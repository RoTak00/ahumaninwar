<?php
function UPDATE_SetActiveStory($id, $active)
{
    global $conn;

    $sqlq = "UPDATE posts
    SET active = ?
    WHERE id = ?";

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    $stmt->bind_param("si", $active, $id);

    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    return true;
}
?>