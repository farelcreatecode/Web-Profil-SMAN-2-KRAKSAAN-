<?php
session_start();
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<?php
$identitas = mysqli_query($con, "SELECT * FROM identitas WHERE id_identitas='1'");
$t = mysqli_fetch_array($identitas);
$identitas_data = $t;
?>
<title><?php echo $t['nama_sekolah']; ?></title>

<meta name="keywords" content="SMADU, SMAN 2 Kraksaan, SMA Negeri 2 Kraksaan, Sekolah Terbaik Probolinggo, PPDB Online">
<meta name="description" content="SMAN 2 Kraksaan Probolinggo - Mencetak Generasi Cerdas, Berakhlakul Karimah, dan Berwawasan Global.">
<meta name="author" content="SMAN 2 Kraksaan">
<meta name="theme-color" content="#1B2A4A">

<!-- OpenGraph Social Media Meta Tags -->
<meta property="og:title" content="<?php echo $t['nama_sekolah']; ?>">
<meta property="og:description" content="SMAN 2 Kraksaan - Mencetak Generasi Cerdas, Berakhlakul Karimah & Berwawasan Global.">
<meta property="og:image" content="images/slider-01.jpg">
<meta property="og:type" content="website">
<meta property="og:locale" content="id_ID">


<!-- Google Fonts - Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="style.css">
<!-- ALL VERSION CSS -->
<link rel="stylesheet" href="css/versions.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="css/responsive.css">
<!-- GALERY CSS -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/slicknav.min.css" />
<link rel="stylesheet" href="css/fresco.css" />
<link rel="stylesheet" href="css/slick.css" />

<!-- Main Stylesheets -->
<link rel="stylesheet" href="css/style.css" />

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
<!-- Load Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Load DataTables CSS -->
<link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="jquery.orgchart.css" media="all" rel="stylesheet" type="text/css" />

<!-- Custom CSS (MUST BE LAST to override all above) -->
<link rel="stylesheet" href="css/custom.css?v=<?= time(); ?>">
<style type="text/css">
#orgChart {
    width: auto;
    height: auto;
}

#orgChartContainer {
    width: auto;
    height: 500px;
    overflow: auto;
    background: #eeeeee;
}
</style>

</head>


