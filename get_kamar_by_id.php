<?php
include 'koneksi.php';

if (isset($_GET['id_room'])) {
    $id = $_GET['id_room'];
    $query = "SELECT * FROM kamar WHERE id_room = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        echo json_encode(array("success" => true, "data" => $row));
    } else {
        echo json_encode(array("success" => false, "message" => "Kamar tidak ditemukan"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Room tidak ditemukan"));
}
?>