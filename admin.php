<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username']; // Got the logged-in user's username
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Admin Registration</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <form class="registration-form" action="admin_regestration.php" method="POST">
        <h2>Admin Registration for parking Lot Management</h2>
        <div class="form-group">
            <label for="username">Username/Email</label>
            <input type="text" id="username" name="username" placeholder="Enter your username or email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <div class="form-group">
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
