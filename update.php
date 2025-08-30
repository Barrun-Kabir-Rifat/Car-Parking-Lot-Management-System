<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username']; // Get the logged-in user's username
?>


    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'parking_lot');

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if 'token' is set in the URL
    if (isset($_GET['token'])) {
        $token = $_GET['token']; // Get the token from the URL
        $token = $conn->real_escape_string($token); // Sanitize the token

        // Fetch the current record from the database
        $sql = "SELECT * FROM vehicle_info WHERE Token = '$token'";
        $sql2 = "SELECT * FROM all_vehicle_info WHERE Token = '$token'";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if ($result->num_rows > 0 && $result2->num_rows > 0) {
            // Fetch the record details
            $row = $result->fetch_assoc();
            $row2 = $result2->fetch_assoc();
        } else {
            echo "No record found with that token.";
            exit();
        }
    }

    // Check if form is submitted to update the record
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data
        $ownerName = $_POST['Owner_Name'];
        $vehicleName = $_POST['Vehicle_Name'];
        $vehicleNumber = $_POST['Vehicle_Number'];
        $entryDate = $_POST['Entry_Date'];
        $exitDate = $_POST['Exit_Date'];

        // Sanitize the form data
        $ownerName = $conn->real_escape_string($ownerName);
        $vehicleName = $conn->real_escape_string($vehicleName);
        $vehicleNumber = $conn->real_escape_string($vehicleNumber);
        $entryDate = $conn->real_escape_string($entryDate);
        $exitDate = $conn->real_escape_string($exitDate);

        // SQL query to update the record
        $updateSql = "UPDATE vehicle_info 
                  SET Owner_Name = '$ownerName', Vehicle_Name = '$vehicleName', Vehicle_Number = '$vehicleNumber', Entry_Date = '$entryDate', Exit_Date = '$exitDate'
                  WHERE Token = '$token'";


        $updateSql2 = "UPDATE all_vehicle_info 
                  SET Owner_Name = '$ownerName', Vehicle_Name = '$vehicleName', Vehicle_Number = '$vehicleNumber', Entry_Date = '$entryDate', Exit_Date = '$exitDate'
                  WHERE Token = '$token'";

        // Execute the update query
        if (($conn->query($updateSql) === TRUE) && ($conn->query($updateSql2) === TRUE)) {
            echo "Record updated successfully.";
            echo "<br><a href='update_records.php'>Go back to Vehicle Details Page</a>";
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }

    ?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vehicle Information</title>
    <link rel="stylesheet" href="update_records.css">
</head>

<body>
    <h1>Update Vehicle Information</h1>

    <?php if (isset($row)): ?>
        <!-- Display the form with the current values -->
        <form method="POST" action="">
            <label for="Owner_Name">Owner Name:</label>
            <input type="text" id="Owner_Name" name="Owner_Name" value="<?php echo htmlspecialchars($row['Owner_Name']); ?>" required><br><br>

            <label for="Vehicle_Name">Vehicle Name:</label>
            <input type="text" id="Vehicle_Name" name="Vehicle_Name" value="<?php echo htmlspecialchars($row['Vehicle_Name']); ?>" required><br><br>

            <label for="Vehicle_Number">Vehicle Number:</label>
            <input type="text" id="Vehicle_Number" name="Vehicle_Number" value="<?php echo htmlspecialchars($row['Vehicle_Number']); ?>" required><br><br>

            <label for="Entry_Date">Entry Date:</label>
            <input type="date" id="Entry_Date" name="Entry_Date" value="<?php echo htmlspecialchars($row['Entry_Date']); ?>" required><br><br>

            <label for="Exit_Date">Exit Date:</label>
            <input type="date" id="Exit_Date" name="Exit_Date" value="<?php echo htmlspecialchars($row['Exit_Date']); ?>" required><br><br>

            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p>Record not found.</p>
    <?php endif; ?>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>