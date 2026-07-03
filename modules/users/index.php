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

<table class="users-table" id="usersTable">

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

           <td class="action-column">

<a
href="edit.php?id=<?= $row['id']; ?>"
class="icon-btn edit-btn"
title="Edit">

<i class="fas fa-pen"></i>

</a>

<a
href="delete.php?id=<?= $row['id']; ?>"
class="icon-btn delete-btn"
title="Delete"
onclick="return confirm('Delete this user?')">

<i class="fas fa-trash"></i>

</a>

</td>
        </tr>

    <?php } ?>

    </tbody>

</table>

<div class="table-footer">

    <div class="entries">

        Showing

        <select id="rowsPerPage">
            <option>10</option>
            <option>20</option>
            <option>50</option>
        </select>

    </div>

    <div id="tableInfo"></div>

    <div class="pagination">

        <button id="prevBtn">
            <i class="fas fa-chevron-left"></i>
        </button>

        <span id="pageNumbers"></span>

        <button id="nextBtn">
            <i class="fas fa-chevron-right"></i>
        </button>

    </div>

</div>

</div>

</div>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/users.js"></script>

</body>
</html>