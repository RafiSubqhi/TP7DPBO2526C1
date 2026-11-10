<?php
class Proyek {
    private $conn;
    private $table_name = "proyek";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ: Join dengan tabel Klien dan Freelancer untuk mendapatkan nama
    public function read() {
        $query = "SELECT p.id_proyek, p.judul_proyek, p.harga, k.nama_perusahaan, f.nama_freelancer 
                  FROM " . $this->table_name . " p
                  LEFT JOIN klien k ON p.id_klien = k.id_klien
                  LEFT JOIN freelancer f ON p.id_freelancer = f.id_freelancer";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($judul_proyek, $harga, $id_klien, $id_freelancer) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (judul_proyek, harga, id_klien, id_freelancer) 
                  VALUES (:judul_proyek, :harga, :id_klien, :id_freelancer)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":judul_proyek", $judul_proyek);
        $stmt->bindParam(":harga", $harga);
        $stmt->bindParam(":id_klien", $id_klien);
        $stmt->bindParam(":id_freelancer", $id_freelancer);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE: Hapus Proyek
    public function delete($id_proyek) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_proyek = :id_proyek";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_proyek", $id_proyek);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne($id_proyek) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_proyek = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id_proyek);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_proyek, $judul_proyek, $harga, $id_klien, $id_freelancer) {
        $query = "UPDATE " . $this->table_name . " 
                  SET judul_proyek = :judul, harga = :harga, id_klien = :id_k, id_freelancer = :id_f 
                  WHERE id_proyek = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":judul", $judul_proyek);
        $stmt->bindParam(":harga", $harga);
        $stmt->bindParam(":id_k", $id_klien);
        $stmt->bindParam(":id_f", $id_freelancer);
        $stmt->bindParam(":id", $id_proyek);
        return $stmt->execute();
    }
}
?>