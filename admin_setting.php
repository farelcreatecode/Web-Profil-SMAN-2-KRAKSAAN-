<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='index.php?page=home';</script>";
    exit;
}

include_once "config/koneksi.php";
?>

<?php
$current_admin_user = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : (isset($_SESSION['user_username']) ? $_SESSION['user_username'] : 'admin');
?>

<div class="row">
    <div class="col-lg-8 col-12">
        <div class="admin-main-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="mb-1 font-weight-bold text-dark">
                        <i class="fa fa-lock text-primary me-2"></i> Pengaturan Akun & Keamanan
                    </h5>
                    <small class="text-muted">Perbarui kata sandi akun administrator untuk menjaga keamanan portal sistem.</small>
                </div>
            </div>
            <div class="card-body p-4">
                <div id="settingAlert" class="alert d-none" role="alert"></div>
                
                <form id="formChangePassword">
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small text-dark">Username Administrator</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa fa-user text-muted"></i></span>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($current_admin_user) ?>" disabled style="background:#f8fafc; font-weight:600;">
                        </div>
                        <small class="text-muted">Username default sistem tidak dapat diubah sembarangan.</small>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small text-dark">Password Lama <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa fa-key text-muted"></i></span>
                            <input type="password" class="form-control" name="old_password" placeholder="Masukkan password saat ini..." required>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold small text-dark">Password Baru <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa fa-lock text-muted"></i></span>
                            <input type="password" class="form-control" name="new_password" placeholder="Minimal 6 karakter..." required>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold small text-dark">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa fa-check text-muted"></i></span>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Ketik ulang password baru..." required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary font-weight-bold px-4 py-2" id="btnSavePass" style="background:#1B2A4A; border:none; border-radius:8px;">
                        <i class="fa fa-save me-1"></i> Simpan Password Baru
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('formChangePassword').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSavePass');
    const alert = document.getElementById('settingAlert');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';
    
    const formData = new FormData(this);
    formData.append('action', 'change_password');
    
    fetch('api_admin.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert.classList.remove('d-none', 'alert-danger', 'alert-success');
        if (data.success) {
            alert.classList.add('alert-success');
            alert.innerHTML = '<i class="fa fa-check-circle"></i> ' + data.message;
            this.reset();
        } else {
            alert.classList.add('alert-danger');
            alert.innerHTML = '<i class="fa fa-exclamation-circle"></i> ' + data.message;
        }
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Password Baru';
    })
    .catch(err => {
        alert.classList.remove('d-none', 'alert-success');
        alert.classList.add('alert-danger');
        alert.innerHTML = '<i class="fa fa-exclamation-circle"></i> Terjadi kesalahan. Silakan coba lagi.';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Password Baru';
    });
});
</script>
