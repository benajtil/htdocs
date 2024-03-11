<?php
$servername = "localhost"; // Change this to your database server name if different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password if set
$dbname = "lakbaymarista"; // Change this to your database name


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$name = $_POST['name'];
$age = $_POST['age'];
$location = $_POST['location'];
$occupation = $_POST['occupation'];

// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO user (username, name, age, location, occupation) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $username, $name, $age, $location, $occupation);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
