<?php
// module/user/register.php
$db = new Database();
$success_msg = "";
$error_msg = "";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Ambil data role dari form
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $check_email = $db->query("SELECT * FROM users WHERE email = '$email'");
    
    if ($check_email->num_rows > 0) {
        $error_msg = "Email sudah terdaftar! Gunakan email lain.";
    } else {
        // Tambahkan 'role' ke dalam array data untuk insert ke DB
        $data = [
            'nama' => $nama,
            'email' => $email,
            'pass' => $hashed_password,
            'role' => $role 
        ];
        
        if ($db->insert('users', $data)) {
            $success_msg = "Akun <b>$role</b> berhasil dibuat! Silakan <a href='/lab11_php_oop/user/login' class='font-bold underline'>Login di sini</a>.";
        } else {
            $error_msg = "Gagal mendaftar. Coba lagi nanti.";
        }
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { font-family: 'Montserrat', sans-serif; }
    .bg-emerald-custom { background-color: #10b981; }
    .bg-teal-custom { background-color: #00c0a5; }
    nav, aside, footer { display: none !important; }
</style>

<div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden min-h-[600px]">
        
        <div class="w-full md:w-2/5 bg-emerald-custom p-8 md:p-12 flex flex-col justify-center items-center text-center text-white">
            <h2 class="text-4xl font-bold mb-6">Welcome Back!</h2>
            <p class="mb-10 leading-relaxed font-light">
                Untuk tetap terhubung dengan kami, silakan login dengan akun yang sudah ada.
            </p>
            
            <a href="/lab11_php_oop/user/login" 
               class="px-12 py-3 border-2 border-white rounded-full uppercase tracking-wider text-sm font-bold hover:bg-white hover:text-emerald-custom transition-all">
                Sign In
            </a>
        </div>

        <div class="w-full md:w-3/5 p-8 md:p-12 flex flex-col justify-center items-center text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Create Account</h1>

            
            <p class="text-gray-400 text-sm mb-6">lengkapi data diri anda</p>

            <?php if ($error_msg): ?>
                <div class="mb-4 text-red-500 text-sm font-medium italic bg-red-50 px-4 py-2 rounded-lg w-full max-w-sm">
                    <i class="bi bi-exclamation-circle mr-1"></i> <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <?php if ($success_msg): ?>
                <div class="mb-4 text-emerald-600 text-sm font-medium bg-emerald-50 px-4 py-2 rounded-lg w-full max-w-sm">
                    <i class="bi bi-check-circle mr-1"></i> <?= $success_msg ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="w-full max-w-sm space-y-4">
                <input type="text" name="nama" required placeholder="Full Name" 
                       class="w-full px-4 py-3 bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-teal-500 outline-none transition-all">

                <input type="email" name="email" required placeholder="Email Address" 
                       class="w-full px-4 py-3 bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-teal-500 outline-none transition-all">

                <input type="password" name="password" required placeholder="Password"
                       class="w-full px-4 py-3 bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-teal-500 outline-none transition-all">

                <div class="relative">
                    <select name="role" required 
                            class="w-full px-4 py-3 bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-teal-500 outline-none transition-all appearance-none text-gray-500 font-medium">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" name="register" 
                            class="px-12 py-3 bg-teal-custom text-white font-bold rounded-full uppercase tracking-wider text-sm hover:bg-teal-600 transition-all active:scale-95 shadow-md">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>