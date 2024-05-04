<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Element.php');
include('classes/Karakter.php');
include('classes/Path.php');
include('classes/Template.php');

$karakter = new Karakter($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$karakter->open();
$karakter->getKarakter();

$element = new Element($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$element->open();
$element->getElement();
$elementOptions = '';
while ($row = $element->getResult()) {
    $elementOptions .= '<option value="' . $row['id_element'] . '">' . $row['nama_element'] . '</option>';
}

$path = new Path($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$path->open();
$path->getPath();
$pathOptions = '';
while ($row = $path->getResult()) {
    $pathOptions .= '<option value="' . $row['id_path'] . '">' . $row['nama_path'] . '</option>';
}

$view = new Template('templates/skinform.html');
$btn = 'Tambah';
$title = 'Tambah';

if (!isset($_GET['id'])) {
    $data = 
    '<form action="tambahKarakter.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="foto">Foto Karakter</label>
            <input type="file" class="form-control" id="foto" name="foto" required>
        </div>
        <div class="mb-3">
            <label for="nama">Nama karakter</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option selected disabled>Pilih Jenis Kelamin</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tinggi">Tinggi(cm)</label>
            <input type="text" class="form-control" id="tinggi" name="tinggi" required>
        </div>
        <div class="mb-3">
            <label for="id_path">Path</label>
            <select class="form-select" id="id_path" name="id_path" required>
                <option selected disabled>Pilih Path</option>
                ' . $pathOptions . '
            </select>
        </div>
        <div class="mb-3">
            <label for="id_element">Element</label>
            <select class="form-select" id="id_element" name="id_element" required>
                <option selected disabled>Pilih Element</option>
                ' . $elementOptions . '
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
    </form>';

    if (isset($_POST['submit'])) {
       // Direktori tempat file akan disimpan
        $targetDirectory = "assets/images/";

        // Mendapatkan nama file
        $fileName = basename($_FILES["foto"]["name"]);

        // Menggabungkan direktori target dengan nama file
        $targetFilePath = $targetDirectory . $fileName;

        // Mendapatkan ekstensi file
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        // Izinkan format file yang diizinkan
        $allowedTypes = array('jpg','jpeg','png');

        if (in_array($fileType, $allowedTypes)) {
            // Coba mengunggah file
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
                // Jika berhasil diunggah, tambahkan karakter ke database
                if ($karakter->addData($_POST, $_FILES) > 0) {
                    echo "<script>
                        alert('Data berhasil ditambah!');
                        document.location.href = 'index.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('Data gagal ditambah!');
                        document.location.href = 'index.php';
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Terjadi kesalahan saat mengunggah file!');
                    document.location.href = 'index.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Format file tidak didukung!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$mainTitle = 'Karakter';

$karakter->close();
$element->close();
$path->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $data);

$view->write();
