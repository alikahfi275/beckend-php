<?php
include_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$dari_tanggal = isset($data->dari_tanggal) ? $data->dari_tanggal : '';
$ke_tanggal = isset($data->ke_tanggal) ? $data->ke_tanggal : '';
$nama_barang = isset($data->nama_barang) ? $data->nama_barang : '';
$tipe = isset($data->tipe) ? $data->tipe : ''; 

$dari_tanggal = $conn->real_escape_string($dari_tanggal);
$ke_tanggal = $conn->real_escape_string($ke_tanggal);
$nama_barang = $conn->real_escape_string($nama_barang);
$tipe = $conn->real_escape_string($tipe);

$sql = "SELECT * FROM riwayat_return WHERE 1=1";

if ($dari_tanggal && $ke_tanggal) {
    $sql .= " AND tanggal BETWEEN '$dari_tanggal' AND '$ke_tanggal'";
} elseif ($dari_tanggal) {
    $sql .= " AND tanggal >= '$dari_tanggal'";
} elseif ($ke_tanggal) {
    $sql .= " AND tanggal <= '$ke_tanggal'";
}

if ($nama_barang) {
    $sql .= " AND nama_barang LIKE '%$nama_barang%'";
}

if ($tipe) {
    $sql .= " AND tipe = '$tipe'";
}

$sql .= " ORDER BY tanggal DESC"; 
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
