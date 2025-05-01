<?php
include_once '../../config/db.php';

$sql = "SELECT * FROM riwayat_barang_retur_service ORDER BY tanggal_retur DESC";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["status" => "success", "data" => $data]);
$conn->close();
?>
