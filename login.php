<?php
session_start();
include 'db_connect.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password match
    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Use password_verify to compare hashed passwords
            $_SESSION['admin_id'] = $row['id'];
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid credentials";
        }
    } else {
        $error = "Username not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; }
        .login-container { max-width: 400px; margin: 50px auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #5cb85c; }
        .form-control:focus { border-color: #5cb85c; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Admin Login</h2>
        <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</body>
</html>
