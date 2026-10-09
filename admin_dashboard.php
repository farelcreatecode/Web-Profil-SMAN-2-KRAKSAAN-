<?php
// admin_dashboard.php - Comprehensive Web Admin Portal for SMAN 2 Kraksaan
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Strict Admin Access Control
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "<script>alert('Akses Terbatas: Halaman ini hanya dapat diakses oleh Administrator Sistem!'); window.location.href='index.php?page=home';</script>";
    exit;
}

include_once "config/koneksi.php";

$admin_nama = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Administrator';
$admin_username = isset($_SESSION['user_username']) ? $_SESSION['user_username'] : 'admin';
$modul = isset($_GET['modul']) ? $_GET['modul'] : 'ringkasan';

// Hitung statistik ringkasan
$cnt_pending = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM berita WHERE status='P'"))['t'];
$cnt_berita = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM berita WHERE status='Y'"))['t'];
$cnt_spmb = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM pendaftaran_spmb"))['t'];
$cnt_gtk = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM gtk"))['t'];
$cnt_siswa = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM siswa"))['t'];
$cnt_prestasi = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM prestasi"))['t'];
$cnt_galeri = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM galeri"))['t'];
$cnt_download = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as t FROM download"))['t'];
?>

<style>
/* ============================================================
   ADMIN DASHBOARD - Clean, Modern, Refined Design System
   ============================================================ */
:root {
    --admin-primary: #1B2A4A;
    --admin-accent: #2563EB;
    --admin-bg: #F8FAFC;
    --admin-card: #FFFFFF;
    --admin-text: #0F172A;
    --admin-text-muted: #64748B;
    --admin-border: #E2E8F0;
    --admin-border-light: #F1F5F9;
}

/* Hide floating WhatsApp widget on admin portal so it doesn't block actions */
.wa-float {
    display: none !important;
}

/* Hide legacy title banner */
.admin-portal-wrapper ~ .all-title-box,
.admin-portal-wrapper .all-title-box {
    display: none !important;
}

