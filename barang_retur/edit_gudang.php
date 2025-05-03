<?php
include_once '../config/db.php';

// Ambil data dari body request
$data = json_decode(file_get_contents("php://input"));

// Validasi kode_barang
if (empty($data->kode_barang)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'kode_barang wajib disertakan untuk edit data'
    ]);
    exit;
}

// Sanitasi data
$kode_barang = $conn->real_escape_string($data->kode_barang);
$nama_barang = isset($data->nama_barang) ? $conn->real_escape_string($data->nama_barang) : '';
$tanggal_retur = isset($data->tanggal_retur) ? $conn->real_escape_string($data->tanggal_retur) : '';
$jumlah = isset($data->jumlah) ? (int) $data->jumlah : 0;
$supplier = isset($data->supplier) ? $conn->real_escape_string($data->supplier) : '';
$catatan = isset($data->catatan) ? $conn->real_escape_string($data->catatan) : '';
$status = isset($data->status) ? $conn->real_escape_string($data->status) : '';
$tanggal_kembali = isset($data->tanggal_kembali) ? $conn->real_escape_string($data->tanggal_kembali) : null;

// Query update ke barang_retur_gudang
$sql = "UPDATE barang_retur_gudang SET
            nama_barang = '$nama_barang',
            tanggal_retur = '$tanggal_retur',
            jumlah = $jumlah,
            supplier = '$supplier',
            catatan = '$catatan',
            status = '$status',
            tanggal_kembali = " . ($tanggal_kembali ? "'$tanggal_kembali'" : "NULL") . "
        WHERE kode_barang = '$kode_barang'";

$response = [];

if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
        // Update juga di tabel riwayat_return dengan tipe = 'gudang'
        $updateRiwayat = "UPDATE riwayat_return SET nama_barang = '$nama_barang' 
                          WHERE kode_barang = '$kode_barang' AND tipe = 'gudang'";
        $conn->query($updateRiwayat); // Optional: bisa dicek juga affected_rows-nya

        $response = [
            'status' => 'success',
            'message' => 'Data barang retur berhasil diperbarui (termasuk riwayat_return)'
        ];
    } else {
        $response = [
            'status' => 'warning',
            'message' => 'Data tidak ditemukan atau tidak ada perubahan'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Gagal memperbarui data: ' . $conn->error
    ];
}

echo json_encode($response);
$conn->close();
?>
