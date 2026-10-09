 	<div id="overviews" class="section wb">
 	    <?php
 			$id_b = intval($_GET['id']);
 			// Increment view counter
 			mysqli_query($con, "UPDATE berita SET dibaca = dibaca + 1 WHERE id_berita='$id_b'");
 			
 			$next = mysqli_query($con, "SELECT * FROM berita WHERE id_berita='$id_b'");
 			$berita = mysqli_fetch_array($next);
            $is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
            if (!$berita || (!in_array($berita['status'], ['Y', 'A', '1']) && !$is_admin)) {
                echo "<div class='container py-5 text-center'><i class='fa fa-lock fa-3x text-warning mb-3'></i><h3>Berita atau Karya ini belum aktif (Menunggu Persetujuan Admin) atau tidak tersedia.</h3><a href='index.php?page=berita' class='btn btn-primary mt-3' style='background:#1B2A4A; border:none;'>Kembali ke Daftar Berita</a></div></div>";
                return;
            }
 			$tgl = tgl_indo($berita['tanggal']);			
 			$time = $berita['tanggal'];
            $judul_d = !empty($berita['judul']) ? $berita['judul'] : (isset($berita['berita']) ? $berita['berita'] : 'Berita');
 			$isi_berita = !empty($berita['isi_berita']) ? $berita['isi_berita'] : (isset($berita['deskripsi']) ? $berita['deskripsi'] : '');
 			$day = date('d', strtotime($time));
 			$month = date('M', strtotime($time));
 			
 			// Author & Category join
 			$query_kat = mysqli_query($con, "SELECT kategori FROM kategori WHERE id_kategori='$berita[kategori]'");
 			$kat_arr = mysqli_fetch_array($query_kat);
 			$nama_kategori = $kat_arr ? $kat_arr['kategori'] : 'Umum';
 			
 			$http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
 			$req_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
 			$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $http_host . $req_uri;
 			$share_title = urlencode($judul_d);
 			$share_url = urlencode($current_url);
 		?>
 	    <div class="container">
 	        <div class="row">
 	            <div class="col-lg-9 blog-post-single">
 	                <div class="blog-item">
 	                    <div class="image-blog">
 	                        <img src="img/<?= $berita['foto'];?>" alt="<?= $judul_d;?>" class="img-fluid rounded" onerror="this.src='img/default_berita.jpg'">
 	                    </div>
 	                    <div class="post-content">
 	                        <div class="post-date">
 	                            <span class="day"><?= $day?></span>
 	                            <span class="month"><?= $month?></span>
 	                        </div>
 	                        <div class="meta-info-blog">
 	                            <span><i class="fa fa-calendar"></i> <?= $tgl?> </span>
 	                            <span><i class="fa fa-tag"></i> <?= $nama_kategori; ?> </span>
 	                            <span><i class="fa fa-user"></i> Oleh: <?= $berita['penulis']; ?> </span>
 	                            <span><i class="fa fa-eye"></i> <?= $berita['dibaca'];?>x dilihat</span>
 	                        </div>
 	                        <div class="blog-title">
 	                            <h3><a href="#" title=""><?= $judul_d;?></a></h3>
 	                        </div>
 	                        <div class="blog-desc mt-3">
 	                            <p style="text-align: justify; line-height: 1.8; font-size: 16px;">
 	                                <?= nl2br($isi_berita); ?>
 	                            </p>
 	                        </div>
 	                        
 	                        <!-- Social Share Container -->
 	                        <div class="social-share-container mt-4">
 	                            <span class="fw-bold text-dark"><i class="fa fa-share-alt"></i> Bagikan Berita Ini:</span>
 	                            <div>
 	                                <a href="https://api.whatsapp.com/send?text=<?= $share_title ?>%20<?= $share_url ?>" target="_blank" class="social-share-btn btn-share-wa">
 	                                    <i class="fa fa-whatsapp"></i> WhatsApp
 	                                </a>
 	                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $share_url ?>" target="_blank" class="social-share-btn btn-share-fb">
 	                                    <i class="fa fa-facebook"></i> Facebook
 	                                </a>
 	                                <a href="https://telegram.me/share/url?url=<?= $share_url ?>&text=<?= $share_title ?>" target="_blank" class="social-share-btn btn-share-tg">
 	                                    <i class="fa fa-paper-plane"></i> Telegram
 	                                </a>
 	                                <button onclick="copyShareUrl()" class="social-share-btn btn-share-copy">
 	                                    <i class="fa fa-link"></i> Salin Link
 	                                </button>
 	                            </div>
 	                        </div>
 	                        
 	                    </div>
 	                </div>

 	            </div><!-- end col -->
 	            <div class="col-lg-3 col-12 right-single">
 	                <div class="widget-search mb-4">
 	                    <div class="site-search-area">
 	                        <form method="GET" action="index.php">
 	                            <input type="hidden" name="page" value="berita">
 	                            <div class="input-group">
 	                                <input class="form-control" name="q" placeholder="Cari berita..." type="text">
 	                                <button class="btn btn-primary" type="submit" style="background:#1B2A4A; border:none;"><i class="fa fa-search"></i></button>
 	                            </div>
 	                        </form>
 	                    </div>
 	                </div>
   	                <div class="widget-categories p-3 bg-light rounded border shadow-sm mb-4">
   	                    <h3 class="widget-title border-bottom pb-2 mb-3 font-weight-bold text-dark" style="font-size:16px;">
                            <i class="fa fa-folder-open text-primary me-2"></i> Kategori Berita
                        </h3>
   	                    <div class="category-list">
   	                        <?php
   	                        $active_kat = isset($_GET['kategori']) ? $_GET['kategori'] : '';
   	                        $side_kat = mysqli_query($con, "SELECT * FROM kategori ORDER BY kategori ASC");
   	                        while($sk = mysqli_fetch_array($side_kat)) {
   	                            if(empty($sk['kategori'])) continue;
   	                            $id_k = $sk['id_kategori'];
   	                            $q_cnt = mysqli_query($con, "SELECT COUNT(*) as total FROM berita WHERE kategori='$id_k' AND (status='Y' OR status='A' OR status='1')");
   	                            $d_cnt = mysqli_fetch_assoc($q_cnt);
   	                            $cnt = $d_cnt ? $d_cnt['total'] : 0;
   	                            $is_active = ($active_kat == $id_k) ? 'active' : '';
   	                            echo "<a href='index.php?page=berita&kategori=".$id_k."' class='category-item-link $is_active'>
   	                                    <span><i class='fa fa-angle-right me-2'></i> ".$sk['kategori']."</span>
   	                                    <span class='badge bg-secondary text-white rounded-pill'>$cnt</span>
   	                                  </a>";
   	                        }
   	                        ?>
   	                    </div>
   	                </div>

  	                <!-- Widget Berita Populer (Terbanyak Dilihat) -->
  	                <div class="widget-popular-posts p-3 bg-light rounded border shadow-sm mb-4">
  	                    <h3 class="widget-title border-bottom pb-2 mb-3 font-weight-bold text-danger" style="font-size:16px;">
                            <i class="fa fa-fire"></i> Berita Populer
                        </h3>
  	                    <div class="popular-posts-list">
  	                        <?php
  	                        $q_pop = mysqli_query($con, "SELECT * FROM berita WHERE status='Y' OR status='A' OR status='1' ORDER BY CAST(dibaca AS UNSIGNED) DESC LIMIT 5");
  	                        if ($q_pop && mysqli_num_rows($q_pop) > 0) {
  	                            while ($pop = mysqli_fetch_array($q_pop)) {
                                    $pop_title = !empty($pop['judul']) ? $pop['judul'] : (isset($pop['berita']) ? $pop['berita'] : 'Berita');
                                    $pop_views = !empty($pop['dibaca']) ? intval($pop['dibaca']) : 0;
  	                        ?>
  	                        <div class="popular-item d-flex mb-3 pb-2 border-bottom align-items-center">
  	                            <img src="img/<?= $pop['foto']; ?>" alt="<?= $pop_title; ?>" class="rounded me-2" style="width:60px; height:50px; object-fit:cover;" onerror="this.src='images/blog_1.jpg'">
  	                            <div class="ms-2">
  	                                <h6 class="mb-1" style="font-size:13px; line-height:1.3; font-weight:600;">
  	                                    <a href="index.php?page=detail&id=<?= $pop['id_berita']; ?>" class="text-dark hover-primary"><?= strlen($pop_title) > 45 ? substr($pop_title, 0, 42).'...' : $pop_title; ?></a>
  	                                </h6>
  	                                <small class="text-muted" style="font-size:11px;">
  	                                    <i class="fa fa-eye text-warning"></i> <?= $pop_views; ?> views
  	                                </small>
  	                            </div>
  	                        </div>
  	                        <?php
  	                            }
  	                        }
  	                        ?>
  	                    </div>
  	                </div>
  	            </div>
  	        </div><!-- end row -->
 	    </div><!-- end container -->
 	</div><!-- end section -->

<script>
function copyShareUrl() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Tautan berita berhasil disalin ke clipboard!');
    }, function(err) {
        alert('Gagal menyalin tautan.');
    });
}
</script>

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