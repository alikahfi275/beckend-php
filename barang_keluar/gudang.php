<?php
include_once('../config/db.php');

$input = json_decode(file_get_contents("php://input"));

if (!isset($input->kode_barang) || !isset($input->jumlah)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Input tidak lengkap'
    ]);
    exit;
}

$kode_barang = $input->kode_barang;
$jumlah = (int)$input->jumlah;

// Kurangi stok
$query = "UPDATE barang_gudang SET stok =  $jumlah WHERE kode_barang = '$kode_barang'";
$result = $conn->query($query);

if ($result) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Stok berhasil dikurangi'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal update stok'
    ]);
}
?>
