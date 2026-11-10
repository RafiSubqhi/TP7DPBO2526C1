<?php
class Klien {
    private $conn;
    private $table_name = "klien";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ: Tampilkan semua Klien
    public function read() {
        // Menggunakan prepared statement (wajib sesuai modul)
        $query = "SELECT id_klien, nama_perusahaan, email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREATE: Tambah Klien baru
    public function create($nama_perusahaan, $email) {
        $query = "INSERT INTO " . $this->table_name . " (nama_perusahaan, email) VALUES (:nama_perusahaan, :email)";
        $stmt = $this->conn->prepare($query);

        // Bind data untuk keamanan dari SQL Injection
        $stmt->bindParam(":nama_perusahaan", $nama_perusahaan);
        $stmt->bindParam(":email", $email);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE: Hapus Klien
    public function delete($id_klien) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_klien = :id_klien";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_klien", $id_klien);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Ambil 1 data Klien untuk ditaruh di Form Edit
    public function readOne($id_klien) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_klien = :id_klien";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_klien", $id_klien);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Simpan perubahan data Klien
    public function update($id_klien, $nama_perusahaan, $email) {
        $query = "UPDATE " . $this->table_name . " SET nama_perusahaan = :nama, email = :email WHERE id_klien = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama", $nama_perusahaan);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id_klien);
        return $stmt->execute();
    }
}
?>