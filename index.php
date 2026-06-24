<?php 
include 'koneksi.php'; 

// Logika untuk Menyimpan Data (Create)
if (isset($_POST['simpan'])) {
    $no_kamar   = $_POST['no_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga      = $_POST['harga'];
    $status     = $_POST['status'];

    $query = "INSERT INTO tb_kamar (no_kamar, tipe_kamar, harga, status) VALUES ('$no_kamar', '$tipe_kamar', '$harga', '$status')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Logika untuk Menghapus Data (Delete)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM tb_kamar WHERE id_kamar = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Berhasil Dihapus!'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manajemen Kontrakan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 30px; background: #f9f9f9; padding: 15px; border-radius: 5px; width: 300px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 10px 0; }
        button { background-color: green; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <nav style="margin-bottom: 20px;">
    <a href="index.php" style="margin-right: 15px; text-decoration: none; color: #333; font-weight: bold;">Data Kamar</a> | 
    <a href="penyewa.php" style="text-decoration: none; color: #007BFF; font-weight: bold;">Data Penyewa</a>
</nav>

    <h2>Tambah Data Kamar Kontrakan</h2>
    <form action="" method="POST">
        <label>No Kamar:</label>
        <input type="text" name="no_kamar" required>
        
        <label>Tipe Kamar:</label>
        <select name="tipe_kamar">
            <option value="Reguler">Reguler</option>
            <option value="VIP">VIP</option>
            <option value="VVIP">VVIP</option>
        </select>
        
        <label>Harga Sewa:</label>
        <input type="number" name="harga" required>
        
        <label>Status:</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Terisi">Terisi</option>
        </select>
        
        <button type="submit" name="simpan">Simpan Data</button>
    </form>

    <h2>Daftar Kamar Kontrakan</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>No Kamar</th>
            <th>Tipe</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        $ambil_data = mysqli_query($koneksi, "SELECT * FROM tb_kamar");
        while ($row = mysqli_fetch_assoc($ambil_data)) {
            echo "<tr>
                    <td>{$row['id_kamar']}</td>
                    <td>{$row['no_kamar']}</td>
                    <td>{$row['tipe_kamar']}</td>
                    <td>Rp " . number_format($row['harga']) . "</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='edit.php?id={$row['id_kamar']}'>Edit</a> | 
                        <a href='index.php?hapus={$row['id_kamar']}' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>

</body>
</html>