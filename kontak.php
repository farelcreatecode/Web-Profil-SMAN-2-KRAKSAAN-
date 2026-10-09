	<div class="all-title-box">
	    <div class="container text-center">
	        <h1>Hubungi Kami<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
	    </div>
	</div>

	<div id="contact" class="section wb">
	    <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 p-4 text-center">
                        <div class="mb-3 text-warning"><i class="fa fa-map-marker fa-3x" style="color:#eea412;"></i></div>
                        <h5 class="fw-bold">Alamat Sekolah</h5>
                        <p class="text-muted mb-0"><?php echo $t['alamat']; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 p-4 text-center">
                        <div class="mb-3 text-primary"><i class="fa fa-phone fa-3x" style="color:#0088cc;"></i></div>
                        <h5 class="fw-bold">Telepon / WhatsApp</h5>
                        <p class="text-muted mb-0"><?php echo $t['no_telp']; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 p-4 text-center">
                        <div class="mb-3 text-success"><i class="fa fa-envelope fa-3x" style="color:#25D366;"></i></div>
                        <h5 class="fw-bold">Email Resmi</h5>
                        <p class="text-muted mb-0"><?php echo $t['email']; ?></p>
                    </div>
                </div>
            </div>

	        <div class="row justify-content-center">
	            <div class="col-lg-8 col-md-10 col-12">
	                <div class="card border-0 shadow-lg rounded-3 p-4 p-md-5 bg-white">
	                    <div class="text-center mb-4">
	                        <span class="badge bg-primary px-3 py-2 text-white mb-2" style="background:#1B2A4A !important; font-size:13px; letter-spacing:1px;">LAYANAN KONTAK</span>
	                        <h3 class="font-weight-bold" style="color:#1B2A4A;"><i class="fa fa-paper-plane text-primary me-2"></i> Kirim Pesan Ke Sekolah</h3>
	                        <p class="text-muted small">Punya pertanyaan seputar akademik, pendaftaran PPDB, atau fasilitas? Silakan kirimkan pesan Anda di bawah ini.</p>
	                    </div>
	                    <div id="contactAlert" class="alert d-none"></div>
	                    
	                    <form id="contactFormFront">
	                        <div class="form-group mb-3">
	                            <label class="form-label font-weight-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
	                            <input type="text" name="nama" class="form-control modern-input py-2" placeholder="Masukkan nama lengkap Anda..." required>
	                        </div>
	                        
	                        <div class="row mb-3">
	                            <div class="col-md-6 mb-3 mb-md-0">
	                                <div class="form-group">
	                                    <label class="form-label font-weight-bold text-dark">Email <span class="text-danger">*</span></label>
	                                    <input type="email" name="email" class="form-control modern-input py-2" placeholder="contoh@email.com" required>
	                                </div>
	                            </div>
	                            <div class="col-md-6">
	                                <div class="form-group">
	                                    <label class="form-label font-weight-bold text-dark">No. HP / WhatsApp <span class="text-danger">*</span></label>
	                                    <input type="text" name="phone" class="form-control modern-input py-2" placeholder="08xxxxxxxxxx" required>
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <div class="form-group mb-4">
	                            <label class="form-label font-weight-bold text-dark">Pesan Anda <span class="text-danger">*</span></label>
	                            <textarea name="pesan" class="form-control modern-input p-3" rows="5" placeholder="Tuliskan pertanyaan atau pesan Anda secara detail..." required></textarea>
	                        </div>
	                        
	                        <button type="submit" class="btn btn-submit-berita w-100 py-3 font-weight-bold" style="font-size:16px;">
	                            <i class="fa fa-send me-2"></i> Kirim Pesan Ke Sekolah
	                        </button>
	                    </form>
	                </div>
	            </div><!-- end col -->
	        </div><!-- end row -->
	    </div><!-- end container -->
	</div><!-- end section -->

<script>
document.getElementById('contactFormFront').addEventListener('submit', function(e) {
    e.preventDefault();
    const alert = document.getElementById('contactAlert');
    const nama = this.nama.value;
    const email = this.email.value;
    const phone = this.phone.value;
    const pesan = this.pesan.value;
    
    const waText = encodeURIComponent(`Halo SMA Unggulan Badridduja,\nSaya: ${nama}\nEmail: ${email}\nNo HP: ${phone}\n\nPesan:\n${pesan}`);
    
    alert.classList.remove('d-none', 'alert-danger');
    alert.classList.add('alert-success');
    alert.innerHTML = '<h4><i class="fa fa-check-circle"></i> Terima kasih, pesan Anda telah disiapkan!</h4>' +
        '<p class="mb-0">Mengalihkan Anda ke WhatsApp resmi sekolah untuk mengirim pesan secara instan...</p>';
        
    setTimeout(() => {
        window.open(`https://wa.me/628123456789?text=${waText}`, '_blank');
        this.reset();
    }, 1500);
});
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