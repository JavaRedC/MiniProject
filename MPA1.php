<?php
// Database connection details
$host = 'localhost'; // Usually 'localhost'
$dbname = 'pdb'; // Your actual database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$id = intval($_GET['id']); // Sanitize input for security
$region = $_GET['region']; // No need to escape yet, since we will use prepared statements

echo $id;
echo $region;

// Prepare an SQL statement for safe insertion
$stmt = $conn->prepare("INSERT INTO users (id_number, Region) VALUES (?, ?)");
$stmt->bind_param("is", $id, $region); // "is" stands for integer (i) and string (s)

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
