<?php

include('config/db.php');

class Karyawan extends DB
{
    function getKaryawanJoin()
    {
        $query = "SELECT * FROM karyawan JOIN outlet ON karyawan.outlet_id=outlet.outlet_id JOIN jabatan ON karyawan.jabatan_id=jabatan.jabatan_id ORDER BY karyawan_id";
        return $this->execute($query);
    }

    function getKaryawan()
    {
        $query = "SELECT * FROM karyawan";
        return $this->execute($query);
    }

    function getKaryawanById($id)
    {
        $query = "SELECT * FROM karyawan JOIN outlet ON karyawan.outlet_id=outlet.outlet_id JOIN jabatan ON karyawan.jabatan_id=jabatan.jabatan_id WHERE karyawan_id=$id";
        return $this->execute($query);
    }

    function searchKaryawan($search)
    {
        $query = "SELECT * FROM karyawan JOIN outlet ON karyawan.outlet_id=outlet.outlet_id JOIN jabatan ON karyawan.jabatan_id=jabatan.jabatan_id WHERE karyawan_nama LIKE '%".$search."%'";
        return $this->execute($query);
    }

    function addKaryawan($data, $file)
    {
        $tmp_file = $file['file_image']['tmp_name'];
        $foto = $file['file_image']['name'];
        
        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['nama'];
        $nip = $data['nip'];
        $date = $data['ttl'];
        $outlet_id = $data['outlet'];
        $jabatan_id = $data['jabatan'];
        

        $query = "INSERT INTO karyawan VALUES('', '$foto', '$nip', '$nama', '$date', '$outlet_id' ,'$jabatan_id')";
        return $this->executeAffected($query);
    }

    function updateKaryawan($id, $data, $file, $img)
    {
        $tmp_file = $file['file_image']['tmp_name'];
        $foto = $file['file_image']['name'];
        
        if ($foto == "") {
            $foto = $img;
        }

        $dir = "assets/images/$foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['nama'];
        $nip = $data['nip'];
        $date = $data['ttl'];
        $outlet_id = $data['outlet'];
        $jabatan_id = $data['jabatan'];

        $query = "UPDATE karyawan SET karyawan_foto = '$foto', karyawan_nama = '$nama', karyawan_nip = '$nip', karyawan_ttl = '$date', outlet_id = '$outlet_id', jabatan_id = '$jabatan_id' WHERE karyawan_id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteKaryawan($id)
    {
        $query = "DELETE FROM karyawan WHERE karyawan_id = $id";
        return $this->executeAffected($query);
    }

    function filterKaryawanAsc()
    {
        $query = "SELECT * FROM karyawan JOIN outlet ON karyawan.outlet_id=outlet.outlet_id JOIN jabatan ON karyawan.jabatan_id=jabatan.jabatan_id ORDER BY karyawan_nama ASC";
        return $this->execute($query);
    }
    
    function filterKaryawanDesc()
    {
        $query = "SELECT * FROM karyawan JOIN outlet ON karyawan.outlet_id=outlet.outlet_id JOIN jabatan ON karyawan.jabatan_id=jabatan.jabatan_id ORDER BY karyawan_nama DESC";
        return $this->execute($query);
    }
}