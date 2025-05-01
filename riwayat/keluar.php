<?php
include_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

$kode_barang = $data->kode_barang;
$nama_barang = $data->nama_barang; 
$jumlah = $data->jumlah;
$tipe = $data->tipe;
$tanggal = $data->tanggal;

$sql = "INSERT INTO riwayat_keluar (kode_barang, nama_barang, jumlah, tipe, tanggal) 
        VALUES ('$kode_barang', '$nama_barang', $jumlah, '$tipe', '$tanggal')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Riwayat keluar berhasil ditambahkan"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}
$conn->close();
?>
