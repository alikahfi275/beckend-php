<?php
include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$kode_barang = $data->kode_barang;
$nama_barang = $data->nama_barang;
$stok = $data->stok;
$merek = $data->merek;
$satuan = $data->satuan;
$gambar = $data->gambar;

$sql = "INSERT INTO barang_gudang (kode_barang, nama_barang, stok, merek, satuan, gambar) 
        VALUES ('$kode_barang', '$nama_barang', '$stok', '$merek', '$satuan', '$gambar')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Barang created successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}
$conn->close();
?>
