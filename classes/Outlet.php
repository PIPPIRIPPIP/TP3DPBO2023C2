<?php

include('config/db.php');

class Outlet extends DB
{
    function getOutlet()
    {
        $query = "SELECT * FROM outlet";
        return $this->execute($query);
    }

    function getOutletById($id)
    {
        $query = "SELECT * FROM outlet WHERE outlet_id = $id";
        return $this->execute($query);
    }

    function searchOutlet($search)
    {
        $query = "SELECT * FROM outlet WHERE outlet_nama LIKE '%".$search."%'";
        return $this->execute($query);
    }

    function addOutlet($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO outlet VALUES('', '$nama')";
        return $this->executeAffected($query);
    }
    
    function updateOutlet($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE outlet SET outlet_nama = '$nama' WHERE outlet_id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteOutlet($id)
    {
        $query = "DELETE FROM outlet WHERE outlet_id = $id";
        return $this->executeAffected($query);
    }

    function filterOutletAsc()
    {
        $query = "SELECT * FROM outlet ORDER BY outlet_nama ASC";
        return $this->execute($query);
    }
    
    function filterOutletDesc()
    {
        $query = "SELECT * FROM outlet ORDER BY outlet_nama DESC";
        return $this->execute($query);
    }
}