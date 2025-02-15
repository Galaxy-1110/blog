<?php
include('./config.php');

$connection = mysqli_init();
if (!$connection->real_connect(host, user, password, database)) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($connection->connect_error) {
    echo ("Connection failed " . $connection->connect_error);
}
?>