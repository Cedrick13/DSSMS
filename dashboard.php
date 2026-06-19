<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
    <h1>Welcome Administrator</h1>

    <div class="cards">
        <div class="card">
            <h3>Users</h3>
            <p>Manage System Users</p>
        </div>

        <div class="card">
            <h3>Documents</h3>
            <p>Manage Documents</p>
        </div>

        <div class="card">
            <h3>Reports</h3>
            <p>View Reports</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>