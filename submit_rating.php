<?php
// Connect to your MySQL database
$connection = mysqli_connect("localhost", "root", "", "lakbaymarista");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get review data from the POST request
$name = $_POST['name'];
$email = $_POST['email'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Insert review into the database
$query = "INSERT INTO reviews (name, email, rating, comment) VALUES ('$name', '$email', '$rating', '$comment')";
$result = mysqli_query($connection, $query);

if ($result) {
    echo "Review submitted successfully!";
} else {
    echo "Error: " . mysqli_error($connection);
}

// Close the connection
mysqli_close($connection);
?>
