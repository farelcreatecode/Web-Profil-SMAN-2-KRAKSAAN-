<div class="all-title-box">
    <div class="container text-center">
        <h1>Struktur Organisasi<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>

<div id="overviews" class="section wb">
    <?php
        $struktur = mysqli_query($con, "SELECT * FROM profil_info WHERE kategori='9'");
        $stru = mysqli_fetch_array($struktur);
        ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 blog-post-single">
                <div class="blog-item">
                    <div class="image-blog">
                        <img src="img/<?php echo $stru['foto'];?>" alt="" class="img-fluid">
                    </div>
                    <div class="post-content">
                        <div class="blog-title">
                            <h2><a href="#" title=""><?php echo $stru['judul']; ?></a></h2>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
            <div class="col-lg-3 col-12 right-single">
                <div class="widget-search">
                    <div class="site-search-area">
                        <form method="get" id="site-searchform" action="#">
                            <div>
                                <input class="input-text form-control" name="search-k" id="search-k"
                                    placeholder="Search keywords..." type="text">
                                <input id="searchsubmit" value="Search" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-categories">
                    <h3 class="widget-title">Categories</h3>
                    <ul>
                        <li><a href="#">Political Science</a></li>
                        <li><a href="#">Business Leaders Guide</a></li>
                        <li><a href="#">Become a Product Manage</a></li>
                        <li><a href="#">Language Education</a></li>
                        <li><a href="#">Micro Biology</a></li>
                        <li><a href="#">Social Media Management</a></li>
                    </ul>
                </div>
                <div class="widget-tags">
                    <h3 class="widget-title">Search Tags</h3>
                    <ul class="tags">
                        <li><a href="#"><b>business</b></a></li>
                        <li><a href="#"><b>jquery</b></a></li>
                        <li><a href="#">corporate</a></li>
                        <li><a href="#">portfolio</a></li>
                        <li><a href="#">css3</a></li>
                        <li><a href="#"><b>theme</b></a></li>
                        <li><a href="#"><b>html5</b></a></li>
                        <li><a href="#"><b>mysql</b></a></li>
                        <li><a href="#">multipurpose</a></li>
                        <li><a href="#">responsive</a></li>
                        <li><a href="#">premium</a></li>
                        <li><a href="#">javascript</a></li>
                        <li><a href="#"><b>Best jQuery</b></a></li>
                    </ul>
                </div>
            </div>
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