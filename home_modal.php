<div class="modal-dialog modal-dialog-centered smadu-login-modal" style="max-width: 520px;" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
        
        <!-- Header Modal Branding SMAN 2 Kraksaan -->
        <div class="smadu-login-header p-4 text-center text-white" style="background: linear-gradient(135deg, #0F172A 0%, #1B2A4A 100%); position: relative;">
            <button type="button" class="close text-white position-absolute" data-dismiss="modal" aria-label="Close" style="top: 20px; right: 25px; opacity: 0.8; font-size: 28px;">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                <img src="images/logo.png" alt="SMADU Logo" class="navbar-brand-logo" style="height: 50px; width: auto; object-fit: contain;" onerror="this.src='img/logo.png'">
            </div>
            <h3 class="font-weight-bold mb-1 text-white" style="letter-spacing: 1px;">SMAN 2 KRAKSAAN</h3>
            <p class="text-warning small mb-0 font-weight-bold" style="letter-spacing: 2px;">PORTAL LAYANAN TERPADU • SMADU MANTAB</p>
        </div>

        <div class="modal-body p-4 bg-white">
            <!-- Role Switcher Pills -->
            <label class="text-muted small font-weight-bold mb-2 d-block text-center">PILIH TIPE AKUN / ROLE LOGIN:</label>
            <div class="role-switcher-grid mb-4">
                <button type="button" class="role-btn active" data-role="admin" onclick="switchRole('admin')">
                    <i class="fa fa-user-secret"></i> Admin
                </button>
                <button type="button" class="role-btn" data-role="guru" onclick="switchRole('guru')">
                    <i class="fa fa-graduation-cap"></i> Guru / Staf
                </button>
                <button type="button" class="role-btn" data-role="siswa" onclick="switchRole('siswa')">
                    <i class="fa fa-users"></i> Siswa
                </button>
            </div>

            <form role="form" id="smaduMultiRoleForm">
                <input type="hidden" name="role" id="selectedRoleInput" value="admin">
                
                <div id="loginAlertBox" class="alert d-none" role="alert"></div>

                <!-- Info Role Badge -->
                <div class="p-3 bg-light rounded border mb-3 text-center" id="roleInfoBadge">
                    <small class="text-primary font-weight-bold" id="roleDescriptionText">
                        <i class="fa fa-info-circle"></i> Otentikasi Administrator Sistem SMAN 2 Kraksaan.
                    </small>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label font-weight-bold text-dark small" id="usernameLabel">Username Admin:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fa fa-user text-muted" id="userIcon"></i></span>
                        <input class="form-control py-2" id="loginUsername" name="username" placeholder="Masukkan username admin..." type="text" required>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label font-weight-bold text-dark small">Password:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fa fa-lock text-muted"></i></span>
                        <input class="form-control py-2" id="loginPassword" name="password" placeholder="Masukkan password..." type="password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 font-weight-bold rounded-3 shadow-sm mb-2" id="btnSubmitLogin" style="background:#1B2A4A; border:none; font-size:16px;">
                    <i class="fa fa-sign-in me-2"></i> Masuk Sekarang
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function switchRole(role) {
    document.getElementById('selectedRoleInput').value = role;
    
    const roleBtns = document.querySelectorAll('.role-btn');
    roleBtns.forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.role-btn[data-role="${role}"]`).classList.add('active');
    
    const label = document.getElementById('usernameLabel');
    const input = document.getElementById('loginUsername');
    const badgeText = document.getElementById('roleDescriptionText');
    const userIcon = document.getElementById('userIcon');
    
    if (role === 'admin') {
        label.innerHTML = 'Username Admin:';
        input.placeholder = 'Masukkan username admin...';
        badgeText.innerHTML = '<i class="fa fa-info-circle"></i> Otentikasi Administrator Sistem SMAN 2 Kraksaan.';
        userIcon.className = 'fa fa-user-secret text-muted';
    } else if (role === 'guru') {
        label.innerHTML = 'Email / NIP / ID GTK Guru:';
        input.placeholder = 'Contoh: asna8694@gmail.com / NIP...';
        badgeText.innerHTML = '<i class="fa fa-info-circle"></i> Otentikasi Guru & Staf Pengajar SMAN 2 Kraksaan.';
        userIcon.className = 'fa fa-graduation-cap text-muted';
    } else if (role === 'siswa') {
        label.innerHTML = 'NISN / NIPD / Email Siswa:';
        input.placeholder = 'Contoh: 0045775440 (NISN)...';
        badgeText.innerHTML = '<i class="fa fa-info-circle"></i> Otentikasi Siswa / Siswi Aktif SMAN 2 Kraksaan.';
        userIcon.className = 'fa fa-user text-muted';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById('smaduMultiRoleForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitLogin');
            const alertBox = document.getElementById('loginAlertBox');
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses Otentikasi...';
            
            const formData = new FormData(this);
            formData.append('action', 'login');
            
            fetch('auth.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                alertBox.classList.remove('d-none', 'alert-danger', 'alert-success', 'alert-info');
                if (data.success) {
                    alertBox.classList.add('alert-success');
                    alertBox.innerHTML = data.message;
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    alertBox.classList.add('alert-danger');
                    alertBox.innerHTML = data.message;
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa fa-sign-in me-2"></i> Masuk Sekarang';
                }
            })
            .catch(err => {
                alertBox.classList.remove('d-none', 'alert-success', 'alert-info');
                alertBox.classList.add('alert-danger');
                alertBox.innerHTML = 'Terjadi kesalahan saat memproses data.';
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-sign-in me-2"></i> Masuk Sekarang';
            });
        });
    }
});
</script>