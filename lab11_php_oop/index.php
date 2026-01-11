<?php
// 1. Jalankan session pertama kali sebelum kode apa pun
session_start();

// 2. Load konfigurasi dan library
include "config.php";
include "class/database.php";
include "class/form.php";

// 3. Tangkap URL untuk Routing
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));

$mod = (isset($segments[0]) && $segments[0] != '') ? $segments[0] : 'home';
$page = (isset($segments[1]) && $segments[1] != '') ? $segments[1] : 'index';

// 4. PROTEKSI LOGIN & WHITELIST
// Tentukan halaman yang boleh diakses tanpa login
$allowedPages = ['login', 'register'];
$isAuthPage = ($mod == 'user' && in_array($page, $allowedPages));

// Jika belum login DAN mencoba akses halaman selain login/register, lempar ke login
if (!isset($_SESSION['login']) && !$isAuthPage) {
    header("Location: /lab11_php_oop/user/login");
    exit;
}

// 5. Tentukan file modul yang akan dimuat
$file = "module/{$mod}/{$page}.php";

// 6. LOAD TAMPILAN
// Jika sedang di halaman auth (login/register), jangan tampilkan header & sidebar
if (!$isAuthPage) {
    include "template/header.php";
}

if (file_exists($file)) {
    include $file;
} else {
    echo '<div class="container mt-5"><div class="alert alert-danger">Halaman tidak ditemukan!</div></div>';
}

if (!$isAuthPage) {
    include "template/footer.php";
}
?>