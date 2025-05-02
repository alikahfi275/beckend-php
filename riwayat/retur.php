<?php
include_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$kode_barang = $conn->real_escape_string($data->kode_barang);
$jumlah = (int) $data->jumlah;
$tanggal = $conn->real_escape_string($data->tanggal);
$tipe = $conn->real_escape_string($data->tipe);
$status = $conn->real_escape_string($data->status);
$nama_barang = $conn->real_escape_string($data->nama_barang);
$catatan = isset($data->catatan) ? $conn->real_escape_string($data->catatan) : null;

// Query insert
$sql = "INSERT INTO riwayat_return (kode_barang, jumlah, tanggal, tipe, status, nama_barang, catatan)
        VALUES ('$kode_barang', $jumlah, '$tanggal', '$tipe', '$status', '$nama_barang', '$catatan')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Riwayat retur berhasil disimpan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $conn->error]);
}

$conn->close();
?>
