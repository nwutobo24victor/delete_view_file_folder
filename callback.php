<?php
// Database credentials
$host = 'localhost';
$user = 'napelqze_root';
$pass = 'napec_pass';
$dbToDelete = 'napelqze_napec_db';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to delete the database
$sql = "DROP DATABASE $dbToDelete";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbToDelete' deleted successfully.";
} else {
    echo "Error deleting database: " . $conn->error;
}

// Close connection
$conn->close();
?>
