<?php
include '../../config/database.php';

$id = $_GET['id'];

$result = mysqli_query($conn,
    "SELECT * FROM categories WHERE category_id='$id'");

$category = mysqli_fetch_assoc($result);

if(!$category){
    die("Category not found.");
}

if(isset($_POST['update']))
{
    $category_name = mysqli_real_escape_string($conn,$_POST['category_name']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $check = mysqli_query($conn,"
        SELECT * FROM categories
        WHERE category_name='$category_name'
        AND category_id != '$id'
    ");

    if(mysqli_num_rows($check) > 0)
    {
        $error = "Category already exists!";
    }
    else
    {
        mysqli_query($conn,"
            UPDATE categories
            SET
            category_name='$category_name',
            description='$description'
            WHERE category_id='$id'
        ");

        header("Location:index.php?success=updated");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Category</title>

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
<i class="fas fa-edit"></i>
Edit Category
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
value="<?= htmlspecialchars($category['category_name']); ?>"
required>

</div>

<div class="form-group">

<label>Description</label>

<textarea
name="description"
rows="5"><?= htmlspecialchars($category['description']); ?></textarea>

</div>

<div class="button-group">

<a href="index.php" class="cancel-btn">
Cancel
</a>

<button
type="submit"
name="update"
class="save-btn">

Update Category

</button>

</div>

</form>

</div>

</div>

<script src="../../assets/js/main.js"></script>

</body>
</html>