<?php
// User.php
class User {
    public $id;
    public $name;
    public $email;
    
    public function save() {
        // Logika untuk menyimpan data pengguna ke database
    }
    
    public static function find($id) {
        // Logika untuk menemukan pengguna berdasarkan ID
    }
}
