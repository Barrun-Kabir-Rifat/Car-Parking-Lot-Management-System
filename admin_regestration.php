<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<?php
// Database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking_lot";

// Created connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checked connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checked if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $user_name = $_POST['username'];
    $pass_word = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords checked
    if ($pass_word !== $confirm_password) {
        echo "<br><br><p style='color: red;font-size: xx-large;'>Passwords do not match!:";
        echo "<a style='color:dark-red;font-size: x-large;' href='admin.php'>Click_here_To_try_Again</a></p>";
        echo "<br><p style='color:dark-red;font-size: xx-large;'>Want to go back to home page?</a>";
        echo "<a style='color:dark-red;font-size:x-large;' href='index.php'>Click Here</a>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO admin(User_Name, Pass_Word) VALUES ('$user_name', '$pass_word')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<center><br><br><br><p style='color: green;font-size: xx-large;'>Registration successful!</p></center>";
            echo "<center><br><p style='color:dark-red;font-size: xx-large;'>Want to go back to home page?</p></center>";
            echo "<center><br><a style='color:dark-red;font-size: xx-large;' href='index.php'>Click Here</a></center>";
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
    }
}

// Close the connection
$conn->close();
?>
