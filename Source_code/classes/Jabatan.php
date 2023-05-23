<?php

class Jabatan extends DB
{
    function getJabatan()
    {
        $query = "SELECT * FROM jabatan";
        return $this->execute($query);
    }

    function getJabatanById($id)
    {
        $query = "SELECT * FROM jabatan WHERE jabatan_id = $id";
        return $this->execute($query);
    }

    function searchJabatan($search)
    {
        $query = "SELECT * FROM jabatan WHERE jabatan_nama LIKE '%".$search."%'";
        return $this->execute($query);
    }

    function addJabatan($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO jabatan VALUES ('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateJabatan($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE jabatan SET jabatan_nama = '$nama' WHERE jabatan_id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteJabatan($id)
    {
        $query = "DELETE FROM jabatan WHERE jabatan_id = $id";
        return $this->executeAffected($query);
    }

    function filterJabatanAsc()
    {
        $query = "SELECT * FROM jabatan ORDER BY jabatan_nama ASC";
        return $this->execute($query);
    }
    
    function filterJabatanDesc()
    {
        $query = "SELECT * FROM jabatan ORDER BY jabatan_nama DESC";
        return $this->execute($query);
    }
}
