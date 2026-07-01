<?php
include 'config/database.php';

$search = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$query = mysqli_query($conn,"
SELECT documents.*, users.username
FROM documents
LEFT JOIN users
ON documents.user_id = users.id
WHERE documents.file_name LIKE '%$search%'
ORDER BY documents.id DESC
");

while($row = mysqli_fetch_assoc($query))
{
    $extension = strtoupper(pathinfo($row['file_name'], PATHINFO_EXTENSION));
?>

<tr>

    <td>
        <i class="fas fa-file-alt file-icon"></i>
        <?= $row['file_name']; ?>
    </td>

    <td>
        <span class="doc-badge">
            <?= $extension ?>
        </span>
    </td>

    <td>
        <?= date('M d, Y', strtotime($row['upload_date'])) ?>
    </td>

    <td>
        <?= $row['username'] ?>
    </td>

    <td>
        <a href="assets/uploads/documents/<?= $row['file_path'] ?>"
           target="_blank"
           class="view-btn">
            View
        </a>
    </td>

</tr>

<?php
}
?>