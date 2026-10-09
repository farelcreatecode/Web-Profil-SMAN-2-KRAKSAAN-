<?php
// cetak_spmb.php - Official Print / PDF Registration Card
include_once "config/koneksi.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$no_pendaftaran = isset($_GET['no']) ? mysqli_real_escape_string($con, $_GET['no']) : '';

$where = $id > 0 ? "id_pendaftaran='$id'" : "no_pendaftaran='$no_pendaftaran'";
$q = mysqli_query($con, "SELECT * FROM pendaftaran_spmb WHERE $where");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Data pendaftaran tidak ditemukan.</h2>";
    exit;
}

$identitas = mysqli_query($con, "SELECT * FROM identitas WHERE id_identitas='1'");
$t = mysqli_fetch_assoc($identitas);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - <?= $data['no_pendaftaran'] ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; font-family: 'Arial', sans-serif; color: #333; }
        .card-print { background: #fff; border: 2px solid #1B2A4A; border-radius: 12px; max-width: 750px; margin: 30px auto; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .header-print { border-bottom: 3px double #1B2A4A; padding-bottom: 15px; margin-bottom: 20px; text-align: center; }
        .header-print h2 { color: #1B2A4A; font-weight: bold; margin: 0; font-size: 24px; text-transform: uppercase; }
        .header-print h4 { color: #eea412; font-size: 16px; margin: 5px 0 0; }
        .header-print p { font-size: 12px; margin: 0; color: #666; }
        .badge-no { background: #1B2A4A; color: #fff; font-size: 18px; padding: 8px 20px; border-radius: 50px; display: inline-block; margin-bottom: 20px; }
        .table-data th { width: 35%; background: #f1f5f9; }
        .table-data td, .table-data th { padding: 10px 15px; vertical-align: middle; }
        @media print {
            .no-print { display: none !important; }
            .card-print { border: none; box-shadow: none; margin: 0; max-width: 100%; }
            body { background: #fff; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card-print">
        <div class="header-print">
            <h2><?= $t['nama_sekolah'] ?></h2>
            <h4>PANITIA PENERIMAAN MURID BARU (SPMB) TAHUN AJARAN <?= date('Y'); ?>/<?= date('Y')+1; ?></h4>
            <p><?= $t['alamat'] ?> | Telp: <?= $t['no_telp'] ?> | Email: <?= $t['email'] ?></p>
        </div>
        
        <div class="text-center">
            <span class="badge-no">NO. PENDAFTARAN: <?= $data['no_pendaftaran'] ?></span>
        </div>
        
        <h5 class="fw-bold mb-3 text-uppercase text-secondary border-bottom pb-2">Data Calon Siswa Baru</h5>
        
        <table class="table table-bordered table-data">
            <tr>
                <th>Nama Lengkap</th>
                <td class="fw-bold text-uppercase"><?= htmlspecialchars($data['nama_lengkap']) ?></td>
            </tr>
            <tr>
                <th>NISN</th>
                <td><?= $data['nisn'] ? htmlspecialchars($data['nisn']) : '-' ?></td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td><?= htmlspecialchars($data['asal_sekolah']) ?></td>
            </tr>
            <tr>
                <th>Pilihan Jurusan</th>
                <td><strong class="text-primary"><?= htmlspecialchars($data['jurusan']) ?></strong></td>
            </tr>
            <tr>
                <th>No. WhatsApp / HP</th>
                <td><?= htmlspecialchars($data['no_hp']) ?></td>
            </tr>
            <tr>
                <th>Alamat Rumah</th>
                <td><?= nl2br(htmlspecialchars($data['alamat'])) ?></td>
            </tr>
            <tr>
                <th>Tanggal Pendaftaran</th>
                <td><?= date('d F Y, H:i', strtotime($data['tanggal_daftar'])) ?> WIB</td>
            </tr>
        </table>
        
        <div class="mt-4 p-3 bg-light rounded text-muted" style="font-size:12px;">
            <strong>Catatan untuk Calon Siswa:</strong>
            <ol class="mb-0 ps-3">
                <li>Simpan lembar bukti pendaftaran ini sebagai bukti verifikasi ulang saat masuk sekolah.</li>
                <li>Panitia SPMB akan menghubungi Anda via WhatsApp untuk jadwal tes & seragam.</li>
            </ol>
        </div>
        
        <div class="row mt-4 pt-3 align-items-center">
            <div class="col-6 text-center">
                <p class="mb-5">Calon Siswa Baru,</p>
                <p class="fw-bold text-uppercase border-bottom d-inline-block pb-1"><?= htmlspecialchars($data['nama_lengkap']) ?></p>
            </div>
            <div class="col-6 text-center">
                <p class="mb-0">Kraksaan, <?= date('d F Y', strtotime($data['tanggal_daftar'])) ?></p>
                <p class="mb-5">Panitia SPMB,</p>
                <p class="fw-bold text-uppercase border-bottom d-inline-block pb-1">PANITIA SPMB <?= $t['nama_sekolah'] ?></p>
            </div>
        </div>
        
        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary btn-lg me-2" style="background:#1B2A4A; border:none;">
                <i class="fa fa-print"></i> Cetak / Simpan PDF
            </button>
            <a href="index.php?page=spmb" class="btn btn-secondary btn-lg">Kembali</a>
        </div>
    </div>
</div>

</body>
</html>
