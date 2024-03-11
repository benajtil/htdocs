<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "Til091002";
$dbname = "lakbaymarista";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];


$email = mysqli_real_escape_string($conn, $email);


$sql = "SELECT id, hashed_password, original_password FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['hashed_password'];
    $original_password = $row['original_password'];
    $user_id = $row['id'];


    if (password_verify($password, $hashed_password) || $password === $original_password) {
        // Password is correct, set session and redirect to index.html
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user_id;
        header('Location: index.html');
    } else {
        // Password is incorrect
        echo "Invalid email or password. <a href='javascript:history.back()'>Go back</a> and try again.";
    }
} else {
    // User doesn't exist
    echo "Invalid email or password. <a href='javascript:history.back()'>Go back</a> and try again.";
}

$conn->close();
?>
