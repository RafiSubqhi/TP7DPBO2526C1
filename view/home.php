<?php
include_once '../config/db.php';
include_once '../class/Klien.php';
include_once '../class/Freelancer.php';
include_once '../class/Proyek.php';

$database = new Database();
$db = $database->getConnection();

$klien = new Klien($db);
$freelancer = new Freelancer($db);
$proyek = new Proyek($db);

include 'header.php'; 
?>

<h3>📊 Dashboard Utama - Freelance Marketplace</h3>
<p style="color: #666; margin-bottom: 30px;">Berikut adalah data entitas yang terdaftar di dalam sistem.</p>

<!-- BAGIAN 1: TABEL KLIEN -->
<div style="margin-bottom: 40px;">
    <h4 style="color: #0056b3; border-bottom: 2px solid #0056b3; padding-bottom: 5px;">1. Data Klien</h4>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Perusahaan</th>
            <th>Email</th>
        </tr>
        <?php
        $stmtKlien = $klien->read();
        $hasKlien = false;
        while ($row = $stmtKlien->fetch(PDO::FETCH_ASSOC)) {
            $hasKlien = true;
            echo "<tr>";
            echo "<td>{$row['id_klien']}</td>";
            echo "<td>{$row['nama_perusahaan']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "</tr>";
        }
        if(!$hasKlien) {
            echo "<tr><td colspan='3' style='text-align:center; color:#777;'>Belum ada data klien.</td></tr>";
        }
        ?>
    </table>
</div>

<!-- BAGIAN 2: TABEL FREELANCER -->
<div style="margin-bottom: 40px;">
    <h4 style="color: #0056b3; border-bottom: 2px solid #0056b3; padding-bottom: 5px;">2. Data Freelancer</h4>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Freelancer</th>
            <th>Skill Utama</th>
        </tr>
        <?php
        $stmtFree = $freelancer->read();
        $hasFree = false;
        while ($row = $stmtFree->fetch(PDO::FETCH_ASSOC)) {
            $hasFree = true;
            echo "<tr>";
            echo "<td>{$row['id_freelancer']}</td>";
            echo "<td>{$row['nama_freelancer']}</td>";
            echo "<td>{$row['skill_utama']}</td>";
            echo "</tr>";
        }
        if(!$hasFree) {
            echo "<tr><td colspan='3' style='text-align:center; color:#777;'>Belum ada data freelancer.</td></tr>";
        }
        ?>
    </table>
</div>

<!-- BAGIAN 3: TABEL PROYEK -->
<div style="margin-bottom: 20px;">
    <h4 style="color: #0056b3; border-bottom: 2px solid #0056b3; padding-bottom: 5px;">3. Data Proyek (Transaksi & Relasi)</h4>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul Proyek</th>
            <th>Harga</th>
            <th>Klien</th>
            <th>Freelancer</th>
        </tr>
        <?php
        $stmtProyek = $proyek->read();
        $hasProyek = false;
        while ($row = $stmtProyek->fetch(PDO::FETCH_ASSOC)) {
            $hasProyek = true;
            echo "<tr>";
            echo "<td>{$row['id_proyek']}</td>";
            echo "<td>{$row['judul_proyek']}</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "<td>{$row['nama_perusahaan']}</td>";
            echo "<td>{$row['nama_freelancer']}</td>";
            echo "</tr>";
        }
        if(!$hasProyek) {
            echo "<tr><td colspan='5' style='text-align:center; color:#777;'>Belum ada data proyek.</td></tr>";
        }
        ?>
    </table>
</div>

<?php include 'footer.php'; ?>