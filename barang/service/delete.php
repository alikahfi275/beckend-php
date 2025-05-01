<?php
include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));
$kode_barang = $data->kode_barang;

$sql = "DELETE FROM barang_service WHERE kode_barang = '$kode_barang'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Barang berhasil dihapus"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
