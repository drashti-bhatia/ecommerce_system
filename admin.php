<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: auth/login.php");
    exit;
}
header("Location: admin/dashboard.php");
?>
