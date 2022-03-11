<?php

function INSERT_AddPost($name, $age, $story, $filename, $contact = "")
{
    $sqlq = "INSERT INTO posts(name, age, story, contact, imagename) VALUES (?, ?, ?, ?, ?)";
    global $conn;

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    $stmt->bind_param("sisss", $name, $age, $story, $contact, $filename);

    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    return $conn->insert_id;
    
}
?>