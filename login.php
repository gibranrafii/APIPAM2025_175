<?php
// File: login.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil input dari Android/Postman
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada di database?
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Username ditemukan, sekarang cek Password (Hash Verification)
        if (password_verify($password, $row['password'])) {
            
            // Password Cocok! Login Sukses
            $response['success'] = true;
            $response['message'] = "Selamat datang, " . $row['username'];
            
            // Kirim data user kembali ke Android (PENTING untuk session nanti)
            $response['user'] = array(
                "id_user" => $row['id_user'],
                "username" => $row['username']
            );

        } else {
            // Password Salah
            $response['success'] = false;
            $response['message'] = "Password salah";
        }
    } else {
        // Username tidak ditemukan
        $response['success'] = false;
        $response['message'] = "Username tidak terdaftar";
    }

    // Output JSON
    echo json_encode($response);
}
?>