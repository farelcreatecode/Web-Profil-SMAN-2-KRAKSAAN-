	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>Berita & Artikel<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
            <a href="index.php?page=submit_berita" class="btn btn-submit-berita mt-3"><i class="fa fa-pencil"></i> Kirim Berita Anda</a>
	    </div>
	</div>

	<div id="overviews" class="section wb">
	    <div class="container">
            <!-- Filter & Search Bar -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <?php
                    $current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';
                    $q_val = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
                    $kat_val = isset($_GET['kategori']) ? $_GET['kategori'] : '';
                    ?>
                    <!-- Tab Filter Quick Navigation -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 p-3 bg-white rounded shadow-sm border">
                        <div class="btn-group mb-2 mb-md-0" role="group">
                            <a href="index.php?page=berita&sort=terbaru<?= !empty($kat_val)?'&kategori='.$kat_val:'' ?><?= !empty($q_val)?'&q='.urlencode($q_val):'' ?>" 
                               class="btn <?= ($current_sort !== 'populer') ? 'btn-primary active' : 'btn-outline-primary' ?>" style="<?= ($current_sort !== 'populer') ? 'background:#1B2A4A; border-color:#1B2A4A;' : '' ?>">
                                <i class="fa fa-clock-o"></i> Berita Terkini (Terbaru)
                            </a>
                            <a href="index.php?page=berita&sort=populer<?= !empty($kat_val)?'&kategori='.$kat_val:'' ?><?= !empty($q_val)?'&q='.urlencode($q_val):'' ?>" 
                               class="btn <?= ($current_sort === 'populer') ? 'btn-danger active' : 'btn-outline-danger' ?>">
                                <i class="fa fa-fire"></i> Berita Populer (Terbanyak Dilihat)
                            </a>
                        </div>
                        <span class="text-muted small">
                            <i class="fa fa-info-circle"></i> Showing: <strong><?= ($current_sort === 'populer') ? 'Berita Paling Banyak Dilihat' : 'Berita Tanggal Terbaru' ?></strong>
                        </span>
                    </div>

                    <form method="GET" action="index.php" class="p-4 bg-light rounded shadow-sm">
                        <input type="hidden" name="page" value="berita">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5 mb-2 mb-md-0">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fa fa-search text-muted"></i></span>
                                    <input type="text" name="q" class="form-control modern-input" placeholder="Cari judul atau kata kunci berita..." value="<?php echo $q_val; ?>">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <select name="kategori" class="form-control modern-input">
                                    <option value="">-- Semua Kategori --</option>
                                    <?php
                                    $kat_q = mysqli_query($con, "SELECT * FROM kategori ORDER BY kategori ASC");
                                    while($k = mysqli_fetch_array($kat_q)) {
                                        $sel = ($kat_val == $k['id_kategori']) ? 'selected' : '';
                                        echo "<option value='".$k['id_kategori']."' $sel>".$k['kategori']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2 mb-md-0">
                                <select name="sort" class="form-control modern-input">
                                    <option value="terbaru" <?= ($current_sort !== 'populer') ? 'selected' : '' ?>>📅 Terbaru (Tanggal)</option>
                                    <option value="populer" <?= ($current_sort === 'populer') ? 'selected' : '' ?>>🔥 Populer (View)</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="submit" class="btn btn-primary w-100 me-2" style="background:#1B2A4A; border:none;"><i class="fa fa-filter"></i> Filter</button>
                                <?php if(isset($_GET['q']) || isset($_GET['kategori']) || isset($_GET['sort'])): ?>
                                    <a href="index.php?page=berita" class="btn btn-outline-secondary ms-1" title="Reset Filter"><i class="fa fa-refresh"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

	        <div class="row justify-content-md-center">
	            <?php
                    // Pagination logic
                    $limit = 6;
                    $p = isset($_GET['p']) ? intval($_GET['p']) : 1;
                    if ($p < 1) $p = 1;
                    $offset = ($p - 1) * $limit;

                    $where = "WHERE (status='Y' OR status='A' OR status='1')";
                    if (!empty($_GET['q'])) {
                        $search = mysqli_real_escape_string($con, $_GET['q']);
                        $where .= " AND (judul LIKE '%$search%' OR isi_berita LIKE '%$search%' OR penulis LIKE '%$search%')";
                    }
                    if (!empty($_GET['kategori'])) {
                        $kat_filter = mysqli_real_escape_string($con, $_GET['kategori']);
                        $where .= " AND kategori='$kat_filter'";
                    }

                    // Sorting condition
                    if ($current_sort === 'populer') {
                        $order_by = "ORDER BY CAST(dibaca AS UNSIGNED) DESC, id_berita DESC";
                    } else {
                        $order_by = "ORDER BY STR_TO_DATE(tanggal, '%Y-%m-%d') DESC, jam DESC, id_berita DESC";
                    }

                    // Count total
                    $count_sql = mysqli_query($con, "SELECT COUNT(*) as total FROM berita $where");
                    $count_res = mysqli_fetch_assoc($count_sql);
                    $total_rows = $count_res ? $count_res['total'] : 0;
                    $total_pages = ceil($total_rows / $limit);

                    // Fetch rows
					$sql = mysqli_query($con, "SELECT * FROM berita $where $order_by LIMIT $offset, $limit");
                    
                    if ($sql && mysqli_num_rows($sql) > 0) {
                        while ($b = mysqli_fetch_array($sql)) {
                            $judul_b = !empty($b['judul']) ? $b['judul'] : (isset($b['berita']) ? $b['berita'] : 'Tanpa Judul');
                            $raw_isi = !empty($b['isi_berita']) ? $b['isi_berita'] : (isset($b['deskripsi']) ? $b['deskripsi'] : '');
                            $isi_berita = strip_tags($raw_isi);
                            $isi = substr($isi_berita, 0, 150);
                            $isinya = (strlen($isi_berita) > 150) ? substr($isi, 0, strrpos($isi, " ")) . '...' : $isi_berita;
                            $view_count = !empty($b['dibaca']) ? intval($b['dibaca']) : 0;
                            $tgl_display = !empty($b['tanggal']) ? tgl_indo($b['tanggal']) : 'Terbaru';
				?>
	            <div class="col-lg-4 col-md-6 col-12 mb-4">
	                <div class="modern-course-item h-100 shadow-sm border rounded bg-white d-flex flex-column">
	                    <div class="image-blog position-relative">
	                        <img src="img/<?php echo $b['foto']; ?>" alt="<?php echo $judul_b; ?>" class="img-fluid w-100" style="height:200px; object-fit:cover;" onerror="this.src='images/blog_1.jpg'">
                            <?php if (!empty($b['jenis_konten']) && $b['jenis_konten'] !== 'berita'): ?>
                                <span class="position-absolute top-0 start-0 bg-dark text-white px-2 py-1 m-2 rounded text-xs font-weight-bold" style="font-size:11px; opacity:0.9;">
                                    <?= ($b['jenis_konten'] === 'poster') ? '🎨 Poster' : (($b['jenis_konten'] === 'puisi') ? '✍️ Puisi' : '📝 Karya') ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($current_sort === 'populer'): ?>
                                <span class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded text-xs font-weight-bold" style="font-size:12px;">
                                    <i class="fa fa-fire"></i> Populer (<?= $view_count ?> views)
                                </span>
                            <?php else: ?>
                                <span class="position-absolute top-0 end-0 bg-primary text-white px-2 py-1 m-2 rounded text-xs font-weight-bold" style="background:#1B2A4A !important; font-size:12px;">
                                    <i class="fa fa-clock-o"></i> Terkini
                                </span>
                            <?php endif; ?>
	                    </div>
	                    <div class="course-br p-3 d-flex flex-column flex-grow-1">
	                        <div class="course-title mb-2">
	                            <h2 style="font-size:18px; font-weight:700; line-height:1.4;">
	                                <a href="index.php?page=detail&id=<?php echo $b['id_berita']; ?>" title="<?php echo $judul_b; ?>" style="color:#1B2A4A;"><?php echo $judul_b; ?></a>
	                            </h2>
	                        </div>
	                        <div class="course-desc flex-grow-1">
	                            <p class="text-secondary small mb-2"><?= $isinya ?></p>
	                        </div>
                            <a href="index.php?page=detail&id=<?php echo $b['id_berita']; ?>" class="text-primary font-weight-bold small mt-auto">
                                Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                            </a>
	                    </div>
	                    <div class="course-meta-bot p-2 bg-light border-top text-muted small">
	                        <ul class="d-flex justify-content-between list-unstyled mb-0 px-2">
	                            <li><i class="fa fa-calendar text-primary" aria-hidden="true"></i> <?php echo $tgl_display; ?></li>
	                            <li><i class="fa fa-eye text-warning" aria-hidden="true"></i> <strong><?php echo $view_count; ?></strong>x dibaca</li>
	                        </ul>
	                    </div>
	                </div>
	            </div><!-- end col -->
	            <?php 
                        }
                    } else {
                        echo '<div class="col-12 text-center py-5">
                                <i class="fa fa-newspaper-o fa-3x text-muted mb-3"></i>
                                <h4>Tidak ada berita ditemukan.</h4>
                                <p class="text-muted">Coba kata kunci lain atau reset filter pencarian Anda.</p>
                              </div>';
                    } 
                ?>
	        </div><!-- end row -->

            <!-- Pagination Nav -->
            <?php if ($total_pages > 1): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php
                            $q_param = isset($_GET['q']) ? '&q=' . urlencode($_GET['q']) : '';
                            $kat_param = isset($_GET['kategori']) ? '&kategori=' . urlencode($_GET['kategori']) : '';
                            $sort_param = isset($_GET['sort']) ? '&sort=' . urlencode($_GET['sort']) : '';
                            $base_url = "index.php?page=berita" . $q_param . $kat_param . $sort_param;

                            // Prev button
                            if ($p > 1) {
                                echo '<li class="page-item"><a class="page-link" href="'.$base_url.'&p='.($p-1).'">&laquo; Prev</a></li>';
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($i == $p) ? 'active' : '';
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="'.$base_url.'&p='.$i.'">'.$i.'</a></li>';
                            }

                            // Next button
                            if ($p < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="'.$base_url.'&p='.($p+1).'">Next &raquo;</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php endif; ?>

	    </div><!-- end container -->
	</div><!-- end section -->