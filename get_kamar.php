<?php
include 'koneksi.php';

if (isset($_GET['id_kost'])) {
    $id_kost = $_GET['id_kost'];

    // PERBAIKAN: Tambahkan GROUP BY k.id_room agar tidak double
    $query = "SELECT k.*, p.id_penghuni, p.nama_lengkap 
              FROM kamar k 
              LEFT JOIN penghuni p ON k.id_room = p.id_room 
              WHERE k.id_kost = '$id_kost' 
              GROUP BY k.id_room 
              ORDER BY k.nomor_kamar ASC";

    $result = mysqli_query($con, $query);

    $kamars = array();
    while($row = mysqli_fetch_assoc($result)) {
        $kamars[] = $row;
    }

    echo json_encode(array("success" => true, "kamars" => $kamars));
} else {
    echo json_encode(array("success" => false, "message" => "ID Kost tidak ditemukan"));
}
?>