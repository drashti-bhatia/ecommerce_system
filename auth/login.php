<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <?php
session_start();
require '../includes/config.php';

// Redirect logged-in users
if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username_or_email) || empty($password)) {
        echo "<p style='color: red;'>Please enter username/email and password.</p>";
    } else {
        // Prepare SQL query to fetch user details
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $username, $hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {                
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                header("Location: ../dashboard.php");
                exit();
            } else {
                echo "<p style='color: red;'>Invalid credentials.</p>";
            }
        } else {
            echo "<p style='color: red;'>User not found.</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
</body>

</html>