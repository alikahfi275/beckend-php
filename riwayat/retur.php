<?php
include_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$kode_barang = $conn->real_escape_string($data->kode_barang);
$jumlah = (int) $data->jumlah;
$tanggal = $conn->real_escape_string($data->tanggal);
$tipe = $conn->real_escape_string($data->tipe);
$status = $conn->real_escape_string($data->status);
$nama_barang = $conn->real_escape_string($data->nama_barang);
$supplier = $conn->real_escape_string($data->supplier);
$catatan = isset($data->catatan) ? "'" . $conn->real_escape_string($data->catatan) . "'" : "NULL";

if (isset($data->nama_pelanggan) && trim($data->nama_pelanggan) !== '') {
    $nama_pelanggan = "'" . $conn->real_escape_string($data->nama_pelanggan) . "'";
} else {
    $nama_pelanggan = "NULL";
}

if (isset($data->tanggal_dianter) && 
    !empty($data->tanggal_dianter) && 
    $data->tanggal_dianter !== '00-00-00 00:00:00') {
    $tanggal_dianter = "'" . $conn->real_escape_string($data->tanggal_dianter) . "'";
} else {
    $tanggal_dianter = "NULL";
}

$sql = "INSERT INTO riwayat_return (
            kode_barang, jumlah, tanggal, tipe, status,
            nama_barang, supplier, nama_pelanggan, tanggal_dianter, catatan
        ) VALUES (
            '$kode_barang', $jumlah, '$tanggal', '$tipe', '$status',
            '$nama_barang','$supplier', $nama_pelanggan, $tanggal_dianter, $catatan
        )";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Riwayat retur berhasil disimpan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $conn->error]);
}

$conn->close();
?>
