<?php
// File: register.php
include 'koneksi.php';

// Menerima input JSON dari Android
// (Karena nanti kita pakai Retrofit/Volley di Android)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data yang dikirimkan
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username sudah ada?
    $cek = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_fetch_array(mysqli_query($con, $cek));

    if (isset($result)) {
        // Gagal: Username sudah terpakai
        $response['success'] = false;
        $response['message'] = "Username sudah digunakan";
    } else {
        // Sukses: Insert ke tabel user
        // Kita encrypt password pakai MD5 atau Password Hash biar aman
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $insert = "INSERT INTO user (username, password) VALUES ('$username', '$password_hash')";
        
        if (mysqli_query($con, $insert)) {
            $response['success'] = true;
            $response['message'] = "Berhasil mendaftar";
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal menyimpan";
        }
    }
    
    // Kirim balasan JSON ke Android
    echo json_encode($response);
}
?>