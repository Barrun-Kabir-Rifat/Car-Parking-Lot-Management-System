<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username']; // Get the logged-in user's username
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'parking_lot');

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the 'token' parameter exists in the URL
    if (isset($_GET['token'])) {
        $token = $_GET['token']; // Got the token from the URL

        // Sanitize the input to prevent SQL injection
        $token = $conn->real_escape_string($token);

        // SQL query to delete the record with the specified token
        $sql = "DELETE FROM vehicle_info WHERE Token = '$token'";

        // Execute the query and check if it was successful
        if ($conn->query($sql) === TRUE) {
            // Redirect to the index page or display a success message
            echo "<p>Record deleted successfully.</p>";
           
        } else {
            // If there is an error, display it
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "No token specified.";
    }

    // Close the database connection
    $conn->close();
    ?>

<p style="color: blue;">Want To Go Vehicle Update Page?:</p>
    <form action="update_records.php">
        <button type="submit" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Click here
        </button>
    </form>
</body>

</html>