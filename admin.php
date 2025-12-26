<?php
session_start();
include 'db_connect.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch current username
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM admin_users WHERE id = '$admin_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Update username and password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $update_sql = "UPDATE admin_users SET username = '$new_username', password = '$hashed_password' WHERE id = '$admin_id'";

    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['success'] = "Credentials updated successfully!";
        header("Location: admin.php");
    } else {
        $_SESSION['error'] = "Error updating credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .panel-container {
            margin-left: 270px;
            max-width: 600px;
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .panel-container h2 {
            margin-bottom: 30px;
            font-size: 28px;
        }

        .btn-primary {
            background-color: #5cb85c;
        }

        .form-control:focus {
            border-color: #5cb85c;
        }

        .widget-card {
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .widget-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3 class="text-center text-white">Admin Panel</h3>
        <a href="admin.php">Dashboard</a>
        <a href="admin_panel.php">Manage Products</a>
        
    </div>

    <div class="panel-container">
        <h2>Welcome, Admin</h2>
        <?php if (isset($_SESSION['success'])) {
            echo "<p class='text-success'>{$_SESSION['success']}</p>";
            unset($_SESSION['success']);
        } ?>
        <?php if (isset($_SESSION['error'])) {
            echo "<p class='text-danger'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
        } ?>

        <!-- Change Username & Password Widget -->
        <div class="widget-card">
            <div class="widget-title">Change Username & Password</div>
            <form method="POST">
                <div class="form-group">
                    <label for="new_username">New Username</label>
                    <input type="text" name="new_username" id="new_username" class="form-control" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary btn-block">Update Credentials</button>
            </form>
        </div>
    </div>
</body>

</html>
