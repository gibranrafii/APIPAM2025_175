<?php
include 'koneksi.php';

// Pastikan menggunakan POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_penghuni = $_POST['id_penghuni'];
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];

    // Mulai Query Dasar (Update teks dulu)
    $query_update = "UPDATE penghuni SET nama_lengkap = '$nama', no_hp = '$hp'";

    // CEK: Apakah ada file foto baru yang dikirim?
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        
        $nama_file = basename($_FILES['foto']['name']);
        $target_file = "uploads/" . $nama_file;
        
        // Coba upload file baru
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Jika upload sukses, tambahkan kolom foto ke query update
            $query_update .= ", foto_ktp = '$nama_file'";
        } else {
             echo json_encode(array("success" => false, "message" => "Gagal upload foto baru"));
             exit();
        }
    }

    // Akhiri Query dengan WHERE
    $query_update .= " WHERE id_penghuni = '$id_penghuni'";

    // Eksekusi Query
    if (mysqli_query($con, $query_update)) {
        echo json_encode(array("success" => true, "message" => "Data penghuni berhasil diupdate"));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal update database"));
    }

} else {
    echo json_encode(array("success" => false, "message" => "Metode request salah"));
}
?>