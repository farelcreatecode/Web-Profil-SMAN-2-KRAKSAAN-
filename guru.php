	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>Direktori Guru & Pendidik<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
	    </div>
	</div>

	<div id="teachers" class="section wb">
	    <div class="container">
            <!-- Search Teacher Bar -->
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-8">
                    <form method="GET" action="index.php" class="p-3 bg-light rounded shadow-sm">
                        <input type="hidden" name="page" value="guru">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fa fa-search text-muted"></i></span>
                            <input type="text" name="q" class="form-control modern-input" placeholder="Cari nama guru atau mata pelajaran..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                            <button type="submit" class="btn btn-primary px-4" style="background:#1B2A4A; border:none;"><i class="fa fa-search"></i> Cari Guru</button>
                            <?php if(isset($_GET['q']) && $_GET['q'] !== ''): ?>
                                <a href="index.php?page=guru" class="btn btn-outline-secondary ms-1" title="Reset"><i class="fa fa-refresh"></i></a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

	        <div class="row justify-content-center">
	            <?php
                    $where_guru = "";
                    if (!empty($_GET['q'])) {
                        $search_g = mysqli_real_escape_string($con, $_GET['q']);
                        $where_guru = "WHERE nama LIKE '%$search_g%' OR mapel_peg LIKE '%$search_g%' OR jenis_ptk LIKE '%$search_g%'";
                    }

					$conguru = mysqli_query($con, "SELECT * FROM gtk $where_guru ORDER BY id_gtk ASC");
                    if ($conguru && mysqli_num_rows($conguru) > 0) {
                        while ($guru = mysqli_fetch_array($conguru)) {
                            $foto_guru = !empty($guru['foto']) ? $guru['foto'] : 'user.png';
				?>
	            <div class="col-lg-3 col-md-6 col-12 mb-4 d-flex">
	                <div class="our-team w-100 shadow-sm rounded-3 overflow-hidden d-flex flex-column bg-white border">
	                    <div class="team-img text-center p-3" style="height: 260px; background: #f8f9fa;">
	                        <img src="img/<?php echo $foto_guru; ?>" class="h-100 rounded" style="object-fit: cover; max-width:100%;" alt="<?php echo $guru['nama']; ?>" onerror="this.src='img/user.png'">
	                    </div>
	                    <div class="team-content p-3 text-center d-flex flex-column flex-grow-1" style="background:#fff;">
	                        <h3 class="title mb-1" style="font-size: 16px; font-weight:700; color:#1B2A4A;"><?php echo $guru['nama']; ?></h3>
	                        <span class="post text-muted small mt-auto">
                                <strong class="text-primary"><?php echo $guru['jenis_ptk']; ?></strong>
                                <?php if (!empty($guru['mapel_peg'])): ?>
                                    <br><i class="fa fa-book me-1"></i> <?php echo $guru['mapel_peg']; ?>
                                <?php endif; ?>
                            </span>
	                    </div>
	                </div>
	            </div>
	            <?php 
                        }
                    } else {
                        echo '<div class="col-12 text-center py-5">
                                <i class="fa fa-user-times fa-3x text-muted mb-3"></i>
                                <h4>Data Guru tidak ditemukan.</h4>
                                <p class="text-muted">Coba kata kunci pencarian nama atau mata pelajaran lain.</p>
                              </div>';
                    }
                ?>
	        </div><!-- end row -->
	    </div><!-- end container -->
	</div><!-- end section -->

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