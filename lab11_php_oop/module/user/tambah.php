<?php
// module/user/tambah.php
$db = new Database();
$msg = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama'  => $_POST['nama'],
        'email' => $_POST['email'],
        'pass'  => password_hash($_POST['pass'], PASSWORD_DEFAULT),
        'role'  => $_POST['role']
    ];
    
    $simpan = $db->insert('users', $data);
    if ($simpan) {
        $status = "success";
        $msg = "User <b>{$_POST['nama']}</b> berhasil ditambahkan!";
    } else {
        $status = "error";
        $msg = "Gagal menambahkan user. Pastikan email belum terdaftar.";
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="flex items-center justify-center min-h-[80vh] p-4">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100">
        
        <div class="w-full md:w-2/5 bg-[#10b981] p-10 flex flex-col justify-center items-center text-center text-white">
            <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center text-4xl mb-6 shadow-inner">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h2 class="text-3xl font-bold mb-4">New Member</h2>
            <p class="mb-8 leading-relaxed font-light opacity-90">
                Tambahkan anggota tim baru dan berikan hak akses sesuai dengan peran mereka.
            </p>

        </div>

        <div class="w-full md:w-3/5 p-10 md:p-14 flex flex-col justify-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Create Account</h1>
            <p class="text-gray-400 text-sm mb-8">Lengkapi data di bawah ini untuk mendaftarkan user</p>

            <?php if ($msg): ?>
                <div class="mb-6 p-4 rounded-2xl text-sm flex items-center gap-3 <?= $status === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-red-50 text-red-700 border border-red-100' ?>">
                    <i class="bi <?= $status === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?>"></i>
                    <span><?= $msg ?></span>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-4">
                <div class="relative">
                    <i class="bi bi-person absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="text" name="nama" required placeholder="Nama Lengkap" 
                           class="w-full pl-12 pr-4 py-3.5 bg-gray-100 border-none rounded-xl focus:ring-2 focus:ring-[#00c0a5] outline-none transition-all text-sm">
                </div>

                <div class="relative">
                    <i class="bi bi-envelope absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="email" name="email" required placeholder="Email Address" 
                           class="w-full pl-12 pr-4 py-3.5 bg-gray-100 border-none rounded-xl focus:ring-2 focus:ring-[#00c0a5] outline-none transition-all text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="password" name="pass" required placeholder="Password"
                               class="w-full pl-12 pr-4 py-3.5 bg-gray-100 border-none rounded-xl focus:ring-2 focus:ring-[#00c0a5] outline-none transition-all text-sm">
                    </div>
                    
                    <div class="relative">
                        <i class="bi bi-shield-check absolute left-4 top-3.5 text-gray-400"></i>
                        <select name="role" required 
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-100 border-none rounded-xl focus:ring-2 focus:ring-[#00c0a5] outline-none transition-all text-sm appearance-none cursor-pointer">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-4 text-[10px] text-gray-400"></i>
                    </div>
                </div>

                <div class="pt-6 flex justify-center md:justify-start">
                    <button type="submit" 
                            class="px-14 py-4 bg-[#00c0a5] text-white font-bold rounded-full uppercase tracking-widest text-xs hover:bg-[#00a891] transition-all active:scale-95 shadow-lg shadow-teal-100">
                        Sign Up User
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>