/* ---- Portal Wrapper ---- */
.admin-portal-wrapper {
    background: var(--admin-bg);
    min-height: calc(100vh - 68px);
    padding-bottom: 50px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.admin-container {
    max-width: 1400px;
    margin: 0 auto;
    padding-left: 20px;
    padding-right: 20px;
}

/* ---- Refined Top Header Bar ---- */
.admin-top-bar {
    background: #FFFFFF;
    border-bottom: 1px solid var(--admin-border);
    margin-bottom: 24px;
}

.admin-breadcrumb {
    font-size: 12px;
    color: var(--admin-text-muted);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.admin-breadcrumb a {
    color: var(--admin-text-muted);
    text-decoration: none;
}

.admin-breadcrumb a:hover {
    color: var(--admin-accent);
}

.admin-page-title {
    font-size: 20px;
    font-weight: 800;
    color: var(--admin-text);
    margin: 0;
    letter-spacing: -0.3px;
}

.admin-header-date {
    font-size: 12px;
    color: var(--admin-text-muted);
    background: var(--admin-bg);
    border: 1px solid var(--admin-border);
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
}

/* ---- Sleek Light Sidebar ---- */
.admin-sidebar {
    background: #FFFFFF;
    border: 1px solid var(--admin-border);
    border-radius: 12px;
    padding: 0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    margin-bottom: 20px;
    position: sticky;
    top: 85px;
    overflow: hidden;
}

.admin-sidebar-header {
    padding: 16px;
    background: #FAFBFC;
    border-bottom: 1px solid var(--admin-border);
}

.admin-avatar-circle {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #EFF6FF;
    color: #2563EB;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
    border: 1px solid #DBEAFE;
}

.admin-sidebar-header h6 {
    font-size: 13.5px;
    font-weight: 700;
    margin: 0;
    color: var(--admin-text);
    line-height: 1.2;
}

.admin-role-badge {
    font-size: 9.5px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 4px;
    background: #FEF2F2;
    color: #DC2626;
    border: 1px solid #FEE2E2;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    display: inline-block;
}

.admin-nav {
    padding: 8px;
}

.admin-nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    color: #475569;
    text-decoration: none !important;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 2px;
    transition: all 0.15s ease;
}

.admin-nav-item i:first-child {
    width: 16px;
    text-align: center;
    font-size: 13.5px;
    flex-shrink: 0;
    color: #64748B;
}

.admin-nav-item:hover {
    color: var(--admin-text);
    background: #F1F5F9;
}

.admin-nav-item.active {
    color: #1D4ED8;
    background: #EFF6FF;
    font-weight: 600;
}

.admin-nav-item.active i:first-child {
    color: #2563EB;
}

.admin-nav-badge {
    margin-left: auto;
    font-size: 10px;
    padding: 2px 7px;
    border-radius: 12px;
    font-weight: 700;
    line-height: 1.2;
}

/* ---- Stat Cards (Ringkasan) ---- */
.stat-card {
    background: #FFFFFF;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    border: 1px solid var(--admin-border);
    display: flex;
    align-items: center;
    gap: 14px;
    transition: all 0.2s ease;
}

.stat-card:hover {
    border-color: #CBD5E1;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.stat-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.stat-card h3 {
    font-size: 22px;
    font-weight: 800;
    color: var(--admin-text);
    margin: 0;
    line-height: 1;
}

.stat-card small {
    font-size: 12px;
    font-weight: 600;
    color: var(--admin-text-muted);
    display: block;
    margin-top: 4px;
}

/* ---- Main Content Cards ---- */
.admin-main-card {
    background: #FFFFFF;
    border-radius: 12px;
    border: 1px solid var(--admin-border);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    margin-bottom: 20px;
}

.admin-main-card > .admin-card-header {
    background: #FFFFFF;
    border-bottom: 1px solid var(--admin-border);
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.admin-main-card > .admin-card-header h5 {
    font-size: 15px;
    font-weight: 700;
    color: var(--admin-text);
    margin: 0;
}

.admin-main-card > .admin-card-header small {
    font-size: 12px;
    color: var(--admin-text-muted);
}

/* ---- Tables ---- */
.admin-main-card .table {
    margin-bottom: 0;
    font-size: 13px;
}

.admin-main-card .table thead th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 700;
    background: #F8FAFC;
    color: #475569;
    border-top: none;
    border-bottom: 1px solid var(--admin-border);
    padding: 11px 16px;
    white-space: nowrap;
}

.admin-main-card .table tbody td {
    padding: 11px 16px;
    vertical-align: middle;
    border-color: #F1F5F9;
    color: #334155;
}

.admin-main-card .table tbody tr:hover {
    background: #F8FAFC;
}

.admin-main-card .table tbody tr:last-child td {
    border-bottom: none;
}

/* ---- Action Buttons in Tables ---- */
.btn-action {
    padding: 5px 9px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
    transition: all 0.15s ease;
}

/* ---- Admin Button Overrides ---- */
.admin-portal-wrapper .btn-success {
    background: #059669;
    border: none;
    font-weight: 600;
    font-size: 13px;
    padding: 8px 16px;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(5, 150, 105, 0.2);
    transition: all 0.2s ease;
}

.admin-portal-wrapper .btn-success:hover {
    background: #047857;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(5, 150, 105, 0.3);
}

/* ---- Modals ---- */
.admin-portal-wrapper .modal-content,
body .modal-content {
    border-radius: 12px !important;
    border: none !important;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
}

.admin-portal-wrapper .modal-header {
    padding: 14px 20px;
}

.admin-portal-wrapper .modal-body {
    padding: 20px;
}

.admin-portal-wrapper .modal-footer {
    padding: 12px 20px;
    background: #F8FAFC;
    border-top: 1px solid var(--admin-border);
}

/* ---- Custom scrollbar ---- */
.admin-portal-wrapper ::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.admin-portal-wrapper ::-webkit-scrollbar-track {
    background: transparent;
}

.admin-portal-wrapper ::-webkit-scrollbar-thumb {
    background: #CBD5E1;
    border-radius: 10px;
}

/* ============================================================
   RESPONSIVE - Tablet & Mobile (< 992px)
   ============================================================ */
@media (max-width: 991.98px) {
    .admin-container {
        padding-left: 14px;
        padding-right: 14px;
    }

    .admin-sidebar {
        position: static;
        border-radius: 10px;
        margin-bottom: 16px;
    }

    .admin-sidebar-header {
        padding: 12px 14px;
    }

    .admin-nav {
        display: flex;
        overflow-x: auto;
        gap: 6px;
        padding: 8px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .admin-nav::-webkit-scrollbar {
        display: none;
    }

    .admin-nav-item {
        white-space: nowrap;
        font-size: 12px;
        padding: 7px 12px;
        flex-shrink: 0;
        gap: 6px;
        margin-bottom: 0;
    }

    .admin-nav .border-top {
        display: none !important;
    }

    .admin-top-bar {
        margin-bottom: 16px;
    }

    .admin-page-title {
        font-size: 18px;
    }

    .stat-card {
        padding: 12px;
    }

    .stat-card h3 {
        font-size: 20px;
    }

    .admin-main-card > .admin-card-header {
        padding: 12px 16px;
    }
}
</style>

<?php
$modul_titles = [
    'ringkasan' => 'Ringkasan & Statistik',
    'berita' => 'Manajemen Berita & Karya',
    'spmb' => 'Pendaftaran SPMB Online',
    'guru' => 'Data Guru & Tenaga Kependidikan',
    'siswa' => 'Data Siswa',
    'prestasi' => 'Prestasi Sekolah',
    'media' => 'Galeri Foto & Dokumentasi',
    'download' => 'Berkas Unduhan Dokumen',
    'setting' => 'Pengaturan Akun & Password'
];
$current_modul_title = isset($modul_titles[$modul]) ? $modul_titles[$modul] : 'Panel Administrator';
?>

<!-- Clean Admin Top Bar -->
<div class="admin-top-bar">
    <div class="admin-container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 py-3">
            <div>
                <div class="admin-breadcrumb">
                    <a href="index.php?page=home"><i class="fa fa-home"></i> Beranda</a>
                    <span>/</span>
                    <a href="index.php?page=admin_dashboard">Admin</a>
                    <span>/</span>
                    <span class="text-primary font-weight-bold"><?= $current_modul_title ?></span>
                </div>
                <h1 class="admin-page-title"><?= $current_modul_title ?></h1>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="admin-header-date">
                    <i class="fa fa-calendar-o mr-1"></i> <?= date('d M Y') ?>
                </span>
                <a href="index.php?page=home" target="_blank" class="btn btn-sm btn-outline-secondary font-weight-bold" style="border-radius: 6px; font-size: 12px;">
                    <i class="fa fa-external-link mr-1"></i> Lihat Web
                </a>
            </div>
        </div>
    </div>
</div>

<div class="admin-portal-wrapper">
    <div class="admin-container">
        
        <div class="row">
            <!-- SIDEBAR NAVIGASI ADMIN (RESPONSIF) -->
            <div class="col-xl-3 col-lg-4 col-12">
                <div class="admin-sidebar">
                    <div class="admin-sidebar-header">
                        <div class="d-flex align-items-center gap-2">
                            <div class="admin-avatar-circle">
                                <i class="fa fa-user"></i>
                            </div>
                            <div>
                                <h6><?= htmlspecialchars($admin_nama) ?></h6>
                                <span class="admin-role-badge">Super Admin</span>
                            </div>
                        </div>
                    </div>

                    <nav class="admin-nav">
                        <a href="index.php?page=admin_dashboard&modul=ringkasan" class="admin-nav-item <?= ($modul === 'ringkasan') ? 'active' : '' ?>">
                            <i class="fa fa-tachometer"></i> Dashboard
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=berita" class="admin-nav-item <?= ($modul === 'berita') ? 'active' : '' ?>">
                            <i class="fa fa-newspaper-o"></i> Berita & Karya
                            <?php if($cnt_pending > 0): ?>
                                <span class="admin-nav-badge bg-warning text-dark"><?= $cnt_pending ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=spmb" class="admin-nav-item <?= ($modul === 'spmb') ? 'active' : '' ?>">
                            <i class="fa fa-users"></i> Pendaftar SPMB
                            <span class="admin-nav-badge bg-primary text-white"><?= $cnt_spmb ?></span>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=guru" class="admin-nav-item <?= ($modul === 'guru') ? 'active' : '' ?>">
                            <i class="fa fa-id-badge"></i> Data Guru
                            <span class="admin-nav-badge bg-secondary text-white"><?= $cnt_gtk ?></span>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=siswa" class="admin-nav-item <?= ($modul === 'siswa') ? 'active' : '' ?>">
                            <i class="fa fa-graduation-cap"></i> Data Siswa
                            <span class="admin-nav-badge bg-secondary text-white"><?= $cnt_siswa ?></span>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=prestasi" class="admin-nav-item <?= ($modul === 'prestasi') ? 'active' : '' ?>">
                            <i class="fa fa-trophy"></i> Prestasi
                            <span class="admin-nav-badge bg-secondary text-white"><?= $cnt_prestasi ?></span>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=media" class="admin-nav-item <?= ($modul === 'media') ? 'active' : '' ?>">
                            <i class="fa fa-picture-o"></i> Galeri
                            <span class="admin-nav-badge bg-secondary text-white"><?= $cnt_galeri ?></span>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=download" class="admin-nav-item <?= ($modul === 'download') ? 'active' : '' ?>">
                            <i class="fa fa-download"></i> Unduhan
                            <span class="admin-nav-badge bg-secondary text-white"><?= $cnt_download ?></span>
                        </a>
                        <a href="index.php?page=admin_dashboard&modul=setting" class="admin-nav-item <?= ($modul === 'setting') ? 'active' : '' ?>">
                            <i class="fa fa-key"></i> Pengaturan
                        </a>
                        
                        <div class="my-2 border-top" style="border-color: #F1F5F9 !important;"></div>
                        
                        <a href="auth.php?action=logout" class="admin-nav-item text-danger">
                            <i class="fa fa-sign-out text-danger"></i> Keluar
                        </a>
                    </nav>
                </div>
            </div>

            <!-- AREA KONTEN MODUL UTAMA -->
            <div class="col-xl-9 col-lg-8 col-12">
                
                <!-- ==============================================================
                     1. MODUL: RINGKASAN & STATISTIK DASHBOARD
                     ============================================================== -->
                <?php if($modul === 'ringkasan'): ?>
                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-warning text-dark"><i class="fa fa-clock-o"></i></div>
                            <div>
                                <h3 class="font-weight-bold mb-0"><?= $cnt_pending ?></h3>
                                <small class="text-muted font-weight-bold">Pending Approval</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-primary text-white"><i class="fa fa-newspaper-o"></i></div>
                            <div>
                                <h3 class="font-weight-bold mb-0"><?= $cnt_berita ?></h3>
                                <small class="text-muted font-weight-bold">Berita & Karya</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-success text-white"><i class="fa fa-users"></i></div>
                            <div>
                                <h3 class="font-weight-bold mb-0"><?= $cnt_spmb ?></h3>
                                <small class="text-muted font-weight-bold">Pendaftar SPMB</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-info text-white"><i class="fa fa-trophy"></i></div>
                            <div>
                                <h3 class="font-weight-bold mb-0"><?= $cnt_prestasi ?></h3>
                                <small class="text-muted font-weight-bold">Prestasi Sekolah</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kartu Kiriman yang Membutuhkan Approval Segera -->
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1"><i class="fa fa-hourglass-half text-warning me-2"></i> Kiriman Siswa & Guru Menunggu Verifikasi</h5>
                            <small class="text-muted">Konten berstatus TIDAK AKTIF hingga Anda meng-ACC.</small>
                        </div>
                        <a href="index.php?page=admin_dashboard&modul=berita" class="btn btn-sm btn-primary font-weight-bold" style="background:#1B2A4A; border:none;">
                            Kelola Semua Berita & Karya <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul & Jenis</th>
                                        <th>Pengirim / Penulis</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi Cepat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q_dash_p = mysqli_query($con, "SELECT * FROM berita WHERE status='P' ORDER BY id_berita DESC LIMIT 5");
                                    if(mysqli_num_rows($q_dash_p) > 0):
                                        while($dp = mysqli_fetch_assoc($q_dash_p)):
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($dp['judul']) ?></strong>
                                            <span class="badge bg-light text-dark border ms-1"><?= ucfirst($dp['jenis_konten']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($dp['penulis']) ?> <span class="badge bg-secondary" style="font-size:10px;"><?= strtoupper($dp['role_pengirim']) ?></span></td>
                                        <td><small class="text-muted"><?= $dp['tanggal'] ?></small></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success btn-action" onclick="approveBerita(<?= $dp['id_berita'] ?>)">
                                                <i class="fa fa-check"></i> ACC
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-action" onclick="rejectBerita(<?= $dp['id_berita'] ?>)">
                                                <i class="fa fa-times"></i> Tolak
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fa fa-check-circle fa-2x text-success mb-2 d-block"></i>
                                            Semua kiriman konten telah diproses. Tidak ada antrean pending.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ==============================================================
                     2. MODUL: BERITA & KARYA (APPROVAL + FULL CRUD)
                     ============================================================== -->
                <?php elseif($modul === 'berita'): ?>
                    <?php include 'admin_berita.php'; ?>

                <!-- ==============================================================
                     3. MODUL: SPMB ONLINE
                     ============================================================== -->
                <?php elseif($modul === 'spmb'): ?>
                    <?php include 'admin_spmb.php'; ?>

                <!-- ==============================================================
                     4. MODUL: GURU & GTK (CRUD)
                     ============================================================== -->
                <?php elseif($modul === 'guru'): ?>
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1"><i class="fa fa-id-badge text-primary me-2"></i> Manajemen Data Guru & Tenaga Kependidikan</h5>
                            <small class="text-muted">Data yang tampil pada halaman direktori Guru sekolah.</small>
                        </div>
                        <button type="button" class="btn btn-success font-weight-bold shadow-sm" onclick="openModalTambahGtk()">
                            <i class="fa fa-plus-circle me-1"></i> Tambah Guru Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 70px;">Foto</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIP / ID GTK</th>
                                        <th>Jenis PTK</th>
                                        <th>Mata Pelajaran</th>
                                        <th class="text-center" style="width: 140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q_gtk = mysqli_query($con, "SELECT * FROM gtk ORDER BY id_gtk ASC");
                                    while($g = mysqli_fetch_assoc($q_gtk)):
                                        $f_src = (!empty($g['foto']) && file_exists('img/' . $g['foto'])) ? 'img/' . $g['foto'] : 'img/user.png';
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><img src="<?= $f_src ?>" class="rounded-circle shadow-sm" style="width:45px; height:45px; object-fit:cover;"></td>
                                        <td><strong><?= htmlspecialchars($g['nama']) ?></strong></td>
                                        <td><?= htmlspecialchars($g['nip'] ? $g['nip'] : $g['id_gtk']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($g['jenis_ptk']) ?></span></td>
                                        <td><?= htmlspecialchars($g['mapel_peg']) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary btn-action me-1" onclick="editGtk('<?= $g['id_gtk'] ?>')"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-outline-danger btn-action" onclick="deleteGtk('<?= $g['id_gtk'] ?>')"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ==============================================================
                     5. MODUL: DATA SISWA (CRUD)
                     ============================================================== -->
                <?php elseif($modul === 'siswa'): ?>
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1"><i class="fa fa-graduation-cap text-success me-2"></i> Manajemen Data Siswa</h5>
                            <small class="text-muted">Data akademik yang tampil pada halaman Siswa.</small>
                        </div>
                        <button type="button" class="btn btn-success font-weight-bold shadow-sm" onclick="openModalTambahSiswa()">
                            <i class="fa fa-plus-circle me-1"></i> Tambah Siswa Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Nama Siswa</th>
                                        <th>NISN</th>
                                        <th>NIPD</th>
                                        <th>JK</th>
                                        <th>Kelas</th>
                                        <th>Alamat / Desa</th>
                                        <th class="text-center" style="width: 140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q_sw = mysqli_query($con, "SELECT * FROM siswa ORDER BY id_siswa DESC LIMIT 100");
                                    while($sw = mysqli_fetch_assoc($q_sw)):
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= htmlspecialchars($sw['Nama']) ?></strong></td>
                                        <td><?= htmlspecialchars($sw['NISN']) ?></td>
                                        <td><?= htmlspecialchars($sw['NIPD']) ?></td>
                                        <td><?= htmlspecialchars($sw['JK']) ?></td>
                                        <td><span class="badge bg-primary"><?= htmlspecialchars($sw['Kelas']) ?></span></td>
                                        <td><small class="text-muted"><?= htmlspecialchars($sw['Kelurahan']) ?></small></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary btn-action me-1" onclick="editSiswa(<?= $sw['id_siswa'] ?>)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-outline-danger btn-action" onclick="deleteSiswa(<?= $sw['id_siswa'] ?>)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ==============================================================
                     6. MODUL: PRESTASI SEKOLAH (CRUD)
                     ============================================================== -->
                <?php elseif($modul === 'prestasi'): ?>
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1"><i class="fa fa-trophy text-warning me-2"></i> Manajemen Prestasi Sekolah</h5>
                            <small class="text-muted">Prestasi kejuaraan siswa yang tampil pada menu Prestasi.</small>
                        </div>
                        <button type="button" class="btn btn-success font-weight-bold shadow-sm" onclick="openModalTambahPrestasi()">
                            <i class="fa fa-plus-circle me-1"></i> Tambah Prestasi Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 70px;">Foto</th>
                                        <th>Nama Kejuaraan / Lomba</th>
                                        <th>Juara</th>
                                        <th>Peraih</th>
                                        <th>Tingkat</th>
                                        <th>Tanggal</th>
                                        <th class="text-center" style="width: 140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q_pr = mysqli_query($con, "SELECT * FROM prestasi ORDER BY id_prestasi DESC");
                                    while($pr = mysqli_fetch_assoc($q_pr)):
                                        $f_pr = (!empty($pr['foto']) && file_exists('img/' . $pr['foto'])) ? 'img/' . $pr['foto'] : 'images/blog_1.jpg';
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><img src="<?= $f_pr ?>" class="rounded" style="width:50px; height:40px; object-fit:cover;"></td>
                                        <td><strong><?= htmlspecialchars($pr['nama_lomba']) ?></strong></td>
                                        <td><span class="badge bg-warning text-dark font-weight-bold">Juara <?= htmlspecialchars($pr['juara']) ?></span></td>
                                        <td><?= htmlspecialchars($pr['peraih']) ?></td>
                                        <td><?= htmlspecialchars($pr['tingkat']) ?></td>
                                        <td><small class="text-muted"><?= $pr['tanggal'] ?></small></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary btn-action me-1" onclick="editPrestasi(<?= $pr['id_prestasi'] ?>)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-outline-danger btn-action" onclick="deletePrestasi(<?= $pr['id_prestasi'] ?>)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ==============================================================
                     7. MODUL: GALERI / MEDIA (CRUD)
                     ============================================================== -->
                <?php elseif($modul === 'media'): ?>
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1"><i class="fa fa-picture-o text-info me-2"></i> Manajemen Galeri Foto & Media</h5>
                            <small class="text-muted">Kumpulan dokumentasi kegiatan pembelajaran dan ekstrakurikuler.</small>
                        </div>
                        <button type="button" class="btn btn-success font-weight-bold shadow-sm" onclick="$('#modalTambahGaleri').modal('show')">
                            <i class="fa fa-plus-circle me-1"></i> Upload Foto Galeri Baru
                        </button>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <?php
                            $q_gl = mysqli_query($con, "SELECT * FROM galeri ORDER BY id_galeri DESC");
                            if(mysqli_num_rows($q_gl) > 0):
                                while($gl = mysqli_fetch_assoc($q_gl)):
                                    $img_src = (!empty($gl['foto']) && file_exists('img/' . $gl['foto'])) ? 'img/' . $gl['foto'] : 'img/default_berita.jpg';
                            ?>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 border shadow-sm rounded-3 overflow-hidden">
                                    <img src="<?= $img_src ?>" class="w-100" style="height: 180px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <p class="card-text small mb-2 text-dark font-weight-bold"><?= htmlspecialchars($gl['keterangan'] ? $gl['keterangan'] : 'Foto Kegiatan') ?></p>
                                        <button class="btn btn-sm btn-outline-danger w-100" onclick="deleteGaleri(<?= $gl['id_galeri'] ?>)">
                                            <i class="fa fa-trash me-1"></i> Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; else: ?>
                            <div class="col-12 text-center py-5 text-muted">Belum ada foto galeri kegiatan.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- ==============================================================
                     8. MODUL: UNDUHAN / DOKUMEN (CRUD)
                     ============================================================== -->
                <?php elseif($modul === 'download'): ?>
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1"><i class="fa fa-download text-primary me-2"></i> Manajemen Berkas Unduhan Sekolah</h5>
                            <small class="text-muted">Dokumen PDF/Word yang dapat diunduh siswa, guru, atau wali murid.</small>
                        </div>
                        <button type="button" class="btn btn-success font-weight-bold shadow-sm" onclick="$('#modalTambahDownload').modal('show')">
                            <i class="fa fa-plus-circle me-1"></i> Upload Dokumen Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Nama Berkas Dokumen</th>
                                        <th>Nama File Fisik</th>
                                        <th>Tanggal Unggah</th>
                                        <th class="text-center" style="width: 140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q_dl = mysqli_query($con, "SELECT * FROM download ORDER BY id_download DESC");
                                    while($dl = mysqli_fetch_assoc($q_dl)):
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= htmlspecialchars($dl['nama_file']) ?></strong></td>
                                        <td><small class="text-muted"><?= htmlspecialchars($dl['file']) ?></small></td>
                                        <td><?= htmlspecialchars($dl['tanggal']) ?></td>
                                        <td class="text-center">
                                            <a href="dist/download/<?= $dl['file'] ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-action me-1"><i class="fa fa-download"></i> Unduh</a>
                                            <button class="btn btn-sm btn-outline-danger btn-action" onclick="deleteDownload(<?= $dl['id_download'] ?>)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ==============================================================
                     9. MODUL: PENGATURAN PASSWORD ADMIN
                     ============================================================== -->
                <?php elseif($modul === 'setting'): ?>
                    <?php include 'admin_setting.php'; ?>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<!-- ==============================================================
     MODAL FORMS (CRUD GURU, SISWA, PRESTASI, GALERI, DOWNLOAD)
     ============================================================== -->

<!-- 1. Modal GTK (Tambah / Edit) -->
<div class="modal fade" id="modalGtk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header bg-primary text-white" style="background:#1B2A4A !important;">
                <h5 class="modal-title text-white font-weight-bold" id="modalGtkTitle"><i class="fa fa-user-plus me-2"></i> Tambah Data Guru / GTK</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formGtk" enctype="multipart/form-data">
                <input type="hidden" name="action" id="gtkAction" value="gtk_add">
                <div class="modal-body p-4">
                    <div id="alertGtk" class="alert d-none"></div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">ID GTK (Kode Unik): <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="id_gtk" id="gtk_id" placeholder="Contoh: GSMAUB015" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">Nama Lengkap & Gelar: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" id="gtk_nama" placeholder="Nama Guru..." required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">NIP / NUPTK:</label>
                            <input type="text" class="form-control" name="nip" id="gtk_nip" placeholder="NIP (jika ada)...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">Jenis Kelamin:</label>
                            <select class="form-control" name="jk" id="gtk_jk">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">Jenis PTK / Jabatan:</label>
                            <input type="text" class="form-control" name="jenis_ptk" id="gtk_jenis_ptk" placeholder="Contoh: Guru Mapel, Kepala Sekolah, Staf TU">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">Mata Pelajaran yang Diampu:</label>
                            <input type="text" class="form-control" name="mapel_peg" id="gtk_mapel" placeholder="Contoh: Matematika, Bahasa Indonesia">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">Email Guru:</label>
                            <input type="email" class="form-control" name="email" id="gtk_email" placeholder="guru@smadu.sch.id">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold small">No. WhatsApp / HP:</label>
                            <input type="text" class="form-control" name="no_hp" id="gtk_hp" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label font-weight-bold small">Foto Profil:</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto profil.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveGtk" style="background:#1B2A4A; border:none;">Simpan Data Guru</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 2. Modal Siswa (Tambah / Edit) -->
<div class="modal fade" id="modalSiswa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white font-weight-bold" id="modalSiswaTitle"><i class="fa fa-graduation-cap me-2"></i> Tambah Data Siswa</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formSiswa">
                <input type="hidden" name="action" id="siswaAction" value="siswa_add">
                <input type="hidden" name="id_siswa" id="siswa_id">
                <div class="modal-body p-4">
                    <div id="alertSiswa" class="alert d-none"></div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Nama Siswa: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="Nama" id="sw_nama" placeholder="Nama lengkap siswa..." required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">NISN: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="NISN" id="sw_nisn" placeholder="Nomor NISN..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">NIPD:</label>
                            <input type="text" class="form-control" name="NIPD" id="sw_nipd" placeholder="Nomor NIPD...">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">Jenis Kelamin:</label>
                            <select class="form-control" name="JK" id="sw_jk">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">Kelas:</label>
                            <input type="text" class="form-control" name="Kelas" id="sw_kelas" placeholder="Contoh: X MIPA 1, XI IPS 2">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Desa / Kelurahan / Alamat:</label>
                        <input type="text" class="form-control" name="Kelurahan" id="sw_kelurahan" placeholder="Alamat atau nama kelurahan...">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="btnSaveSiswa">Simpan Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 3. Modal Prestasi (Tambah / Edit) -->
<div class="modal fade" id="modalPrestasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title font-weight-bold" id="modalPrestasiTitle"><i class="fa fa-trophy me-2"></i> Tambah Prestasi Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formPrestasi" enctype="multipart/form-data">
                <input type="hidden" name="action" id="prestasiAction" value="prestasi_add">
                <input type="hidden" name="id_prestasi" id="prestasi_id">
                <div class="modal-body p-4">
                    <div id="alertPrestasi" class="alert d-none"></div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Nama Kejuaraan / Lomba: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_lomba" id="pr_lomba" placeholder="Contoh: Olimpiade Matematika, Lomba Pidato Bahasa Arab..." required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">Juara yang Diraih: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="juara" id="pr_juara" placeholder="Contoh: I, II, Harapan 1..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">Nama Siswa / Tim Peraih: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="peraih" id="pr_peraih" placeholder="Nama siswa/tim..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold small">Tingkat Kejuaraan:</label>
                            <select class="form-control" name="tingkat" id="pr_tingkat">
                                <option value="Kabupaten">Kabupaten / Kota</option>
                                <option value="Karesidenan">Karesidenan</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold small">Tempat Penyelenggara:</label>
                            <input type="text" class="form-control" name="tempat" id="pr_tempat" placeholder="Contoh: Probolinggo, Malang">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold small">Tanggal Prestasi:</label>
                            <input type="date" class="form-control" name="tanggal" id="pr_tanggal">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Deskripsi Singkat:</label>
                        <textarea class="form-control" name="deskripsi" id="pr_deskripsi" rows="3" placeholder="Rincian mengenai perlombaan..."></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Foto Dokumentasi Piala / Sertifikat:</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSavePrestasi" style="background:#1B2A4A; border:none;">Simpan Prestasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 4. Modal Galeri (Upload Foto) -->
<div class="modal fade" id="modalTambahGaleri" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title text-white font-weight-bold"><i class="fa fa-picture-o me-2"></i> Upload Foto Galeri Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formGaleri" enctype="multipart/form-data">
                <input type="hidden" name="action" value="galeri_add">
                <div class="modal-body p-4">
                    <div id="alertGaleri" class="alert d-none"></div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Keterangan Foto Kegiatan: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="keterangan" placeholder="Contoh: Upacara Bendera HUT RI, Classmeeting..." required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Pilih Berkas Foto: <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="foto" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white" id="btnSaveGaleri">Upload ke Galeri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 5. Modal Download (Upload Berkas) -->
<div class="modal fade" id="modalTambahDownload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header bg-primary text-white" style="background:#1B2A4A !important;">
                <h5 class="modal-title text-white font-weight-bold"><i class="fa fa-upload me-2"></i> Upload Berkas Unduhan Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formDownload" enctype="multipart/form-data">
                <input type="hidden" name="action" value="download_add">
                <div class="modal-body p-4">
                    <div id="alertDownload" class="alert d-none"></div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Nama Dokumen / Keterangan: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_file" placeholder="Contoh: Kalender Akademik 2026/2027, Tata Tertib..." required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Pilih Berkas File (PDF, DOCX, XLS, ZIP): <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="file" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveDownload" style="background:#1B2A4A; border:none;">Upload Berkas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// =========================================================================
// HANDLER CRUD GURU
// =========================================================================
function openModalTambahGtk() {
    $('#modalGtkTitle').html('<i class="fa fa-user-plus me-2"></i> Tambah Data Guru / GTK Baru');
    $('#gtkAction').val('gtk_add');
    $('#gtk_id').prop('readonly', false);
    $('#formGtk')[0].reset();
    $('#alertGtk').addClass('d-none');
    $('#modalGtk').modal('show');
}

function editGtk(id) {
    $('#modalGtkTitle').html('<i class="fa fa-pencil me-2"></i> Edit Data Guru / GTK');
    $('#gtkAction').val('gtk_update');
    $('#alertGtk').addClass('d-none');
    
    fetch('api_crud.php?action=gtk_get&id_gtk=' + encodeURIComponent(id))
    .then(res => res.json())
    .then(res => {
        if(res.success && res.data) {
            const d = res.data;
            $('#gtk_id').val(d.id_gtk).prop('readonly', true);
            $('#gtk_nama').val(d.nama);
            $('#gtk_nip').val(d.nip);
            $('#gtk_jk').val(d.jk);
            $('#gtk_jenis_ptk').val(d.jenis_ptk);
            $('#gtk_mapel').val(d.mapel_peg);
            $('#gtk_email').val(d.email);
            $('#gtk_hp').val(d.no_hp);
            $('#modalGtk').modal('show');
        } else {
            alert(res.message);
        }
    });
}

$('#formGtk').on('submit', function(e) {
    e.preventDefault();
    const btn = $('#btnSaveGtk').prop('disabled', true).text('Menyimpan...');
    fetch('api_crud.php', { method: 'POST', body: new FormData(this) })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            alert(res.message);
            location.reload();
        } else {
            $('#alertGtk').removeClass('d-none').addClass('alert-danger').text(res.message);
            btn.prop('disabled', false).text('Simpan Data Guru');
        }
    });
});

function deleteGtk(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data Guru ini?')) {
        const fd = new FormData();
        fd.append('action', 'gtk_delete');
        fd.append('id_gtk', id);
        fetch('api_crud.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// =========================================================================
// HANDLER CRUD SISWA
// =========================================================================
function openModalTambahSiswa() {
    $('#modalSiswaTitle').html('<i class="fa fa-graduation-cap me-2"></i> Tambah Data Siswa Baru');
    $('#siswaAction').val('siswa_add');
    $('#formSiswa')[0].reset();
    $('#alertSiswa').addClass('d-none');
    $('#modalSiswa').modal('show');
}

function editSiswa(id) {
    $('#modalSiswaTitle').html('<i class="fa fa-pencil me-2"></i> Edit Data Siswa');
    $('#siswaAction').val('siswa_update');
    $('#alertSiswa').addClass('d-none');
    
    fetch('api_crud.php?action=siswa_get&id_siswa=' + id)
    .then(res => res.json())
    .then(res => {
        if(res.success && res.data) {
            const d = res.data;
            $('#siswa_id').val(d.id_siswa);
            $('#sw_nama').val(d.Nama);
            $('#sw_nisn').val(d.NISN);
            $('#sw_nipd').val(d.NIPD);
            $('#sw_jk').val(d.JK);
            $('#sw_kelas').val(d.Kelas);
            $('#sw_kelurahan').val(d.Kelurahan);
            $('#modalSiswa').modal('show');
        } else {
            alert(res.message);
        }
    });
}

$('#formSiswa').on('submit', function(e) {
    e.preventDefault();
    const btn = $('#btnSaveSiswa').prop('disabled', true).text('Menyimpan...');
    fetch('api_crud.php', { method: 'POST', body: new FormData(this) })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            alert(res.message);
            location.reload();
        } else {
            $('#alertSiswa').removeClass('d-none').addClass('alert-danger').text(res.message);
            btn.prop('disabled', false).text('Simpan Siswa');
        }
    });
});

