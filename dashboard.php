<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .additional {
            display: grid;
            justify-items: center;
            grid-auto-flow: column;
            width: 217px;
            margin: 12px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="../home.php">Home</a>
        <a href="manage_product.php">Manage Products</a>
        <a href="../auth/logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="additional">
            <a href="add_product.php"><button class="additional">Add New Product</button></a>
            <a href="../client/display_product.php"><button class="additional">View Products</button></a>
        </div>
    </div>
</body>

</html>