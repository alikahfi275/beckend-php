<?php
include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$kode_barang_retur = $data->kode_barang_retur;
$nama_barang = $data->nama_barang;
$tanggal_retur = $data->tanggal_retur;
$jumlah_barang = $data->jumlah_barang;
$supplier = $data->supplier;
$status = $data->status;
$catatan = $data->catatan;

$sql = "INSERT INTO barang_retur_service (kode_barang_retur, nama_barang, tanggal_retur, jumlah_barang, supplier, status, catatan) 
        VALUES ('$kode_barang_retur', '$nama_barang', '$tanggal_retur', '$jumlah_barang', '$supplier', '$status', '$catatan')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Barang retur service berhasil"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}
$conn->close();
?>
