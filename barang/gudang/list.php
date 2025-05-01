<?php
include_once '../../config/db.php';

$response = array();
$sql = "SELECT * FROM barang_gudang ORDER BY nama_barang ASC";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$response['status'] = 'success';
$response['data'] = $data;
echo json_encode($response);
$conn->close();
?>
