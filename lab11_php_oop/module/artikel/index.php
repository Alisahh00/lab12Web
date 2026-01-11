<?php
$db = new Database();
$result = $db->query("SELECT * FROM artikel");
?>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Artikel</h3>
        <a href="/lab11_php_oop/artikel/tambah" class="btn btn-primary">Tambah Baru</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['judul']; ?></td>
                <td>
                    <a href="/lab11_php_oop/artikel/ubah/<?= $row['id']; ?>" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    
                    <a href="/lab11_php_oop/artikel/hapus/<?= $row['id']; ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus artikel [<?= $row['judul']; ?>]?')">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>