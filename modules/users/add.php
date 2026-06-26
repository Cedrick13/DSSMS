<?php
include '../../config/database.php';

if(isset($_POST['save']))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

// Check if username already exists
$check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($check) > 0)
{
    $error = "Username already exists!";
}
else
{
    mysqli_query($conn,"
        INSERT INTO users
        (fullname,username,password,role)
        VALUES
        ('$fullname','$username','$password','$role')
    ");

    header("Location:index.php?success=added");
    exit();
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>

    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/users.css">
</head>
<body>

<?php include '../../includes/sidebar.php'; ?>

<<div class="main-content">

    <div class="page-header">
        <h2>Add User</h2>
        <p>Create a new system user account.</p>
    </div>

    <div class="user-card">

        <form method="POST">

<?php if(isset($error)){ ?>

<div class="alert-error">
    <?= $error ?>
</div>

<?php } ?>

            <div class="form-group">
                <label>Full Name</label>
                <input
                    type="text"
                    name="fullname"
                    placeholder="Enter full name"
                    required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Enter username"
                    required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    required>
            </div>

            <div class="form-group">
                <label>Role</label>

                <select name="role">

                    <option value="Staff">Staff</option>

                    <option value="Admin">Admin</option>

                </select>
            </div>

            <div class="button-group">

                <a href="index.php" class="cancel-btn">
                    Cancel
                </a>

                <button
                    type="submit"
                    name="save"
                    class="save-btn">

                    Save User

                </button>

            </div>

        </form>

    </div>

</div>

<script src="../../assets/js/main.js"></script>

</body>
</html>