function deleteSiswa(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
        const fd = new FormData();
        fd.append('action', 'siswa_delete');
        fd.append('id_siswa', id);
        fetch('api_crud.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// =========================================================================
// HANDLER CRUD PRESTASI
// =========================================================================
function openModalTambahPrestasi() {
    $('#modalPrestasiTitle').html('<i class="fa fa-trophy me-2"></i> Tambah Prestasi Baru');
    $('#prestasiAction').val('prestasi_add');
    $('#formPrestasi')[0].reset();
    $('#alertPrestasi').addClass('d-none');
    $('#modalPrestasi').modal('show');
}

function editPrestasi(id) {
    $('#modalPrestasiTitle').html('<i class="fa fa-pencil me-2"></i> Edit Data Prestasi');
    $('#prestasiAction').val('prestasi_update');
    $('#alertPrestasi').addClass('d-none');
    
    fetch('api_crud.php?action=prestasi_get&id_prestasi=' + id)
    .then(res => res.json())
    .then(res => {
        if(res.success && res.data) {
            const d = res.data;
            $('#prestasi_id').val(d.id_prestasi);
            $('#pr_lomba').val(d.nama_lomba);
            $('#pr_juara').val(d.juara);
            $('#pr_peraih').val(d.peraih);
            $('#pr_tingkat').val(d.tingkat);
            $('#pr_tempat').val(d.tempat);
            $('#pr_tanggal').val(d.tanggal);
            $('#pr_deskripsi').val(d.deskripsi);
            $('#modalPrestasi').modal('show');
        } else {
            alert(res.message);
        }
    });
}

$('#formPrestasi').on('submit', function(e) {
    e.preventDefault();
    const btn = $('#btnSavePrestasi').prop('disabled', true).text('Menyimpan...');
    fetch('api_crud.php', { method: 'POST', body: new FormData(this) })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            alert(res.message);
            location.reload();
        } else {
            $('#alertPrestasi').removeClass('d-none').addClass('alert-danger').text(res.message);
            btn.prop('disabled', false).text('Simpan Prestasi');
        }
    });
});

