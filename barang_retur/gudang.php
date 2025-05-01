<?php
include_once '../config/db.php';

// Ambil input dari body request
$data = json_decode(file_get_contents("php://input"));

// Validasi input
if (
    empty($data->nama_barang) ||
    empty($data->kode_barang) ||
    empty($data->tanggal_retur) ||
    empty($data->jumlah) ||
    empty($data->supplier) ||
    empty($data->status)
) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Semua field kecuali catatan wajib diisi'
    ]);
    exit;
}

// Sanitasi data
$nama_barang = $conn->real_escape_string($data->nama_barang);
$kode_barang = $conn->real_escape_string($data->kode_barang);
$tanggal_retur = $conn->real_escape_string($data->tanggal_retur);
$jumlah = (int) $data->jumlah;
$supplier = $conn->real_escape_string($data->supplier);
$status = $conn->real_escape_string($data->status);
$catatan = isset($data->catatan) ? $conn->real_escape_string($data->catatan) : null;

// Query insert
$sql = "INSERT INTO barang_retur_gudang (nama_barang, kode_barang, tanggal_retur, jumlah, supplier, status, catatan)
        VALUES ('$nama_barang', '$kode_barang', '$tanggal_retur', $jumlah, '$supplier', '$status', '$catatan')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Data retur berhasil disimpan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $conn->error]);
}

$conn->close();
?>
