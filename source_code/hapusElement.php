<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Element.php');

// Pastikan ID element yang akan dihapus disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat instance objek element
    $element = new Element($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $element->open();

    // Hapus element berdasarkan ID
    if ($element->deleteElement($id)) {
        echo "<script>
                alert('Element berhasil dihapus!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus element!');
                document.location.href = 'index.php';
              </script>";
    }

    // Tutup koneksi database
    $element->close();
} else {
    // Jika tidak ada ID element yang disediakan, tampilkan pesan kesalahan
    echo "<script>
            alert('ID element tidak ditemukan!');
            document.location.href = 'index.php'; // Redirect ke halaman utama
          </script>";
}
?>
