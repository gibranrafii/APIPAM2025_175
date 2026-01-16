<?php
// File: koneksi.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "juragankost"; // Update nama DB di sini

$con = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    echo json_encode(array(
        "success" => false,
        "message" => "Gagal connect: " . mysqli_connect_error()
    ));
    exit();
}
?>
