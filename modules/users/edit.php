<?php
include '../../config/database.php';

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

if(!$user){
    die("User not found.");
}

if(isset($_POST['update']))
{
    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);
    $password = $_POST['password'];

    // Check if username already exists (except current user)
    $check = mysqli_query($conn,"
        SELECT * FROM users
        WHERE username='$username'
        AND id != '$id'
    ");

    if(mysqli_num_rows($check) > 0)
    {
        $error = "Username already exists!";
    }
    else
    {
        if(!empty($password))
        {
            $password = password_hash($password,PASSWORD_DEFAULT);

            mysqli_query($conn,"
                UPDATE users
                SET
                fullname='$fullname',
                username='$username',
                password='$password',
                role='$role'
                WHERE id='$id'
            ");
        }
        else
        {
            mysqli_query($conn,"
                UPDATE users
                SET
                fullname='$fullname',
                username='$username',
                role='$role'
                WHERE id='$id'
            ");
        }

        header("Location:index.php?success=updated");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit User</title>

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
<i class="fas fa-user-edit"></i>
Edit User
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
<label>Full Name</label>

<input
type="text"
name="fullname"
value="<?= htmlspecialchars($user['fullname']); ?>"
required>

</div>

<div class="form-group">
<label>Username</label>

<input
type="text"
name="username"
value="<?= htmlspecialchars($user['username']); ?>"
required>

</div>

<div class="form-group">
<label>New Password (Optional)</label>

<input
type="password"
name="password"
placeholder="Leave blank to keep current password">

</div>

<div class="form-group">
<label>Role</label>

<select name="role">

<option value="Admin" <?= $user['role']=="Admin" ? "selected" : ""; ?>>
Admin
</option>

<option value="Staff" <?= $user['role']=="Staff" ? "selected" : ""; ?>>
Staff
</option>

</select>

</div>

<div class="button-group">

<a href="index.php" class="cancel-btn">
Cancel
</a>

<button
type="submit"
name="update"
class="save-btn">

Update User

</button>

</div>

</form>

</div>

</div>

<script src="../../assets/js/main.js"></script>

</body>
</html>