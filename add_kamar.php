<?php
// File: add_kamar.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_kost     = $_POST['id_kost'];
    $nomor_kamar = $_POST['nomor_kamar'];
    $harga       = $_POST['harga'];

    // Validasi input
    if (empty($id_kost) || empty($nomor_kamar) || empty($harga)) {
        echo json_encode(array("success" => false, "message" => "Data tidak lengkap"));
        exit();
    }

    // Cek Duplikasi: Apakah nomor kamar ini SUDAH ADA di kost ini?
    $cek = "SELECT * FROM kamar WHERE nomor_kamar = '$nomor_kamar' AND id_kost = '$id_kost'";
    $result_cek = mysqli_query($con, $cek);

    if (mysqli_num_rows($result_cek) > 0) {
        echo json_encode(array("success" => false, "message" => "Nomor kamar sudah ada"));
    } else {
        // Simpan Kamar Baru (Default is_occupied = 0)
        $query = "INSERT INTO kamar (id_kost, nomor_kamar, harga, is_occupied) VALUES ('$id_kost', '$nomor_kamar', '$harga', 0)";
        
        if (mysqli_query($con, $query)) {
            echo json_encode(array("success" => true, "message" => "Kamar berhasil ditambahkan"));
        } else {
            echo json_encode(array("success" => false, "message" => "Gagal: " . mysqli_error($con)));
        }
    }
}
?>