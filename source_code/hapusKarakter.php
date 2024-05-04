<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Karakter.php');

// Pastikan ID karakter yang akan dihapus disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat instance objek karakter
    $karakter = new Karakter($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $karakter->open();

    // Hapus karakter berdasarkan ID
    if ($karakter->deleteData($id)) {
        echo "<script>
                alert('Karakter berhasil dihapus!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus karakter!');
                document.location.href = 'index.php';
              </script>";
    }

    // Tutup koneksi database
    $karakter->close();
} else {
    // Jika tidak ada ID karakter yang disediakan, tampilkan pesan kesalahan
    echo "<script>
            alert('ID karakter tidak ditemukan!');
            document.location.href = 'index.php'; // Redirect ke halaman utama
          </script>";
}
?>
