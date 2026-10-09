<div class="blog-item">
    <?php
            $conoskeg    = mysqli_query($con, "SELECT * FROM bidang_kegiatan");
            while ($kegosis = mysqli_fetch_array($conoskeg)) {
        ?>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="image-blog">
                    <img src="img/galeri/<?php echo $kegosis['foto']; ?>" alt=""
                        class="img-thumbnail img-fluid rounded-start">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $kegosis['judul']; ?></h5>
                    <p class="card-text"><?php echo $kegosis['isi_kegiatan']; ?></p>
                    <p class="card-text"><small class="text-body-secondary"><?php echo $kegosis['waktu']; ?></small></p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>