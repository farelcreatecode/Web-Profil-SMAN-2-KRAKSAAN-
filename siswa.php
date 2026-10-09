<div class="all-title-box">
    <div class="container text-center">
        <h1>Data Siswa<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>
<div id="overviews" class="section wb">

    <div class="container">
        <div class="row g-2 align-items-center">
            <nav class="navbar bg-primary" data-bs-theme="dark">
                <!-- Navbar content -->
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelectGrid">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelectGrid">Works with selects</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInputGrid" placeholder="name@example.com"
                            value="mdo@example.com">
                        <label for="floatingInputGrid">Email address</label>
                    </div>
                </div>
            </nav>


        </div>
        <div class="row align-items-center" ;>
            <table class="table">
                <thead class="table-primary ">
                    <tr>
                        <th scope="col" style="vertical-align : middle;text-align:center;">No</th>
                        <th scope="col" style="vertical-align : middle;text-align:center;">Nama</th>
                        <th scope="col" style="vertical-align : middle;text-align:center;">JK</th>
                        <th scope="col" style="vertical-align : middle;text-align:center;">NIPD</th>
                        <th scope="col" style="vertical-align : middle;text-align:center;">NISN</th>
                        <th scope="col" style="vertical-align : middle;text-align:center;">Kelas</th>
                        <th scope="col" style="vertical-align : middle;text-align:center;">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $consiswa    = mysqli_query($con, "SELECT * FROM siswa ORDER BY NIPD DESC");
                        while ($siswa = mysqli_fetch_array($consiswa)) {
                    ?>
                    <tr>
                        <th scope="row" style="vertical-align : middle;text-align:center;"><?php echo $no++ ?></th>
                        <td><?php echo $siswa['Nama']; ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $siswa['JK']; ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $siswa['NIPD']; ?></td>
                        <td style="vertical-align : middle;text-align:center;"><?php echo $siswa['NISN']; ?></td>
                        <td><?php echo $siswa['Kelas']; ?></td>
                        <td><?php echo $siswa['Kelurahan']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>

    </div>
</div><!-- end container -->
</div><!-- end section -->

<div id="testimonials" class="parallax section db parallax-off" style="background-image:url('images/parallax_04.jpg');">
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