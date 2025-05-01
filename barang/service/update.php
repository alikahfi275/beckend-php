<?php
include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true); // Mendapatkan data JSON yang dikirimkan

$kode_barang = $data['kode_barang'];
$nama_barang = $data['nama_barang'];
$stok = $data['stok'];
$merek = $data['merek'];
$satuan = $data['satuan'];
$gambar = $data['gambar'];

$sql = "UPDATE barang_service SET 
        nama_barang = '$nama_barang',
        stok = '$stok',
        merek = '$merek',
        satuan = '$satuan',
        gambar = '$gambar'
        WHERE kode_barang = '$kode_barang'";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => "success",
        "message" => "Barang service berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Error: " . $conn->error
    ]);
}

$conn->close();
?>
