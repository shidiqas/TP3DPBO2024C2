<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Path.php');
include('classes/Element.php');
include('classes/Karakter.php');
include('classes/Template.php');

$listKarakter = new Karakter($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listKarakter->open();

$data = null;

// Check if search button is clicked
if (isset($_POST['btn-cari'])) {
    $listKarakter->searchKarakter($_POST['cari']);
} else {
    // If no search, retrieve unsorted character list
    if(isset($_GET['order']) && $_GET['order'] == 'desc') {
        $listKarakter->getKarakterJoinSorted('DESC');
    }
    else if(isset($_GET['order']) && $_GET['order'] == 'asc') {
        $listKarakter->getKarakterJoinSorted('ASC');
    }
    else {
        $listKarakter->getKarakterJoin();
    }
}

while ($row = $listKarakter->getResult()) {
    $elementClass = $row['nama_element'];
    $data .= '<div class="col gx-4 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 karakter-thumbnail">
        <a href="detail.php?id=' . $row['id_karakter'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto'] . '" class="card-img-top" alt="' . $row['foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text karakter-nama my-0">' . $row['nama'] . '</p>
                <p class="card-text path-nama">' . $row['nama_path'] . '</p>
                <p class="card-text element-nama '.$elementClass.' my-0">' . $row['nama_element'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$listKarakter->close();

$home = new Template('templates/skin.html');

$home->replace('DATA_KARAKTER', $data);
$home->write();
?>
