<?php
include '../../config/database.php';

if(isset($_POST['save']))
{
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Check if category already exists
    $check = mysqli_query($conn,
        "SELECT * FROM categories
        WHERE category_name='$category_name'");

    if(mysqli_num_rows($check) > 0)
    {
        $error = "Category already exists!";
    }
    else
    {
        mysqli_query($conn,"
            INSERT INTO categories
            (category_name,description)
            VALUES
            ('$category_name','$description')
        ");

        header("Location:index.php?success=added");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Category</title>

<link rel="stylesheet" href="../../assets/css/dashboard.css">
<link rel="stylesheet" href="../../assets/css/users.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include '../../includes/sidebar.php'; ?>

<div class="main-content">

<div class="page-header">

<h2>

<i class="fas fa-folder-plus"></i>

Add Category

</h2>

</div>

<div class="user-card">

<form method="POST">

<?php if(isset($error)){ ?>

<div class="alert-error">

<?= $error ?>

</div>

<?php } ?>

<div class="form-group">

<label>Category Name</label>

<input
type="text"
name="category_name"
placeholder="Enter category name"
required>

</div>

<div class="form-group">

<label>Description</label>

<textarea
name="description"
placeholder="Enter description"
rows="5"></textarea>

</div>

<div class="button-group">

<a
href="index.php"
class="cancel-btn">

Cancel

</a>

<button
type="submit"
name="save"
class="save-btn">

Save Category

</button>

</div>

</form>

</div>

</div>

<script src="../../assets/js/main.js"></script>

</body>
</html>