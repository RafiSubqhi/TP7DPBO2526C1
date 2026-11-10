<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Marketplace</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f9f9f9; }
        /* Memperlebar container utama dari 800px menjadi 1100px dan meratakannya */
        .container { max-width: 1100px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 20px; text-decoration: none; color: #0056b3; font-weight: bold; font-size: 16px; }
        nav a:hover { text-decoration: underline; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #0056b3; color: white; }
        .form-group { margin-bottom: 15px; }
        input[type="text"], input[type="email"], input[type="number"], select { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 4px; font-weight: bold; }
        button:hover { background-color: #218838; }
        .btn-hapus { background-color: #dc3545; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-edit { background-color: #ffc107; color: black; padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold; margin-right: 5px; }
        /* Mengatur agar tombol aksi di tabel sejajar ke samping */
        td.aksi-col { white-space: nowrap; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🚀 Sistem Freelance Marketplace</h2>
        <nav>
            <a href="home.php">Home</a>
            <a href="klien.php">Data Klien</a>
            <a href="freelancer.php">Data Freelancer</a>
            <a href="proyek.php">Data Proyek</a>
        </nav>
        <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">