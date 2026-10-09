<div class="all-title-box">
    <div class="container text-center">
        <h1>Data Pokok Pendidikan (DAPODIK)<span class="m_1">Identitas Resmi <?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>

<?php
$npsn = !empty($t['npsn']) ? $t['npsn'] : '69965593';
?>

<div id="overviews" class="section wb">
    <div class="container">
        
        <!-- Header Info Card -->
        <div class="card border-0 shadow-sm mb-4 rounded-3 overflow-hidden">
            <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #1B2A4A 0%, #0088cc 100%) !important;">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <img src="images/<?php echo !empty($t['logo_sekolah']) ? $t['logo_sekolah'] : 'logosma.png'; ?>" alt="Logo Sekolah" class="img-fluid rounded bg-white p-2" style="max-height:90px;" onerror="this.src='images/logo.png'">
                    </div>
                    <div class="col-md-10">
                        <h2 class="text-white font-weight-bold mb-1" style="color:#ffffff !important;"><?php echo $t['nama_sekolah']; ?></h2>
                        <p class="mb-2 text-light opacity-90"><i class="fa fa-map-marker"></i> <?php echo $t['alamat'] . ', ' . $t['desa'] . ', ' . $t['kecamatan'] . ', ' . $t['kabupaten']; ?></p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-warning text-dark font-weight-bold px-3 py-2 me-2 mb-1" style="font-size:13px;"><i class="fa fa-id-card"></i> NPSN: <?php echo $npsn; ?></span>
                            <span class="badge bg-success font-weight-bold px-3 py-2 me-2 mb-1" style="font-size:13px;"><i class="fa fa-check-circle"></i> Akreditasi: <?php echo $t['akreditasi']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="text-center mb-4">
            <div class="btn-group shadow-sm p-1 bg-light rounded-pill" role="group" id="dapodikTabBtns">
                <button type="button" class="btn btn-primary rounded-pill px-4 font-weight-bold active" id="btnTab1" onclick="switchDapodikTab('tabel')">
                    <i class="fa fa-table me-1"></i> Data Identitas Dapodik Sekolah
                </button>
                <button type="button" class="btn btn-outline-primary rounded-pill px-4 font-weight-bold ms-2" id="btnTab2" onclick="switchDapodikTab('portal')">
                    <i class="fa fa-globe me-1"></i> Portal Referensi Kemendikdasmen
                </button>
            </div>
        </div>

        <!-- Tab 1: Tabel Identitas Dapodik -->
        <div id="tabViewTabel" class="dapodik-tab-content">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="font-weight-bold mb-0" style="color:#1B2A4A;"><i class="fa fa-list-alt text-primary"></i> Data Identitas Sekolah & Dapodik (Database)</h4>
                        <span class="badge bg-info text-white px-3 py-2"><i class="fa fa-database"></i> Terintegrasi System</span>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover align-middle">
                            <thead class="table-dark" style="background:#1B2A4A !important;">
                                <tr>
                                    <th style="width: 35%;">Parameter Identitas Dapodik</th>
                                    <th style="width: 65%;">Nilai / Data Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong><i class="fa fa-university text-primary me-2"></i> Nama Satuan Pendidikan</strong></td>
                                    <td class="font-weight-bold text-dark"><?php echo $t['nama_sekolah']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-barcode text-primary me-2"></i> NPSN (Nomor Pokok Sekolah Nasional)</strong></td>
                                    <td><span class="badge bg-primary px-3 py-2" style="font-size:14px; background:#1B2A4A !important;"><?php echo $npsn; ?></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-certificate text-warning me-2"></i> Status Akreditasi</strong></td>
                                    <td><span class="badge bg-success px-3 py-2">Terakreditasi <?php echo $t['akreditasi']; ?></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-user-circle text-secondary me-2"></i> Kepala Sekolah</strong></td>
                                    <td class="font-weight-bold"><?php echo $t['nama_ks']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-map-marker text-danger me-2"></i> Alamat Sekolah</strong></td>
                                    <td><?php echo $t['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-tag text-primary me-2"></i> Desa / Kelurahan</strong></td>
                                    <td><?php echo $t['desa']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-map-signs text-primary me-2"></i> Kecamatan</strong></td>
                                    <td><?php echo $t['kecamatan']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-globe text-primary me-2"></i> Kabupaten / Kota</strong></td>
                                    <td><?php echo $t['kabupaten']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-envelope text-success me-2"></i> Email Resmi</strong></td>
                                    <td><a href="mailto:<?php echo $t['email']; ?>"><?php echo $t['email']; ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-phone text-success me-2"></i> No. Telepon / Whatsapp</strong></td>
                                    <td><?php echo $t['no_telp']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fa fa-desktop text-info me-2"></i> Website Utama</strong></td>
                                    <td><a href="http://<?php echo $t['nama_website']; ?>" target="_blank"><?php echo $t['nama_website']; ?></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Portal Embed Kemendikdasmen -->
        <div id="tabViewPortal" class="dapodik-tab-content" style="display:none;">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-light d-flex justify-content-between align-items-center p-3">
                    <span class="font-weight-bold"><i class="fa fa-external-link"></i> Portal Referensi Kemendikdasmen (NPSN: <?= $npsn ?>)</span>
                    <a href="https://referensi.data.kemendikdasmen.go.id/pendidikan/npsn/<?= $npsn ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-globe"></i> Buka Tab Baru</a>
                </div>
                <div class="card-body p-0">
                    <iframe src="https://referensi.data.kemendikdasmen.go.id/pendidikan/npsn/<?= $npsn ?>" frameborder="0" width='100%' height='650px' class="w-100 rounded-bottom"></iframe>
                </div>
            </div>
        </div>

    </div><!-- end container -->
</div><!-- end section -->

<script>
function switchDapodikTab(tab) {
    const btn1 = document.getElementById('btnTab1');
    const btn2 = document.getElementById('btnTab2');
    const viewTabel = document.getElementById('tabViewTabel');
    const viewPortal = document.getElementById('tabViewPortal');

    if (tab === 'tabel') {
        btn1.className = 'btn btn-primary rounded-pill px-4 font-weight-bold active';
        btn1.style.background = '#1B2A4A';
        btn2.className = 'btn btn-outline-primary rounded-pill px-4 font-weight-bold ms-2';
        viewTabel.style.display = 'block';
        viewPortal.style.display = 'none';
    } else {
        btn2.className = 'btn btn-primary rounded-pill px-4 font-weight-bold active';
        btn2.style.background = '#1B2A4A';
        btn1.className = 'btn btn-outline-primary rounded-pill px-4 font-weight-bold';
        viewTabel.style.display = 'none';
        viewPortal.style.display = 'block';
    }
}
</script>