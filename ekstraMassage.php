<hr class="invis">
<div class="course-item">
    <?php
        $condb = mysqli_query($con, "SELECT * FROM profil_info WHERE kategori='6'");
        $ekstra = mysqli_fetch_array($condb);
    ?>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                    <?php echo $ekstra['judul'];?>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class='container'>
                    <div class="row">

                        <div class="col-md-2">
                            <div class="text-center d-flex align-items-center justify-content-center"
                                style="height:180px; width:180px;">
                                <img src="img/<?php echo $ekstra['foto'];?>"
                                    style="padding:10px; max-width:100%; max-height:100%;" class="rounded"
                                    alt="User Profile">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="accordion-body" style="padding:10px;">
                                <?php echo $ekstra['detail'];?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo">
                    Galeri Kegiatan
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="container">
                        <div class="row justify-content-md-center text-center">
                            <?php
                                    $conpra    = mysqli_query($con, "SELECT * FROM berita WHERE kategori='6' AND status='Y' ORDER BY tanggal ASC");
                                    while ($pramuka = mysqli_fetch_array($conpra)) {
                                ?>
                            <div class="col-4">
                                <div class="pricing-table pricing-table-highlighted">
                                    <div class="pricing-table-header grd1">
                                        <h4><?php echo $pramuka['judul']; ?></h4>
                                    </div>
                                    <!-- <div class="pricing-table-space"></div> -->
                                    <!-- <div class="pricing-table-features"> -->
                                    <div class="blog-item">
                                        <div class="image-blog">
                                            <img src="images/blog_1.jpg" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <div class="pricing-table-sign-up">
                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>