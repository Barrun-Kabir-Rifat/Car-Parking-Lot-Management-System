
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
    <title>Vehicle Information</title>
    <link rel="stylesheet" href="update_records.css"> 
</head>
<body>
    <h1>Ongoing Vehicle Records</h1>
    <br>


    <!-- Search Form -->


    <form method="POST" action="">
        <label for="search" style="font-weight: bold;">Search by Owner Name:</label>
        <input type="text" id="search" name="search" placeholder="Enter Owner Name" style="padding: 5px;" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
        <button type="submit" style="padding: 5px 10px; background-color: blue; color: white; border: none; cursor: pointer;">Search</button>
    </form>
    <br><br>




    
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'parking_lot');

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if search query exists
    $searchQuery = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

    // Query to fetch data
    $sql = "SELECT * FROM vehicle_info";
    if ($searchQuery) {
        $sql .= " WHERE Owner_Name LIKE '%$searchQuery%'";
    }

    $result = $conn->query($sql);

    // Check if records exist
    if ($result->num_rows > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr>
                <th>Token No</th>
                <th>Owner Name</th>
                <th>Vehicle Name</th>
                <th>Vehicle Number</th>
                <th>Entry Date</th>
                <th>Exit Date</th>
                <th>Actions</th>
              </tr>";

        // Loop through rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['Token'] . "</td>
                    <td>" . $row['Owner_Name'] . "</td>
                    <td>" . $row['Vehicle_Name'] . "</td>
                    <td>" . $row['Vehicle_Number'] . "</td>
                    <td>" . $row['Entry_Date'] . "</td>
                    <td>" . $row['Exit_Date'] . "</td>
                    <td>
                        <a href='update.php?token=" . $row['Token'] . "' class='action-btn update'>Update</a>
                        <a href='delete.php?token=" . $row['Token'] . "' class='action-btn delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }

    // Close the connection
    $conn->close();
    ?>

    <p style="color: blue;">Want To Go Back To Home Page: </p>
    <form action="index.php">
        <button type="submit" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Click here
        </button>
    </form>
</body>
</html>
