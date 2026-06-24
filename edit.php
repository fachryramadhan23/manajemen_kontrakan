<?php
include 'koneksi.php';

// 1. Ambil ID data yang ingin di-edit dari URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_kamar = $_GET['id'];

// 2. Ambil data kamar berdasarkan ID tersebut untuk ditampilkan di form
$query_ambil = "SELECT * FROM tb_kamar WHERE id_kamar = '$id_kamar'";
$result = mysqli_query($koneksi, $query_ambil);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan kembali ke index
if (mysqli_num_rows($result) < 1) {
    die("Data tidak ditemukan.");
}

// 3. Proses Update data ketika tombol 'Update' ditekan
if (isset($_POST['update'])) {
    $no_kamar   = $_POST['no_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga      = $_POST['harga'];
    $status     = $_POST['status'];

    $query_update = "UPDATE tb_kamar SET 
                        no_kamar = '$no_kamar', 
                        tipe_kamar = '$tipe_kamar', 
                        harga = '$harga', 
                        status = '$status' 
                     WHERE id_kamar = '$id_kamar'";

    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data Berhasil Diubah!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Kamar</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { background: #f9f9f9; padding: 20px; border-radius: 5px; width: 350px; border: 1px solid #ccc; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px 0; box-sizing: border-box; }
        button { background-color: #007BFF; color: white; padding: 10px; border: none; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .kembali { display: inline-block; margin-bottom: 15px; color: #333; text-decoration: none; }
    </style>
</head>
<body>

    <h2>Edit Data Kamar Kontrakan</h2>
    
    <a class="kembali" href="index.php">← Kembali ke Daftar Kamar</a>

    <form action="" method="POST">
        <label>No Kamar:</label>
        <input type="text" name="no_kamar" value="<?php echo $data['no_kamar']; ?>" required>
        
        <label>Tipe Kamar:</label>
        <select name="tipe_kamar">
            <option value="Reguler" <?php if($data['tipe_kamar'] == 'Reguler') echo 'selected'; ?>>Reguler</option>
            <option value="VIP" <?php if($data['tipe_kamar'] == 'VIP') echo 'selected'; ?>>VIP</option>
            <option value="VVIP" <?php if($data['tipe_kamar'] == 'VVIP') echo 'selected'; ?>>VVIP</option>
        </select>
        
        <label>Harga Sewa:</label>
        <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required>
        
        <label>Status:</label>
        <select name="status">
            <option value="Tersedia" <?php if($data['status'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
            <option value="Terisi" <?php if($data['status'] == 'Terisi') echo 'selected'; ?>>Terisi</option>
        </select>
        
        <button type="submit" name="update">Update Data</button>
    </form>

</body>
</html>