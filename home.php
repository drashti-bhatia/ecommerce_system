<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/style.css">
    <style>
        .container2 {
            display: grid;
            justify-items: center;
            grid-auto-flow: row;
            width: 466px;
            margin: 12px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="./client/display_product.php">Products</a>
        <a href="./auth/register.php">Register</a>
        <a href="./auth/login.php">Login</a>
    </div>
    <div class="container">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="additional"></div>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>You are logged in.</p>
            <a href="logout.php">Logout</a>
        </div>
    <?php else: ?>
        <div class="container2">
            <h2>Welcome to Our Website</h2>
            <p>Please <a href="./auth/login.php">Login</a> or <a href="./auth/register.php">Register</a></p>
        </div>
    <?php endif; ?>
    </div>

    <h3>Our Products</h3>
    <div class="product-list">
        <?php
        // Connect to database
        // require './includes/config.php';
        
        // $sql = "SELECT * FROM products";
        // $result = $conn->query($sql);
        
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         echo "<div class='product'>";
        //         echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
        //         echo "<h4>" . $row['name'] . "</h4>";
        //         echo "<p>" . $row['description'] . "</p>";
        //         echo "<p>Price: $" . $row['price'] . "</p>";
        //         echo "</div>";
        //     }
        // } else {
        //     echo "<p>No products available.</p>";
        // }
        ?>
    </div>

</body>

</html>