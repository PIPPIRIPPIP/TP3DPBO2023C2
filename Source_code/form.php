<?php 

    include('config/db.php');
    include('classes/DB.php');
    include('classes/Template.php');
    include('classes/Karyawan.php');
    include('classes/Outlet.php');
    include('classes/Jabatan.php');

    $outlet = new Outlet($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $jabatan = new Jabatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $anggota = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $tmp_image = new Karyawan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $outlet->open();
    $jabatan->open();
    $anggota->open();
    $tmp_image->open();

    // VAR UNTUK SHOW DIVISI DAN JABATAN
    $outlet_options = null;
    $jabatan_options = null;

    // VAR UNTUK EDIT TAPI JADI GLOBAL
    $img_edit = "";
    $nama_edit = ""; $semester_edit = "";
    $outlet_edit = ""; $jabatan_edit = "";
    $nip_edit = ""; $ttl_edit = "";

    $view_form = new Template('templates/skinadd.html');
    if (!isset($_GET['edit'])) {
        if (isset($_POST['submit'])) {
            if ($anggota->addKaryawan($_POST, $_FILES) > 0) {
                echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'form.php';
                </script>
                ";
            }
        }
        
        // Connect to Tabel Divisi
        
        $outlet->getOutlet();
    
        // Looping for Shows the data 
        while ($row = $outlet->getResult()) {
            $outlet_options .= "<option value=". $row['outlet_id']. ">" . $row['outlet_nama'] . "</option>";
        }
        
        $jabatan->getJabatan();
    
        // Looping for shows the data
        while($row = $jabatan->getResult()) {
            $jabatan_options .= "<option value=". $row['jabatan_id']. ">" . $row['jabatan_nama'] . "</option>";
        }
    } else if (isset($_GET['edit'])) {
        $_ID = $_GET['edit'];
        $tmp_image->getKaryawan();
        $tmp_image->getKaryawanById($_ID);
        $temp_fix = $tmp_image->getResult();
        $temp_img = $temp_fix['karyawan_foto'];
        if (isset($_POST['submit'])) {
            if ($anggota->updateKaryawan($_ID, $_POST, $_FILES, $temp_img) > 0) {
                echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'form.php';
                </script>
                ";
            }
        }
        $anggota->getKaryawanById($_ID);

        $row = $anggota->getResult();
        $img_edit = $row['karyawan_foto'];
        $nip_edit = $row['karyawan_nip'];
        $nama_edit = $row['karyawan_nama'];
        $ttl_edit = $row['karyawan_ttl'];
        $outlet_edit = $row['outlet_id'];
        $jabatan_edit = $row['jabatan_id'];

        $outlet->getOutlet();
    
        // Looping for Shows the data 
        while ($row = $outlet->getResult()) {
            $select = ($row['outlet_id'] == $outlet_edit) ? 'selected' : "";
            $outlet_options .= "<option value=". $row['outlet_id']. " . $select . >" . $row['outlet_nama'] . "</option>";
        }
    
    
        // Connect to Tabel Jabatan
        
        $jabatan->getJabatan();
    
        // Looping for shows the data
        while($row = $jabatan->getResult()) {
            $select = ($row['jabatan_id'] == $jabatan_edit) ? 'selected' : "";
            $jabatan_options .= "<option value=". $row['jabatan_id']. " . $select . >" . $row['jabatan_nama'] . "</option>";
        }
    }

    $view_form->replace('IMAGE_DATA' , $img_edit);
    $view_form->replace('NIP_DATA' , $nip_edit);
    $view_form->replace('NAMA_DATA' , $nama_edit);
    $view_form->replace('TANGGAL_LAHIR' , $ttl_edit);
    $view_form->replace('JABATAN_DATA' , $jabatan_edit);
    $view_form->replace('OUTLET_OPTIONS', $outlet_options);
    $view_form->replace('JABATAN_OPTIONS', $jabatan_options);
    $view_form->write();


    $anggota->close();
    $outlet->close();
    $jabatan->close();

?>