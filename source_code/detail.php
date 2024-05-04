<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Path.php');
include('classes/Element.php');
include('classes/Karakter.php');
include('classes/Template.php');

$karakter = new Karakter($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$karakter->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $karakter->getKarakterById($id);
        $row = $karakter->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto'] . '" class="img-thumbnail" alt="' . $row['foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>' . $row['jenis_kelamin'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tinggi</td>
                                    <td>:</td>
                                    <td>' . $row['tinggi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Path</td>
                                    <td>:</td>
                                    <td>' . $row['nama_path'] . '</td>
                                </tr>
                                <tr>
                                    <td>Element</td>
                                    <td>:</td>
                                    <td>' . $row['nama_element'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="ubahKarakter.php?id=' . $row['id_karakter'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="hapusKarakter.php?id=' . $row['id_karakter'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$karakter->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_KARAKTER', $data);
$detail->write();