<body class="host_version">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Modal Login -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php include 'home_modal.php'; ?>
    </div>

    <!-- Modal Search Global -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white" style="background:#1B2A4A !important;">
                    <h5 class="modal-header-title text-white mb-0"><i class="fa fa-search"></i> Cari Informasi & Berita</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form method="GET" action="index.php">
                        <input type="hidden" name="page" value="berita">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control modern-input py-2" placeholder="Ketik kata kunci pencarian..." required autofocus>
                            <button type="submit" class="btn btn-primary px-4" style="background:#1B2A4A; border:none;"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Start header -->
    <?php include 'home_navbar.php'; ?>
    <!-- End header -->

    <!-- Content will be loaded here -->
    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            if ($page === 'home') {
                include 'home.php';
            } elseif ($page === 'sejarah') {
                include 'sejarah.php';
            } elseif ($page === 'visimisi') {
                include 'visimisi.php';
            } elseif ($page === 'struktur') {
                include 'struktur.php';
            } elseif ($page === 'dapodik') {
                include 'dapodik.php';
            } elseif ($page === 'kepalasekolah') {
                include 'kepalasekolah.php';
            } elseif ($page === 'komite') {
                include 'komite.php';
            } elseif ($page === 'guru') {
                include 'guru.php';
            } elseif ($page === 'siswa') {
                include 'siswa.php';
            } elseif ($page === 'tatatertib') {
                include 'tatatertib.php';
            } elseif ($page === 'osis') {
                include 'osis.php';
            } elseif ($page === 'ekstra') {
                include 'ekstra.php';
            } elseif ($page === 'spmb') {
                include 'spmb.php';
            } elseif ($page === 'prestasi') {
                include 'prestasi.php';
            } elseif ($page === 'alumni') {
                include 'alumni.php';
            } elseif ($page === 'unduhan') {
                include 'download.php';
            } elseif ($page === 'media') {
                include 'media.php';
            } elseif ($page === 'berita') {
                include 'berita.php';
            } elseif ($page === 'kontak') {
                include 'kontak.php';
            } elseif ($page === 'detail') {
                include 'detail_berita.php';
            } elseif ($page === 'submit_berita') {
                include 'submit_berita.php';
            } elseif ($page === 'riwayat_posting') {
                include 'submit_berita.php';
            } elseif ($page === 'admin_dashboard') {
                include 'admin_dashboard.php';
            } elseif ($page === 'admin_berita') {
                $_GET['modul'] = 'berita';
                include 'admin_dashboard.php';
            } elseif ($page === 'admin_spmb') {
                $_GET['modul'] = 'spmb';
                include 'admin_dashboard.php';
            } elseif ($page === 'admin_setting') {
                $_GET['modul'] = 'setting';
                include 'admin_dashboard.php';
            } elseif ($page === '404') {
                include '404.php';
            } else {
                include '404.php';
            }
    ?>


    <?php include 'home_footer.php'; ?>



    <!-- JS VIDEO -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/fresco.min.js"></script>
    <script src="js/main.js"></script>
    <!-- JS VIDEO -->

    <script src="dist/pagination.js"></script>
    <script src="dist/pagination.min.js"></script>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/timeline.min.js"></script>
    <script>
    timeline(document.querySelectorAll('.timeline'), {
        forceVerticalMode: 700,
        mode: 'horizontal',
        verticalStartPosition: 'left',
        visibleItems: 4
    });
    </script>

    <!-- Load jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <!-- Load Bootstrap JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <!-- Load DataTables JS -->
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <!-- Initialize DataTables -->
    <script>
    $(document).ready(function() {
        new DataTable('#tabelunduh');
    });
    </script>

    <script type="text/javascript">
    var testData = <?php echo isset($json) && !empty($json) ? $json : '[]'; ?>;
    // var testData = [
    //     {id: 1, name: 'My Organization', parent: 0},
    //     {id: 2, name: 'CEO Office', parent: 1},

    // ];
    $(function() {
        org_chart = $('#orgChart').orgChart({
            data: testData,
            showControls: true,
            allowEdit: true,
            onAddNode: function(node) {

                log('Created new node on node ' + node.data.id + "Dengan induk nomor" + node
                    .data.parent);
                org_chart.newNode(node.data.id);

            },
            onDeleteNode: function(node) {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {
                        id: node.data.id
                    },
                    dataType: "text",
                    success: function(data) {

                    }

                });



                log('Deleted node ' + node.data.id);
                org_chart.deleteNode(node.data.id);
            },
            onSaveNode: function(node) {

                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: {
                        parent: node.data.parent,
                        name: node.data.name
                    },
                    dataType: "text",

                });

                log('Data ' + node.data.name + ' Tersimpan ');
                org_chart.saveNode(node.data.id);
            },
            onClickNode: function(node) {

                $.ajax({
                    url: "update.php",
                    method: "POST",
                    data: {
                        id: node.data.id,
                        name: node.data.name
                    },
                    dataType: "text",
                    success: function(data) {

                    }

                });



                log(node.data.name + ' Clicked node ' + node.data.id);

            }

        });
    });

    // just for example purpose
    function log(text) {
        $('#consoleOutput').append('<p>' + text + '</p>')
    }
    </script>
    <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
            '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
    </script>
    <!-- WhatsApp Floating Button -->
    <?php
    $phone_num = isset($identitas_data['no_telp']) ? $identitas_data['no_telp'] : '08123456789';
    $clean_phone = preg_replace('/[^0-9]/', '', $phone_num);
    if (substr($clean_phone, 0, 1) === '0') {
        $clean_phone = '62' . substr($clean_phone, 1);
    }
    ?>
    <a href="https://wa.me/<?= $clean_phone ?>?text=Halo%20SMA%20Unggulan%20Badridduja,%20saya%20ingin%20bertanya..." class="wa-float-btn" target="_blank" title="Hubungi kami via WhatsApp">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.572-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="wa-float-text">Hubungi Kami</span>
    </a>

</body>

</html>