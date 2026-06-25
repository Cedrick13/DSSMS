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

<h2>Add User</h2>

<form method="POST">

    <label>Full Name</label><br>
    <input type="text" name="fullname" required>

    <br><br>

    <label>Username</label><br>
    <input type="text" name="username" required>

    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>

    <br><br>

    <label>Role</label><br>
    <select name="role">

        <option value="Staff">
            Staff
        </option>

        <option value="Admin">
            Admin
        </option>

    </select>

    <br><br>

    <button type="submit" name="save">
        Save User
    </button>

</form>