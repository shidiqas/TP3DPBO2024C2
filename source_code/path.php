<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Path.php');
include('classes/Template.php');

$path = new Path($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$path->open();
$path->getPath();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($path->addPath($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'path.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'path.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Path';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Path</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'path';

while ($row = $path->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['nama_path'] . '</td>
    <td style="font-size: 22px;">
        <a href="ubahPath.php?id=' . $row['id_path'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="hapusPath.php?id=' . $row['id_path'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($path->updatePath($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'path.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'path.php';
            </script>";
            }
        }

        $path->getPathById($id);
        $row = $path->getResult();

        $dataUpdate = $row['nama_path'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($path->deletePath($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'path.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'path.php';
            </script>";
        }
    }
}

$path->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();

