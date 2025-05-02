<?php
include_once '../config/db.php';

// Ambil parameter tipe dari URL
$tipe = isset($_GET['tipe']) ? $_GET['tipe'] : '';

if (empty($tipe)) {
    echo json_encode([
        "status" => "error",
        "message" => "Tipe tidak boleh kosong"
    ]);
    exit;
}

$sql = "SELECT * FROM riwayat_return WHERE tipe = '$tipe' ORDER BY tanggal DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $riwayat_return = array();
    while ($row = $result->fetch_assoc()) {
        $riwayat_return[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $riwayat_return
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Tidak ada riwayat return untuk tipe '$tipe'"
    ]);
}

$conn->close();
?>
