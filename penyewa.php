<?php 
include 'koneksi.php'; 

// Logika untuk Menyimpan Data Penyewa (Create)
if (isset($_POST['simpan_penyewa'])) {
    $nama   = $_POST['nama'];
    $no_hp  = $_POST['no_hp'];
    $no_ktp = $_POST['no_ktp'];

    $query = "INSERT INTO tb_penyewa (nama, no_hp, no_ktp) VALUES ('$nama', '$no_hp', '$no_ktp')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Penyewa Berhasil Disimpan!'); window.location='penyewa.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Logika untuk Menghapus Data Penyewa (Delete)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM tb_penyewa WHERE id_penyewa = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Penyewa Berhasil Dihapus!'); window.location='penyewa.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manajemen Penyewa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #007BFF; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 30px; background: #f9f9f9; padding: 15px; border-radius: 5px; width: 300px; border: 1px solid #ccc; }
        input { width: 100%; padding: 8px; margin: 5px 0 10px 0; box-sizing: border-box; }
        button { background-color: #28a745; color: white; padding: 10px; border: none; cursor: pointer; width: 100%; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

    <nav>
        <a href="index.php">Data Kamar</a> | 
        <a href="penyewa.php" style="color: #333;">Data Penyewa</a>
    </nav>

    <h2>Tambah Data Penyewa</h2>
    <form action="" method="POST">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required>
        
        <label>No. HP:</label>
        <input type="text" name="no_hp" required>
        
        <label>No. KTP:</label>
        <input type="text" name="no_ktp" required>
        
        <button type="submit" name="simpan_penyewa">Simpan Penyewa</button>
    </form>

    <h2>Daftar Penyewa Kontrakan</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No. HP</th>
            <th>No. KTP</th>
            <th>Aksi</th>
        </tr>
        <?php
        $ambil_data = mysqli_query($koneksi, "SELECT * FROM tb_penyewa");
        while ($row = mysqli_fetch_assoc($ambil_data)) {
            echo "<tr>
                    <td>{$row['id_penyewa']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['no_hp']}</td>
                    <td>{$row['no_ktp']}</td>
                    <td>
                        <a href='edit_penyewa.php?id={$row['id_penyewa']}'>Edit</a> | 
                        <a href='penyewa.php?hapus={$row['id_penyewa']}' onclick='return confirm(\"Yakin hapus penyewa ini?\")'>Hapus</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>

</body>
</html>