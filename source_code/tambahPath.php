<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Path.php');
include('classes/Template.php');


$path = new Path($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$path->open();
$path->getPath();

$view = new Template('templates/skinform.html');
$btn = 'Tambah';
$title = 'Tambah';

if (!isset($_GET['id'])) {
    $data = 
    '<form action="tambahPath.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama">Nama Path</label>
            <input type="text" class="form-control" id="nama_path" name="nama_path" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
    </form>';

    if (isset($_POST['submit'])) {
        // Tambahkan karakter baru ke database
        if ($path->addPath($_POST) > 0) {
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
    }
}

$mainTitle = 'Path';

$path->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $data);

$view->write();