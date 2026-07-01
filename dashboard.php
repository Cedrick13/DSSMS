<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/database.php';

// Counts
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$totalDocuments = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM documents")
)['total'];
$totalCategories = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories")
)['total'];

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">

    <h2>
        <i class="fas fa-list-alt"></i>
        Dashboard</h2>

    <?php if(isset($_GET['upload'])): ?>
    <div class="success-msg">
        Document uploaded successfully!
    </div>
<?php endif; ?>

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

                <div class="form-group">

<label>Category</label>

<select name="category_id" required>

    <option value="">-- Select Category --</option>

    <?php

    $categories = mysqli_query($conn,"SELECT * FROM categories ORDER BY category_name ASC");

    while($cat = mysqli_fetch_assoc($categories))
    {

    ?>

        <option value="<?= $cat['category_id']; ?>">
            <?= $cat['category_name']; ?>
        </option>

    <?php } ?>

</select>

</div>

<input
type="file"
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

    <div class="table-header">
        <h3>Recent Documents</h3>

        <div class="table-actions">
            <input type="text" id="searchInput" placeholder="🔍 Search...">
            <!-- <button>Filters</button> -->
        </div>
    </div>

    <table class="documents-table" id="documentsTable">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Type</th>
                <th>Date Uploaded</th>
                <th>Uploaded By</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="documentsBody">

        <?php
        $query = mysqli_query($conn,"
            SELECT documents.*, users.username
            FROM documents
            LEFT JOIN users ON documents.user_id = users.id
            ORDER BY documents.id DESC
            LIMIT 5
        ");

        while($row = mysqli_fetch_assoc($query)){

            $extension = strtoupper(pathinfo($row['file_name'], PATHINFO_EXTENSION));
        ?>
            <tr>

                <td>
                    <i class="fas fa-file-alt file-icon"></i>
                    <?= $row['file_name']; ?>
                </td>

                <td>
                    <span class="doc-badge">
                        <?= $extension; ?>
                    </span>
                </td>

                <td>
                    <?= date('M d, Y', strtotime($row['upload_date'])); ?>
                </td>

                <td>
                    <?= $row['username']; ?>
                </td>

                <td>
                    <a href="assets/uploads/documents/<?= $row['file_path']; ?>"
                       target="_blank"
                       class="view-btn">
                        View
                    </a>
                </td>

            </tr>
        <?php } ?>

        </tbody>
    </table>

</div>

</div>

<?php include 'includes/footer.php'; ?>