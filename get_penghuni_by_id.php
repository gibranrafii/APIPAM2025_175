<?php
include 'koneksi.php';

if (isset($_GET['id_penghuni'])) {
    $id = $_GET['id_penghuni'];

    $query = "SELECT * FROM penghuni WHERE id_penghuni = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        echo json_encode(array("success" => true, "data" => $row));
    } else {
        echo json_encode(array("success" => false, "message" => "Data tidak ditemukan"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID tidak ditemukan"));
}
?>