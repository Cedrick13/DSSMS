<?php
include 'includes/auth.php';
?>

<h1>Welcome <?php echo $_SESSION['fullname']; ?></h1>

<a href="logout.php">Logout</a>