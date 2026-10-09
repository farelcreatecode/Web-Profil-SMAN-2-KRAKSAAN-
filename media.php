	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>Galeri Media & Kegiatan<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
	    </div>
	</div>

	<div id="overviews" class="section wb">
	    <div class="container">
            <div class="section-title text-center">
                <h3>Dokumentasi Kegiatan Sekolah</h3>
                <p class="lead">Kumpulan galeri foto dan dokumentasi kegiatan pembelajaran serta ekstrakurikuler SMADU.</p>
            </div>

            <div class="row text-center">
                <?php
                $condb = mysqli_query($con, "SELECT * FROM berita WHERE status='Y' AND foto != '' ORDER BY id_berita DESC");
                if (mysqli_num_rows($condb) > 0) {
                    while ($g = mysqli_fetch_array($condb)) {
                        $judul_g = !empty($g['judul']) ? $g['judul'] : (isset($g['berita']) ? $g['berita'] : 'Foto Kegiatan');
                ?>
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden modern-course-item">
                        <div class="position-relative overflow-hidden" style="height: 240px;">
                            <img src="img/<?php echo $g['foto']; ?>" class="w-100 h-100" style="object-fit: cover;" alt="<?php echo $judul_g; ?>" onerror="this.src='img/default_berita.jpg'">
                            <a class="fresco btn btn-light btn-sm position-absolute bottom-0 end-0 m-3 shadow-sm" href="img/<?php echo $g['foto']; ?>" data-fresco-group="gallery" data-fresco-caption="<?php echo $judul_g; ?>">
                                <i class="fa fa-search-plus"></i> Perbesar
                            </a>
                        </div>
                        <div class="card-body p-3 text-start">
                            <h5 class="fw-bold mb-1" style="font-size: 16px; color: #1B2A4A;"><?php echo $judul_g; ?></h5>
                            <small class="text-muted"><i class="fa fa-calendar me-1"></i> <?php echo $g['tanggal']; ?></small>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo '<div class="col-12 text-center py-5"><p class="text-muted">Belum ada foto galeri.</p></div>';
                }
                ?>
            </div>
	    </div>
	</div>

	<div class="parallax section dbcolor">
	    <div class="container">
	                    <div class="row logos">
                <div class="col-md-2 col-sm-4 col-xs-4 wow fadeInUp">
                    <a href="javascript:void(0)" title="Tut Wuri Handayani - Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi"><img src="images/logo_01.png" alt="Tut Wuri Handayani" class="img-responsive"></a>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 wow fadeInUp">
                    <a href="javascript:void(0)" title="Komunitas Belajar SMA Negeri 2 Kraksaan"><img src="images/logo_02.png" alt="Komunitas Belajar SMAN 2 Kraksaan" class="img-responsive"></a>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 wow fadeInUp">
                    <a href="javascript:void(0)" title="Ambalan Patih Sidopekso Sri Tanjung - Pangkalan SMA Negeri 2 Kraksaan"><img src="images/logo_03.png" alt="Ambalan Patih Sidopekso Sri Tanjung" class="img-responsive"></a>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 wow fadeInUp">
                    <a href="javascript:void(0)" title="Humas SMA Negeri 2 Kraksaan"><img src="images/logo_04.png" alt="Humas SMA Negeri 2 Kraksaan" class="img-responsive"></a>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 wow fadeInUp">
                    <a href="javascript:void(0)" title="SMA Negeri 2 Kraksaan"><img src="images/logo_05.png" alt="SMA Negeri 2 Kraksaan" class="img-responsive"></a>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 wow fadeInUp">
                    <a href="javascript:void(0)" title="Pemerintah Provinsi Jawa Timur - Jer Basuki Mawa Beya"><img src="images/logo_06.png" alt="Pemerintah Provinsi Jawa Timur" class="img-responsive"></a>
                </div>
            </div><!-- end row -->
	    </div><!-- end container -->
	</div><!-- end section -->