<?php

    $server = "localhost";
    $user = "root";
    $password = "root";
    $dbname = "saep_db";

    $conn = new mysqli($server, $user, $password, $dbname);

    if($conn->connect_error) {
        die("Error connection!" . $conn->connect_error);
    }

?>