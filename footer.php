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
								<a href="index.php?page=home" title="<?php echo isset($t['nama_sekolah']) ? $t['nama_sekolah'] : 'SMA Unggulan Badridduja'; ?>">
									<img src="images/logo.png" alt="Logo Sekolah" class="img-fluid footer-logo-clean" style="max-height: 55px; width: auto; object-fit: contain; display: block;" onerror="this.src='images/logo.png'">
								</a>
							</div>
							<h3>Tentang Kami</h3>
						</div>
						<p><?php echo isset($t['nama_sekolah']) ? $t['nama_sekolah'] : 'SMA Unggulan Badridduja'; ?> berkomitmen untuk mencetak generasi muda yang cerdas, berakhlak mulia, dan siap menghadapi tantangan masa depan.</p>   
						<div class="footer-right">
							<ul class="footer-links-soi">
								<li><a href="<?php echo isset($t['url_fb']) ? $t['url_fb'] : '#'; ?>"><i class="fa fa-facebook"></i></a></li>
								<li><a href="<?php echo isset($t['url_ig']) ? $t['url_ig'] : '#'; ?>"><i class="fa fa-instagram"></i></a></li>
								<li><a href="<?php echo isset($t['url_youtube']) ? $t['url_youtube'] : '#'; ?>"><i class="fa fa-youtube"></i></a></li>
							</ul><!-- end links -->
						</div>						
					</div><!-- end clearfix -->
				</div><!-- end col -->

				<div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Pricing</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Contact</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact Details</h3>
                        </div>

                        <ul class="footer-links">
                            <li><a href="mailto:#">info@yoursite.com</a></li>
                            <li><a href="#">www.yoursite.com</a></li>
                            <li>PO Box 16122 Collins Street West Victoria 8007 Australia</li>
                            <li>+61 3 8376 6284</li>
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
                    <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="#">SmartEDU</a> Design By : <a href="https://html.design/">html design</a></p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

