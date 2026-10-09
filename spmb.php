<div class="all-title-box">
    <div class="container text-center">
        <h1>SPMB Online<span class="m_1">Sistem Penerimaan Murid Baru - <?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="message-box">
                    <h4>Penerimaan Murid Baru Tahun Ajaran <?php echo date('Y'); ?>/<?php echo date('Y')+1; ?></h4>
                    <h2>Bergabunglah Bersama SMADU!</h2>
                    <p class="lead">SMA Unggulan Badridduja siap mencetak generasi pemimpin masa depan yang religius, berprestasi, dan berwawasan global.</p>
                    <p>Fasilitas lengkap, lingkungan asri dan kondusif, didukung guru berpengalaman. Dapatkan akses ke kurikulum unggulan dan beragam kegiatan ekstrakurikuler pilihan.</p>
                    <ul class="list-unstyled mt-3">
                        <li><i class="fa fa-check-circle text-success me-2"></i> Gedung & Ruang Kelas Nyaman</li>
                        <li><i class="fa fa-check-circle text-success me-2"></i> Laboratorium Komputer & IPA Lengkap</li>
                        <li><i class="fa fa-check-circle text-success me-2"></i> Program Beasiswa Siswa Berprestasi</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-12 col-12">
                <div class="card border-0 shadow-lg rounded-3">
                    <div class="card-header bg-primary text-white text-center py-3" style="background:#1B2A4A !important;">
                        <h4 class="mb-0 text-white font-weight-bold"><i class="fa fa-user-plus"></i> Form Pendaftaran Online</h4>
                    </div>
                    <div class="card-body p-4">
                        <div id="spmbAlert" class="alert d-none" role="alert"></div>
                        
                        <form id="formDaftarSPMB">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control modern-input" name="nama_lengkap" placeholder="Nama sesuai ijazah..." required>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">NISN</label>
                                        <input type="text" class="form-control modern-input" name="nisn" placeholder="Nomor Induk Siswa Nasional...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">No. WhatsApp/HP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control modern-input" name="no_hp" placeholder="08xxxxxxxxxx" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Asal Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control modern-input" name="asal_sekolah" placeholder="SMP / MTs asal..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">Pilihan Jurusan <span class="text-danger">*</span></label>
                                        <select class="form-control modern-input" name="jurusan" required>
                                            <option value="">-- Pilih Jurusan --</option>
                                            <option value="IPA (MIPA)">IPA (Matematika & IPA)</option>
                                            <option value="IPS (IPS)">IPS (Ilmu Pengetahuan Sosial)</option>
                                            <option value="Bahasa & Budaya">Bahasa & Budaya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold">Alamat Rumah Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control modern-input" name="alamat" rows="3" placeholder="Alamat lengkap tempat tinggal..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-submit-berita w-100 py-3" id="btnDaftar">
                                <i class="fa fa-paper-plane"></i> Kirim Pendaftaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('formDaftarSPMB').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnDaftar');
    const alert = document.getElementById('spmbAlert');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses Pendaftaran...';
    
    const formData = new FormData(this);
    formData.append('action', 'daftar');
    
    fetch('api_spmb.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert.classList.remove('d-none', 'alert-danger', 'alert-success');
        if (data.success) {
            alert.classList.add('alert-success');
            alert.innerHTML = '<h4><i class="fa fa-check-circle"></i> ' + data.message + '</h4>' +
                '<p><strong>No. Pendaftaran Anda:</strong> <span class="badge bg-primary fs-6">' + data.no_pendaftaran + '</span></p>' +
                '<p class="mb-3">Simpan nomor pendaftaran ini. Panitia kami akan menghubungi Anda melalui WhatsApp.</p>' +
                '<a href="cetak_spmb.php?no=' + data.no_pendaftaran + '" target="_blank" class="btn btn-warning fw-bold text-dark"><i class="fa fa-print"></i> Cetak Bukti Pendaftaran (PDF)</a>';
            this.reset();
        } else {
            alert.classList.add('alert-danger');
            alert.innerHTML = '<i class="fa fa-exclamation-circle"></i> ' + data.message;
        }
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-paper-plane"></i> Kirim Pendaftaran';
        window.scrollTo({top: 200, behavior: 'smooth'});
    })
    .catch(err => {
        alert.classList.remove('d-none', 'alert-success');
        alert.classList.add('alert-danger');
        alert.innerHTML = '<i class="fa fa-exclamation-circle"></i> Terjadi kesalahan. Silakan coba lagi.';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-paper-plane"></i> Kirim Pendaftaran';
    });
});
</script>