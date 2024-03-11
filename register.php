<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Til091002";
$dbname = "lakbaymarista";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if passwords match
if ($password !== $confirm_password) {
    echo "Passwords do not match. <a href='javascript:history.back()'>Go back</a> and try again.";
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL injection prevention
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$hashed_password = mysqli_real_escape_string($conn, $hashed_password);
$password = mysqli_real_escape_string($conn, $password); // Store original password for future reference

// Insert user data into database
$sql = "INSERT INTO users (name, email, hashed_password, original_password) VALUES ('$name', '$email', '$hashed_password', '$password')";

if ($conn->query($sql) === TRUE) {
    // Redirect to profile page upon successful registration
    header("Location: profile.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
