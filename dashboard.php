<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/database.php';

// Counts
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$totalDocuments = 0;
$totalCategories = 0;

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">

    <h2>Dashboard</h2>

    <!-- Statistics -->
    <div class="dashboard-cards">

        <div class="dashboard-card">
            <h1><?= $totalUsers ?></h1>
            <p>Users</p>
        </div>

        <div class="dashboard-card">
            <h1><?= $totalDocuments ?></h1>
            <p>Documents</p>
        </div>

        <div class="dashboard-card">
            <h1><?= $totalCategories ?></h1>
            <p>Categories</p>
        </div>

    </div>

    <!-- Upload Area -->
    <div class="upload-section">
        <h3>Upload Files</h3>

        <form action="modules/documents/upload.php"
              method="POST"
              enctype="multipart/form-data">

            <div class="upload-box">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drop files here</p>

                <input type="file"
                       name="document"
                       required>

                <button type="submit">
                    Upload
                </button>
            </div>

        </form>
    </div>

    <!-- Recent Files -->
    <div class="recent-files">

        <h3>Recent Documents</h3>

        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Date Uploaded</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $query = mysqli_query($conn,
                "SELECT * FROM documents
                 ORDER BY id DESC
                 LIMIT 5");

            while($row = mysqli_fetch_assoc($query)){
            ?>
                <tr>
                    <td><?= $row['file_name']; ?></td>
                    <td><?= $row['upload_date']; ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </div>

</div>

<?php include 'includes/footer.php'; ?>