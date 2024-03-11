<?php
include 'config.php';

// Retrieve reviews from database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p>Name: " . $row["name"]. "</p><p>Email: " . $row["email"]. "</p><p>Rating: " . $row["rating"]. "</p><p>Comment: " . $row["comment"]. "</p>";
    }
} else {
    echo "No reviews yet.";
}
$conn->close();
?>
