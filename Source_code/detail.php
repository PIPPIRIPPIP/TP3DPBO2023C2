<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Outlet.php');
include('classes/Jabatan.php');
include('classes/Karyawan.php');
include('classes/Template.php');

$karyawan = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$karyawan->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $karyawan->getKaryawanById($id);
        $row = $karyawan->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['karyawan_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['karyawan_foto'] . '" class="img-thumbnail" alt="' . $row['karyawan_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['karyawan_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td>' . $row['karyawan_nip'] . '</td>
                                </tr>
                                <tr>
                                    <td>Semester</td>
                                    <td>:</td>
                                    <td>' . $row['karyawan_ttl'] . '</td>
                                </tr>
                                <tr>
                                    <td>Outlet</td>
                                    <td>:</td>
                                    <td>' . $row['outlet_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>' . $row['jabatan_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="form.php?edit='.$row['karyawan_id'].'"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?del='.$row['karyawan_id'].'"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    if ($id > 0) {
        if ($karyawan->deleteKaryawan($id) > 0) {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}

$karyawan->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_KARYAWAN', $data);
$detail->write();
