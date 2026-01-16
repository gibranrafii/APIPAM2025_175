<?php
include 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // PERBAIKAN: Gunakan Subquery untuk menghitung penghuni aktif
    $query = "SELECT k.*, 
              (SELECT COUNT(*) FROM kamar WHERE id_kost = k.id_kost AND is_occupied = '1') as jumlah_penghuni,
              (SELECT COUNT(*) FROM kamar WHERE id_kost = k.id_kost) as total_kamar
              FROM kost k 
              WHERE k.id_user = '$id_user'";

    $result = mysqli_query($con, $query);

    $kosts = array();
    while($row = mysqli_fetch_assoc($result)) {
        $kosts[] = $row;
    }

    echo json_encode(array("success" => true, "kosts" => $kosts));
} else {
    echo json_encode(array("success" => false, "message" => "ID User tidak ditemukan"));
}
?>