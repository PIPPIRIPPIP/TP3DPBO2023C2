<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Outlet.php');
include('classes/Template.php');

$outlet = new Outlet($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$outlet->open();
error_log(print_r($_POST['sort'], true));
if (isset($_POST['search'])) {
    $outlet->searchOutlet($_POST['cari']);
}else if(isset($_POST['sort'])){
    if ($_POST['sort'] == 'ascending') {
        $outlet->filterOutletAsc();
    } else if ($_POST['sort'] == 'descending') {
        $outlet->filterOutletDesc();
    }
}else {
    $outlet->getOutlet();
}

$view = new Template('templates/skintabel.html');

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($outlet->addOutlet($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'outlet.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'outlet.php';
            </script>";
        }
    }
    $btn = 'Tambah';
    $title = 'Tambah';
}




$mainTitle = 'Outlet';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Outlet</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'outlet';

while ($div = $outlet->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['outlet_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="outlet.php?id=' . $div['outlet_id'] . '" title="Edit Data">
        <i class="bi bi-pencil-square text-warning"></i>
        </a>&nbsp;
        <a href="outlet.php?hapus=' . $div['outlet_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($outlet->updateOutlet($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'outlet.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'outlet.php';
            </script>";
            }
        }

        $outlet->getOutletById($id);
        $row = $outlet->getResult();

        $dataUpdate = $row['outlet_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($outlet->deleteOutlet($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'outlet.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'outlet.php';
            </script>";
        }
    }
}






$outlet->close();



$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('FILE', 'outlet.php');
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();