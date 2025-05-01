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

$sql = "UPDATE barang_retur_toko SET 
        nama_barang='$nama_barang', tanggal_retur='$tanggal_retur', jumlah_barang=$jumlah_barang, 
        supplier='$supplier', status='$status', catatan='$catatan' 
        WHERE kode_barang_retur='$kode_barang_retur'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Barang retur toko diperbarui"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}
$conn->close();
?>
