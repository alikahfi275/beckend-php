<?php
include_once '../../config/db.php';

$query = $_GET['query'];

$sql = "SELECT * FROM barang_toko WHERE nama_barang LIKE '%$query%' ORDER BY nama_barang ASC";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["status" => "success", "data" => $data]);
$conn->close();
?>
