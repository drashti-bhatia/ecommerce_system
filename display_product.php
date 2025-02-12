<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container">
        <h2>Products</h2>
        <div id="product-list"></div>
    </div>

    <script>
        fetch('client/fetch_products.php')
            .then(response => response.json())
            .then(data => {
                let output = "";
                data.forEach(product => {
                    output += `<div>
                                <img src="uploads/${product.image}" width="100">
                                <h3>${product.product_name}</h3>
                                <p>${product.description}</p>
                                <p>Price: $${product.price}</p>
                            </div>`;
                });
                document.getElementById("product-list").innerHTML = output;
            });
    </script>

    <?php
        require '../includes/config.php';

        $result = $conn->query("SELECT * FROM products");
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        echo json_encode($products);
        $conn->close();
    ?>

</body>
</html>
