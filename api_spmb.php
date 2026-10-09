<?php
// api_spmb.php - Backend handler for SPMB online registration
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "config/koneksi.php";

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'daftar') {
    $nama = mysqli_real_escape_string($con, $_POST['nama_lengkap']);
    $nisn = mysqli_real_escape_string($con, $_POST['nisn']);
    $asal = mysqli_real_escape_string($con, $_POST['asal_sekolah']);
    $hp = mysqli_real_escape_string($con, $_POST['no_hp']);
    $jurusan = mysqli_real_escape_string($con, $_POST['jurusan']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    
    // Generate Registration Number: SPMB-YYYYMMDD-XXXX
    $no_pendaftar = 'SPMB-' . date('Ymd') . '-' . rand(1000, 9999);
    
    $query = mysqli_query($con, "INSERT INTO pendaftaran_spmb (no_pendaftaran, nama_lengkap, nisn, asal_sekolah, no_hp, jurusan, alamat) 
                VALUES ('$no_pendaftar', '$nama', '$nisn', '$asal', '$hp', '$jurusan', '$alamat')");
    
    if ($query) {
        echo json_encode([
            'success' => true, 
            'message' => 'Pendaftaran berhasil!', 
            'no_pendaftaran' => $no_pendaftar,
            'nama' => $nama
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mendaftar. Silakan coba lagi.']);
    }
    exit;
}

// Delete registration (admin only)
if ($action === 'delete' && isset($_SESSION['admin_logged_in'])) {
    $id = intval($_POST['id_pendaftaran']);
    $query = mysqli_query($con, "DELETE FROM pendaftaran_spmb WHERE id_pendaftaran='$id'");
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Data pendaftar berhasil dihapus.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus data.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action.']);
?>
