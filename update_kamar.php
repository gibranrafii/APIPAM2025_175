<?php
include 'koneksi.php';

$id_room = $_POST['id_room'];
$nomor_kamar = $_POST['nomor_kamar'];
$harga = $_POST['harga'];

$query = "UPDATE kamar SET nomor_kamar = '$nomor_kamar', harga = '$harga' WHERE id_room = '$id_room'";

if (mysqli_query($con, $query)) {
    echo json_encode(array("success" => true, "message" => "Kamar berhasil diupdate"));
} else {
    echo json_encode(array("success" => false, "message" => "Gagal update kamar"));
}
?>