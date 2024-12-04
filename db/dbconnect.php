<?php

$conn = mysqli_connect("localhost", "root", "", "saep");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
