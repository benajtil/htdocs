<?php

$servername = "localhost"; 
$username = "root";
$password = "Til091002"; 
$database = "lakbaymarista";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
