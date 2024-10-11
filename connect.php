<?php
// Include the file that handles the database connection
include 'MPA1.php'; // Make sure this file defines the $conn variable

echo "Connected Successfully<br>";

// Retrieve form data from the GET request
$id = intval($_GET['id']); // Sanitize input for security, converting it to an integer
$region = $_GET['region']; // The region string, which will be handled securely by prepared statements

// Prepare an SQL statement for safe insertion into the users table
$stmt = $conn->prepare("INSERT INTO users (id_number, Region) VALUES (?, ?)");

// Check if the prepare() was successful
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind the parameters: "i" for integer (id) and "s" for string (region)
$stmt->bind_param("is", $id, $region);

// Execute the prepared statement
if ($stmt->execute()) {
    header("Location: result.html?id=" . urlencode($id) . "&region=" . urlencode($region));
    exit();
} else {
    // If an error occurs, display the error message
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
