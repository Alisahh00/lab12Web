<?php
// module/user/profile.php
$db = new Database();
$nama_user = $_SESSION['nama'];

// Ambil data terbaru dari database
$result = $db->query("SELECT * FROM users WHERE nama = '$nama_user'");
$user = $result->fetch_assoc();

$msg = "";
$status = "";

if (isset($_POST['update_pass'])) {
    $pass_baru = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($pass_baru === $konfirmasi) {
        $hash = password_hash($pass_baru, PASSWORD_DEFAULT);
        $update = $db->update('users', ['pass' => $hash], "email = '{$user['email']}'");
        
        if ($update) {
            $status = "success";
            $msg = "Password berhasil diperbarui!";
        } else {
            $status = "error";
            $msg = "Gagal memperbarui password.";
        }
    } else {
        $status = "error";
        $msg = "Konfirmasi password tidak cocok!";
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { font-family: 'Montserrat', sans-serif; background-color: #f8fafc; }
    .bg-emerald-custom { background-color: #10b981; }
    .btn-teal { background-color: #00c0a5; color: white; transition: all 0.3s; }
    .btn-teal:hover { background-color: #00a891; transform: translateY(-1px); shadow: 0 4px 12px rgba(0, 192, 165, 0.2); }
</style>

<div class="p-6 lg:p-10">
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-800">My Profile</h3>
        <p class="text-sm text-gray-500">Kelola informasi akun dan keamanan kata sandi Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-center p-8">
                <div class="w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4 border-4 border-emerald-50">
                    <?= strtoupper(substr($user['nama'], 0, 1)); ?>
                </div>
                
                <h4 class="text-xl font-bold text-gray-800"><?= $user['nama']; ?></h4>
                <p class="text-emerald-600 font-semibold text-xs uppercase tracking-widest mt-1 mb-6"><?= $_SESSION['role'] ?? 'User'; ?></p>
                
                <div class="space-y-4 text-left border-t border-gray-50 pt-6">
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Email Address</label>
                        <p class="text-sm text-gray-700 font-medium"><?= $user['email']; ?></p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Account Status</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            <p class="text-sm text-gray-700 font-medium">Active</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-600">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h5 class="text-lg font-bold text-gray-800">Keamanan Akun</h5>
                </div>

                <?php if ($msg): ?>
                    <div class="mb-6 p-4 rounded-2xl text-sm font-medium flex items-center gap-3 <?= $status === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-red-50 text-red-700 border border-red-100' ?>">
                        <i class="bi <?= $status === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?>"></i>
                        <?= $msg ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase px-1">Password Baru</label>
                            <input type="password" name="pass_baru" required placeholder="••••••••"
                                   class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase px-1">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi" required placeholder="••••••••"
                                   class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" name="update_pass" 
                                class="btn-teal px-8 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-teal-100 flex items-center gap-2">
                            <i class="bi bi-save"></i> Perbarui Password
                        </button>
                    </div>
                </form>
                
                <div class="mt-10 p-4 bg-amber-50 rounded-2xl border border-amber-100 flex gap-4">
                    <i class="bi bi-info-circle text-amber-500 text-xl"></i>
                    <p class="text-xs text-amber-700 leading-relaxed">
                        Pastikan password Anda terdiri dari minimal 6 karakter dan mengandung kombinasi huruf dan angka untuk keamanan maksimal.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>