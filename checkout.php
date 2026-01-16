<?php
// File: checkout.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_room = $_POST['id_room'];

    // Validasi
    if (empty($id_room)) {
        echo json_encode(array("success" => false, "message" => "ID Room kosong"));
        exit();
    }

    // Ubah status kamar jadi KOSONG (0)
    $query = "UPDATE kamar SET is_occupied = 0 WHERE id_room = '$id_room'";

    if (mysqli_query($con, $query)) {
        echo json_encode(array("success" => true, "message" => "Berhasil Check-Out"));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal: " . mysqli_error($con)));
    }
}
?>