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

$path = new Path($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$path->open();
$path->getPath();

$view = new Template('templates/skinform.html');
$btn = 'Ubah';
$title = 'Ubah';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $karakter->getKarakterById($id);
    $row = $karakter->getResult();

    $foto = $row['foto'];
    $nama = $row['nama'];
    $jenis_kelamin = $row['jenis_kelamin'];
    $tinggi = $row['tinggi'];
    $id_path = $row['id_path'];
    $id_element = $row['id_element'];
    $nama_foto = basename($foto);

    $jenis_kelamin_options = '<option selected disabled>Pilih Jenis Kelamin</option>';
    $jenis_kelamin_options .= '<option value="Pria" '.(($jenis_kelamin == "Pria") ? "selected" : "").'>Pria</option>';
    $jenis_kelamin_options .= '<option value="Wanita" '.(($jenis_kelamin == "Wanita") ? "selected" : "").'>Wanita</option>';

    $elementOptions = '';
    while ($row = $element->getResult()) {
        $selected = ($row['id_element'] == $id_element) ? 'selected' : '';
        $elementOptions .= '<option value="' . $row['id_element'] . '" '.$selected.'>' . $row['nama_element'] . '</option>';
    }

    $pathOptions = '';
    while ($row = $path->getResult()) {
        $selected = ($row['id_path'] == $id_path) ? 'selected' : '';
        $pathOptions .= '<option value="' . $row['id_path'] . '" '.$selected.'>' . $row['nama_path'] . '</option>';
    }


    // Menentukan lokasi foto yang akan ditampilkan
    $lokasi_foto = 'assets/images/' . $foto;

    $data = 
    '<form action="ubahKarakter.php?id='.$id.'" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="foto">Foto Karakter</label><br>
            <img src="'.$lokasi_foto.'" alt="Foto Karakter" style="max-width: 200px;"><br>
            <input type="file" class="form-control" id="foto" name="foto" value="'.$foto.'">
        </div>
        <div class="mb-3">
            <label for="nama">Nama Karakter</label>
            <input type="text" class="form-control" id="nama" name="nama" value="'.$nama.'" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                ' . $jenis_kelamin_options . '
            </select>
        </div>
        <div class="mb-3">
            <label for="tinggi">Tinggi</label>
            <input type="text" class="form-control" id="tinggi" name="tinggi" value="'.$tinggi.'" required>
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
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>';

    if (isset($_POST['submit'])) {
        if ($karakter->updateData($id, $_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diupdate!');
                window.location.href = 'index.php';
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
?>