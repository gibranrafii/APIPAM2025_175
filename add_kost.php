<?php
// File: add_kost.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data
    $id_user   = $_POST['id_user'];   // PENTING: Siapa pemiliknya?
    $nama_kost = $_POST['nama_kost'];
    $alamat    = $_POST['alamat'];

    // Validasi sederhana
    if (empty($nama_kost) || empty($alamat)) {
        echo json_encode(array("success" => false, "message" => "Data tidak boleh kosong"));
        exit();
    }

    $query = "INSERT INTO kost (id_user, nama_kost, alamat) VALUES ('$id_user', '$nama_kost', '$alamat')";

    if (mysqli_query($con, $query)) {
        echo json_encode(array("success" => true, "message" => "Kost berhasil ditambahkan"));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal: " . mysqli_error($con)));
    }
}
?>