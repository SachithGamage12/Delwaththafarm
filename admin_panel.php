<?php
include('db_connect.php'); // Include the database connection file

// Handle form submission for adding a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    
    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "assets/img/product/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO products (name, category, image, status) VALUES ('$name', '$category', '$image', '$status')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New product added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }
}

// Handle product deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product deleted successfully!');window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error deleting product: " . $conn->error . "');</script>";
    }
}

// Fetch products from the database
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets\img\logo.jpeg">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .card {
            width: 250px;
            margin: 10px;
        }
        .product-img {
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body class="container py-4">
    <!-- Back to Home Button -->
    <a href="farm.php" class="btn btn-secondary mb-4">Back to Home</a>

    <h2 class="text-center mb-4">Manage Products</h2>
    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="mb-3">
            <input type="text" name="category" class="form-control" placeholder="Category" required>
        </div>
        <div class="mb-3">
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <select name="status" class="form-control" required>
                <option value="in-stock">In Stock</option>
                <option value="out-of-stock">Out of Stock</option>
            </select>
        </div>
        <button type="submit" name="add_product" class="btn btn-primary w-100">Add Product</button>
    </form>
    
    <div class="d-flex flex-wrap">
        <?php while ($row = $products->fetch_assoc()) { ?>
            <div class="card">
                <img src="assets/img/product/<?php echo $row['image']; ?>" class="card-img-top product-img" alt="<?php echo $row['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text">Category: <?php echo $row['category']; ?></p>
                    <p class="card-text">Status: <?php echo $row['status']; ?></p>
                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>