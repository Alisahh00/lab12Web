<?php
$db = new Database();
$form = new Form("", "Simpan User");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama'  => $_POST['nama'],
        'email' => $_POST['email'],
        'pass'  => password_hash($_POST['pass'], PASSWORD_DEFAULT)
    ];
    
    $simpan = $db->insert('users', $data);
    if ($simpan) {
        echo "<div class='alert alert-success'>User berhasil ditambahkan!</div>";
    }
}

echo "<h3>Tambah User Baru</h3>";
$form->addField("nama", "Nama Lengkap");
$form->addField("email", "Email", "text");
$form->addField("pass", "Password", "password");
$form->displayForm();
?>