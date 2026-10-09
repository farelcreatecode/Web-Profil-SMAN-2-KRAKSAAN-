	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>Visi & Misi<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
	    </div>
	</div>

	<div id="overviews" class="section wb">
	    <div class="container">
	        <?php
				$convisi = mysqli_query($con, "SELECT * FROM visi");
				$visi = mysqli_fetch_array($convisi);
				$isivisi = $visi['visi'];
				$isimisi = $visi['misi'];
				$isitujuan = $visi['tujuan'];
			?>
	        <div class="row">
	            <div class="col-lg-9 blog-post-single">
	                <div class="accordion" id="accordionPanelsStayOpenExample">
	                    <div class="accordion-item">
	                        <h2 class="accordion-header">
	                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
	                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
	                                aria-controls="panelsStayOpen-collapseOne">
	                                VISI
	                            </button>
	                        </h2>
	                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
	                            <div class="accordion-body">
	                                <?php echo $isivisi ?>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="accordion-item">
	                        <h2 class="accordion-header">
	                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
	                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
	                                aria-controls="panelsStayOpen-collapseTwo">
	                                MISI
	                            </button>
	                        </h2>
	                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
	                            <div class="accordion-body">
	                                <?php echo $isimisi ?>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="accordion-item">
	                        <h2 class="accordion-header">
	                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
	                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
	                                aria-controls="panelsStayOpen-collapseThree">
	                                TUJUAN
	                            </button>
	                        </h2>
	                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
	                            <div class="accordion-body">
	                                <?php echo $isitujuan ?>
	                            </div>
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


	<div id="testimonials" class="parallax section db parallax-off"
	    style="background-image:url('images/parallax_04.jpg');">
	    <div class="container">
	        <div class="section-title text-center">
	            <h3>Testimonials</h3>
	            <p>Lorem ipsum dolor sit aet, consectetur adipisicing lit sed do eiusmod tempor incididunt ut labore et
	                dolore magna aliqua. </p>
	        </div><!-- end title -->

	        <div class="row">
	            <div class="col-md-12 col-sm-12">
	                <div class="testi-carousel owl-carousel owl-theme">
	                    <div class="testimonial clearfix">
	                        <div class="testi-meta">
	                            <img src="images/testi_01.png" alt="" class="img-fluid">
	                            <h4>James Fernando </h4>
	                        </div>
	                        <div class="desc">
	                            <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
	                            <p class="lead">They have got my project on time with the competition with a sed highly
	                                skilled, and experienced & professional team.</p>
	                        </div>
	                        <!-- end testi-meta -->
	                    </div>
	                    <!-- end testimonial -->

	                    <div class="testimonial clearfix">
	                        <div class="testi-meta">
	                            <img src="images/testi_02.png" alt="" class="img-fluid">
	                            <h4>Jacques Philips </h4>
	                        </div>
	                        <div class="desc">
	                            <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
	                            <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and
	                                praising pain was born and I will give you completed.</p>
	                        </div>
	                        <!-- end testi-meta -->
	                    </div>
	                    <!-- end testimonial -->

	                    <div class="testimonial clearfix">
	                        <div class="testi-meta">
	                            <img src="images/testi_03.png" alt="" class="img-fluid ">
	                            <h4>Venanda Mercy </h4>
	                        </div>
	                        <div class="desc">
	                            <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
	                            <p class="lead">The master-builder of human happines no one rejects, dislikes avoids
	                                pleasure itself, because it is very pursue pleasure. </p>
	                        </div>
	                        <!-- end testi-meta -->
	                    </div>
	                    <!-- end testimonial -->
	                    <div class="testimonial clearfix">
	                        <div class="testi-meta">
	                            <img src="images/testi_01.png" alt="" class="img-fluid">
	                            <h4>James Fernando </h4>
	                        </div>
	                        <div class="desc">
	                            <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
	                            <p class="lead">They have got my project on time with the competition with a sed highly
	                                skilled, and experienced & professional team.</p>
	                        </div>
	                        <!-- end testi-meta -->
	                    </div>
	                    <!-- end testimonial -->

	                    <div class="testimonial clearfix">
	                        <div class="testi-meta">
	                            <img src="images/testi_02.png" alt="" class="img-fluid">
	                            <h4>Jacques Philips </h4>
	                        </div>
	                        <div class="desc">
	                            <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
	                            <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and
	                                praising pain was born and I will give you completed.</p>
	                        </div>
	                        <!-- end testi-meta -->
	                    </div>
	                    <!-- end testimonial -->

	                    <div class="testimonial clearfix">
	                        <div class="testi-meta">
	                            <img src="images/testi_03.png" alt="" class="img-fluid">
	                            <h4>Venanda Mercy </h4>
	                        </div>
	                        <div class="desc">
	                            <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
	                            <p class="lead">The master-builder of human happines no one rejects, dislikes avoids
	                                pleasure itself, because it is very pursue pleasure. </p>
	                        </div>
	                        <!-- end testi-meta -->
	                    </div><!-- end testimonial -->
	                </div><!-- end carousel -->
	            </div><!-- end col -->
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