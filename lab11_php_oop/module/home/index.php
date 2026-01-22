<?php
// module/home/index.php
$db = new Database();
// Pastikan session sudah dimulai di file utama (index.php)
// Kita ambil nama dari session untuk menyapa user
$nama_user = $_SESSION['nama'] ?? 'Admin';
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { 
        font-family: 'Montserrat', sans-serif; 
        background-color: #f3f4f6; /* Abu-abu muda agar card putih terlihat kontras */
    }
    .bg-emerald-custom { background-color: #10b981; }
    .text-emerald-custom { color: #10b981; }
    .bg-teal-custom { background-color: #00c0a5; }
</style>

<div class="p-6 lg:p-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, <?= $nama_user ?>! 👋</h1>
            <p class="text-gray-500 mt-1">Ini adalah Dashboard Admin Panel konsep PHP OOP Modular.</p>
        </div>
        <div>
            <span class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold border border-emerald-200">
                <i class="bi bi-calendar3 mr-2"></i> <?= date('d M Y') ?>
            </span>
        </div>
    </div>

 
        </div>
    </div>
</div>