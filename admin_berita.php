<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "<script>alert('Silakan login terlebih dahulu sebagai Administrator!'); window.location.href='index.php?page=home';</script>";
    exit;
}

include_once "config/koneksi.php";
?>

<style>
.btn-admin-action {
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 12px;
}
.badge-jenis {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 8px;
    border-radius: 6px;
}
.badge-role-tag {
    font-size: 10px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 4px;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <p class="text-muted small mb-0"><i class="fa fa-info-circle text-primary mr-1"></i> Kelola publikasi artikel, berita sekolah, serta karya siswa dan guru.</p>
    </div>
    <div>
        <button type="button" class="btn btn-sm btn-success font-weight-bold" data-toggle="modal" data-target="#modalUploadAdmin" style="border-radius:6px; padding: 7px 14px;">
            <i class="fa fa-plus-circle mr-1"></i> Upload Berita Baru
        </button>
    </div>
</div>

<!-- Tabel 1: Kiriman Pending (Menunggu Persetujuan) -->
<div class="row">
    <div class="col-12">
        <div class="admin-main-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark">
                        <i class="fa fa-clock-o mr-1 text-warning"></i> Kiriman Pending (Menunggu Persetujuan)
                    </h5>
                    <small class="text-muted">Konten berstatus belum dipublikasikan hingga Anda menyetujui.</small>
                </div>
                <?php
                $q_count_p = mysqli_query($con, "SELECT COUNT(*) as tot FROM berita WHERE status='P'");
                $tot_p = mysqli_fetch_assoc($q_count_p)['tot'];
                ?>
                <span class="badge" style="background:#FEF3C7; color:#92400E; border:1px solid #FDE68A; font-weight:700; padding:5px 12px; border-radius:12px; font-size:11.5px;">
                    <?= $tot_p ?> Kiriman Perlu Review
                </span>
            </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 80px;">Media</th>
                                        <th>Judul & Jenis</th>
                                        <th>Pengirim / Penulis</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th class="text-center" style="width: 220px;">Aksi Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query_pending = mysqli_query($con, "SELECT b.*, k.kategori as nama_kategori 
                                                                         FROM berita b 
                                                                         LEFT JOIN kategori k ON b.kategori = k.id_kategori 
                                                                         WHERE b.status='P' 
                                                                         ORDER BY b.id_berita DESC");
                                    if(mysqli_num_rows($query_pending) > 0):
                                        while($bp = mysqli_fetch_array($query_pending)):
                                            $judul_p = !empty($bp['judul']) ? $bp['judul'] : (isset($bp['berita']) ? $bp['berita'] : 'Tanpa Judul');
                                            $foto_p = (!empty($bp['foto']) && file_exists('img/' . $bp['foto'])) ? 'img/' . $bp['foto'] : 'img/default_berita.jpg';
                                            
                                            $jenis_label = 'Berita';
                                            $jenis_class = 'bg-primary text-white';
                                            if($bp['jenis_konten'] === 'poster') {
                                                $jenis_label = '🎨 Poster';
                                                $jenis_class = 'bg-success text-white';
                                            } elseif($bp['jenis_konten'] === 'puisi') {
                                                $jenis_label = '✍️ Puisi';
                                                $jenis_class = 'bg-warning text-dark';
                                            } elseif($bp['jenis_konten'] === 'karya_lainnya') {
                                                $jenis_label = '📝 Karya Lainnya';
                                                $jenis_class = 'bg-info text-white';
                                            }

                                            $role_label = !empty($bp['role_pengirim']) ? strtoupper($bp['role_pengirim']) : 'UMUM';
                                            $role_class = ($role_label === 'SISWA') ? 'bg-success text-white' : (($role_label === 'GURU') ? 'bg-info text-white' : 'bg-secondary text-white');
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <img src="<?= $foto_p ?>" alt="Thumb" class="rounded shadow-sm" style="width: 65px; height: 50px; object-fit: cover; cursor:pointer;" onclick="previewModal(<?= $bp['id_berita'] ?>)">
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-dark mb-1" style="font-size: 15px;"><?= htmlspecialchars($judul_p) ?></div>
                                            <span class="badge-jenis <?= $jenis_class ?>"><?= $jenis_label ?></span>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-dark"><?= htmlspecialchars($bp['penulis']) ?></div>
                                            <span class="badge-role-tag <?= $role_class ?>"><?= $role_label ?></span>
                                        </td>
                                        <td>
                                            <span class="text-muted small"><?= htmlspecialchars($bp['nama_kategori'] ? $bp['nama_kategori'] : '-') ?></span>
                                        </td>
                                        <td>
                                            <small class="text-muted"><i class="fa fa-calendar me-1"></i> <?= $bp['tanggal'] ?></small>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info text-white btn-admin-action me-1" onclick="previewModal(<?= $bp['id_berita'] ?>)" title="Pratinjau Lengkap">
                                                <i class="fa fa-eye"></i> Detail
                                            </button>
                                            <button class="btn btn-sm btn-success btn-admin-action me-1" onclick="approveBerita(<?= $bp['id_berita'] ?>)" title="Setujui (ACC)">
                                                <i class="fa fa-check"></i> ACC
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-admin-action" onclick="rejectBerita(<?= $bp['id_berita'] ?>)" title="Tolak">
                                                <i class="fa fa-times"></i> Tolak
                                            </button>
                                        </td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fa fa-check-circle-o fa-3x text-success mb-2 d-block"></i>
                                            <p class="text-muted mb-0">Tidak ada kiriman berita atau karya pending. Semua kiriman telah diproses.</p>
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

        <!-- Tabel 2: Semua Berita Dipublikasi / Ditolak -->
        <div class="row">
            <div class="col-12">
                <div class="admin-main-card">
                    <div class="admin-card-header">
                        <div>
                            <h5 class="mb-1 font-weight-bold text-dark">
                                <i class="fa fa-archive me-2 text-primary"></i> Arsip Berita & Karya (Dipublikasikan / Ditolak)
                            </h5>
                            <small class="text-muted">Daftar seluruh kiriman yang sudah disetujui (ACC) atau ditolak.</small>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabelBeritaSemua">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 80px;">Media</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th class="text-center" style="width: 160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query_semua = mysqli_query($con, "SELECT b.*, k.kategori as nama_kategori 
                                                                       FROM berita b 
                                                                       LEFT JOIN kategori k ON b.kategori = k.id_kategori 
                                                                       WHERE b.status != 'P' 
                                                                       ORDER BY b.id_berita DESC");
                                    if(mysqli_num_rows($query_semua) > 0):
                                        while($bs = mysqli_fetch_array($query_semua)):
                                            $judul_s = !empty($bs['judul']) ? $bs['judul'] : (isset($bs['berita']) ? $bs['berita'] : 'Tanpa Judul');
                                            $foto_s = (!empty($bs['foto']) && file_exists('img/' . $bs['foto'])) ? 'img/' . $bs['foto'] : 'img/default_berita.jpg';
                                            
                                            $is_published = ($bs['status'] === 'Y' || $bs['status'] === 'A' || $bs['status'] === '1');
                                            $badge = $is_published 
                                                ? '<span class="badge bg-success text-white px-2 py-1"><i class="fa fa-check-circle me-1"></i> Published</span>' 
                                                : '<span class="badge bg-danger text-white px-2 py-1"><i class="fa fa-ban me-1"></i> Ditolak</span>';
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <img src="<?= $foto_s ?>" alt="Thumb" class="rounded shadow-sm" style="width: 60px; height: 45px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-dark"><?= htmlspecialchars($judul_s) ?></div>
                                            <small class="text-muted"><?= htmlspecialchars($bs['nama_kategori'] ? $bs['nama_kategori'] : '-') ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($bs['penulis']) ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= ucfirst($bs['jenis_konten'] ? $bs['jenis_konten'] : 'berita') ?></span>
                                        </td>
                                        <td><?= $badge ?></td>
                                        <td><small class="text-muted"><?= $bs['tanggal'] ?></small></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="previewModal(<?= $bs['id_berita'] ?>)" title="Pratinjau">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="deleteBerita(<?= $bs['id_berita'] ?>)" title="Hapus Permanen">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4">Belum ada data berita yang dipublikasikan atau ditolak.</td>
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

<!-- MODAL 1: PREVIEW / PRATINJAU DETAIL KIRIMAN -->
<div class="modal fade" id="modalPreviewAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">
            <div class="modal-header bg-primary text-white" style="background:#1B2A4A !important;">
                <h5 class="modal-title text-white mb-0"><i class="fa fa-newspaper-o me-2"></i> Pratinjau Lengkap Kiriman</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="modalPreviewBody">
                <div class="text-center py-5"><i class="fa fa-spinner fa-spin fa-2x"></i> Memuat berkas...</div>
            </div>
            <div class="modal-footer bg-light" id="modalPreviewFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: UPLOAD BERITA / KARYA LANGSUNG OLEH ADMIN (TARGET 2) -->
<div class="modal fade" id="modalUploadAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius:18px; overflow:hidden;">
            <div class="modal-header bg-primary text-white" style="background:#1B2A4A !important;">
                <h5 class="modal-title text-white mb-0">
                    <i class="fa fa-cloud-upload me-2"></i> Upload Berita / Publikasi Karya Baru (Admin)
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAdminUpload" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div id="adminUploadAlert" class="alert d-none" role="alert"></div>

                    <div class="alert alert-info py-2 px-3 small mb-3">
                        <i class="fa fa-info-circle me-1"></i> Berita atau karya yang diupload melalui formulir ini akan <strong>langsung berstatus AKTIF (Diterbitkan)</strong>. Anda juga dapat mengunggah berkas yang dititipkan oleh guru atau siswa.
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">Jenis Konten: <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_konten" id="adminJenisKonten" required>
                                <option value="berita">📰 Berita Sekolah</option>
                                <option value="poster">🎨 Karya Poster / Desain</option>
                                <option value="puisi">✍️ Karya Puisi / Sastra</option>
                                <option value="karya_lainnya">📝 Karya Lainnya / Opini</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold small">Kategori: <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori" required>
                                <?php
                                $katQ = mysqli_query($con, "SELECT * FROM kategori ORDER BY kategori ASC");
                                while($k = mysqli_fetch_array($katQ)) {
                                    if(!empty(trim($k['kategori']))) {
                                        echo '<option value="'.$k['id_kategori'].'">'.htmlspecialchars($k['kategori']).'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Judul Berita / Karya: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul" placeholder="Masukkan judul..." required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Nama Penulis / Pembuat Karya: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="penulis" value="Administrator" placeholder="Nama penulis atau nama siswa/guru yang menitipkan..." required>
                        <small class="text-muted">Dapat diisi nama Admin, atau nama siswa/guru yang menitipkan karya/berita.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Isi Berita / Bait Puisi / Deskripsi Karya: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="isi_berita" rows="6" placeholder="Tuliskan isi naskah di sini..." required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small">Unggah Gambar / Poster:</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF, WebP (Maksimal 5 MB).</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitAdminUpload" style="background:#1B2A4A; border:none;">
                        <i class="fa fa-cloud-upload me-1"></i> Publikasikan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// 1. Preview Modal
function previewModal(id) {
    $('#modalPreviewAdmin').modal('show');
    const body = document.getElementById('modalPreviewBody');
    const footer = document.getElementById('modalPreviewFooter');
    
    body.innerHTML = '<div class="text-center py-5"><i class="fa fa-spinner fa-spin fa-2x text-primary"></i><div class="mt-2 text-muted">Memuat data kiriman...</div></div>';
    footer.innerHTML = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';

    fetch('api_berita.php?action=get_detail&id_berita=' + id)
    .then(res => res.json())
    .then(res => {
        if(res.success && res.data) {
            const d = res.data;
            let statusBadge = '';
            if(d.status === 'P') {
                statusBadge = '<span class="badge bg-warning text-dark px-3 py-1 font-weight-bold"><i class="fa fa-clock-o me-1"></i> PENDING (Tidak Aktif)</span>';
            } else if(d.status === 'Y' || d.status === 'A' || d.status === '1') {
                statusBadge = '<span class="badge bg-success text-white px-3 py-1 font-weight-bold"><i class="fa fa-check-circle me-1"></i> PUBLISHED (Aktif)</span>';
            } else {
                statusBadge = '<span class="badge bg-danger text-white px-3 py-1 font-weight-bold"><i class="fa fa-times-circle me-1"></i> DITOLAK</span>';
            }

            let imgHtml = '';
            if(d.foto && d.foto !== '') {
                imgHtml = `<div class="text-center mb-3 bg-light p-3 rounded">
                    <img src="img/${d.foto}" class="img-fluid rounded shadow-sm" style="max-height: 380px; object-fit: contain;" alt="${d.judul}">
                </div>`;
            }

            body.innerHTML = `
                ${imgHtml}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-primary px-2 py-1">${(d.jenis_konten || 'BERITA').toUpperCase()}</span>
                    ${statusBadge}
                </div>
                <h4 class="font-weight-bold mb-2">${d.judul}</h4>
                <div class="p-2 bg-light rounded text-muted small mb-3">
                    <i class="fa fa-user me-1 text-primary"></i> Penulis: <strong>${d.penulis}</strong> (${d.role_pengirim ? d.role_pengirim.toUpperCase() : 'UMUM'}) | 
                    <i class="fa fa-calendar me-1 text-info"></i> Tanggal: ${d.tanggal} | 
                    <i class="fa fa-tag me-1 text-success"></i> Kategori: ${d.nama_kategori || '-'}
                </div>
                <div class="p-3 bg-white border rounded mb-3" style="white-space: pre-wrap; font-family: inherit; line-height: 1.7; font-size: 15px;">${d.isi_berita}</div>
                ${d.catatan_admin ? `<div class="alert alert-danger py-2 px-3 small"><strong>Catatan Penolakan:</strong> ${d.catatan_admin}</div>` : ''}
            `;

            if(d.status === 'P') {
                footer.innerHTML = `
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" onclick="rejectBerita(${d.id_berita})">
                        <i class="fa fa-times me-1"></i> Tolak Kiriman Ini
                    </button>
                    <button type="button" class="btn btn-success" onclick="approveBerita(${d.id_berita})">
                        <i class="fa fa-check me-1"></i> Setujui & Publikasikan (ACC)
                    </button>
                `;
            } else {
                footer.innerHTML = `<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>`;
            }
        } else {
            body.innerHTML = '<div class="alert alert-danger">Gagal memuat rincian data.</div>';
        }
    })
    .catch(() => {
        body.innerHTML = '<div class="alert alert-danger">Terjadi gangguan koneksi data.</div>';
    });
}

// 2. Approve Berita
function approveBerita(id) {
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
}

// 3. Reject Berita
function rejectBerita(id) {
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
}

// 4. Delete Berita
function deleteBerita(id) {
    if(confirm('Apakah Anda yakin ingin menghapus berita / karya ini secara permanen?')) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id_berita', id);
        
        fetch('api_berita.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success) location.reload();
        });
    }
}

// 5. Submit Admin Direct Upload
document.getElementById('formAdminUpload').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmitAdminUpload');
    const alertBox = document.getElementById('adminUploadAlert');

    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Mengunggah...';

    const formData = new FormData(this);
    formData.append('action', 'admin_upload');

    fetch('api_berita.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alertBox.classList.remove('d-none', 'alert-danger', 'alert-success');
        if (data.success) {
            alertBox.classList.add('alert-success');
            alertBox.innerHTML = '<i class="fa fa-check-circle me-1"></i> ' + data.message;
            setTimeout(() => {
                location.reload();
            }, 1200);
        } else {
            alertBox.classList.add('alert-danger');
            alertBox.innerHTML = '<i class="fa fa-exclamation-circle me-1"></i> ' + data.message;
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-cloud-upload me-1"></i> Publikasikan Sekarang';
        }
    })
    .catch(() => {
        alertBox.classList.remove('d-none', 'alert-success');
        alertBox.classList.add('alert-danger');
        alertBox.innerHTML = '<i class="fa fa-exclamation-circle me-1"></i> Terjadi kesalahan komunikasi server.';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-cloud-upload me-1"></i> Publikasikan Sekarang';
    });
});
</script>
