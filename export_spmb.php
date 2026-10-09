<?php
// export_spmb.php - Export SPMB Registrants to Excel (.xls)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("Unauthorized access.");
}

include_once "config/koneksi.php";

$filename = "Rekap_Pendaftar_SPMB_" . date('Y-m-d') . ".xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

$query = mysqli_query($con, "SELECT * FROM pendaftaran_spmb ORDER BY id_pendaftaran DESC");
?>
<table border="1">
    <thead>
        <tr style="background-color:#1B2A4A; color:#ffffff;">
            <th>No</th>
            <th>No. Pendaftaran</th>
            <th>Nama Lengkap</th>
            <th>NISN</th>
            <th>Asal Sekolah</th>
            <th>Jurusan</th>
            <th>No. WhatsApp</th>
            <th>Alamat</th>
            <th>Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['no_pendaftaran'] . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nisn']) . "</td>";
            echo "<td>" . htmlspecialchars($row['asal_sekolah']) . "</td>";
            echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
            echo "<td>'" . htmlspecialchars($row['no_hp']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td>" . $row['tanggal_daftar'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
