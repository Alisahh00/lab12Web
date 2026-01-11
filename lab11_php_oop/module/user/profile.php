<?php
// module/user/profile.php
$db = new Database();
$nama_user = $_SESSION['nama'];

// Ambil data terbaru dari database berdasarkan nama (atau id jika ada di session)
$result = $db->query("SELECT * FROM users WHERE nama = '$nama_user'");
$user = $result->fetch_assoc();

$msg = "";

if (isset($_POST['update_pass'])) {
    $pass_baru = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($pass_baru === $konfirmasi) {
        $hash = password_hash($pass_baru, PASSWORD_DEFAULT);
        $update = $db->update('users', ['pass' => $hash], "email = '{$user['email']}'");
        
        if ($update) {
            $msg = "<div class='alert alert-success'>Password berhasil diperbarui!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Gagal memperbarui password.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Konfirmasi password tidak cocok!</div>";
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person-circle"></i> Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted" width="30%">Nama Lengkap</td>
                            <td class="fw-bold">: <?= $user['nama']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td class="fw-bold">: <?= $user['email']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-shield-lock"></i> Ganti Password</h5>
                </div>
                <div class="card-body">
                    <?= $msg; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Baru</label>
                            <input type="password" name="pass_baru" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi" class="form-control" placeholder="Ulangi password baru" required>
                        </div>
                        <button type="submit" name="update_pass" class="btn btn-dark w-100">
                            Simpan Password Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>