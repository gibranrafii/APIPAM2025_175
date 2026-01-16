<?php
// File: checkin.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Ambil Data Teks
    $id_room = $_POST['id_room'];
    $nama    = $_POST['nama_lengkap'];
    $hp      = $_POST['no_hp'];

    // 2. Proses Upload Foto
    // Nama folder target
    $target_dir = "images/";
    
    // Kita generate nama file unik pakai timestamp biar gak kembar
    // Hasilnya misal: ktp_17099992.jpg
    $nama_file_baru = "ktp_" . time() . ".jpg";
    $target_file = $target_dir . $nama_file_baru;

    // Cek apakah ada file yang dikirim?
    if (isset($_FILES['foto_ktp'])) {
        
        // Coba pindahkan file dari folder sementara (tmp) ke folder images
        if (move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $target_file)) {
            
            // 3. Jika Upload Berhasil, Simpan ke Database
            // Ambil tanggal hari ini (Format: Tahun-Bulan-Tanggal)
            $tanggal_masuk = date("Y-m-d"); 
            // ---------------------

            // Update Query Insert: Tambahkan kolom tanggal_masuk
            $query_insert = "INSERT INTO penghuni (id_room, nama_lengkap, no_hp, foto_ktp_path, tanggal_masuk) 
                VALUES ('$id_room', '$nama', '$hp', '$nama_file_baru', '$tanggal_masuk')";
            
            if (mysqli_query($con, $query_insert)) {
                
                // Query 2: UPDATE status kamar jadi TERISI (1)
                $query_update = "UPDATE kamar SET is_occupied = 1 WHERE id_room = '$id_room'";
                mysqli_query($con, $query_update);

                echo json_encode(array("success" => true, "message" => "Check-in berhasil"));
            
            } else {
                echo json_encode(array("success" => false, "message" => "Gagal simpan DB: " . mysqli_error($con)));
            }

        } else {
            echo json_encode(array("success" => false, "message" => "Gagal upload gambar ke server"));
        }

    } else {
        echo json_encode(array("success" => false, "message" => "Foto KTP tidak ditemukan"));
    }
}
?>