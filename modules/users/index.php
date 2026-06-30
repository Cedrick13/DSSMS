<?php
include '../../config/database.php';

$result = mysqli_query($conn,"SELECT * FROM users");

$success = "";

if(isset($_GET['success']) && $_GET['success'] == "added")
{
    $success = "User added successfully!";
}

if(isset($_GET['success']) && $_GET['success'] == "updated")
{
    $success = "User updated successfully!";
}

if(isset($_GET['success']) && $_GET['success'] == "deleted")
{
    $success = "User deleted successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>

    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php include '../../includes/sidebar.php'; ?>

<div class="main-content">

<?php if($success != ""){ ?>

<div class="alert-success">
    <?= $success; ?>
</div>

<?php } ?>

    <div class="page-header">

    <div>
        <h2>
            <i class="fas fa-users"></i>
            Users</h2>
        <!-- <p>Manage system user accounts.</p> -->
    </div>

    <a href="add.php" class="add-btn">
        + Add User
    </a>

</div>

<div class="table-toolbar">

    <input
        type="text"
        id="searchInput"
        placeholder="🔍 Search users...">

</div>

<div class="table-card">

<table class="users-table">

    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['fullname']; ?></td>
            <td><?= $row['username']; ?></td>
            <td><?= $row['role']; ?></td>

            <td>

                <a
                    class="edit-btn"
                    href="edit.php?id=<?= $row['id']; ?>">
                    Edit
                </a>

                <a
                    class="delete-btn"
                    href="delete.php?id=<?= $row['id']; ?>"
                    onclick="return confirm('Delete this user?')">
                    Delete
                </a>

            </td>
        </tr>

    <?php } ?>

    </tbody>

</table>

</div>

</div>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/users.js"></script>

</body>
</html>