<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Element.php');
include('classes/Template.php');

$element = new Element($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$element->open();
$element->getElement();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($element->addElement($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'element.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'element.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Element';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Element</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'element';

while ($row = $element->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['nama_element'] . '</td>
    <td style="font-size: 22px;">
        <a href="ubahElement.php?id=' . $row['id_element'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="hapusElement.php?id=' . $row['id_element'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($element->updateElement($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'element.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'element.php';
            </script>";
            }
        }

        $element->getElementById($id);
        $row = $element->getResult();

        $dataUpdate = $row['nama_element'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($element->deleteElement($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'element.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'element.php';
            </script>";
        }
    }
}

$element->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();

