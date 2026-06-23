<?php
include '../../config/database.php';

$query = mysqli_query($conn,"
    SELECT documents.*, users.username
    FROM documents
    LEFT JOIN users ON documents.user_id = users.id
    ORDER BY documents.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Documents</title>

    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/documents.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php include '../../includes/sidebar.php'; ?>

<div class="main-content">

<div class="documents-container">

    <div class="page-header">

        <h2>
            <i class="fas fa-folder-open"></i>
            Documents
        </h2>

    </div>

    <div class="table-card">

        <div class="search-box">
            <input type="text"
                   id="searchInput"
                   placeholder="🔍 Search document...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Uploaded By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($query)){ ?>

                <tr>

                    <td>

                    <?php
                    $ext = strtoupper(
                        pathinfo(
                            $row['file_name'],
                            PATHINFO_EXTENSION
                        )
                    );
                    ?>

                    <i class="fas fa-file-alt file-icon"></i>

                    <?= htmlspecialchars($row['file_name']) ?>

                    <span class="badge">
                        <?= $ext ?>
                    </span>

                    </td>

                    <td>
                        <?= htmlspecialchars($row['username']) ?>
                    </td>

                    <td>
                        <?= date('M d, Y h:i A',
                        strtotime($row['upload_date'])) ?>
                    </td>

                <td>
    <div class="action-buttons">

        <a class="view-btn"
        href="../../assets/uploads/documents/<?= $row['file_path'] ?>"
        target="_blank">
            <i class="fas fa-eye"></i>
            View
        </a>

        <a class="download-btn"
        href="../../assets/uploads/documents/<?= $row['file_path'] ?>"
        download>
            <i class="fas fa-download"></i>
            Download
        </a>

        <a class="delete-btn"
        href="delete.php?id=<?= $row['id'] ?>"
        onclick="return confirm('Delete this file?')">
            <i class="fas fa-trash"></i>
        </a>

    </div>
</td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</div>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/documents.js"></script>

</body>
</html>