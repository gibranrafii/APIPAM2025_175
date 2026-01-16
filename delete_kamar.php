<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_room = $_POST['id_room'];
    
    $query = "DELETE FROM kamar WHERE id_room = '$id_room'";
    
    if (mysqli_query($con, $query)) {
        echo json_encode(array("success" => true, "message" => "Kamar berhasil dihapus"));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal: " . mysqli_error($con)));
    }
}
?>