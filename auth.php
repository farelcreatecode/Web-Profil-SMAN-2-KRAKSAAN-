<?php
// auth.php - Handle multi-role login (Admin, Guru, Siswa) & Google Auth
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "config/koneksi.php";

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

if ($action === 'login') {
    $role = isset($_POST['role']) ? $_POST['role'] : 'admin';
    $raw_username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    $username = function_exists('clean_input') ? clean_input($raw_username, $con) : mysqli_real_escape_string($con, trim($raw_username));
    
    if (empty($username)) {
        echo json_encode(['success' => false, 'message' => 'Silakan isi username / NIP / NISN.']);
        exit;
    }

    if ($role === 'admin') {
        $query = mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");
        if ($query && mysqli_num_rows($query) > 0) {
            $admin = mysqli_fetch_array($query);
            $pass_valid = false;
            if (password_verify($password, $admin['password'])) {
                $pass_valid = true;
            } elseif ($password === $admin['password']) {
                $pass_valid = true;
            }

            if ($pass_valid) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_role'] = 'admin';
                $_SESSION['user_id'] = $admin['id_admin'];
                $_SESSION['user_nama'] = $admin['nama'];
                $_SESSION['user_username'] = $admin['username'];
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id_admin'];
                $_SESSION['admin_nama'] = $admin['nama'];
                $_SESSION['admin_username'] = $admin['username'];
                
                echo json_encode([
                    'success' => true, 
                    'message' => 'Selamat Datang Admin ('.$admin['nama'].')!', 
                    'redirect' => 'index.php?page=admin_dashboard'
                ]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Password Admin tidak cocok!']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Username Admin tidak ditemukan!']);
            exit;
        }
    } elseif ($role === 'guru') {
        $query = mysqli_query($con, "SELECT * FROM gtk WHERE id_gtk='$username' OR email='$username' OR nip='$username' OR nik='$username' OR nama LIKE '%$username%' LIMIT 1");
        if ($query && mysqli_num_rows($query) > 0) {
            $guru = mysqli_fetch_array($query);
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_nama']);
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_role'] = 'guru';
            $_SESSION['user_id'] = $guru['id_gtk'];
            $_SESSION['user_nama'] = $guru['nama'];
            $_SESSION['user_username'] = !empty($guru['email']) ? $guru['email'] : $guru['id_gtk'];
            $_SESSION['user_avatar'] = !empty($guru['foto']) ? $guru['foto'] : 'profile.jpg';
            $_SESSION['user_info'] = !empty($guru['jenis_ptk']) ? $guru['jenis_ptk'] : 'Guru SMAN 2 Kraksaan';
            
            echo json_encode([
                'success' => true, 
                'message' => 'Login Guru Berhasil! Selamat datang Bapak/Ibu '.$guru['nama'], 
                'redirect' => 'index.php?page=guru'
            ]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Guru (NIP / Email / ID GTK) tidak ditemukan!']);
            exit;
        }
    } elseif ($role === 'siswa') {
        $query = mysqli_query($con, "SELECT * FROM siswa WHERE NISN='$username' OR NIPD='$username' OR Email='$username' OR Nama LIKE '%$username%' LIMIT 1");
        if ($query && mysqli_num_rows($query) > 0) {
            $siswa = mysqli_fetch_array($query);
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_nama']);
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_role'] = 'siswa';
            $_SESSION['user_id'] = $siswa['id_siswa'];
            $_SESSION['user_nama'] = $siswa['Nama'];
            $_SESSION['user_username'] = $siswa['NISN'];
            $_SESSION['user_kelas'] = !empty($siswa['Kelas']) ? $siswa['Kelas'] : 'Siswa SMADU';
            $_SESSION['user_avatar'] = !empty($siswa['foto']) ? $siswa['foto'] : 'user.png';
            
            echo json_encode([
                'success' => true, 
                'message' => 'Login Siswa Berhasil! Selamat datang '.$siswa['Nama'].' ('.$siswa['Kelas'].')', 
                'redirect' => 'index.php?page=siswa'
            ]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Data Siswa (NISN / NIPD / Email) tidak ditemukan!']);
            exit;
        }
    }
}

if ($action === 'logout') {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header('Location: index.php?page=home');
    exit;
}
?>

