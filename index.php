<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Outlet.php');
include('classes/Jabatan.php');
include('classes/Karyawan.php');
include('classes/Template.php');

// buat instance pengurus
$listKaryawan = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listKaryawan->open();
// tampilkan data pengurus
$listKaryawan->getKaryawanJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listKaryawan->searchKaryawan($_POST['cari']);
}else if(isset($_POST['sort'])){
    if ($_POST['sort'] == 'ascending') {
        $listKaryawan->filterKaryawanAsc();
    } else if ($_POST['sort'] == 'descending') {
        $listKaryawan->filterKaryawanDesc();
    }
}else {
    // method menampilkan data pengurus
    $listKaryawan->getKaryawanJoin();
}

$data = null;

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listKaryawan->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['karyawan_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['karyawan_foto'] . '" class="card-img-top" alt="' . $row['karyawan_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text text-center pengurus-nama my-0">' . $row['karyawan_nama'] . '</p>
                <p class="card-text text-center divisi-nama">' . $row['karyawan_nip'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['jabatan_nama'] . '</p>
                <p class="card-text outlet-nama">' . $row['outlet_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listKaryawan->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_KARYAWAN', $data);
$home->replace('FILE', 'index.php');
$home->write();
