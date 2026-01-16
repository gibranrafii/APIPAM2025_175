<?php
include 'koneksi.php';

if (isset($_GET['id_kost'])) {
    $id_kost = $_GET['id_kost'];

    // Query: Ambil Payment -> Join Penghuni -> Join Kamar (Filter by ID Kost)
    $query = "SELECT py.*, p.nama_lengkap 
              FROM payment py
              JOIN penghuni p ON py.id_penghuni = p.id_penghuni
              JOIN kamar k ON p.id_room = k.id_room
              WHERE k.id_kost = '$id_kost'
              ORDER BY py.id_payment DESC";

    $result = mysqli_query($con, $query);

    $payments = array();
    while($row = mysqli_fetch_assoc($result)) {
        $payments[] = $row;
    }

    echo json_encode(array("success" => true, "payments" => $payments));
} else {
    echo json_encode(array("success" => false, "message" => "ID Kost tidak ditemukan"));
}
?>