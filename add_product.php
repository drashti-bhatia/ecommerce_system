<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h2>Add Product</h2>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Product Description" required></textarea>
            <input type="number" name="price" placeholder="Price" required>
            <input type="file" name="image" required>
            <input type="text" name="category" placeholder="Category" required>
            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>


<?php
require '../includes/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $upload_dir = "../assets/uploads/"; 
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); 
    }

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = $upload_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, $image_path)) {
        
        $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $product_name, $description, $price, $image_name, $category);

        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error adding product.";
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>

?>
