<div class="sidebar" id="sidebar">

    <div class="logo">
        <h2>DSSMS</h2>
        <button id="toggleBtn">☰</button>
    </div>

    <span class="menu-title">MAIN</span>

    <ul class="menu">
        <li>
            <a href="dashboard.php">
                <span class="icon">🏠</span>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="menu-item has-submenu">
            <a href="#">
                <span class="icon">👤</span>
                <span class="text">Users</span>
            </a>

            <ul class="submenu">
                <li><a href="modules/users/add.php">Add User</a></li>
                <li><a href="modules/users/index.php">Manage Users</a></li>
            </ul>
        </li>

        <li>
            <a href="modules/documents/index.php">
                <span class="icon">📄</span>
                <span class="text">Documents</span>
            </a>
        </li>

        <li>
            <a href="modules/categories/index.php">
                <span class="icon">📁</span>
                <span class="text">Categories</span>
            </a>
        </li>

        <li>
            <a href="modules/reports/daily.php">
                <span class="icon">📊</span>
                <span class="text">Reports</span>
            </a>
        </li>
    </ul>

    <span class="menu-title">SETTINGS</span>

    <ul class="menu">
        <li>
            <a href="logout.php">
                <span class="icon">🚪</span>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>

</div>