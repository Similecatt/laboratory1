<?php
include "db_connect.php";
 
$message = "";
 
// This runs only when the form is submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the form
    $product_name = $_POST['product_name'];
    $category  = $_POST['category'];
    $price      = $_POST['price'];
    $quantity     = $_POST['quantity'];
    $supplier     = $_POST['supplier'];
 
    // Use a prepared statement to safely insert data (prevents SQL injection)
    $stmt = $conn->prepare("INSERT INTO products (product_name, category, price, quantity, supplier) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $product_name, $category, $price, $quantity $supplier);
 
    if ($stmt->execute()) {
        header("Location: index.php"); // go back to the list after saving
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        input, select { width: 100%; padding: 8px; margin: 6px 0 14px; box-sizing: border-box; }
        button { padding: 10px 16px; background: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; }
        a { display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Add New Product</h1>
    <?php if ($message): ?><p style="color:red;"><?= $message ?></p><?php endif; ?>
 
    <form method="POST">
        <label>Product Name</label>
        <input type="text" name="Product_name" required>
 
        <label>Category</label>
        <input type="text" name="category" required>
 
        <label>Price</label>
        <input type="text" name="price" required>
 
        <label>Quantity</label>
        <input type="text" name="quantity" required>

        <label>Supplier</label>
        <input type="text" name="supplier" required>
 
 
        <button type="submit">Save Product</button>
    </form>
    <a href="index.php">← Back to list</a>
</body>
</html>