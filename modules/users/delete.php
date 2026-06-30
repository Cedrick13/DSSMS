<?php

include '../../config/database.php';

if(isset($_GET['id']))
{
    $id = (int)$_GET['id'];

    mysqli_query($conn,
        "DELETE FROM users
        WHERE id='$id'");
}

header("Location:index.php?success=deleted");
exit();