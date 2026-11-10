<?php
include_once '../config/db.php';
include_once '../class/Proyek.php';
include_once '../class/Klien.php';
include_once '../class/Freelancer.php';

$database = new Database();
$db = $database->getConnection();
$proyek = new Proyek($db);
$klien = new Klien($db);
$freelancer = new Freelancer($db);

if(isset($_POST['tambah'])) {
    $proyek->create($_POST['judul_proyek'], $_POST['harga'], $_POST['id_klien'], $_POST['id_freelancer']);
    header("Location: proyek.php"); exit();
}
if(isset($_POST['update'])) {
    $proyek->update($_POST['id_proyek'], $_POST['judul_proyek'], $_POST['harga'], $_POST['id_klien'], $_POST['id_freelancer']);
    header("Location: proyek.php"); exit();
}
if(isset($_GET['delete'])) {
    $proyek->delete($_GET['delete']);
    header("Location: proyek.php"); exit();
}

$edit_data = null;
if(isset($_GET['edit'])) {
    $edit_data = $proyek->readOne($_GET['edit']);
}

include 'header.php'; 
?>
<h3>Manajemen Data Proyek</h3>
<div style="background: #f1f1f1; padding: 15px; border-radius: 5px;">
    <h4><?= $edit_data ? "Edit Proyek" : "Buat Proyek Baru" ?></h4>
    <form method="POST" action="">
        <?php if($edit_data): ?>
            <input type="hidden" name="id_proyek" value="<?= $edit_data['id_proyek'] ?>">
        <?php endif; ?>
        
        <div class="form-group">
            <label>Judul Proyek:</label>
            <input type="text" name="judul_proyek" value="<?= $edit_data ? $edit_data['judul_proyek'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label>Harga (Rp):</label>
            <input type="number" name="harga" value="<?= $edit_data ? $edit_data['harga'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label>Pilih Klien:</label>
            <select name="id_klien" required>
                <option value="">-- Pilih Klien --</option>
                <?php
                $stmtK = $klien->read();
                while ($r = $stmtK->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($edit_data && $edit_data['id_klien'] == $r['id_klien']) ? 'selected' : '';
                    echo "<option value='{$r['id_klien']}' $selected>{$r['nama_perusahaan']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Pilih Freelancer:</label>
            <select name="id_freelancer" required>
                <option value="">-- Pilih Freelancer --</option>
                <?php
                $stmtF = $freelancer->read();
                while ($r = $stmtF->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($edit_data && $edit_data['id_freelancer'] == $r['id_freelancer']) ? 'selected' : '';
                    echo "<option value='{$r['id_freelancer']}' $selected>{$r['nama_freelancer']} - {$r['skill_utama']}</option>";
                }
                ?>
            </select>
        </div>

        <?php if($edit_data): ?>
            <button type="submit" name="update" style="background-color: #ffc107; color: black;">Simpan Perubahan</button>
            <a href="proyek.php" style="margin-left: 10px;">Batal</a>
        <?php else: ?>
            <button type="submit" name="tambah">+ Tambah Proyek</button>
        <?php endif; ?>
    </form>
</div>

<table>
    <tr><th>ID</th><th>Judul Proyek</th><th>Harga</th><th>Klien</th><th>Freelancer</th><th>Aksi</th></tr>
    <?php
    $stmt = $proyek->read();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id_proyek']}</td><td>{$row['judul_proyek']}</td><td>Rp " . number_format($row['harga'],0,',','.') . "</td>";
        echo "<td>{$row['nama_perusahaan']}</td><td>{$row['nama_freelancer']}</td>";
        echo "<td>
                <a href='?edit={$row['id_proyek']}' style='background-color:#ffc107; color:black; padding:5px 10px; text-decoration:none; border-radius:4px;'>Edit</a>
                <a href='?delete={$row['id_proyek']}' class='btn-hapus' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
<?php include 'footer.php'; ?>