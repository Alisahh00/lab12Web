<?php
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'judul' => $_POST['judul'],
        'isi'   => $_POST['isi']
    ];
    $simpan = $db->insert('artikel', $data);
    if ($simpan) {
        echo "<div class='alert alert-success'>Artikel berhasil disimpan! <a href='/lab11_php_oop/index.php/artikel/index'>Lihat Daftar</a></div>";
    }
}
?>

<h3>Tambah Artikel Baru</h3>
<form method="POST">
    <div class="mb-3">
        <label>Judul Artikel</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Isi Konten</label>
        <textarea name="isi" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Artikel</button>
    <a href="/lab11_php_oop/index.php/artikel/index" class="btn btn-secondary">Kembali</a>
</form>