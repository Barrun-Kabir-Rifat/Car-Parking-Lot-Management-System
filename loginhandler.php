<?php
// Start a session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'parking_lot');

// Checked connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checked if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Checked credentials
    $query = "SELECT * FROM admin WHERE User_Name='$username' AND Pass_Word='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $_SESSION["username"] = $username; // Stored session data
        header("Location: index.php");     // Redirect to index.php
       
    } else {
       
        echo "Invalid Information";
        header("Location:login.php");
        exit();
    }
}

$conn->close();
?>
