<?php
// module/user/register.php
$db = new Database();
$success_msg = "";
$error_msg = "";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash password agar aman dan bisa dibaca password_verify saat login
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $check_email = $db->query("SELECT * FROM users WHERE email = '$email'");
    
    if ($check_email->num_rows > 0) {
        $error_msg = "Email sudah terdaftar! Gunakan email lain.";
    } else {
        // Insert data ke database
        $data = [
            'nama' => $nama,
            'email' => $email,
            'pass' => $hashed_password
        ];
        
        if ($db->insert('users', $data)) {
            $success_msg = "Akun berhasil dibuat! Silakan <a href='/lab11_php_oop/user/login' class='font-bold underline'>Login di sini</a>.";
        } else {
            $error_msg = "Gagal mendaftar. Coba lagi nanti.";
        }
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .bg-pattern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        background-image: url('https://www.transparenttextures.com/patterns/cubes.png'), linear-gradient(135deg, #10b981 0%, #047857 100%);
    }
    nav, aside, footer { display: none !important; }
</style>

<div class="flex min-h-screen bg-white fixed inset-0 z-[9999]">
    <div class="hidden lg:flex lg:w-1/2 bg-pattern p-16 flex-col justify-between text-white relative overflow-hidden">
        <div class="relative z-10">
            <div class="text-4xl mb-8">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h1 class="text-6xl font-bold leading-tight">Join <br>EduDash! 🚀</h1>
            <p class="mt-6 text-lg text-emerald-100 max-w-md leading-relaxed">
                Buat akun admin baru untuk mengelola konten artikel dan manajemen user secara efisien.
            </p>
        </div>
        <div class="relative z-10 text-sm text-emerald-200">
            © 2025 Lab Informatika. All rights reserved.
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16">
        <div class="w-full max-w-md">
            <h2 class="text-3xl font-bold text-slate-900 mb-2">Create Account</h2>
            <p class="text-sm text-slate-500 mt-2 mb-8">Sudah punya akun? <a href="/lab11_php_oop/user/login" class="text-emerald-600 font-bold hover:underline">Login di sini</a></p>

            <?php if ($error_msg): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    <i class="bi bi-exclamation-circle-fill mr-2"></i> <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <?php if ($success_msg): ?>
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm rounded-r-lg">
                    <i class="bi bi-check-circle-fill mr-2"></i> <?= $success_msg ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-5">
                <div class="border-b-2 border-slate-200 focus-within:border-emerald-500 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Full Name</label>
                    <input type="text" name="nama" required placeholder="John Doe" 
                           class="w-full bg-transparent outline-none text-slate-800 font-medium">
                </div>

                <div class="border-b-2 border-slate-200 focus-within:border-emerald-500 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Email Address</label>
                    <input type="email" name="email" required placeholder="admin@mail.com" 
                           class="w-full bg-transparent outline-none text-slate-800 font-medium">
                </div>

                <div class="border-b-2 border-slate-200 focus-within:border-emerald-500 transition-all py-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full bg-transparent outline-none text-slate-800 font-medium">
                </div>

                <button type="submit" name="register" 
                        class="w-full bg-emerald-600 text-white py-4 rounded-xl font-bold hover:bg-emerald-700 transition-all active:scale-[0.98] shadow-lg shadow-emerald-100">
                    Register Now
                </button>
            </form>
        </div>
    </div>
</div>