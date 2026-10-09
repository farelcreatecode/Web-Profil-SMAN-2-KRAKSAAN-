<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "config/koneksi.php";

$is_logged_in = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$current_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';
$current_nama = isset($_SESSION['user_nama']) ? $_SESSION['user_nama'] : '';
$current_user_id = isset($_SESSION['user_id']) ? strval($_SESSION['user_id']) : '';

// Tentukan tab aktif
$active_tab = (isset($_GET['tab']) && $_GET['tab'] === 'status') || (isset($_GET['page']) && $_GET['page'] === 'riwayat_posting') ? 'status' : 'kirim';
?>

<style>
.submit-berita-wrapper {
    background: #f8fafc;
    min-height: 700px;
    padding: 40px 0;
}
.nav-pills-custom .nav-link {
    font-weight: 600;
    color: #475569;
    border-radius: 12px;
    padding: 12px 24px;
    transition: all 0.3s ease;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    margin: 0 5px;
}
.nav-pills-custom .nav-link.active {
    background: #1B2A4A !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(27, 42, 74, 0.25);
    border-color: #1B2A4A;
}
.card-custom {
    border-radius: 20px;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    background: #ffffff;
    overflow: hidden;
}
.card-custom-header {
    background: linear-gradient(135deg, #1B2A4A 0%, #2A4365 100%);
    color: #ffffff;
    padding: 25px 30px;
}
.badge-role {
    font-size: 11px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.badge-role-siswa { background: #10B981; color: white; }
.badge-role-guru { background: #3B82F6; color: white; }
.badge-role-admin { background: #EF4444; color: white; }

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
}
.status-badge-pending {
    background: #FEF3C7;
    color: #92400E;
    border: 1px solid #FCD34D;
}
.status-badge-active {
    background: #D1FAE5;
    color: #065F46;
    border: 1px solid #6EE7B7;
}
.status-badge-rejected {
    background: #FEE2E2;
    color: #991B1B;
    border: 1px solid #FCA5A5;
}

.upload-box {
    border: 2px dashed #cbd5e1;
    border-radius: 16px;
    padding: 30px 20px;
    text-align: center;
    background: #f8fafc;
    cursor: pointer;
    position: relative;
    transition: all 0.2s ease;
}
.upload-box:hover {
    border-color: #1B2A4A;
    background: #f1f5f9;
}
.modern-select, .modern-input {
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    padding: 10px 14px;
}
.modern-select:focus, .modern-input:focus {
    border-color: #1B2A4A;
    box-shadow: 0 0 0 3px rgba(27, 42, 74, 0.15);
}
.jenis-selector-card {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 16px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 12px;
    background: white;
}
.jenis-selector-card:hover {
    border-color: #3B82F6;
    background: #f8fafc;
}
.jenis-selector-card.active {
    border-color: #1B2A4A;
    background: #eff6ff;
    box-shadow: 0 2px 8px rgba(27, 42, 74, 0.1);
}
.jenis-selector-card input[type="radio"] {
    display: none;
}
</style>

<div class="all-title-box">
    <div class="container text-center">
        <h1>Portal Kirim Berita & Karya Siswa-Guru<span class="m_1"><?php echo isset($t['nama_sekolah']) ? $t['nama_sekolah'] : 'SMAN 2 Kraksaan'; ?></span></h1>
    </div>
</div>

<div class="submit-berita-wrapper">
    <div class="container">
        
        <!-- Navigation Pills Tabs -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <ul class="nav nav-pills nav-pills-custom justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?= ($active_tab === 'kirim') ? 'active' : '' ?>" id="tab-kirim" data-toggle="pill" href="#paneKirim" role="tab">
                            <i class="fa fa-pencil-square-o me-2"></i> Kirim Berita & Karya
                        </a>
                    </li>
                    <?php if($is_logged_in): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($active_tab === 'status') ? 'active' : '' ?>" id="tab-status" data-toggle="pill" href="#paneStatus" role="tab">
                            <i class="fa fa-list-alt me-2"></i> Status Kiriman Saya
                            <?php
                            $user_id_esc = mysqli_real_escape_string($con, $current_user_id);
                            $user_nama_esc = mysqli_real_escape_string($con, $current_nama);
                            $count_query = mysqli_query($con, "SELECT COUNT(*) as total, SUM(CASE WHEN status='P' THEN 1 ELSE 0 END) as total_pending FROM berita WHERE user_id='$user_id_esc' OR penulis='$user_nama_esc'");
                            $c_row = mysqli_fetch_assoc($count_query);
                            $total_pending = $c_row ? intval($c_row['total_pending']) : 0;
                            if($total_pending > 0) {
                                echo '<span class="badge bg-warning text-dark ms-1" style="font-size:11px;">'.$total_pending.' Pending</span>';
                            }
                            ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <!-- TAB 1: FORM KIRIM BERITA & KARYA -->
            <div class="tab-pane fade <?= ($active_tab === 'kirim') ? 'show active' : '' ?>" id="paneKirim" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        <div class="card card-custom">
                            <div class="card-custom-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1 text-white font-weight-bold"><i class="fa fa-upload me-2"></i> Formulir Publikasi Karya & Berita</h4>
                                    <p class="mb-0 text-white-50 small">Kirim berita, artikel, puisi, dan karya poster kreasi Anda.</p>
                                </div>
                                <?php if($is_logged_in): ?>
                                    <div class="text-right">
                                        <span class="badge-role <?= ($current_role === 'siswa') ? 'badge-role-siswa' : (($current_role === 'guru') ? 'badge-role-guru' : 'badge-role-admin') ?>">
                                            <?= strtoupper($current_role) ?>
                                        </span>
                                        <div class="text-white small font-weight-bold mt-1"><?= htmlspecialchars($current_nama) ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                
                                <?php if(!$is_logged_in): ?>
                                    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                                        <i class="fa fa-info-circle fa-2x me-3 text-info"></i>
                                        <div>
                                            <strong>Tips untuk Siswa & Guru:</strong> Anda belum masuk ke akun sekolah. Disarankan <a href="#" data-toggle="modal" data-target="#login" class="alert-link font-weight-bold">Login terlebih dahulu</a> agar kiriman Anda otomatis terhubung dengan akun dan Anda dapat memantau status persetujuannya di tab <strong>Status Kiriman Saya</strong>.
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="background:#f0fdf4; border-color:#bbf7d0;">
                                        <i class="fa fa-check-circle fa-2x me-3 text-success"></i>
                                        <div>
                                            <strong>Halo, <?= htmlspecialchars($current_nama) ?>!</strong> Anda terotentikasi sebagai <strong><?= ucfirst($current_role) ?></strong>. Semua kiriman Anda akan otomatis tercatat dan dapat dipantau statusnya pada menu <strong>Status Kiriman Saya</strong>.
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div id="submitAlert" class="alert d-none" role="alert"></div>

                                <form id="formSubmitBerita" enctype="multipart/form-data">
                                    
                                    <!-- 1. Pilihan Jenis Konten (Berita vs Karya) -->
                                    <div class="form-group mb-4">
                                        <label class="form-label font-weight-bold text-dark mb-2">Pilih Jenis Konten yang Dikirim: <span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col-md-3 col-6 mb-2">
                                                <div class="jenis-selector-card active" onclick="selectJenis('berita', this)">
                                                    <input type="radio" name="jenis_konten" value="berita" checked>
                                                    <i class="fa fa-newspaper-o fa-lg text-primary"></i>
                                                    <div>
                                                        <strong class="d-block small">Berita Sekolah</strong>
                                                        <span class="text-muted" style="font-size:11px;">Kegiatan / Info</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2">
                                                <div class="jenis-selector-card" onclick="selectJenis('poster', this)">
                                                    <input type="radio" name="jenis_konten" value="poster">
                                                    <i class="fa fa-picture-o fa-lg text-success"></i>
                                                    <div>
                                                        <strong class="d-block small">Karya Poster</strong>
                                                        <span class="text-muted" style="font-size:11px;">Desain / Infografis</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2">
                                                <div class="jenis-selector-card" onclick="selectJenis('puisi', this)">
                                                    <input type="radio" name="jenis_konten" value="puisi">
                                                    <i class="fa fa-book fa-lg text-warning"></i>
                                                    <div>
                                                        <strong class="d-block small">Karya Puisi</strong>
                                                        <span class="text-muted" style="font-size:11px;">Sastra / Bait Puisi</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2">
                                                <div class="jenis-selector-card" onclick="selectJenis('karya_lainnya', this)">
                                                    <input type="radio" name="jenis_konten" value="karya_lainnya">
                                                    <i class="fa fa-lightbulb-o fa-lg text-info"></i>
                                                    <div>
                                                        <strong class="d-block small">Karya Lainnya</strong>
                                                        <span class="text-muted" style="font-size:11px;">Cerpen / Opini</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2. Judul -->
                                    <div class="form-group mb-3">
                                        <label for="judul" class="form-label font-weight-bold text-dark" id="labelJudul">Judul Berita / Karya <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control modern-input" id="judul" name="judul" placeholder="Contoh: Puisi 'Mentari di Pagi SMADU' atau Liputan Kegiatan..." required>
                                    </div>

                                    <!-- 3. Penulis & Kategori -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="penulis" class="form-label font-weight-bold text-dark">Nama Penulis / Pembuat Karya <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control modern-input" id="penulis" name="penulis" 
                                                       value="<?= htmlspecialchars($current_nama) ?>" 
                                                       placeholder="Nama lengkap penulis..." 
                                                       <?= $is_logged_in ? 'readonly style="background:#f1f5f9;"' : 'required' ?>>
                                                <?php if($is_logged_in): ?>
                                                    <small class="text-muted"><i class="fa fa-lock"></i> Terkunci sesuai akun login Anda (<?= ucfirst($current_role) ?>).</small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kategori" class="form-label font-weight-bold text-dark">Kategori</label>
                                                <select class="form-control modern-select" id="kategori" name="kategori">
                                                    <?php
                                                    $katQuery = mysqli_query($con, "SELECT * FROM kategori ORDER BY kategori ASC");
                                                    while ($kat = mysqli_fetch_array($katQuery)) {
                                                        if(!empty(trim($kat['kategori']))) {
                                                            echo '<option value="'.$kat['id_kategori'].'">'.htmlspecialchars($kat['kategori']).'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 4. Isi Konten -->
                                    <div class="form-group mb-4">
                                        <label for="isi_berita" class="form-label font-weight-bold text-dark" id="labelIsi">Isi Teks Berita / Deskripsi Karya / Bait Puisi <span class="text-danger">*</span></label>
                                        <textarea class="form-control modern-input" id="isi_berita" name="isi_berita" rows="8" placeholder="Tuliskan naskah berita, bait-bait puisi, atau penjelasan karya poster Anda di sini..." required></textarea>
                                    </div>

                                    <!-- 5. Foto / Poster Upload -->
                                    <div class="form-group mb-4">
                                        <label for="foto" class="form-label font-weight-bold text-dark" id="labelFoto">Unggah Gambar / File Poster / Dokumentasi <span id="reqFotoText" class="text-muted small font-weight-normal">(Wajib untuk karya poster)</span></label>
                                        
                                        <div class="upload-box" id="uploadArea">
                                            <i class="fa fa-cloud-upload fa-3x text-primary mb-2"></i>
                                            <h6 class="font-weight-bold mb-1">Klik atau seret gambar ke sini</h6>
                                            <p class="text-muted small mb-0">Format: JPG, PNG, GIF, WebP (Maksimal 5 MB)</p>
                                            <input type="file" id="foto" name="foto" accept="image/*" style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;cursor:pointer;">
                                        </div>
                                        
                                        <div id="previewContainer" class="mt-3 d-none p-3 border rounded bg-light text-center">
                                            <img id="previewImage" src="" alt="Pratinjau" class="img-fluid rounded shadow-sm" style="max-height: 260px; object-fit: contain;">
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removePreview()">
                                                    <i class="fa fa-trash"></i> Hapus Gambar
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Notice Reminder -->
                                    <div class="p-3 bg-light border rounded mb-4 text-center">
                                        <span class="status-badge status-badge-pending mb-2">
                                            <i class="fa fa-clock-o"></i> Status Default: TIDAK AKTIF (Menunggu ACC)
                                        </span>
                                        <p class="text-muted small mb-0">
                                            Setiap kiriman berita maupun karya akan berstatus <strong>Tidak Aktif</strong> terlebih dahulu sampai Administrator memverifikasi dan menyetujui (ACC) penerbitannya.
                                        </p>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary px-5 py-3 font-weight-bold shadow" id="btnSubmit" style="background:#1B2A4A; border:none; font-size:16px; border-radius:12px;">
                                            <i class="fa fa-paper-plane me-2"></i> Kirim untuk Ditinjau Admin
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: STATUS KIRIMAN SAYA -->
            <?php if($is_logged_in): ?>
            <div class="tab-pane fade <?= ($active_tab === 'status') ? 'show active' : '' ?>" id="paneStatus" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-lg-11 col-12">
                        <div class="card card-custom">
                            <div class="card-custom-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1 text-white font-weight-bold"><i class="fa fa-history me-2"></i> Status Kiriman & Karya Saya</h4>
                                    <p class="mb-0 text-white-50 small">Pantau status publikasi karya dan berita yang pernah Anda ajukan.</p>
                                </div>
                                <a href="index.php?page=submit_berita&tab=kirim" class="btn btn-light btn-sm font-weight-bold">
                                    <i class="fa fa-plus me-1"></i> Buat Kiriman Baru
                                </a>
                            </div>
                            <div class="card-body p-4">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 50px;">No</th>
                                                <th>Pratinjau</th>
                                                <th>Judul & Jenis</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Unggah</th>
                                                <th class="text-center">Indikator Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $q_my = mysqli_query($con, "SELECT b.*, k.kategori as nama_kategori 
                                                                        FROM berita b 
                                                                        LEFT JOIN kategori k ON b.kategori = k.id_kategori 
                                                                        WHERE b.user_id='$user_id_esc' OR b.penulis='$user_nama_esc' 
                                                                        ORDER BY b.id_berita DESC");
                                            
                                            if($q_my && mysqli_num_rows($q_my) > 0):
                                                while($row = mysqli_fetch_assoc($q_my)):
                                                    $jenis_badge = 'Berita';
                                                    if($row['jenis_konten'] === 'poster') $jenis_badge = '🎨 Poster';
                                                    elseif($row['jenis_konten'] === 'puisi') $jenis_badge = '✍️ Puisi';
                                                    elseif($row['jenis_konten'] === 'karya_lainnya') $jenis_badge = '📝 Karya Lainnya';

                                                    $foto_src = (!empty($row['foto']) && file_exists('img/' . $row['foto'])) ? 'img/' . $row['foto'] : 'img/default_berita.jpg';
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <img src="<?= $foto_src ?>" alt="Thumbnail" class="rounded shadow-sm" style="width: 65px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td>
                                                    <div class="font-weight-bold text-dark"><?= htmlspecialchars($row['judul']) ?></div>
                                                    <span class="badge bg-light text-dark border mt-1" style="font-size:11px;"><?= $jenis_badge ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-muted small"><?= htmlspecialchars($row['nama_kategori'] ? $row['nama_kategori'] : '-') ?></span>
                                                </td>
                                                <td>
                                                    <small class="text-muted"><i class="fa fa-calendar me-1"></i> <?= $row['tanggal'] ?></small>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($row['status'] === 'P'): ?>
                                                        <span class="status-badge status-badge-pending">
                                                            <i class="fa fa-hourglass-half"></i> Tidak Aktif (Menunggu ACC)
                                                        </span>
                                                    <?php elseif($row['status'] === 'Y' || $row['status'] === 'A' || $row['status'] === '1'): ?>
                                                        <span class="status-badge status-badge-active">
                                                            <i class="fa fa-check-circle"></i> Aktif (Diterbitkan)
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="status-badge status-badge-rejected" title="<?= htmlspecialchars($row['catatan_admin'] ? $row['catatan_admin'] : 'Tidak disetujui') ?>">
                                                            <i class="fa fa-times-circle"></i> Ditolak
                                                        </span>
                                                        <?php if(!empty($row['catatan_admin'])): ?>
                                                            <div class="text-danger small mt-1" style="font-size:11px;">Alasan: <?= htmlspecialchars($row['catatan_admin']) ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($row['status'] === 'Y' || $row['status'] === 'A' || $row['status'] === '1'): ?>
                                                        <a href="index.php?page=detail&id=<?= $row['id_berita'] ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat di Web">
                                                            <i class="fa fa-external-link"></i> Lihat
                                                        </a>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="viewDetail(<?= $row['id_berita'] ?>)" title="Pratinjau Kiriman">
                                                            <i class="fa fa-eye"></i> Detail
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php 
                                                endwhile;
                                            else:
                                            ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <i class="fa fa-folder-open-o fa-3x text-muted mb-3 d-block"></i>
                                                    <h6 class="text-muted font-weight-bold">Belum Ada Kiriman</h6>
                                                    <p class="text-muted small mb-3">Anda belum pernah mengajukan berita atau karya.</p>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('tab-kirim').click();" style="background:#1B2A4A; border:none;">
                                                        <i class="fa fa-pencil me-1"></i> Mulai Kirim Karya Sekarang
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Pratinjau Detail Kiriman -->
<div class="modal fade" id="modalDetailKiriman" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">
            <div class="modal-header bg-primary text-white" style="background:#1B2A4A !important;">
                <h5 class="modal-title text-white mb-0" id="detailModalTitle"><i class="fa fa-eye me-2"></i> Pratinjau Kiriman</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="detailModalBody">
                <div class="text-center py-4"><i class="fa fa-spinner fa-spin fa-2x"></i> Memuat...</div>
            </div>
        </div>
    </div>
</div>

<script>
// Selector jenis konten
function selectJenis(jenis, el) {
    document.querySelectorAll('.jenis-selector-card').forEach(card => card.classList.remove('active'));
    el.classList.add('active');
    el.querySelector('input[type="radio"]').checked = true;

    const lblJudul = document.getElementById('labelJudul');
    const lblIsi = document.getElementById('labelIsi');
    const txtArea = document.getElementById('isi_berita');
    const reqFoto = document.getElementById('reqFotoText');

    if (jenis === 'poster') {
        lblJudul.innerHTML = 'Judul Poster / Karya Seni Visual <span class="text-danger">*</span>';
        lblIsi.innerHTML = 'Deskripsi Singkat Karya Poster <span class="text-danger">*</span>';
        txtArea.placeholder = 'Jelaskan tema, makna filosofi, atau pesan moral dari poster kreasi Anda...';
        reqFoto.className = 'text-danger small font-weight-bold';
        reqFoto.textContent = '(Wajib melampirkan berkas gambar poster)';
    } else if (jenis === 'puisi') {
        lblJudul.innerHTML = 'Judul Puisi / Karya Sastra <span class="text-danger">*</span>';
        lblIsi.innerHTML = 'Bait-Bait Puisi / Naskah Sastra <span class="text-danger">*</span>';
        txtArea.placeholder = 'Tuliskan bait-bait puisi Anda dengan rapi di sini...\n\nBait 1...\n\nBait 2...';
        reqFoto.className = 'text-muted small font-weight-normal';
        reqFoto.textContent = '(Opsional - Gambar ilustrasi pendukung)';
    } else {
        lblJudul.innerHTML = 'Judul Berita Sekolah <span class="text-danger">*</span>';
        lblIsi.innerHTML = 'Isi Berita Lengkap <span class="text-danger">*</span>';
        txtArea.placeholder = 'Tulis isi liputan berita di sini...';
        reqFoto.className = 'text-muted small font-weight-normal';
        reqFoto.textContent = '(Opsional - Foto dokumentasi kegiatan)';
    }
}

// Image Preview
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewContainer').classList.remove('d-none');
            document.getElementById('uploadArea').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('foto').value = '';
    document.getElementById('previewContainer').classList.add('d-none');
    document.getElementById('uploadArea').style.display = 'block';
}

// Form Submit Handler
document.getElementById('formSubmitBerita').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmit');
    const alertBox = document.getElementById('submitAlert');
    
    // Validasi gambar jika memilih poster
    const jenis = document.querySelector('input[name="jenis_konten"]:checked').value;
    const fileInput = document.getElementById('foto');
    if (jenis === 'poster' && fileInput.files.length === 0) {
        alertBox.classList.remove('d-none', 'alert-success');
        alertBox.classList.add('alert-danger');
        alertBox.innerHTML = '<i class="fa fa-exclamation-circle"></i> Untuk jenis <strong>Karya Poster</strong>, Anda wajib mengunggah file gambar poster kreasi Anda!';
        window.scrollTo({top: 0, behavior: 'smooth'});
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Mengirim berkas...';
    
    const formData = new FormData(this);
    formData.append('action', 'submit');
    
    fetch('api_berita.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alertBox.classList.remove('d-none', 'alert-danger', 'alert-success');
        if (data.success) {
            alertBox.classList.add('alert-success');
            alertBox.innerHTML = '<i class="fa fa-check-circle me-1"></i> ' + data.message + ' <br><small class="mt-1 d-block">Status awal kiriman Anda adalah <strong>Tidak Aktif</strong> dan akan dipublikasikan setelah Administrator meng-ACC.</small>';
            document.getElementById('formSubmitBerita').reset();
            removePreview();
            
            // Jika ada tab status, reload setelah 2 detik
            <?php if($is_logged_in): ?>
            setTimeout(() => {
                window.location.href = 'index.php?page=submit_berita&tab=status';
            }, 2000);
            <?php endif; ?>
        } else {
            alertBox.classList.add('alert-danger');
            alertBox.innerHTML = '<i class="fa fa-exclamation-circle me-1"></i> ' + data.message;
        }
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-paper-plane me-2"></i> Kirim untuk Ditinjau Admin';
        window.scrollTo({top: 0, behavior: 'smooth'});
    })
    .catch(err => {
        alertBox.classList.remove('d-none', 'alert-success');
        alertBox.classList.add('alert-danger');
        alertBox.innerHTML = '<i class="fa fa-exclamation-circle me-1"></i> Terjadi kesalahan jaringan. Silakan coba kembali.';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-paper-plane me-2"></i> Kirim untuk Ditinjau Admin';
    });
});

// View Detail Modal
function viewDetail(id) {
    $('#modalDetailKiriman').modal('show');
    const body = document.getElementById('detailModalBody');
    body.innerHTML = '<div class="text-center py-4"><i class="fa fa-spinner fa-spin fa-2x"></i> Memuat...</div>';
    
    fetch('api_berita.php?action=get_detail&id_berita=' + id)
    .then(res => res.json())
    .then(res => {
        if(res.success && res.data) {
            const d = res.data;
            let statusBadge = '';
            if(d.status === 'P') {
                statusBadge = '<span class="status-badge status-badge-pending"><i class="fa fa-hourglass-half"></i> Tidak Aktif (Menunggu ACC)</span>';
            } else if(d.status === 'Y' || d.status === 'A' || d.status === '1') {
                statusBadge = '<span class="status-badge status-badge-active"><i class="fa fa-check-circle"></i> Aktif (Diterbitkan)</span>';
            } else {
                statusBadge = '<span class="status-badge status-badge-rejected"><i class="fa fa-times-circle"></i> Ditolak</span>';
            }
            
            let imgHtml = '';
            if(d.foto && d.foto !== '') {
                imgHtml = `<div class="text-center mb-3">
                    <img src="img/${d.foto}" class="img-fluid rounded shadow-sm" style="max-height:300px;" alt="${d.judul}">
                </div>`;
            }

            body.innerHTML = `
                ${imgHtml}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-secondary">${d.jenis_konten ? d.jenis_konten.toUpperCase() : 'BERITA'}</span>
                    ${statusBadge}
                </div>
                <h4 class="font-weight-bold mb-2">${d.judul}</h4>
                <p class="text-muted small mb-3">
                    <i class="fa fa-user me-1"></i> Penulis: <strong>${d.penulis}</strong> | 
                    <i class="fa fa-calendar me-1"></i> ${d.tanggal} | 
                    <i class="fa fa-tag me-1"></i> ${d.nama_kategori || '-'}
                </p>
                <div class="p-3 bg-light rounded border mb-3" style="white-space: pre-wrap; font-family: inherit;">${d.isi_berita}</div>
                ${d.catatan_admin ? `<div class="alert alert-danger py-2 px-3 small"><strong>Catatan Admin:</strong> ${d.catatan_admin}</div>` : ''}
            `;
        } else {
            body.innerHTML = '<div class="alert alert-danger">Gagal memuat detail data.</div>';
        }
    })
    .catch(() => {
        body.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan koneksi.</div>';
    });
}
</script>
