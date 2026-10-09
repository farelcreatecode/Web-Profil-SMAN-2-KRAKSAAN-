<div class="blog-item">
    <div class="row">
        <?php
            $conosis    = mysqli_query($con, "SELECT * FROM berita WHERE kategori='2' AND status='Y' ORDER BY tanggal ASC");
            while ($berosis = mysqli_fetch_array($conosis)) {
        ?>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="course-item">
                <div class="image-blog">
                    <img src="images/blog_1.jpg" alt="" class="img-fluid">
                </div>
                <div class="course-br">
                    <div class="course-title">
                        <h2><a href="#" title=""><?php echo $berosis['judul']; ?></a></h2>
                    </div>
                    <div class="course-desc">
                        <p>Lorem ipsum door sit amet, fugiat deicata avise id cum, no quo maiorum intel
                            ogrets
                            geuiat operts elicata libere avisse id cumlegebat, liber regione eu sit....
                        </p>
                    </div>
                    <div class="course-rating">
                        4.5
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                    </div>
                </div>
                <div class="course-meta-bot">
                    <ul>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> 6 Month</li>
                        <li><i class="fa fa-users" aria-hidden="true"></i> 56 Student</li>
                        <li><i class="fa fa-book" aria-hidden="true"></i> 7 Books</li>
                    </ul>
                </div>
            </div>
            <hr class="hr3">
        </div><!-- end col -->
        <?php } ?>
    </div><!-- end col -->
</div><!-- end col -->