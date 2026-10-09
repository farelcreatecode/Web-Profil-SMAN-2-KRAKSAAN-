<div class="all-title-box">
    <div class="container text-center">
        <h1>EKSTRAKURIKULER<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pramuka-tab" data-bs-toggle="tab" data-bs-target="#pramuka-tab-pane"
                    type="button" role="tab" aria-controls="pramuka-tab-pane" aria-selected="true">Pramuka</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pmr-tab" data-bs-toggle="tab" data-bs-target="#pmr-tab-pane" type="button"
                    role="tab" aria-controls="pmr-tab-pane" aria-selected="false">PMR</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="voli-tab" data-bs-toggle="tab" data-bs-target="#voli-tab-pane"
                    type="button" role="tab" aria-controls="voli-tab-pane" aria-selected="false">Volly Ball</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="massage-tab" data-bs-toggle="tab" data-bs-target="#massage-tab-pane"
                    type="button" role="tab" aria-controls="massage-tab-pane" aria-selected="false">Sport
                    Massage</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="desain-tab" data-bs-toggle="tab" data-bs-target="#desain-tab-pane"
                    type="button" role="tab" aria-controls="desain-tab-pane" aria-selected="false">Desain
                    Grafis</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paduan-tab" data-bs-toggle="tab" data-bs-target="#paduan-tab-pane"
                    type="button" role="tab" aria-controls="paduan-tab-pane" aria-selected="false">Paduan
                    Suara</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pramuka-tab-pane" role="tabpanel" aria-labelledby="pramuka-tab"
                tabindex="0"><?php include 'ekstraPramuka.php'; ?></div>
            <div class="tab-pane fade" id="pmr-tab-pane" role="tabpanel" aria-labelledby="pmr-tab" tabindex="0">
                <?php include 'ekstraPMR.php'; ?></div>
            <div class="tab-pane fade" id="voli-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <?php include 'ekstravoli.php'; ?></div>
            <div class="tab-pane fade" id="massage-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <?php include 'ekstraMassage.php'; ?></div>
            <div class="tab-pane fade" id="desain-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <?php include 'ekstraDesain.php'; ?></div>
            <div class="tab-pane fade" id="paduan-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <?php include 'ekstraPaduan.php'; ?></div>
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