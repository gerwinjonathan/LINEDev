<?php

$server = "localhost";
$username = "id7456029_ramadhan";
$password = "ramadhan";
$database = "id7456029_ramadhan";

$conn = mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>