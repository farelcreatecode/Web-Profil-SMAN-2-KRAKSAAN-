	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>Prestasi<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
	    </div>
	</div>

	<div id="pricing-box" class="section wb">
	    <div class="container">
	        <div class="row">
	            <?php
					$condb = mysqli_query($con, "SELECT * FROM prestasi ORDER BY tanggal DESC");
					while ($prestasi = mysqli_fetch_array($condb)) {
				?>
	            <div class="col-md-4 col-sm-6 mb-4">
	                <div class="pricingTable pricing-table-highlighted">
	                    <div class="pricingTable-header">
	                        <span class="heading">
	                            <h3>Juara <?php echo $prestasi['juara']; ?></h3>
	                        </span>
	                        <span class="price-value"><?php echo $prestasi['nama_lomba']; ?>
	                            <span>Diraih Oleh <?php echo $prestasi['peraih']; ?></span>
	                    </div>
	                    <div class="blog-item">
	                        <div class="image-blog">
	                            <img src="images/blog_1.jpg" alt="" class="img-fluid">
	                        </div>
	                    </div>
	                    <div class="pricingContent">
	                        <!-- <i class="fa fa-adjust"></i> -->
	                        <ul>
	                            <li>Tingkat <?php echo $prestasi['tingkat']; ?></li>
	                            <li>Kabupaen <?php echo $prestasi['tempat']; ?></li>
	                            <li><?php echo $prestasi['tanggal']; ?>h</li>
	                        </ul>
	                    </div><!-- /  CONTENT BOX-->
	                </div>
	            </div>
	            <?php } ?>
	        </div>
	    </div>
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