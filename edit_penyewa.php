<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: penyewa.php");
    exit;
}

$id_penyewa = $_GET['id'];

// Ambil data penyewa lama
$query_ambil = "SELECT * FROM tb_penyewa WHERE id_penyewa = '$id_penyewa'";
$result = mysqli_query($koneksi, $query_ambil);
$data = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) < 1) {
    die("Data tidak ditemukan.");
}

// Proses Update
if (isset($_POST['update_penyewa'])) {
    $nama   = $_POST['nama'];
    $no_hp  = $_POST['no_hp'];
    $no_ktp = $_POST['no_ktp'];

    $query_update = "UPDATE tb_penyewa SET 
                        nama = '$nama', 
                        no_hp = '$no_hp', 
                        no_ktp = '$no_ktp' 
                     WHERE id_penyewa = '$id_penyewa'";

    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data Penyewa Berhasil Diubah!'); window.location='penyewa.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Penyewa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { background: #f9f9f9; padding: 20px; border-radius: 5px; width: 350px; border: 1px solid #ccc; }
        input { width: 100%; padding: 8px; margin: 5px 0 15px 0; box-sizing: border-box; }
        button { background-color: #007BFF; color: white; padding: 10px; border: none; cursor: pointer; width: 100%; }
    </style>
</head>
<body>

    <h2>Edit Data Penyewa</h2>
    <a href="penyewa.php">← Kembali</a><br><br>

    <form action="" method="POST">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
        
        <label>No. HP:</label>
        <input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>" required>
        
        <label>No. KTP:</label>
        <input type="text" name="no_ktp" value="<?php echo $data['no_ktp']; ?>" required>
        
        <button type="submit" name="update_penyewa">Update Data</button>
    </form>

</body>
</html>