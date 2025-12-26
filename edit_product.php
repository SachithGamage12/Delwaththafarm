<?php
include('db_connect.php'); // Include the database connection file

// Fetch product details for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $product = $result->fetch_assoc();
}

// Handle form submission for updating a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    // Handle file upload if a new image is provided
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target_dir = "assets/img/product/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        $image = $product['image']; // Keep the existing image if no new image is uploaded
    }

    $sql = "UPDATE products SET name='$name', category='$category', image='$image', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product updated successfully!');window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2 class="text-center mb-4">Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="mb-3">
            <input type="text" name="category" class="form-control" placeholder="Category" value="<?php echo $product['category']; ?>" required>
        </div>
        <div class="mb-3">
            <input type="file" name="image" class="form-control">
            <small>Current Image: <?php echo $product['image']; ?></small>
        </div>
        <div class="mb-3">
            <select name="status" class="form-control" required>
                <option value="in-stock" <?php echo ($product['status'] == 'in-stock') ? 'selected' : ''; ?>>In Stock</option>
                <option value="out-of-stock" <?php echo ($product['status'] == 'out-of-stock') ? 'selected' : ''; ?>>Out of Stock</option>
            </select>
        </div>
        <button type="submit" name="update_product" class="btn btn-primary w-100">Update Product</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>