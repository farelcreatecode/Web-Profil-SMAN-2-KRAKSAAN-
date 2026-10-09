<div class="all-title-box">
    <div class="container text-center">
        <h1>Komite Sekolah<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        <?php
            $conkepsek = mysqli_query($con, "SELECT * FROM komite ORDER BY no_urut DESC");
            $counter = 0; // Menambahkan counter untuk cek posisi
            while ($wkep = mysqli_fetch_array($conkepsek)) {
                if ($counter % 2 == 0) { // Jika genap, foto di kanan
        ?>
        <div class="row align-items-center embos" ;>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="message-box">
                    <h4>Komite Sekolah Periode <?php echo $wkep['masa_jabatan']; ?>
                    </h4>
                    <h2><?php echo $wkep['nama_komite']; ?></h2>
                    <p><?php echo $wkep['keterangan']; ?></p>
                    <a href="#" class="hover-btn-new orange"><span>Learn More</span></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="post-media wow fadeIn text-center" style="height:318px; width:480px;">
                    <img src="img/<?php echo $wkep['foto']; ?>" alt="" style="height:100%; width:auto;">
                </div>
            </div>
        </div>
        <?php
                } else { // Jika ganjil, foto di kiri
            ?>
        <div class="row align-items-center" ;>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"">
                <div class=" post-media wow fadeIn text-center" style="height:318px; width:480px;">
                <img src="img/<?php echo $wkep['foto']; ?>" alt="" style="height:100%; width:auto;">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="message-box">
                <h4><?php echo $wkep['status']; ?> Kepala Sekolah Periode <?php echo $wkep['masa_jabatan']; ?></h4>
                <h2><?php echo $wkep['nama_ks']; ?></h2>
                <p><?php echo $wkep['keterangan']; ?></p>
                <a href="#" class="hover-btn-new orange"><span>Learn More</span></a>
            </div>
        </div>
    </div>

    <?php
            }
            $counter++; // Menambah nilai counter setiap iterasi
        }
        ?>
</div>
</div>