<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien();

// route
if (isset($_POST['add_data'])) {
    //memanggil addData
    $tp->addData($_POST);
} else if (isset($_GET['delete_id'])) {
    //memanggil deleteData
    $tp->deleteData($_GET['delete_id']);
} else if (isset($_POST['update_data'])) {
    //memanggil updateData
    $tp->updateData($_POST);
} else {
    // memanggil view (halaman)
    $data = $tp->tampil();
}
