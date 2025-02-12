<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
            <h2>Welcome, <?= $_SESSION['username']; ?>!</h2>
            <p>This is your dashboard.</p>
            <a href="auth/logout.php">Logout</a>
    </div>
</body>
</html>
