<?php
// File: get_payment.php
include 'koneksi.php';

if (isset($_GET['id_penghuni'])) {
    
    $id_penghuni = $_GET['id_penghuni'];
    
    // Ambil history bayar, urutkan dari yang terbaru (DESC)
    $query = "SELECT * FROM payment WHERE id_penghuni = '$id_penghuni' ORDER BY tanggal_bayar DESC";
    $result = mysqli_query($con, $query);

    $history = array();
    while($row = mysqli_fetch_assoc($result)) {
        $history[] = $row;
    }

    echo json_encode(array(
        "success" => true,
        "payments" => $history
    ));

} else {
    echo json_encode(array("success" => false, "message" => "ID Penghuni tidak ditemukan"));
}
?>