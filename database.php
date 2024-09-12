<?php
// Database connection settings
$host = 'localhost';
$username = 'u161955963_world';
$password = '5&+t@8brI';
$dbname = 'u161955963_world';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " $conn->connect_error);
}

// SQL query to create table
$sql = "CREATE TABLE messages (
  id INT AUTO_INCREMENT,
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)";

// Execute query
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
?>
