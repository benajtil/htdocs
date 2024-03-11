<?php
// Connect to your MySQL database
$connection = mysqli_connect("localhost", "root", "", "lakbaymarista");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Fetch reviews from the database
$query = "SELECT * FROM reviews";
$result = mysqli_query($connection, $query);

// Convert the result into an associative array
$reviews = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = $row;
}

// Send reviews as JSON response
header('Content-Type: application/json');
echo json_encode($reviews);

// Close the connection
mysqli_close($connection);
?>
