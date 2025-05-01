<?php
include_once '../config/db.php';

// Ambil data dari request
$data = json_decode(file_get_contents("php://input"));

$dari_tanggal = isset($data->dari_tanggal) ? $data->dari_tanggal : '';
$ke_tanggal = isset($data->ke_tanggal) ? $data->ke_tanggal : '';
$nama_barang = isset($data->nama_barang) ? $data->nama_barang : '';
$tipe = isset($data->tipe) ? $data->tipe : '';  // Bisa 'gudang' atau 'service'

// Mengatur query dasar
$sql = "SELECT * FROM riwayat_masuk WHERE 1=1";

// Menambahkan filter tanggal jika ada
if ($dari_tanggal && $ke_tanggal) {
    $sql .= " AND tanggal BETWEEN '$dari_tanggal' AND '$ke_tanggal'";
} elseif ($dari_tanggal) {
    $sql .= " AND tanggal >= '$dari_tanggal'";
} elseif ($ke_tanggal) {
    $sql .= " AND tanggal <= '$ke_tanggal'";
}

// Menambahkan filter nama barang jika ada
if ($nama_barang) {
    $sql .= " AND nama_barang LIKE '%$nama_barang%'";
}

// Menambahkan filter tipe (gudang atau service) jika ada
if ($tipe) {
    $sql .= " AND tipe = '$tipe'";
}

$sql .= " ORDER BY tanggal DESC"; // Urutkan berdasarkan tanggal secara menurun

// Jalankan query
$result = $conn->query($sql);

$riwayat = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $riwayat[] = $row;
    }
    echo json_encode([
        "status" => "success",
        "data" => $riwayat
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "data" => []
    ]);
}

$conn->close();
?>
