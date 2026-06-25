<?php
include '../../config/database.php';

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<h2>Users</h2>

<a href="add.php">+ Add User</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    <?php while($row=mysqli_fetch_assoc($result)){ ?>

    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['fullname']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['role']; ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
            <a href="delete.php?id=<?= $row['id']; ?>">Delete</a>
        </td>
    </tr>

    <?php } ?>

</table>