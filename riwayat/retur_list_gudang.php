<?php
include_once '../config/db.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM barang_retur_gudang ORDER BY tanggal_retur DESC";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Data ditemukan',
        'data' => $data
    ]);
} else {
    echo json_encode([
        'status' => 'empty',
        'message' => 'Tidak ada data retur service'
    ]);
}

$conn->close();
?>
