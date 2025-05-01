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

$sql = "SELECT * FROM riwayat_masuk WHERE tipe = '$tipe' ORDER BY tanggal DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $riwayat_masuk = array();
    while ($row = $result->fetch_assoc()) {
        $riwayat_masuk[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $riwayat_masuk
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Tidak ada riwayat masuk untuk tipe '$tipe'"
    ]);
}

$conn->close();
?>
