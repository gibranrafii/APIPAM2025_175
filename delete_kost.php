<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kost = $_POST['id_kost'];
    
    // Hapus kost (dan idealnya kamar/penghuni di dalamnya, tapi untuk simpel kita hapus kostnya saja)
    $query = "DELETE FROM kost WHERE id_kost = '$id_kost'";
    
    if (mysqli_query($con, $query)) {
        echo json_encode(array("success" => true, "message" => "Kost berhasil dihapus"));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal: " . mysqli_error($con)));
    }
}
?>
