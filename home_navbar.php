<?php
    // Formatting tanggal hari ini untuk navbar & topbar
    $hari_list = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
    $bulan_list = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
    $tgl_navbar = ($hari_list[date('l')] ?? date('l')) . ', ' . date('j') . ' ' . ($bulan_list[(int)date('n')] ?? date('M')) . ' ' . date('Y');

    // Phone / WhatsApp contact formatting
    $phone_num = isset($identitas_data['no_telp']) ? $identitas_data['no_telp'] : '08123456789';
    $clean_phone = preg_replace('/[^0-9]/', '', $phone_num);
    if (substr($clean_phone, 0, 1) === '0') {
        $clean_phone = '62' . substr($clean_phone, 1);
    }
?>

<header class="top-navbar smadu-header-wrapper">
    <!-- 1. Sleek Topbar: Date, Announcement & Quick Contact -->
    <div class="smadu-topbar">
        <div class="container-fluid px-lg-4 px-3">
            <div class="smadu-topbar-inner">
                <div class="smadu-topbar-left">
                    <span class="smadu-topbar-date" title="Hari & Tanggal Hari Ini">
                        <i class="fa fa-calendar text-warning"></i>
                        <span><?= $tgl_navbar; ?></span>
                    </span>
                    <span class="smadu-topbar-badge"><i class="fa fa-bullhorn"></i> Pengumuman</span>
                    <div class="smadu-topbar-marquee">
                        <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                            <a href="index.php?page=spmb" class="smadu-topbar-marquee-link">
                                🔥 <strong>Penerimaan Murid Baru (SPMB) Tahun <?= date('Y'); ?>/<?= date('Y')+1; ?> Telah Dibuka!</strong> &bull; SMAN 2 Kraksaan &bull; SMADU MANTAB &bull; Unggul, Berkarakter & Berwawasan Global &bull; Klik di sini untuk pendaftaran online & beasiswa unggulan.
                            </a>
                        </marquee>
                    </div>
                </div>
                <div class="smadu-topbar-right d-none d-md-flex align-items-center">
                    <a href="index.php?page=kontak" class="smadu-topbar-link" title="Lokasi Sekolah">
                        <i class="fa fa-map-marker text-warning"></i> Kontak & Lokasi
                    </a>
                    <span class="smadu-topbar-sep">|</span>
                    <a href="https://wa.me/<?= $clean_phone ?>?text=Halo%20SMAN%202%20Kraksaan,%20saya%20ingin%20bertanya..." target="_blank" class="smadu-topbar-link" title="Chat WhatsApp">
                        <i class="fa fa-whatsapp text-success"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Main Sticky Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark smadu-main-navbar">
        <div class="container-fluid px-lg-4 px-3">
            <!-- Brand Logo -->
            <a class="navbar-brand smadu-brand" href="index.php?page=home" title="SMAN 2 Kraksaan">
                <img src="images/logo.png" alt="SMADU Logo" class="navbar-brand-logo" onerror="this.src='img/logo.png'" />
            </a>

            <!-- Mobile Actions (Direct Search Button + Hamburger Toggler) -->
            <div class="smadu-mobile-actions d-flex d-lg-none align-items-center">
                <button type="button" class="smadu-mobile-btn" data-toggle="modal" data-target="#searchModal" data-bs-toggle="modal" data-bs-target="#searchModal" title="Cari Informasi" aria-label="Cari">
                    <i class="fa fa-search"></i>
                </button>
                <button class="navbar-toggler smadu-hamburger-btn" type="button" data-toggle="collapse" data-target="#navbars-host" data-bs-toggle="collapse" data-bs-target="#navbars-host" aria-controls="navbars-host" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="smadu-hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <!-- Navigation Menu Items & User CTA -->
            <div class="collapse navbar-collapse" id="navbars-host">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <!-- Beranda -->
                    <li class="nav-item <?= ($page === 'home') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php?page=home"><i class="fa fa-home d-lg-none mr-2"></i>Beranda</a>
                    </li>

                    <!-- Profil Dropdown -->
                    <li class="nav-item dropdown smadu-dropdown <?= in_array($page, ['sejarah', 'visimisi', 'struktur', 'dapodik']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-profil" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-university d-lg-none mr-2"></i>Profil <i class="fa fa-chevron-down smadu-caret"></i>
                        </a>
                        <div class="dropdown-menu smadu-dropdown-menu" aria-labelledby="dropdown-profil">
                            <a class="dropdown-item <?= ($page === 'sejarah') ? 'active' : '' ?>" href="index.php?page=sejarah"><i class="fa fa-history mr-2"></i>Sejarah Singkat</a>
                            <a class="dropdown-item <?= ($page === 'visimisi') ? 'active' : '' ?>" href="index.php?page=visimisi"><i class="fa fa-compass mr-2"></i>Visi & Misi</a>
                            <a class="dropdown-item <?= ($page === 'struktur') ? 'active' : '' ?>" href="index.php?page=struktur"><i class="fa fa-sitemap mr-2"></i>Struktur Organisasi</a>
                            <a class="dropdown-item <?= ($page === 'dapodik') ? 'active' : '' ?>" href="index.php?page=dapodik"><i class="fa fa-database mr-2"></i>Dapodik</a>
                        </div>
                    </li>

                    <!-- Direktori Dropdown -->
                    <li class="nav-item dropdown smadu-dropdown <?= in_array($page, ['kepalasekolah', 'komite', 'guru', 'siswa']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-direktori" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-users d-lg-none mr-2"></i>Direktori <i class="fa fa-chevron-down smadu-caret"></i>
                        </a>
                        <div class="dropdown-menu smadu-dropdown-menu" aria-labelledby="dropdown-direktori">
                            <a class="dropdown-item <?= ($page === 'kepalasekolah') ? 'active' : '' ?>" href="index.php?page=kepalasekolah"><i class="fa fa-user-secret mr-2"></i>Kepala Sekolah</a>
                            <a class="dropdown-item <?= ($page === 'komite') ? 'active' : '' ?>" href="index.php?page=komite"><i class="fa fa-handshake-o mr-2"></i>Komite Sekolah</a>
                            <a class="dropdown-item <?= ($page === 'guru') ? 'active' : '' ?>" href="index.php?page=guru"><i class="fa fa-id-badge mr-2"></i>Guru & Staf</a>
                            <a class="dropdown-item <?= ($page === 'siswa') ? 'active' : '' ?>" href="index.php?page=siswa"><i class="fa fa-graduation-cap mr-2"></i>Siswa</a>
                        </div>
                    </li>

                    <!-- Akademik Dropdown -->
                    <li class="nav-item dropdown smadu-dropdown <?= in_array($page, ['tatatertib', 'osis', 'ekstra']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-akademik" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-book d-lg-none mr-2"></i>Akademik <i class="fa fa-chevron-down smadu-caret"></i>
                        </a>
                        <div class="dropdown-menu smadu-dropdown-menu" aria-labelledby="dropdown-akademik">
                            <a class="dropdown-item <?= ($page === 'tatatertib') ? 'active' : '' ?>" href="index.php?page=tatatertib"><i class="fa fa-list-alt mr-2"></i>Tata Tertib</a>
                            <a class="dropdown-item <?= ($page === 'osis') ? 'active' : '' ?>" href="index.php?page=osis"><i class="fa fa-flag mr-2"></i>OSIS</a>
                            <a class="dropdown-item <?= ($page === 'ekstra') ? 'active' : '' ?>" href="index.php?page=ekstra"><i class="fa fa-trophy mr-2"></i>Ekstrakurikuler</a>
                        </div>
                    </li>

                    <!-- Informasi Dropdown -->
                    <li class="nav-item dropdown smadu-dropdown <?= in_array($page, ['spmb', 'prestasi', 'alumni', 'unduhan']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-info" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-info-circle d-lg-none mr-2"></i>Informasi <i class="fa fa-chevron-down smadu-caret"></i>
                        </a>
                        <div class="dropdown-menu smadu-dropdown-menu" aria-labelledby="dropdown-info">
                            <a class="dropdown-item <?= ($page === 'spmb') ? 'active' : '' ?>" href="index.php?page=spmb"><i class="fa fa-user-plus mr-2 text-warning"></i>SPMB Online</a>
                            <a class="dropdown-item <?= ($page === 'prestasi') ? 'active' : '' ?>" href="index.php?page=prestasi"><i class="fa fa-star mr-2"></i>Prestasi</a>
                            <a class="dropdown-item <?= ($page === 'alumni') ? 'active' : '' ?>" href="index.php?page=alumni"><i class="fa fa-users mr-2"></i>Alumni</a>
                            <a class="dropdown-item <?= ($page === 'unduhan') ? 'active' : '' ?>" href="index.php?page=unduhan"><i class="fa fa-download mr-2"></i>Unduhan</a>
                        </div>
                    </li>

                    <!-- Media -->
                    <li class="nav-item <?= ($page === 'media') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php?page=media"><i class="fa fa-camera d-lg-none mr-2"></i>Media</a>
                    </li>

                    <!-- Berita & Karya Dropdown -->
                    <li class="nav-item dropdown smadu-dropdown <?= in_array($page, ['berita', 'submit_berita', 'riwayat_posting']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-berita" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-newspaper-o d-lg-none mr-2"></i>Berita & Karya <i class="fa fa-chevron-down smadu-caret"></i>
                        </a>
                        <div class="dropdown-menu smadu-dropdown-menu" aria-labelledby="dropdown-berita">
                            <a class="dropdown-item <?= ($page === 'berita') ? 'active' : '' ?>" href="index.php?page=berita"><i class="fa fa-newspaper-o mr-2"></i>Daftar Berita</a>
                            <a class="dropdown-item <?= ($page === 'submit_berita') ? 'active' : '' ?>" href="index.php?page=submit_berita"><i class="fa fa-pencil-square-o mr-2"></i>Kirim Berita & Karya</a>
                        </div>
                    </li>

                    <!-- Kontak -->
                    <li class="nav-item <?= ($page === 'kontak') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php?page=kontak"><i class="fa fa-envelope-o d-lg-none mr-2"></i>Kontak</a>
                    </li>

                    <!-- Desktop Search Button -->
                    <li class="nav-item d-none d-lg-inline-flex smadu-search-nav">
                        <button type="button" class="smadu-search-btn" data-toggle="modal" data-target="#searchModal" data-bs-toggle="modal" data-bs-target="#searchModal" title="Cari Informasi & Berita" aria-label="Cari">
                            <i class="fa fa-search"></i>
                        </button>
                    </li>

                    <!-- LOGIN / USER AUTH AREA -->
                    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                        <?php 
                            $user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'admin';
                            $user_nama = isset($_SESSION['user_nama']) ? $_SESSION['user_nama'] : 'Pengguna';
                            $role_badge = ($user_role === 'admin') ? 'ADMIN' : (($user_role === 'guru') ? 'GURU' : 'SISWA');
                            $badge_color = ($user_role === 'admin') ? '#EF4444' : (($user_role === 'guru') ? '#3B82F6' : '#22C55E');
                        ?>
                        <li class="nav-item dropdown smadu-dropdown smadu-user-nav">
                            <a class="nav-link dropdown-toggle smadu-user-btn" href="#" id="dropdown-user" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="smadu-user-avatar"><i class="fa fa-user"></i></span>
                                <span class="smadu-user-name d-none d-lg-inline"><?= htmlspecialchars(substr($user_nama, 0, 13)); ?></span>
                                <i class="fa fa-chevron-down smadu-caret"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right smadu-dropdown-menu smadu-user-dropdown" aria-labelledby="dropdown-user">
                                <div class="smadu-user-dropdown-header">
                                    <div class="smadu-user-dropdown-avatar"><i class="fa fa-user"></i></div>
                                    <div class="smadu-user-dropdown-info">
                                        <strong><?= htmlspecialchars($user_nama) ?></strong>
                                        <span class="smadu-user-role-label" style="background:<?= $badge_color ?>"><?= $role_badge ?></span>
                                    </div>
                                </div>
                                <div class="dropdown-divider my-1"></div>
                                <?php if($user_role === 'admin'): ?>
                                    <a class="dropdown-item" href="index.php?page=admin_dashboard"><i class="fa fa-tachometer mr-2 text-primary"></i> Dashboard Admin</a>
                                    <a class="dropdown-item" href="index.php?page=admin_dashboard&modul=berita"><i class="fa fa-newspaper-o mr-2 text-success"></i> Kelola Berita</a>
                                    <a class="dropdown-item" href="index.php?page=admin_dashboard&modul=spmb"><i class="fa fa-users mr-2 text-info"></i> Kelola SPMB</a>
                                    <a class="dropdown-item" href="index.php?page=admin_dashboard&modul=guru"><i class="fa fa-id-badge mr-2 text-warning"></i> Kelola Data Guru</a>
                                    <a class="dropdown-item" href="index.php?page=admin_dashboard&modul=siswa"><i class="fa fa-graduation-cap mr-2 text-secondary"></i> Kelola Siswa</a>
                                    <a class="dropdown-item" href="index.php?page=admin_dashboard&modul=setting"><i class="fa fa-key mr-2 text-danger"></i> Ganti Password</a>
                                <?php elseif($user_role === 'guru'): ?>
                                    <a class="dropdown-item" href="index.php?page=guru"><i class="fa fa-id-badge mr-2 text-primary"></i> Profil Guru</a>
                                    <a class="dropdown-item" href="index.php?page=submit_berita"><i class="fa fa-pencil-square-o mr-2 text-success"></i> Posting Berita</a>
                                    <a class="dropdown-item" href="index.php?page=submit_berita&tab=status"><i class="fa fa-history mr-2 text-info"></i> Status Kiriman</a>
                                <?php else: ?>
                                    <a class="dropdown-item" href="index.php?page=siswa"><i class="fa fa-graduation-cap mr-2 text-success"></i> Data Akademik</a>
                                    <a class="dropdown-item" href="index.php?page=prestasi"><i class="fa fa-trophy mr-2 text-warning"></i> Prestasi</a>
                                    <a class="dropdown-item" href="index.php?page=submit_berita"><i class="fa fa-pencil-square-o mr-2 text-primary"></i> Posting Berita</a>
                                    <a class="dropdown-item" href="index.php?page=submit_berita&tab=status"><i class="fa fa-history mr-2 text-info"></i> Status Kiriman</a>
                                <?php endif; ?>
                                <div class="dropdown-divider my-1"></div>
                                <a class="dropdown-item smadu-logout-item" href="auth.php?action=logout"><i class="fa fa-sign-out mr-2"></i> Keluar (Logout)</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item smadu-login-nav">
                            <a class="smadu-login-btn" href="#" data-toggle="modal" data-target="#login" data-bs-toggle="modal" data-bs-target="#login" title="Masuk ke Akun Portal">
                                <i class="fa fa-sign-in"></i> <span>Masuk</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Resilient Interactive Navbar Script for Mobile & Desktop -->
