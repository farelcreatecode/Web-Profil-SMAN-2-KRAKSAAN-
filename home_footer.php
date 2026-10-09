<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <?php 
                        $logo_footer = (!empty($t['logo_sekolah'])) ? $t['logo_sekolah'] : ((!empty($t['logo_web'])) ? $t['logo_web'] : 'logosma.png');
                        ?>
                        <div class="footer-logo-brand mb-3">
                            <a href="index.php?page=home" title="<?php echo $t['nama_sekolah']; ?>">
                                <img src="images/logo.png" alt="<?php echo $t['nama_sekolah']; ?>" class="img-fluid footer-logo-clean" style="max-height: 55px; width: auto; object-fit: contain; display: block;" onerror="this.src='img/logo.png'">
                            </a>
                        </div>
                        <h3>SMAN 2 Kraksaan</h3>
                    </div>
                    <p class="mb-2"><strong>SMADU MANTAB</strong>: Mandiri, Terampil, dan Berakhlak Mulia. Mencetak generasi muda yang cerdas, berakhlakul karimah, dan berwawasan global.</p>
                    <div class="footer-right">
                        <ul class="footer-links-soi">
                            <li><a href="<?php echo $t['url_fb']; ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $t['url_ig']; ?>"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="<?php echo $t['url_youtube']; ?>"><i class="fa fa-youtube"></i></a></li>
                        </ul><!-- end links -->
                    </div>
                </div><!-- end clearfix -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h3>Tautan Informasi</h3>
                    </div>
                    <ul class="footer-links">
                        <li><a href="index.php?page=home">Beranda</a></li>
                        <li><a href="index.php?page=berita">Berita</a></li>
                        <li><a href="index.php?page=sejarah">Profil Sekolah</a></li>
                        <li><a href="index.php?page=prestasi">Prestasi</a></li>
                        <li><a href="index.php?page=kontak">Kontak Kami</a></li>
                    </ul><!-- end links -->
                </div><!-- end clearfix -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h3>Detail Kontak</h3>
                    </div>

                    <ul class="footer-links">
                        <li><a href="mailto:<?php echo $t['email']; ?>"><?php echo $t['email']; ?></a></li>
                        <li><a href="#"><?php echo $t['nama_website']; ?></a></li>
                        <li><?php echo $t['alamat'] . ', ' . $t['desa'] . ', ' . $t['kecamatan'] . ', ' . $t['kabupaten']; ?></li>
                        <li><?php echo $t['no_telp']; ?></li>
                    </ul><!-- end links -->
                </div><!-- end clearfix -->
            </div><!-- end col -->

        </div><!-- end row -->
    </div><!-- end container -->
</footer><!-- end footer -->

<div class="copyrights">
    <div class="container">
        <div class="footer-distributed">
            <div class="footer-center">
                <p class="footer-company-name">All Rights Reserved. &copy; <?php echo date('Y'); ?> <a href="#"><?php echo $t['nama_sekolah']; ?></a></p>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end copyrights -->

<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>