<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='index.php?page=home';</script>";
    exit;
}

include_once "config/koneksi.php";
?>

<div class="row">
    <div class="col-12">
        <div class="admin-main-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="mb-1 font-weight-bold text-dark">
                        <i class="fa fa-users text-primary me-2"></i> Data Pendaftar SPMB Online
                    </h5>
                    <small class="text-muted">Daftar calon siswa baru yang telah mendaftar melalui formulir online.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <?php 
                    $c = mysqli_query($con, "SELECT COUNT(*) as t FROM pendaftaran_spmb");
                    $cr = mysqli_fetch_assoc($c);
                    $tot_pendaftar = $cr['t'];
                    ?>
                    <span class="badge bg-primary text-white font-weight-bold px-3 py-2 rounded-pill">Total: <?= $tot_pendaftar ?> Calon Siswa</span>
                    <a href="export_spmb.php" class="btn btn-success font-weight-bold shadow-sm">
                        <i class="fa fa-file-excel-o me-1"></i> Export Excel (.xls)
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>No. Pendaftaran</th>
                                <th>Nama Lengkap</th>
                                <th>NISN</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan</th>
                                <th>No. WhatsApp</th>
                                <th>Tanggal Daftar</th>
                                <th class="text-center" style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query_spmb = mysqli_query($con, "SELECT * FROM pendaftaran_spmb ORDER BY id_pendaftaran DESC");
                            if(mysqli_num_rows($query_spmb) > 0) {
                                while($s = mysqli_fetch_array($query_spmb)) {
                                    $clean_hp = preg_replace('/[^0-9]/', '', $s['no_hp']);
                                    if (substr($clean_hp, 0, 1) === '0') $clean_hp = '62' . substr($clean_hp, 1);
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><span class="badge bg-light text-dark border font-weight-bold"><?= htmlspecialchars($s['no_pendaftaran']) ?></span></td>
                                <td class="font-weight-bold text-dark"><?= htmlspecialchars($s['nama_lengkap']) ?></td>
                                <td><?= $s['nisn'] ? htmlspecialchars($s['nisn']) : '<span class="text-muted">-</span>' ?></td>
                                <td><?= htmlspecialchars($s['asal_sekolah']) ?></td>
                                <td><span class="badge bg-primary text-white"><?= htmlspecialchars($s['jurusan']) ?></span></td>
                                <td>
                                    <a href="https://wa.me/<?= $clean_hp ?>?text=Halo%20<?= urlencode($s['nama_lengkap']) ?>,%20kami%20dari%20panitia%20SPMB%20SMAN%202%20Kraksaan..." target="_blank" class="btn btn-sm btn-outline-success font-weight-bold">
                                        <i class="fa fa-whatsapp me-1"></i> <?= htmlspecialchars($s['no_hp']) ?>
                                    </a>
                                </td>
                                <td><small class="text-muted"><?= date('d M Y H:i', strtotime($s['tanggal_daftar'])) ?></small></td>
                                <td class="text-center">
                                    <a href="cetak_spmb.php?no_pendaftaran=<?= urlencode($s['no_pendaftaran']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="Cetak Bukti">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteSpmb(<?= $s['id_pendaftaran'] ?>)" title="Hapus Data">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center py-5 text-muted'><i class='fa fa-inbox fa-3x text-muted mb-2 d-block'></i>Belum ada calon siswa yang mendaftar online.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteSpmb(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id_pendaftaran', id);
        
        fetch('api_spmb.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success) location.reload();
        });
    }
}
</script>
