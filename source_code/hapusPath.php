<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Path.php');

// Pastikan ID path yang akan dihapus disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat instance objek path
    $path = new Path($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $path->open();

    // Hapus path berdasarkan ID
    if ($path->deletePath($id)) {
        echo "<script>
                alert('Path berhasil dihapus!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus path!');
                document.location.href = 'index.php';
              </script>";
    }

    // Tutup koneksi database
    $path->close();
} else {
    // Jika tidak ada ID path yang disediakan, tampilkan pesan kesalahan
    echo "<script>
            alert('ID path tidak ditemukan!');
            document.location.href = 'index.php'; // Redirect ke halaman utama
          </script>";
}
?>
