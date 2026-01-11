<aside class="bg-light border-end" style="width: 250px; min-height: 100vh; display: flex; flex-direction: column;">
    <div class="p-3 flex-grow-1">
        <h5 class="mb-4 fw-bold">EduDash Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark" href="/lab11_php_oop/home/index">
                    🏠 Home
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark" href="/lab11_php_oop/artikel/index">
                    📝 Daftar Artikel
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark" href="/lab11_php_oop/user/tambah">
                    👤 Tambah User
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark" href="/lab11_php_oop/user/profile">
                    ⚙️ My Profile
                </a>
            </li>
            
            <li class="nav-item mt-4">
                <hr class="text-muted">
                <a class="nav-link border rounded bg-white shadow-sm text-danger fw-bold" 
                   href="/lab11_php_oop/user/logout" 
                   onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    🚪 Logout
                </a>
            </li>
        </ul>
    </div>
    <div class="p-3 border-top bg-white">
        <small class="text-muted">Logged in as:</small><br>
        <span class="fw-bold text-primary">@<?= $_SESSION['nama'] ?? 'Admin'; ?></span>
    </div>
</aside>