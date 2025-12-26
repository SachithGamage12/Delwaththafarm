<?php
session_start();
include 'db_connect.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before saving it to the database
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if username already exists
    $sql_check = "SELECT * FROM admin_users WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $error = "Username already exists!";
    } else {
        // Insert the new user into the database
        $sql_insert = "INSERT INTO admin_users (username, password) VALUES ('$username', '$hashed_password')";
        if ($conn->query($sql_insert) === TRUE) {
            $_SESSION['success'] = "Registration successful! You can now log in.";
            header("Location: login.php");  // Redirect to login page
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; }
        .register-container { max-width: 400px; margin: 50px auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #5cb85c; }
        .form-control:focus { border-color: #5cb85c; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="text-center">Admin Registration</h2>
        <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
        <?php if (isset($_SESSION['success'])) { echo "<p class='text-success'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); } ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
</body>
</html>
