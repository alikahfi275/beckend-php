<?php
include_once '../../config/db.php';

$kode_barang = $_GET['kode_barang'];

$sql = "SELECT * FROM barang_gudang WHERE kode_barang='$kode_barang'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "error", "message" => "Barang not found"]);
}
$conn->close();
?>
