<?php
// api_admin.php - Backend handler for admin profile & security settings
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "config/koneksi.php";

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'change_password') {
    $id_admin = $_SESSION['admin_id'];
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];
    
    if ($new_pass !== $confirm_pass) {
        echo json_encode(['success' => false, 'message' => 'Konfirmasi password baru tidak cocok.']);
        exit;
    }
    
    if (strlen($new_pass) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password baru minimal 6 karakter.']);
        exit;
    }
    
    // Check old password
    $q = mysqli_query($con, "SELECT * FROM admin WHERE id_admin='$id_admin'");
    $admin = mysqli_fetch_assoc($q);
    
    if (!$admin || !password_verify($old_pass, $admin['password'])) {
        echo json_encode(['success' => false, 'message' => 'Password lama Anda salah!']);
        exit;
    }
    
    // Update password
    $hashed = password_hash($new_pass, PASSWORD_BCRYPT);
    $up = mysqli_query($con, "UPDATE admin SET password='$hashed' WHERE id_admin='$id_admin'");
    
    if ($up) {
        echo json_encode(['success' => true, 'message' => 'Password berhasil diubah!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mengubah password.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action.']);
?>
