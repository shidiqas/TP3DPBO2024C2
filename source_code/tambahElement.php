<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Element.php');
include('classes/Template.php');


$element = new Element($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$element->open();
$element->getElement();

$view = new Template('templates/skinform.html');
$btn = 'Tambah';
$title = 'Tambah';

if (!isset($_GET['id'])) {
    $data = 
    '<form action="tambahElement.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama">Nama Element</label>
            <input type="text" class="form-control" id="nama_element" name="nama_element" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">' . $btn . '</button>
    </form>';

    if (isset($_POST['submit'])) {
        // Tambahkan karakter baru ke database
        if ($element->addElement($_POST) > 0) {
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

$mainTitle = 'Element';

$element->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $data);

$view->write();