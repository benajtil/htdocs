<?php
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
    $username = $_POST["username"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        echo "Username already exists";
    } else {
        echo "";
    }
}
?>
