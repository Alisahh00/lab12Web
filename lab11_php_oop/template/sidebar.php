<?php
// module/template/sidebar.php
$role = $_SESSION['role'] ?? 'User';
$nama_user = $_SESSION['nama'] ?? 'Guest';
?>

<aside class="w-64 min-h-screen bg-white border-r border-gray-100 flex flex-col fixed left-0 top-0 z-50 shadow-sm">
    <div class="p-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-100">
            <i class="bi bi-grid-fill"></i>
        </div>
        <span class="text-xl font-bold text-gray-800">EduDash</span>
    </div>

    <div class="px-6 mb-6">
        <div class="p-3 bg-gray-50 rounded-2xl flex items-center gap-3">
            <div class="w-9 h-9 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                <?= strtoupper(substr($nama_user, 0, 1)); ?>
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-gray-800 truncate"><?= $nama_user ?></p>
                <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider"><?= $role ?></p>
            </div>
        </div>
    </div>

    <nav class="flex-grow px-4 space-y-1.5">
        <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Menu</p>
        
        <a href="/lab11_php_oop/home/index" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-all group">
            <i class="bi bi-house-door text-lg"></i>
            <span class="text-sm font-semibold">Home</span>
        </a>

        <a href="/lab11_php_oop/artikel/index" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-all">
            <i class="bi bi-file-earmark-text text-lg"></i>
            <span class="text-sm font-semibold">Daftar Artikel</span>
        </a>

        <?php if ($role === 'admin'): ?>
            <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-3">Admin Only</p>
            <a href="/lab11_php_oop/user/tambah" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                <i class="bi bi-person-plus text-lg"></i>
                <span class="text-sm font-semibold">Tambah User</span>
            </a>
        <?php endif; ?>

        <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-3">Settings</p>
        <a href="/lab11_php_oop/user/profile" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-all">
            <i class="bi bi-person-circle text-lg"></i>
            <span class="text-sm font-semibold">My Profile</span>
        </a>
    </nav>

    <div class="p-4 border-t border-gray-50">
        <a href="/lab11_php_oop/user/logout" 
           onclick="return confirm('Apakah Anda yakin ingin keluar?')"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition-all group">
            <i class="bi bi-box-arrow-left text-lg group-hover:translate-x-1 transition-transform"></i>
            <span class="text-sm font-bold">Logout</span>
        </a>
    </div>
</aside>

<div class="w-64 h-full shrink-0"></div>