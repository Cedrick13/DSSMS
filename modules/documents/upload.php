<?php
session_start();

include '../../config/database.php';

if(isset($_POST['submit']) || isset($_FILES['document']))
{
    $fileName = $_FILES['document']['name'];
    $tmpName  = $_FILES['document']['tmp_name'];

    // Get selected category
    $category_id = $_POST['category_id'];

    // Upload folder
    $uploadDir = '../../assets/uploads/documents/';

    // Create unique filename
    $newFileName = time() . "_" . $fileName;

    $filePath = $uploadDir . $newFileName;

    if(move_uploaded_file($tmpName, $filePath))
    {
        $user_id = $_SESSION['user_id'];

        mysqli_query($conn,"
            INSERT INTO documents
            (file_name, file_path, user_id, category_id)
            VALUES
            ('$fileName','$newFileName','$user_id','$category_id')
        ");

        header("Location: ../../dashboard.php?upload=success");
        exit();
    }
    else
    {
        echo "Upload Failed";
    }
}
?>