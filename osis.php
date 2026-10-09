	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>OSIS<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
	    </div>
	</div>

	<div id="overviews" class="section wb">
	    <div class="container">
	        <ul class="nav nav-tabs" id="myTab" role="tablist">
	            <li class="nav-item" role="presentation">
	                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
	                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Berita Osis</button>
	            </li>
	            <li class="nav-item" role="presentation">
	                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
	                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tentang
	                    Osis</button>
	            </li>
	            <li class="nav-item" role="presentation">
	                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
	                    type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Kegiatan</button>
	            </li>
	        </ul>
	        <div class="tab-content" id="myTabContent">
	            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
	                tabindex="0"><?php include 'osishome.php'; ?></div>
	            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
	                tabindex="0"><?php include 'osis_profil.php'; ?></div>
	            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
	                tabindex="0"><?php include 'osiskegiatan.php'; ?></div>
	        </div>
	    </div>
	</div><!-- end container -->

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