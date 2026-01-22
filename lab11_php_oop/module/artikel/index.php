<?php
// module/artikel/index.php
$db = new Database();

// 1. Logika Searching
$search = isset($_GET['q']) ? $_GET['q'] : '';
$whereClause = $search ? "WHERE judul LIKE '%$search%'" : '';

// 2. Logika Pagination
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data untuk pagination
$total_result = $db->query("SELECT COUNT(*) as total FROM artikel $whereClause");
$total_data = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

// Ambil data dengan Limit dan Offset
$result = $db->query("SELECT * FROM artikel $whereClause ORDER BY id DESC LIMIT $limit OFFSET $offset");
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { font-family: 'Montserrat', sans-serif; background-color: #f8fafc; }
    .bg-emerald-custom { background-color: #10b981; }
    .text-emerald-custom { color: #10b981; }
    .btn-teal { background-color: #00c0a5; color: white; transition: all 0.3s; }
    .btn-teal:hover { background-color: #00a891; transform: translateY(-1px); }
</style>

<div class="p-6 lg:p-10">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Artikel</h3>
            <p class="text-sm text-gray-500">Total: <?= $total_data ?> artikel ditemukan</p>
        </div>
        
        <div class="flex w-full md:w-auto gap-3">
            <form action="" method="GET" class="relative flex-grow md:w-64">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari judul..." 
                       class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
            </form>
            
            <a href="/lab11_php_oop/artikel/tambah" class="btn-teal px-6 py-2 rounded-xl font-bold text-sm flex items-center shadow-lg shadow-teal-100">
                <i class="bi bi-plus-lg mr-2"></i> Tambah Baru
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Judul Artikel</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-700"><?= $row['judul']; ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="/lab11_php_oop/artikel/ubah/<?= $row['id']; ?>" 
                                       class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <i class="bi bi-pencil-square text-lg"></i>
                                    </a>
                                    <a href="/lab11_php_oop/artikel/hapus/<?= $row['id']; ?>" 
                                       onclick="return confirm('Hapus artikel ini?')"
                                       class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="bi bi-trash3 text-lg"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="px-6 py-10 text-center text-gray-400 italic">Data tidak ditemukan...</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($total_pages > 1): ?>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
            <nav class="flex gap-2">
                <?php if($page > 1): ?>
                    <a href="?p=<?= $page-1 ?>&q=<?= $search ?>" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:border-emerald-500 hover:text-emerald-500 transition-all">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?p=<?= $i ?>&q=<?= $search ?>" 
                       class="w-10 h-10 flex items-center justify-center rounded-lg border transition-all <?= $i == $page ? 'bg-emerald-custom text-white border-emerald-custom shadow-md shadow-emerald-100' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-500 hover:text-emerald-500' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if($page < $total_pages): ?>
                    <a href="?p=<?= $page+1 ?>&q=<?= $search ?>" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:border-emerald-500 hover:text-emerald-500 transition-all">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
        <?php endif; ?>
    </div>
</div>