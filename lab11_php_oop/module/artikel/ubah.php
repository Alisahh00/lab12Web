<?php
$db = new Database();
$id = $segments[2]; // Mengambil ID dari URL /artikel/ubah/{id}

// Ambil data lama
$data_lama = $db->query("SELECT * FROM artikel WHERE id = '$id'")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_baru = [
        'judul' => $_POST['judul'],
        'isi'   => $_POST['isi']
    ];
    $update = $db->update('artikel', $data_baru, "id = '$id'");
    if ($update) {
        echo "<div class='alert alert-success'>Artikel berhasil diupdate! <a href='/lab11_php_oop/index.php/artikel/index'>Lihat Daftar</a></div>";
    }
}
?>

<h3>Ubah Artikel</h3>
<form method="POST">
    <div class="mb-3">
        <label>Judul Artikel</label>
        <input type="text" name="judul" class="form-control" value="<?= $data_lama['judul']; ?>" required>
    </div>
    <div class="mb-3">
        <label>Isi Konten</label>
        <textarea name="isi" class="form-control" rows="5" required Fitz><?= $data_lama['isi']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Update Artikel</button>
</form>