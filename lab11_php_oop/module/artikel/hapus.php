<?php
// module/artikel/hapus.php
$db = new Database();
$id = $segments[2]; // Mengambil ID dari URL: artikel/hapus/{id}

if (isset($id)) {
    $hapus = $db->delete('artikel', "id = '$id'");
    if ($hapus) {
        // Setelah hapus, langsung lempar balik ke daftar artikel
        header("Location: /lab11_php_oop/artikel/index");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location.href='/lab11_php_oop/artikel/index';</script>";
    }
}
?>