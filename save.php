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

    // Retrieve form data
    $owner_name = $_POST['owner_name'];
    $vehicle_name = $_POST['vehicle_name'];
    $vehicle_number = $_POST['vehicle_number'];
    $entry_date = $_POST['entry_date'];
    $exit_date = $_POST['exit_date'];
    $token=$_POST['token'];
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'parking_lot');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the SQL query
    //for update database(vehicle_info)
    $sql = "INSERT INTO vehicle_info (Token,Owner_Name, Vehicle_Name, Vehicle_Number, Entry_Date, Exit_Date) 
        VALUES ('$token','$owner_name', '$vehicle_name', '$vehicle_number', '$entry_date', '$exit_date')";

        //for parmanent database(all_vehicle_info)
    $sql2="INSERT INTO all_vehicle_info (Token,Owner_Name, Vehicle_Name, Vehicle_Number, Entry_Date, Exit_Date) 
        VALUES ('$token','$owner_name', '$vehicle_name', '$vehicle_number', '$entry_date', '$exit_date')";


    if (mysqli_query($conn, $sql)&&mysqli_query($conn, $sql2)) {
        echo "Record inserted successfully.";
    } else {
        die("Query failed: " . mysqli_error($conn));
    }

    // Close the connection
    mysqli_close($conn);
    ?>
    <p style="color: blue;">To go back to the home page:</p>
    <form action="index.php">
        <button type="submit" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Click here
        </button>
    </form>
</body>

</html>