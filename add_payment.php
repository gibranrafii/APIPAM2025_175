<?php
// File: add_payment.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_penghuni = $_POST['id_penghuni'];
    $nominal     = $_POST['nominal'];
    $keterangan  = $_POST['keterangan']; // Contoh: "Bayar Januari 2026"

    if (empty($id_penghuni) || empty($nominal)) {
        echo json_encode(array("success" => false, "message" => "Data tidak lengkap"));
        exit();
    }

    // Insert ke tabel payment
    // Tanggal bayar otomatis terisi CURRENT_TIMESTAMP dari database
    $query = "INSERT INTO payment (id_penghuni, nominal, keterangan) VALUES ('$id_penghuni', '$nominal', '$keterangan')";

    if (mysqli_query($con, $query)) {
        echo json_encode(array("success" => true, "message" => "Pembayaran berhasil dicatat"));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal: " . mysqli_error($con)));
    }
}
?>