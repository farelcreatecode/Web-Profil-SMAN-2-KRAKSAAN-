<?php
// api_berita.php - Backend handler for berita & karya operations
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "config/koneksi.php";

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

// 1. User submit berita atau karya (status 'P' / Pending / Tidak Aktif)
if ($action === 'submit') {
    $judul = mysqli_real_escape_string($con, trim($_POST['judul']));
    $isi = mysqli_real_escape_string($con, trim($_POST['isi_berita']));
    $penulis = mysqli_real_escape_string($con, trim($_POST['penulis']));
    $kategori = intval($_POST['kategori']);
    $jenis_konten = isset($_POST['jenis_konten']) ? mysqli_real_escape_string($con, trim($_POST['jenis_konten'])) : 'berita';
    
    // Validasi input wajib
    if (empty($judul) || empty($isi) || empty($penulis)) {
        echo json_encode(['success' => false, 'message' => 'Judul, nama penulis, dan isi berita/karya wajib diisi!']);
        exit;
    }

    // Identifikasi sesi login pengirim (Siswa / Guru / Tamu)
    $user_id = isset($_SESSION['user_id']) ? mysqli_real_escape_string($con, strval($_SESSION['user_id'])) : null;
    $role_pengirim = isset($_SESSION['user_role']) ? mysqli_real_escape_string($con, $_SESSION['user_role']) : 'umum';

    // Jika user login, pastikan nama penulis menggunakan nama sesi agar valid
    if (isset($_SESSION['user_nama']) && !empty($_SESSION['user_nama'])) {
        $penulis = mysqli_real_escape_string($con, $_SESSION['user_nama']);
    }

    $hari = date('l');
    $tanggal = date('Y-m-d');
    $jam = date('H:i:s');
    
    // Handle foto/poster upload
    $foto = 'default_berita.jpg';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $foto = ($jenis_konten === 'poster' ? 'karya_poster_' : 'berita_') . time() . '_' . rand(100, 999) . '.' . $ext;
            if (!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        }
    }
    
    $user_id_val = $user_id ? "'$user_id'" : "NULL";
    $query = mysqli_query($con, "INSERT INTO berita (judul, foto, isi_berita, hari, tanggal, jam, penulis, user_id, role_pengirim, jenis_konten, status, dibaca, kategori) 
                VALUES ('$judul', '$foto', '$isi', '$hari', '$tanggal', '$jam', '$penulis', $user_id_val, '$role_pengirim', '$jenis_konten', 'P', '0', '$kategori')");
    
    if ($query) {
        $label = ($jenis_konten === 'poster' || $jenis_konten === 'puisi') ? 'Karya' : 'Berita';
        echo json_encode([
            'success' => true, 
            'message' => $label . ' berhasil dikirim! Status saat ini: TIDAK AKTIF (Menunggu persetujuan Admin).'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mengirim: ' . mysqli_error($con)]);
    }
    exit;
}

// 2. Ambil detail berita/karya untuk modal pratinjau (preview)
if ($action === 'get_detail') {
    $id = isset($_GET['id_berita']) ? intval($_GET['id_berita']) : (isset($_POST['id_berita']) ? intval($_POST['id_berita']) : 0);
    $q = mysqli_query($con, "SELECT b.*, k.kategori as nama_kategori FROM berita b LEFT JOIN kategori k ON b.kategori = k.id_kategori WHERE b.id_berita='$id' LIMIT 1");
    if ($q && mysqli_num_rows($q) > 0) {
        $data = mysqli_fetch_assoc($q);
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
    }
    exit;
}

// 3. Admin approve berita/karya (status 'Y' / Aktif)
if ($action === 'approve' && isset($_SESSION['admin_logged_in'])) {
    $id = intval($_POST['id_berita']);
    $query = mysqli_query($con, "UPDATE berita SET status='Y', catatan_admin=NULL WHERE id_berita='$id'");
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Berita / Karya berhasil di-ACC dan sekarang berstatus AKTIF (Diterbitkan)!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyetujui data.']);
    }
    exit;
}

// 4. Admin reject berita/karya (status 'T' / Ditolak)
if ($action === 'reject' && isset($_SESSION['admin_logged_in'])) {
    $id = intval($_POST['id_berita']);
    $catatan = isset($_POST['catatan_admin']) ? mysqli_real_escape_string($con, trim($_POST['catatan_admin'])) : 'Tidak memenuhi kriteria publikasi.';
    $query = mysqli_query($con, "UPDATE berita SET status='T', catatan_admin='$catatan' WHERE id_berita='$id'");
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Berita / Karya berhasil ditolak.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menolak data.']);
    }
    exit;
}

// 5. Admin upload berita/karya langsung (status 'Y' / Aktif)
if ($action === 'admin_upload' && isset($_SESSION['admin_logged_in'])) {
    $judul = mysqli_real_escape_string($con, trim($_POST['judul']));
    $isi = mysqli_real_escape_string($con, trim($_POST['isi_berita']));
    $penulis = mysqli_real_escape_string($con, trim($_POST['penulis']));
    $kategori = intval($_POST['kategori']);
    $jenis_konten = isset($_POST['jenis_konten']) ? mysqli_real_escape_string($con, trim($_POST['jenis_konten'])) : 'berita';
    
    if (empty($judul) || empty($isi) || empty($penulis)) {
        echo json_encode(['success' => false, 'message' => 'Judul, nama penulis, dan isi berita/karya wajib diisi!']);
        exit;
    }

    $hari = date('l');
    $tanggal = date('Y-m-d');
    $jam = date('H:i:s');
    $admin_id = isset($_SESSION['admin_id']) ? strval($_SESSION['admin_id']) : '1';
    
    // Handle foto upload
    $foto = 'default_berita.jpg';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $foto = ($jenis_konten === 'poster' ? 'karya_poster_' : 'berita_') . time() . '_' . rand(100, 999) . '.' . $ext;
            if (!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        }
    }
    
    $query = mysqli_query($con, "INSERT INTO berita (judul, foto, isi_berita, hari, tanggal, jam, penulis, user_id, role_pengirim, jenis_konten, status, dibaca, kategori) 
                VALUES ('$judul', '$foto', '$isi', '$hari', '$tanggal', '$jam', '$penulis', '$admin_id', 'admin', '$jenis_konten', 'Y', '0', '$kategori')");
    
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Berita / Karya berhasil diunggah dan langsung berstatus AKTIF (Diterbitkan)!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mempublikasikan: ' . mysqli_error($con)]);
    }
    exit;
}

// 6. Admin delete berita/karya
if ($action === 'delete' && isset($_SESSION['admin_logged_in'])) {
    $id = intval($_POST['id_berita']);
    $query = mysqli_query($con, "DELETE FROM berita WHERE id_berita='$id'");
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Berita / Karya berhasil dihapus.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus: ' . mysqli_error($con)]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Permintaan tidak valid atau otorisasi gagal.']);
?>
