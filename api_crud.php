<?php
// api_crud.php - Central backend API for Admin CRUD operations
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "config/koneksi.php";

header('Content-Type: application/json');

// Strict Admin Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Akses ditolak. Silakan login sebagai Administrator!']);
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

// =========================================================================
// 1. MODUL GURU & GTK
// =========================================================================
if ($action === 'gtk_get') {
    $id = mysqli_real_escape_string($con, $_GET['id_gtk']);
    $q = mysqli_query($con, "SELECT * FROM gtk WHERE id_gtk='$id' LIMIT 1");
    if ($q && mysqli_num_rows($q) > 0) {
        echo json_encode(['success' => true, 'data' => mysqli_fetch_assoc($q)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Data Guru tidak ditemukan.']);
    }
    exit;
}

if ($action === 'gtk_add') {
    $id_gtk = mysqli_real_escape_string($con, trim($_POST['id_gtk']));
    $nama = mysqli_real_escape_string($con, trim($_POST['nama']));
    $jk = mysqli_real_escape_string($con, trim($_POST['jk']));
    $nip = mysqli_real_escape_string($con, trim($_POST['nip']));
    $jenis_ptk = mysqli_real_escape_string($con, trim($_POST['jenis_ptk']));
    $mapel_peg = mysqli_real_escape_string($con, trim($_POST['mapel_peg']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $no_hp = mysqli_real_escape_string($con, trim($_POST['no_hp']));

    if (empty($id_gtk) || empty($nama)) {
        echo json_encode(['success' => false, 'message' => 'ID GTK dan Nama Guru wajib diisi!']);
        exit;
    }

    // Check duplicate ID GTK
    $chk = mysqli_query($con, "SELECT * FROM gtk WHERE id_gtk='$id_gtk'");
    if (mysqli_num_rows($chk) > 0) {
        echo json_encode(['success' => false, 'message' => 'ID GTK tersebut sudah terdaftar! Gunakan ID lain.']);
        exit;
    }

    $foto = 'user.png';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $foto = 'gtk_' . time() . '_' . rand(100, 999) . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        }
    }

    $ins = mysqli_query($con, "INSERT INTO gtk (id_gtk, nama, jk, nip, jenis_ptk, mapel_peg, email, no_hp, foto) 
                VALUES ('$id_gtk', '$nama', '$jk', '$nip', '$jenis_ptk', '$mapel_peg', '$email', '$no_hp', '$foto')");

    if ($ins) {
        echo json_encode(['success' => true, 'message' => 'Data Guru berhasil ditambahkan!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambah data: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'gtk_update') {
    $id_gtk = mysqli_real_escape_string($con, trim($_POST['id_gtk']));
    $nama = mysqli_real_escape_string($con, trim($_POST['nama']));
    $jk = mysqli_real_escape_string($con, trim($_POST['jk']));
    $nip = mysqli_real_escape_string($con, trim($_POST['nip']));
    $jenis_ptk = mysqli_real_escape_string($con, trim($_POST['jenis_ptk']));
    $mapel_peg = mysqli_real_escape_string($con, trim($_POST['mapel_peg']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $no_hp = mysqli_real_escape_string($con, trim($_POST['no_hp']));

    $foto_update_sql = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $foto = 'gtk_' . time() . '_' . rand(100, 999) . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
            $foto_update_sql = ", foto='$foto'";
        }
    }

    $up = mysqli_query($con, "UPDATE gtk SET 
            nama='$nama', jk='$jk', nip='$nip', jenis_ptk='$jenis_ptk', 
            mapel_peg='$mapel_peg', email='$email', no_hp='$no_hp' $foto_update_sql 
            WHERE id_gtk='$id_gtk'");

    if ($up) {
        echo json_encode(['success' => true, 'message' => 'Data Guru berhasil diperbarui!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'gtk_delete') {
    $id = mysqli_real_escape_string($con, $_POST['id_gtk']);
    $del = mysqli_query($con, "DELETE FROM gtk WHERE id_gtk='$id'");
    if ($del) {
        echo json_encode(['success' => true, 'message' => 'Data Guru berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus: ' . mysqli_error($con)]);
    }
    exit;
}

// =========================================================================
// 2. MODUL SISWA
// =========================================================================
if ($action === 'siswa_get') {
    $id = intval($_GET['id_siswa']);
    $q = mysqli_query($con, "SELECT * FROM siswa WHERE id_siswa='$id' LIMIT 1");
    if ($q && mysqli_num_rows($q) > 0) {
        echo json_encode(['success' => true, 'data' => mysqli_fetch_assoc($q)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Data Siswa tidak ditemukan.']);
    }
    exit;
}

if ($action === 'siswa_add') {
    $nama = mysqli_real_escape_string($con, trim($_POST['Nama']));
    $nisn = mysqli_real_escape_string($con, trim($_POST['NISN']));
    $nipd = mysqli_real_escape_string($con, trim($_POST['NIPD']));
    $jk = mysqli_real_escape_string($con, trim($_POST['JK']));
    $kelas = mysqli_real_escape_string($con, trim($_POST['Kelas']));
    $kelurahan = mysqli_real_escape_string($con, trim($_POST['Kelurahan']));

    if (empty($nama) || empty($nisn)) {
        echo json_encode(['success' => false, 'message' => 'Nama Siswa dan NISN wajib diisi!']);
        exit;
    }

    $ins = mysqli_query($con, "INSERT INTO siswa (Nama, NIPD, JK, NISN, Kelurahan, Kelas) 
                VALUES ('$nama', '$nipd', '$jk', '$nisn', '$kelurahan', '$kelas')");

    if ($ins) {
        echo json_encode(['success' => true, 'message' => 'Data Siswa berhasil ditambahkan!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambah data siswa: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'siswa_update') {
    $id = intval($_POST['id_siswa']);
    $nama = mysqli_real_escape_string($con, trim($_POST['Nama']));
    $nisn = mysqli_real_escape_string($con, trim($_POST['NISN']));
    $nipd = mysqli_real_escape_string($con, trim($_POST['NIPD']));
    $jk = mysqli_real_escape_string($con, trim($_POST['JK']));
    $kelas = mysqli_real_escape_string($con, trim($_POST['Kelas']));
    $kelurahan = mysqli_real_escape_string($con, trim($_POST['Kelurahan']));

    $up = mysqli_query($con, "UPDATE siswa SET 
            Nama='$nama', NIPD='$nipd', JK='$jk', NISN='$nisn', 
            Kelurahan='$kelurahan', Kelas='$kelas' 
            WHERE id_siswa='$id'");

    if ($up) {
        echo json_encode(['success' => true, 'message' => 'Data Siswa berhasil diperbarui!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'siswa_delete') {
    $id = intval($_POST['id_siswa']);
    $del = mysqli_query($con, "DELETE FROM siswa WHERE id_siswa='$id'");
    if ($del) {
        echo json_encode(['success' => true, 'message' => 'Data Siswa berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus: ' . mysqli_error($con)]);
    }
    exit;
}

// =========================================================================
// 3. MODUL PRESTASI
// =========================================================================
if ($action === 'prestasi_get') {
    $id = intval($_GET['id_prestasi']);
    $q = mysqli_query($con, "SELECT * FROM prestasi WHERE id_prestasi='$id' LIMIT 1");
    if ($q && mysqli_num_rows($q) > 0) {
        echo json_encode(['success' => true, 'data' => mysqli_fetch_assoc($q)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Data Prestasi tidak ditemukan.']);
    }
    exit;
}

if ($action === 'prestasi_add') {
    $nama_lomba = mysqli_real_escape_string($con, trim($_POST['nama_lomba']));
    $juara = mysqli_real_escape_string($con, trim($_POST['juara']));
    $peraih = mysqli_real_escape_string($con, trim($_POST['peraih']));
    $tingkat = mysqli_real_escape_string($con, trim($_POST['tingkat']));
    $tempat = mysqli_real_escape_string($con, trim($_POST['tempat']));
    $tanggal = !empty($_POST['tanggal']) ? mysqli_real_escape_string($con, $_POST['tanggal']) : date('Y-m-d');
    $deskripsi = mysqli_real_escape_string($con, trim($_POST['deskripsi']));

    $foto = 'blog_1.jpg';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $foto = 'prestasi_' . time() . '_' . rand(100, 999) . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
        }
    }

    $ins = mysqli_query($con, "INSERT INTO prestasi (nama_lomba, tingkat, tempat, tanggal, juara, peraih, deskripsi, foto) 
                VALUES ('$nama_lomba', '$tingkat', '$tempat', '$tanggal', '$juara', '$peraih', '$deskripsi', '$foto')");

    if ($ins) {
        echo json_encode(['success' => true, 'message' => 'Data Prestasi berhasil ditambahkan!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambah prestasi: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'prestasi_update') {
    $id = intval($_POST['id_prestasi']);
    $nama_lomba = mysqli_real_escape_string($con, trim($_POST['nama_lomba']));
    $juara = mysqli_real_escape_string($con, trim($_POST['juara']));
    $peraih = mysqli_real_escape_string($con, trim($_POST['peraih']));
    $tingkat = mysqli_real_escape_string($con, trim($_POST['tingkat']));
    $tempat = mysqli_real_escape_string($con, trim($_POST['tempat']));
    $tanggal = !empty($_POST['tanggal']) ? mysqli_real_escape_string($con, $_POST['tanggal']) : date('Y-m-d');
    $deskripsi = mysqli_real_escape_string($con, trim($_POST['deskripsi']));

    $foto_update_sql = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $foto = 'prestasi_' . time() . '_' . rand(100, 999) . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);
            $foto_update_sql = ", foto='$foto'";
        }
    }

    $up = mysqli_query($con, "UPDATE prestasi SET 
            nama_lomba='$nama_lomba', juara='$juara', peraih='$peraih', 
            tingkat='$tingkat', tempat='$tempat', tanggal='$tanggal', 
            deskripsi='$deskripsi' $foto_update_sql 
            WHERE id_prestasi='$id'");

    if ($up) {
        echo json_encode(['success' => true, 'message' => 'Data Prestasi berhasil diperbarui!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'prestasi_delete') {
    $id = intval($_POST['id_prestasi']);
    $del = mysqli_query($con, "DELETE FROM prestasi WHERE id_prestasi='$id'");
    if ($del) {
        echo json_encode(['success' => true, 'message' => 'Data Prestasi berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus: ' . mysqli_error($con)]);
    }
    exit;
}

// =========================================================================
// 4. MODUL GALERI / MEDIA
// =========================================================================
if ($action === 'galeri_add') {
    $keterangan = mysqli_real_escape_string($con, trim($_POST['keterangan']));

    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
        echo json_encode(['success' => false, 'message' => 'File gambar galeri wajib diunggah!']);
        exit;
    }

    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
        echo json_encode(['success' => false, 'message' => 'Format file gambar tidak valid.']);
        exit;
    }

    $foto = 'galeri_' . time() . '_' . rand(100, 999) . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);

    $ins = mysqli_query($con, "INSERT INTO galeri (keterangan, foto) VALUES ('$keterangan', '$foto')");
    if ($ins) {
        echo json_encode(['success' => true, 'message' => 'Foto Galeri berhasil ditambahkan!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'galeri_delete') {
    $id = intval($_POST['id_galeri']);
    $del = mysqli_query($con, "DELETE FROM galeri WHERE id_galeri='$id'");
    if ($del) {
        echo json_encode(['success' => true, 'message' => 'Foto Galeri berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus: ' . mysqli_error($con)]);
    }
    exit;
}

// =========================================================================
// 5. MODUL DOWNLOAD / UNDUHAN DOKUMEN
// =========================================================================
if ($action === 'download_add') {
    $nama_file = mysqli_real_escape_string($con, trim($_POST['nama_file']));
    $tanggal = date('Y-m-d');

    if (empty($nama_file) || !isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
        echo json_encode(['success' => false, 'message' => 'Nama dokumen dan berkas file wajib diunggah!']);
        exit;
    }

    $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $filename = 'doc_' . time() . '_' . rand(100, 999) . '.' . $ext;
    if (!is_dir('dist/download')) {
        mkdir('dist/download', 0777, true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'], 'dist/download/' . $filename);

    $ins = mysqli_query($con, "INSERT INTO download (nama_file, tanggal, file) VALUES ('$nama_file', '$tanggal', '$filename')");
    if ($ins) {
        echo json_encode(['success' => true, 'message' => 'Dokumen Unduhan berhasil ditambahkan!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan: ' . mysqli_error($con)]);
    }
    exit;
}

if ($action === 'download_delete') {
    $id = intval($_POST['id_download']);
    $del = mysqli_query($con, "DELETE FROM download WHERE id_download='$id'");
    if ($del) {
        echo json_encode(['success' => true, 'message' => 'Dokumen berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus: ' . mysqli_error($con)]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Aksi tidak dikenali.']);
?>
