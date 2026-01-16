<?php
include 'koneksi.php';

$id_kost = $_POST['id_kost'];
$nama_kost = $_POST['nama_kost'];
$alamat = $_POST['alamat'];

$query = "UPDATE kost SET nama_kost = '$nama_kost', alamat = '$alamat' WHERE id_kost = '$id_kost'";

if (mysqli_query($con, $query)) {
    echo json_encode(array("success" => true, "message" => "Kost berhasil diupdate"));
} else {
    echo json_encode(array("success" => false, "message" => "Gagal update kost"));
}
?>