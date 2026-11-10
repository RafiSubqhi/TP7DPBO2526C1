# TUGAS PRAKTIKUM 7 DPBO C1

# JANJI
Saya Rafi Subqhi Nuraziz dengan NIM 2408678 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan. Aamiin.

## 1. Tema Website
Website ini mengusung tema **Sistem Freelance Marketplace**. Aplikasi web ini berfungsi sebagai platform pencatatan data yang mempertemukan pihak pencari jasa (Klien) dengan pihak penyedia jasa (Freelancer) ke dalam sebuah kesepakatan pekerjaan (Proyek).

Aplikasi dibangun menggunakan **PHP Native** dengan pendekatan **Object-Oriented Programming (OOP)**, memisahkan antara logika pengolahan data (*backend class*) dan antarmuka pengguna (*view*).

## 2. Penjelasan Database
Database yang digunakan bernama `db_freelance` dan mencakup 3 (tiga) tabel entitas utama. File *dump* struktur dan datanya dapat ditemukan pada folder `/database/db_freelance.sql`.

*   **Tabel `klien`**: Menyimpan data perusahaan atau individu yang membutuhkan jasa.
    *   Kolom: `id_klien` (PK), `nama_perusahaan`, `email`
*   **Tabel `freelancer`**: Menyimpan data pekerja lepas beserta keahlian utamanya.
    *   Kolom: `id_freelancer` (PK), `nama_freelancer`, `skill_utama`
*   **Tabel `proyek`**: Entitas transaksional yang mencatat proyek yang sedang berjalan. Tabel ini memiliki **relasi (Foreign Key)** terhadap dua tabel lainnya.
    *   Kolom: `id_proyek` (PK), `judul_proyek`, `harga`
    *   Foreign Key: `id_klien` (merujuk ke `klien.id_klien`)
    *   Foreign Key: `id_freelancer` (merujuk ke `freelancer.id_freelancer`)
    *   *On Delete Cascade*: Jika Klien atau Freelancer dihapus, maka data proyek yang terhubung akan otomatis terhapus untuk menjaga integritas data.

## 3. Penjelasan Flow Code (Alur Program)
Aplikasi ini menerapkan siklus *HTTP Request-Response* dengan struktur folder modular:
1.  **`config/db.php`**: Mengelola koneksi ke database MySQL menggunakan ekstensi **PDO (PHP Data Objects)**.
2.  **`class/`**: Berisi tiga kelas OOP (`Klien.php`, `Freelancer.php`, `Proyek.php`). Setiap kelas bertanggung jawab penuh atas manipulasi datanya sendiri (Enkapsulasi).
    *   Semua metode CRUD di dalam kelas ini **wajib menggunakan Prepared Statement** (`$conn->prepare()` dan `bindParam()`). Tidak ada *raw query* yang disisipkan nilai dari *user* secara langsung, sehingga sistem aman dari ancaman *SQL Injection*.
3.  **`view/`**: Berisi file presentasi GUI (HTML/CSS gabung PHP). 
    *   Menggunakan `header.php` dan `footer.php` agar komponen navigasi bersifat *reusable*.
    *   Saat *user* menekan tombol submit (Tambah/Edit/Hapus), *view* akan menangkap `$_POST` atau `$_GET`, lalu memanggil *method* dari objek kelas yang bersangkutan, mengeksekusi *query*, dan melakukan *redirect* kembali ke halaman tersebut (`header("Location: ...")`).
4.  **`index.php`**: Bertindak sebagai titik masuk (*entry point*) aplikasi yang otomatis mengarahkan *user* ke menu halaman utama (Data Klien).

## 4. Fitur CRUD
Setiap entitas (Klien, Freelancer, Proyek) sudah memiliki fungsionalitas CRUD secara penuh:
*   **Create**: Menambahkan data baru melalui form. Pada menu Proyek, input relasi menggunakan elemen `<select>` (*dropdown*) dinamis yang mengambil data langsung dari tabel master.
*   **Read**: Menampilkan seluruh data dalam bentuk tabel (*fetch PDO*). Pada menu Proyek, nama Klien dan nama Freelancer ditampilkan menggunakan sintaks SQL `LEFT JOIN`.
*   **Update**: Menerapkan konsep "Form Pintar". Saat tombol *Edit* ditekan pada baris tabel, data lama akan ditarik (`readOne()`) dan mengisi *value* form di atasnya, mengubah fungsi tombol form menjadi *Simpan Perubahan*.
*   **Delete**: Menghapus data spesifik berdasarkan parameter `$_GET['delete']`.

## 5. Dokumentasi Penggunaan (Screen Record)
Berikut adalah tautan video dokumentasi yang mendemonstrasikan proses Create, Read, Update, dan Delete untuk semua tabel:

[Klik di sini untuk menonton Video Screenrecord](Dokumentasi/dokumentasi.mp4)