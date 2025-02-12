<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h2>User Registration</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
    <?php
    session_start(); // Start the session
    require '../includes/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // 1. Check if fields are empty
        if (empty($username) || empty($email) || empty($password)) {
            echo "<p style='color:red;'>All fields are required.</p>";
            exit();
        }

        // 2. Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red;'>Invalid email format!</p>";
            exit();
        }

        // 3. Validate password strength
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^\w]/', $password)) {
            echo "<p style='color:red;'>Password must be at least 8 characters long, contain 1 uppercase letter, 1 number, and 1 special character.</p>";
            exit();
        }

        // 4. Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<p style='color:red;'>Username or email already exists.</p>";
            exit();
        }
        $stmt->close();

        // 5. Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // 6. Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // Automatically log in the user after registration
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;

            echo "<p style='color:green;'>Registration successful! Redirecting...</p>";
            header("Refresh: 2; URL=../dashboard.php"); // Redirect to dashboard after 2 seconds
            exit();
        } else {
            echo "<p style='color:red;'>Error: Something went wrong. Please try again.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>


</body>

</html>