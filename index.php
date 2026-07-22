<?php
include "db_connect.php";

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Product Inventory </title>
</head>
<body>
    <h1> Product Inventory </h1>
    <a class="button add" href="add_product.php"> + Add New Product</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Supplier</th>
            <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result-> fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <td><?= htmlspecialchars($row['supplier']) ?></td>
                    <td>
                        <a class="button edit" href="edit_product.php?id=<?= $row['id'] ?>">Edit</a>
                        <a class="button delete" href="delete_product.php?id=<?= $row['id'] ?>"
                           onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                 </tr> 
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No products found.</td></tr>
        <?php endif; ?>  
    </table>
</body>
</html>
<?php $conn->close(); ?>
