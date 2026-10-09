<div class="all-title-box">
    <div class="container text-center">
        <h1>Kontak<span class="m_1"><?php echo $t['nama_sekolah']; ?></span></h1>
    </div>
</div>

<div id="contact" class="section wb">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="table table-responsive-xl">
                    <table class="table table-striped table-bordered dt-responsive nowrap" id="tabelunduh">
                        <thead>
                            <tr>
                                <th style="vertical-align : middle;text-align:center;">No</th>
                                <th style="vertical-align : middle;text-align:center;">Nama Files</th>
                                <th style="vertical-align : middle;text-align:center;">Tanggal Upload</th>
                                <th style="vertical-align : middle;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $con_file    = mysqli_query($con, "SELECT * FROM download");
                            while ($dunlud = mysqli_fetch_array($con_file)) {
                            ?>
                            <tr>
                                <td style="vertical-align : middle;text-align:center;"><?= $no++; ?></td>
                                <td style="vertical-align : middle;text-align:left;"><?= $dunlud["nama_file"]; ?></td>
                                <td style="vertical-align : middle;text-align:rgiht;"><?= $dunlud["tanggal"]; ?></td>
                                <td style="vertical-align : middle;text-align:center;"><a target="_blank"
                                        href="admin/file/<?= $dunlud['file']; ?>" class="btn btn-info">Download</a></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- end row -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->