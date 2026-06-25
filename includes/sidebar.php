<?php
$base_url = "/DSSMS/";
?>

<div class="sidebar" id="sidebar">

    <div class="logo">
        <h2>Documents System</h2>
        <button id="toggleBtn">☰</button>
    </div>

    <span class="menu-title">MAIN</span>

    <ul class="menu">
        <li>
            <a href="<?= $base_url ?>dashboard.php">
                <span class="icon">🏠</span>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="menu-item has-submenu">
            <a href="#">
                <span class="icon">👤</span>
                <span class="text">Users</span>
                <span class="arrow">▼</span>
            </a>

            <ul class="submenu">
                <li><a href="<?= $base_url ?>modules/users/add.php">Add User</a></li>
                <li><a href="<?= $base_url ?>modules/users/index.php">Manage Users</a></li>
            </ul>
        </li>

        <li>
            <a href="<?= $base_url ?>modules/documents/index.php">
                <span class="icon">📄</span>
                <span class="text">Documents</span>
            </a>
        </li>

        <li>
            <a href="<?= $base_url ?>modules/categories/index.php">
                <span class="icon">📁</span>
                <span class="text">Categories</span>
            </a>
        </li>

        <li>
            <a href="<?= $base_url ?>modules/reports/daily.php">
                <span class="icon">📊</span>
                <span class="text">Reports</span>
            </a>
        </li>
    </ul>

    <span class="menu-title">SETTINGS</span>

    <ul class="menu">
        <li>
            <a href="<?= $base_url ?>logout.php">
                <span class="icon">🚪</span>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>

<div class="sidebar-footer">
    © <?php echo date('Y'); ?> Ced<br>
    All rights reserved.
</div>

</div>