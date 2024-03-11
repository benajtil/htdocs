<?php
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        echo "Email already exists";
    } else {
        echo "";
    }
}
?>