function deletePrestasi(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')) {
        const fd = new FormData();
        fd.append('action', 'prestasi_delete');
        fd.append('id_prestasi', id);
        fetch('api_crud.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// =========================================================================
// HANDLER GALERI & DOWNLOAD
// =========================================================================
$('#formGaleri').on('submit', function(e) {
    e.preventDefault();
    fetch('api_crud.php', { method: 'POST', body: new FormData(this) })
    .then(res => res.json())
    .then(res => {
        alert(res.message);
        if(res.success) location.reload();
    });
});

function deleteGaleri(id) {
    if(confirm('Hapus foto dari galeri kegiatan?')) {
        const fd = new FormData();
        fd.append('action', 'galeri_delete');
        fd.append('id_galeri', id);
        fetch('api_crud.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

$('#formDownload').on('submit', function(e) {
    e.preventDefault();
    fetch('api_crud.php', { method: 'POST', body: new FormData(this) })
    .then(res => res.json())
    .then(res => {
        alert(res.message);
        if(res.success) location.reload();
    });
});

function deleteDownload(id) {
    if(confirm('Hapus berkas dokumen ini?')) {
        const fd = new FormData();
        fd.append('action', 'download_delete');
        fd.append('id_download', id);
        fetch('api_crud.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// Quick ACC / Reject Berita handler for Ringkasan Dashboard
if (typeof window.approveBerita === 'undefined') {
    window.approveBerita = function(id) {
        if(confirm('Setujui (ACC) dan publikasikan berita / karya ini ke website publik?')) {
            const formData = new FormData();
            formData.append('action', 'approve');
            formData.append('id_berita', id);
            
            fetch('api_berita.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if(data.success) location.reload();
            });
        }
    };
}

if (typeof window.rejectBerita === 'undefined') {
    window.rejectBerita = function(id) {
        const alasan = prompt('Masukkan alasan penolakan (opsional, akan dapat dibaca oleh pengirim):', 'Perlu revisi pada isi konten atau gambar');
        if(alasan !== null) {
            const formData = new FormData();
            formData.append('action', 'reject');
            formData.append('id_berita', id);
            formData.append('catatan_admin', alasan);
            
            fetch('api_berita.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if(data.success) location.reload();
            });
        }
    };
}
</script>
