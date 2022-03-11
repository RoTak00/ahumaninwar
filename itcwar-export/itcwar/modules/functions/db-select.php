<?php

function SELECT_GetAllPosts()
{
    $sqlq = "SELECT id, name, age, story, contact, imagename, active, added_date FROM posts
    ORDER BY id DESC";

    global $conn;
    $rez = [];

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($id, $name, $age, $story, $contact, $imagename, $active, $added_date);
        while($stmt->fetch())
        {
            $added_date = strtotime($added_date) + 60 * 60;
                        
            $rez[] = [
                    'id' => $id,
                    'age' => $age,
                    'name' => $name,
                    'story' => $story,
                    'contact' => $contact,
                    'imagename' => $imagename,
                    'active' => $active,
                    'added_date' => $added_date
                ];
        }
    }
    return $rez;

}

function SELECT_GetPosts($start, $limit)
{
    $sqlq = "SELECT id, name, age, story, contact, imagename, active, added_date FROM posts
    WHERE active = 'active' 
    ORDER BY id DESC
    LIMIT ?, ?";

    global $conn;
    $rez = [];

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    $stmt->bind_param("ii", $start, $limit);

    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($id, $name, $age, $story, $contact, $imagename, $active, $added_date);
        while($stmt->fetch())
        {
            $added_date = strtotime($added_date) + 60 * 60;
                        
            $rez[] = [
                    'id' => $id,
                    'age' => $age,
                    'name' => $name,
                    'story' => $story,
                    'contact' => $contact,
                    'imagename' => $imagename,
                    'active' => $active,
                    'added_date' => $added_date
                ];
        }
    }
    return $rez;

}

function SELECT_GetFeaturedPosts()
{
    $sqlq = "SELECT id, name, age, story, contact, imagename, active, added_date FROM posts
    WHERE (active = 'featured')
    ORDER BY id DESC";
    //echo $sqlq;

    global $conn;
    $rez = [];

    if(!($stmt = $conn->prepare($sqlq)))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }

    $stmt->store_result();
    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($id, $name, $age, $story, $contact, $imagename, $active, $added_date);
        while($stmt->fetch())
        {
            $added_date = strtotime($added_date) + 60 * 60;
                        
            $rez[] = [
                    'id' => $id,
                    'age' => $age,
                    'name' => $name,
                    'story' => $story,
                    'contact' => $contact,
                    'imagename' => $imagename,
                    'active' => $active,
                    'added_date' => $added_date
                ];
        }
    }
    return $rez;

}


function SELECT_GetPostById($id)
{
    $sqlq = "SELECT id, name, age, story, contact, imagename, active, added_date FROM posts
    WHERE id = ?";

    global $conn;
    $rez = [];

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

    $stmt->store_result();
    if($stmt->num_rows == 1)
    {
        $stmt->bind_result($id, $name, $age, $story, $contact, $imagename, $active, $added_date);
        if($stmt->fetch())
        {
            $added_date = strtotime($added_date) + 60 * 60;
                        
            $rez = [
                    'id' => $id,
                    'age' => $age,
                    'name' => $name,
                    'story' => $story,
                    'contact' => $contact,
                    'imagename' => $imagename,
                    'active' => $active,
                    'added_date' => $added_date
                ];
        }
    }
    return $rez;

}

function Select_CountActivePosts()
{
     $sqlq = "SELECT COUNT(id)
     AS n
     FROM posts
     WHERE active != 'hidden'";

     global $conn;
     $val = 0;
     
     if(!($stmt = $conn->prepare($sqlq)))
     {
        AddAlert($conn->error, "danger");
        return false;
     }
         
    if(!($stmt->execute()))
    {
        AddAlert($conn->error, "danger");
        return false;
    }
    
    $stmt->store_result();
    $stmt->bind_result($val);
    $stmt->fetch();
    return $val;
         
}

?>