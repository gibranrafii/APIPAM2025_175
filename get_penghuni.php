<?php
// File: get_penghuni.php
include 'koneksi.php';

if (isset($_GET['id_room'])) {
    
    $id_room = $_GET['id_room'];
    
    // Ambil data penghuni yang paling baru masuk (ORDER BY id DESC)
    // di kamar tersebut.
    $query = "SELECT * FROM penghuni WHERE id_room = '$id_room' ORDER BY id_penghuni DESC LIMIT 1";
    $result = mysqli_query($con, $query);
    
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        echo json_encode(array("success" => true, "data" => $data));
    } else {
        echo json_encode(array("success" => false, "message" => "Tidak ada penghuni aktif"));
    }

} else {
    echo json_encode(array("success" => false, "message" => "ID Room tidak ditemukan"));
}
?>