<script>
(function() {
    function initSmaduNavbar() {
        var toggler = document.querySelector('.smadu-hamburger-btn');
        var collapse = document.getElementById('navbars-host');
        if (!toggler || !collapse) return;

        // Toggle mobile menu drawer
        toggler.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var isOpen = collapse.classList.contains('show') || collapse.classList.contains('in');
            if (isOpen) {
                collapse.classList.remove('show', 'in');
                collapse.style.display = '';
                toggler.setAttribute('aria-expanded', 'false');
            } else {
                collapse.classList.add('show', 'in');
                collapse.style.display = 'block';
                toggler.setAttribute('aria-expanded', 'true');
            }
        });

        // Mobile dropdown submenus accordion
        var dropdownToggles = collapse.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    e.stopPropagation();
                    var parentLi = btn.closest('.dropdown');
                    var menu = parentLi ? parentLi.querySelector('.dropdown-menu') : null;
                    if (!parentLi || !menu) return;

                    var isMenuOpen = parentLi.classList.contains('show');
                    // Close sibling dropdowns
                    collapse.querySelectorAll('.smadu-dropdown.show').forEach(function(otherLi) {
                        if (otherLi !== parentLi) {
                            otherLi.classList.remove('show');
                            var otherMenu = otherLi.querySelector('.dropdown-menu');
                            if (otherMenu) otherMenu.style.display = 'none';
                            var otherToggle = otherLi.querySelector('.dropdown-toggle');
                            if (otherToggle) otherToggle.setAttribute('aria-expanded', 'false');
                        }
                    });

                    if (isMenuOpen) {
                        parentLi.classList.remove('show');
                        menu.style.display = 'none';
                        btn.setAttribute('aria-expanded', 'false');
                    } else {
                        parentLi.classList.add('show');
                        menu.style.display = 'block';
                        btn.setAttribute('aria-expanded', 'true');
                    }
                }
            });
        });

        // Close menu when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                if (!collapse.contains(e.target) && !toggler.contains(e.target)) {
                    collapse.classList.remove('show', 'in');
                    collapse.style.display = '';
                    toggler.setAttribute('aria-expanded', 'false');
                }
            }
        });

        // Reset display styling on window resize from mobile to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                collapse.style.display = '';
                collapse.classList.remove('show', 'in');
                toggler.setAttribute('aria-expanded', 'false');
                collapse.querySelectorAll('.dropdown-menu').forEach(function(m) {
                    m.style.display = '';
                });
                collapse.querySelectorAll('.dropdown').forEach(function(d) {
                    d.classList.remove('show');
                });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSmaduNavbar);
    } else {
        initSmaduNavbar();
    }
})();
</script>