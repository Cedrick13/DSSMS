<?php
include '../../config/database.php';

if(isset($_POST['save']))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($conn,"
        INSERT INTO users
        (fullname,username,password,role)
        VALUES
        ('$fullname','$username','$password','$role')
    ");

    header("Location:index.php");
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