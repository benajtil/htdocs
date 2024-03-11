<?php
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $middlename = isset($_POST["middlename"]) ? $_POST["middlename"] : "";
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $birthdate = $_POST["birthdate"];

    // Check if any field is blank
    if (empty($username) || empty($password) || empty($firstname) || empty($lastname) || empty($email) || empty($phone_number) || empty($birthdate)) {
        echo "Please fill in all fields";
        exit; // Stop further execution
    }


    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($connection, $check_username_query);
    if (mysqli_num_rows($check_username_result) > 0) {
        echo "Username already used";
        exit; 
    }


    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($connection, $check_email_query);
    if (mysqli_num_rows($check_email_result) > 0) {
        echo "Email already used";
        exit; 
    }


    $hash = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (username, password, password_hash, firstname, middlename, lastname, email, phone_number, birthdate)
            VALUES ('$username', '$password', '$hash', '$firstname', '$middlename', '$lastname', '$email', '$phone_number', '$birthdate')";

    if (mysqli_query($connection, $sql)) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

?>
