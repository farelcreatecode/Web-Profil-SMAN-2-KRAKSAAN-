<div class="all-title-box">
    <div class="container text-center">
        <h1>Kepala Sekolah<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        <?php
            $conkepsek = mysqli_query($con, "SELECT * FROM kepala_sekolah ORDER BY no_urut DESC");
            $counter = 0;
            while ($wkep = mysqli_fetch_array($conkepsek)) {
                if ($counter % 2 == 0) {
        ?>
        <div class="row align-items-center mb-5 kepsek-row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="message-box">
                    <h4><?php echo $wkep['status']; ?> Kepala Sekolah Periode <?php echo $wkep['masa_jabatan']; ?>
                    </h4>
                    <h2><?php echo $wkep['nama_ks']; ?></h2>
                    <p><?php echo $wkep['keterangan']; ?></p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="post-media wow fadeIn kepsek-img-wrap">
                    <img src="img/<?php echo $wkep['foto']; ?>" alt="<?php echo $wkep['nama_ks']; ?>" class="img-fluid rounded">
                </div>
            </div>
        </div>
        <?php
                } else {
            ?>
        <div class="row align-items-center mb-5 kepsek-row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 order-md-2 order-lg-1">
                <div class="post-media wow fadeIn kepsek-img-wrap">
                    <img src="img/<?php echo $wkep['foto']; ?>" alt="<?php echo $wkep['nama_ks']; ?>" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 order-md-1 order-lg-2">
                <div class="message-box">
                    <h4><?php echo $wkep['status']; ?> Kepala Sekolah Periode <?php echo $wkep['masa_jabatan']; ?></h4>
                    <h2><?php echo $wkep['nama_ks']; ?></h2>
                    <p><?php echo $wkep['keterangan']; ?></p>
                </div>
            </div>
        </div>

        <?php
            }
            $counter++;
        }
        ?>
    </div>
</div>