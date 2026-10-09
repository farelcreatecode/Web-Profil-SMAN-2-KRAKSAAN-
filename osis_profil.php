<?php
        $sejarah = mysqli_query($con, "SELECT * FROM profil_info WHERE kategori='2'");
        $sej = mysqli_fetch_array($sejarah);
        $time = $sej['waktu'];
        $tglsej = tgl_indo($sej['waktu']);
        $isi_sejarah = $sej['detail'];
        // Format tanggal ke day dan month
        $day = date('d', strtotime($time)); // Hasil: '30'
        $month = date('M', strtotime($time)); // Hasil: 'Nov'
    ?>
<div class="blog-item">
    <div class="blog-title">
        <h2><a href="#" title=""><?php echo $sej['judul']; ?></a></h2>
    </div>
    <div class="image-blog">
        <img src="img/profil/<?php echo $sej['foto'];?>" alt="" class="img-fluid">
    </div>
    <div class="post-content">
        <div class="post-date">
            <span class="day"><?php echo $day?></span>
            <span class="month"><?php echo $month?></span>
        </div>
        <div class="meta-info-blog">
            <span><i class="fa fa-calendar"></i> <a href="#"><?php echo $tglsej?></a> </span>
            <!-- <span><i class="fa fa-tag"></i> <a href="#">News</a> </span>
                            <span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span> -->
        </div>
        <div class="blog-desc">
            <?php
                function formatText($textsej) {
                    // Memisahkan teks berdasarkan tag <br></br>
                    $paragraphs = explode('<br></br>', $textsej);
                    $totalParagraphs = count($paragraphs);
                
                    // Jika kurang dari 5 paragraf, kembalikan dalam format default
                    if ($totalParagraphs < 5) {
                        return "<p>" . implode('<br></br>', $paragraphs) . "</p>";
                    }
                
                    // Ambil 2 paragraf pertama untuk first part
                    $firstPart = implode('<br></br>', array_slice($paragraphs, 0, 2));
                
                    // Ambil 2 paragraf berikutnya untuk blockquote part
                    $blockquotePart = implode('<br></br>', array_slice($paragraphs, 2, 2));
                
                    // Sisa paragraf dimasukkan ke last part
                    $lastPart = implode('<br></br>', array_slice($paragraphs, 4));
                
                    // Format HTML yang sudah dipisahkan
                    return "<p style='text-align: justify;'>$firstPart</p>\n
                            <blockquote class='default' style='text-align: justify;'>$blockquotePart</blockquote>\n
                            <p style='text-align: justify;'>$lastPart</p>";
                }
                $textsej = $isi_sejarah;
                echo formatText($textsej);
            ?>
        </div>
    </div>
</div>