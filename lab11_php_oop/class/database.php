<?php
class Database {
    protected $conn;

    public function __construct() {
        // Karena dipanggil lewat index.php utama, path config tetap 'config.php'
        include "config.php";
        $this->conn = new mysqli($config['host'], $config['username'], $config['password'], $config['db_name']);

        if ($this->conn->connect_error) {
            die("Koneksi Gagal: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function insert($table, $data) {
        $keys = implode(",", array_keys($data));
        $vals = "'" . implode("','", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($keys) VALUES ($vals)";
        return $this->conn->query($sql);
    }

    // --- TAMBAHKAN FUNGSI UPDATE DI BAWAH INI ---
    public function update($table, $data, $where) {
        $update_parts = [];
        foreach ($data as $key => $val) {
            $update_parts[] = "$key = '$val'";
        }
        $update_string = implode(", ", $update_parts);
        
        $sql = "UPDATE $table SET $update_string WHERE $where";
        return $this->conn->query($sql);
    }

    // --- SEKALIAN TAMBAHKAN FUNGSI DELETE BIAR LENGKAP ---
    public function delete($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
        return $this->conn->query($sql);
    
    }
    
}
?>