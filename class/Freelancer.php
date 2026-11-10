<?php
class Freelancer {
    private $conn;
    private $table_name = "freelancer";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id_freelancer, nama_freelancer, skill_utama FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($nama_freelancer, $skill_utama) {
        $query = "INSERT INTO " . $this->table_name . " (nama_freelancer, skill_utama) VALUES (:nama_freelancer, :skill_utama)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama_freelancer", $nama_freelancer);
        $stmt->bindParam(":skill_utama", $skill_utama);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id_freelancer) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_freelancer = :id_freelancer";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_freelancer", $id_freelancer);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne($id_freelancer) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_freelancer = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id_freelancer);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_freelancer, $nama_freelancer, $skill_utama) {
        $query = "UPDATE " . $this->table_name . " SET nama_freelancer = :nama, skill_utama = :skill WHERE id_freelancer = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama", $nama_freelancer);
        $stmt->bindParam(":skill", $skill_utama);
        $stmt->bindParam(":id", $id_freelancer);
        return $stmt->execute();
    }
}
?>