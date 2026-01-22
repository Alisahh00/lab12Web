<?php
// module/user/login.php
$db = new Database();
$error_msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['username']; 
    $password = $_POST['password'];

    // Ambil data user - Gunakan Prepared Statements jika class Database mendukung untuk keamanan
    $result = $db->query("SELECT * FROM users WHERE email = '$email'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['login'] = true;
        $_SESSION['nama']  = $user['nama'];
        $_SESSION['role']  = $user['role']; // PENTING: Simpan role ke session agar sidebar berfungsi!
        
        header("Location: /lab11_php_oop/home/index");
        exit();
    } else {
        $error_msg = "Email atau password salah!";
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { font-family: 'Montserrat', sans-serif; }
    .bg-emerald-custom { background-color: #10b981; }
    .bg-teal-custom { background-color: #00c0a5; }
    /* Memastikan navigasi global tidak muncul di halaman login */
    nav, aside, header { display: none !important; }
</style>

<div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden min-h-[550px]">
        
        <div class="w-full md:w-3/5 p-8 md:p-16 flex flex-col justify-center items-center text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Sign in</h1>


            <?php if ($error_msg): ?>
                <div class="mb-4 bg-red-50 text-red-500 px-4 py-2 rounded-lg text-sm font-medium border border-red-100 w-full max-w-sm">
                    <i class="bi bi-exclamation-circle mr-2"></i> <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="w-full max-w-sm space-y-4">
                <div class="relative">
                    <i class="bi bi-envelope absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="email" name="username" required placeholder="Email" 
                           class="w-full pl-12 pr-4 py-3 bg-gray-100 border-none rounded-xl focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                </div>

                <div class="relative">
                    <i class="bi bi-lock absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="password" name="password" required placeholder="Password"
                           class="w-full pl-12 pr-4 py-3 bg-gray-100 border-none rounded-xl focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                </div>

                <a href="#" class="text-sm text-gray-600 hover:underline block mb-4">Lupa password anda?</a>

                <button type="submit" name="login" 
                        class="px-12 py-3 bg-teal-custom text-white font-bold rounded-full uppercase tracking-wider text-sm hover:bg-teal-600 transition-all active:scale-95 shadow-lg shadow-teal-100">
                    Sign In
                </button>
            </form>
        </div>

        <div class="w-full md:w-2/5 bg-emerald-custom p-8 md:p-12 flex flex-col justify-center items-center text-center text-white">
            <h2 class="text-4xl font-bold mb-6">Halo, Teman!</h2>
            <p class="mb-10 leading-relaxed font-light">
                Daftarkan diri anda dan mulai gunakan layanan kami segera.
            </p>
            
            <a href="/lab11_php_oop/user/register" 
               class="px-12 py-3 border-2 border-white rounded-full uppercase tracking-wider text-sm font-bold hover:bg-white hover:text-emerald-custom transition-all">
                Sign Up
            </a>
        </div>
        
    </div>
</div>