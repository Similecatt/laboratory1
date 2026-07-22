<?php
include "db_connect.php";
 
$id = $_GET['id'] ?? null;
if (!$id) { die("No student ID provided."); }
 
// If the form was submitted, update the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $category  = $_POST['category'];
    $price      = $_POST['price'];
    $quantity     = $_POST['quantity'];
    $supplier      = $_POST['supplier'];
 
    $stmt = $conn->prepare("UPDATE products SET product_name=?, category=?, price=?, quantity=?,supplier=? WHERE id=?");
    $stmt->bind_param("ssssi", $product_name, $category, $price, $quantity, $supplier, $id);
    $stmt->execute();
    $stmt->close();
 
    header("Location: index.php");
    exit();
}
 
// Otherwise, fetch the existing record to pre-fill the form
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_assoc();
 
if (!$products) { die("products not found."); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        input { width: 100%; padding: 8px; margin: 6px 0 14px; box-sizing: border-box; }
        button { padding: 10px 16px; background: #f39c12; color: white; border: none; border-radius: 4px; cursor: pointer; }
        a { display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <label>Product Name</label>
        <input type="text" name="Product_name" value="<?= htmlspecialchars($products['product_name']) ?>" required>
 
        <label>Category</label>
        <input type="text" name="category" value="<?= htmlspecialchars($products['category']) ?>" required>
 
        <label>Price</label>
        <input type="text" name="price" value="<?= htmlspecialchars($products['price']) ?>" required>
 
        <label>Quantity</label>
        <input type="text" name="quantity" value="<?= htmlspecialchars($products['quantity']) ?>" required>

        <label>Supplier</label>
        <input type="text" name="supplier" value="<?= htmlspecialchars($products['supplier']) ?>" required>
 
        <button type="submit">Update Product</button>
    </form>
    <a href="index.php">← Back to list</a>
</body>
</html>