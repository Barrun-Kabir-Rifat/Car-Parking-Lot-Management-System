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
    <title>Car Parking Lot Management System</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="page-body" >
    
    <div>
        <h1 class="title">Parking Lot Management System</h1>
        <div class="navigation">
            <a href="index.php">Home</a> |
            <a href="update_records.php">Ongoing Records Of Vehicle</a> |
            <a href="all_records.php">Parmanent Records of Vehicle</a> |
            <a href="admin.php">Make Admin</a> |
            <a href="logout.php">Logout <?php echo  $_SESSION['username'] = $username;?></a>
        </div>
    </div>
          <br><br>
    <div>
        <div class="registration-form-container">
            <h3>Vehicle Registration Form</h3>
            <form action="save.php" method="POST">
                <label for="owner-name">Vehicle Owner Name:</label><br>
                <input type="text" id="owner-name" name="owner_name" required><br><br>

                <label for="vehicle-name">Vehicle Name:</label><br>
                <input type="text" id="vehicle-name" name="vehicle_name" required><br><br>

                <label for="vehicle-number">Vehicle Number:</label><br>
                <input type="text" id="vehicle-number" name="vehicle_number" required><br><br>

                <label for="token-number">Token Number:</label><br>
                <input type="text" id="token-number" name="token"><br><br>

                <label for="entry-date">Entry Date:</label><br>
                <input type="date" id="entry-date" name="entry_date" required><br><br>

                <label for="exit-date">Exit Date:</label><br>
                <input type="date" id="exit-date" name="exit_date"><br><br>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
