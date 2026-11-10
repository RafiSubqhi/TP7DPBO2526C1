<?php
include_once '../config/db.php';
include_once '../class/Freelancer.php';

$database = new Database();
$db = $database->getConnection();
$freelancer = new Freelancer($db);

if(isset($_POST['tambah'])) {
    $freelancer->create($_POST['nama_freelancer'], $_POST['skill_utama']);
    header("Location: freelancer.php"); exit();
}
if(isset($_POST['update'])) {
    $freelancer->update($_POST['id_freelancer'], $_POST['nama_freelancer'], $_POST['skill_utama']);
    header("Location: freelancer.php"); exit();
}
if(isset($_GET['delete'])) {
    $freelancer->delete($_GET['delete']);
    header("Location: freelancer.php"); exit();
}
$edit_data = null;
if(isset($_GET['edit'])) {
    $edit_data = $freelancer->readOne($_GET['edit']);
}

include 'header.php'; 
?>
<h3>Manajemen Data Freelancer</h3>
<div style="background: #f1f1f1; padding: 15px; border-radius: 5px;">
    <h4><?= $edit_data ? "Edit Freelancer" : "Tambah Freelancer Baru" ?></h4>
    <form method="POST" action="">
        <?php if($edit_data): ?>
            <input type="hidden" name="id_freelancer" value="<?= $edit_data['id_freelancer'] ?>">
        <?php endif; ?>
        <div class="form-group">
            <label>Nama Freelancer:</label>
            <input type="text" name="nama_freelancer" value="<?= $edit_data ? $edit_data['nama_freelancer'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label>Skill Utama:</label>
            <input type="text" name="skill_utama" value="<?= $edit_data ? $edit_data['skill_utama'] : '' ?>" required>
        </div>
        <?php if($edit_data): ?>
            <button type="submit" name="update" style="background-color: #ffc107; color: black;">Simpan Perubahan</button>
            <a href="freelancer.php" style="margin-left: 10px;">Batal</a>
        <?php else: ?>
            <button type="submit" name="tambah">+ Tambah Freelancer</button>
        <?php endif; ?>
    </form>
</div>

<table>
    <tr><th>ID</th><th>Nama Freelancer</th><th>Skill Utama</th><th>Aksi</th></tr>
    <?php
    $stmt = $freelancer->read();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id_freelancer']}</td><td>{$row['nama_freelancer']}</td><td>{$row['skill_utama']}</td>";
        echo "<td>
                <a href='?edit={$row['id_freelancer']}' style='background-color:#ffc107; color:black; padding:5px 10px; text-decoration:none; border-radius:4px;'>Edit</a>
                <a href='?delete={$row['id_freelancer']}' class='btn-hapus' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
<?php include 'footer.php'; ?>