<?php
require '../includes/config.php';

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h2>Products</h2>
        <div class="product-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="../assets/uploads/<?= $row['image']; ?>" alt="<?= $row['product_name']; ?>">
                    <h3><?= $row['product_name']; ?></h3>
                    <p><?= $row['description']; ?></p>
                    <p>Price: $<?= $row['price']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
