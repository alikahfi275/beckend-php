<?php
include_once '../config/db.php';

$search_term = $_GET['q']; // Dapatkan keyword pencarian dari query string

$sql = "SELECT * FROM barang_service WHERE nama_barang LIKE '%$search_term%' OR kode_barang LIKE '%$search_term%'";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);

$conn->close();
?>
