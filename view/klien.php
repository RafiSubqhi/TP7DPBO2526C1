<?php
include_once '../config/db.php';
include_once '../class/Klien.php';

$database = new Database();
$db = $database->getConnection();
$klien = new Klien($db);

// Menangkap proses Tambah
if(isset($_POST['tambah'])) {
    $klien->create($_POST['nama_perusahaan'], $_POST['email']);
    header("Location: klien.php"); exit();
}
// Menangkap proses Update
if(isset($_POST['update'])) {
    $klien->update($_POST['id_klien'], $_POST['nama_perusahaan'], $_POST['email']);
    header("Location: klien.php"); exit();
}
// Menangkap proses Hapus
if(isset($_GET['delete'])) {
    $klien->delete($_GET['delete']);
    header("Location: klien.php"); exit();
}
// Cek apakah tombol Edit ditekan
$edit_data = null;
if(isset($_GET['edit'])) {
    $edit_data = $klien->readOne($_GET['edit']);
}

include 'header.php'; 
?>
<h3>Manajemen Data Klien</h3>
<div style="background: #f1f1f1; padding: 15px; border-radius: 5px;">
    <h4><?= $edit_data ? "Edit Klien" : "Tambah Klien Baru" ?></h4>
    <form method="POST" action="">
        <?php if($edit_data): ?>
            <input type="hidden" name="id_klien" value="<?= $edit_data['id_klien'] ?>">
        <?php endif; ?>
        <div class="form-group">
            <label>Nama Perusahaan:</label>
            <input type="text" name="nama_perusahaan" value="<?= $edit_data ? $edit_data['nama_perusahaan'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label>Email Perusahaan:</label>
            <input type="email" name="email" value="<?= $edit_data ? $edit_data['email'] : '' ?>" required>
        </div>
        
        <?php if($edit_data): ?>
            <button type="submit" name="update" style="background-color: #ffc107; color: black;">Simpan Perubahan</button>
            <a href="klien.php" style="margin-left: 10px;">Batal</a>
        <?php else: ?>
            <button type="submit" name="tambah">+ Tambah Klien</button>
        <?php endif; ?>
    </form>
</div>

<table>
    <tr><th>ID</th><th>Nama Perusahaan</th><th>Email</th><th>Aksi</th></tr>
    <?php
    $stmt = $klien->read();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id_klien']}</td><td>{$row['nama_perusahaan']}</td><td>{$row['email']}</td>";
        echo "<td>
                <a href='?edit={$row['id_klien']}' style='background-color:#ffc107; color:black; padding:5px 10px; text-decoration:none; border-radius:4px;'>Edit</a>
                <a href='?delete={$row['id_klien']}' class='btn-hapus' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
<?php include 'footer.php'; ?>