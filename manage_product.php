<?php
require '../includes/config.php';
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../auth/login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['product_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    

    $image = $_FILES['image']['name'];
    $target = "../assets/uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);


    $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $desc, $price, $image, $category);
    
    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product.";
    }
}


$result = $conn->query("SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h2>Manage Products</h2>
        <form action="manage_product.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" name="price" placeholder="Price" required>
            <input type="file" name="image" required>
            <input type="text" name="category" placeholder="Category" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <h3>Product List</h3>
        <table border="1">
            <tr><th>ID</th><th>Name</th><th>Price</th><th>Action</th></tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['product_name']; ?></td>
                    <td>$<?= $row['price']; ?></td>
                    <td>
                        <a href="delete_product.php?id=<?= $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
