<?php

class Path extends DB
{
    function getPath()
    {
        $query = "SELECT * FROM path";
        return $this->execute($query);
    }

    function getPathById($id)
    {
        $query = "SELECT * FROM path WHERE id_path=$id";
        return $this->execute($query);
    }

    function addPath($data)
    {
        $nama_path = $data['nama_path'];
        $query = "INSERT INTO path VALUES('', '$nama_path')";
        return $this->executeAffected($query);
    }

    function updatePath($id, $data)
    {
        $nama_path = $data['nama_path'];
        $query = "UPDATE path SET nama_path='$nama_path' WHERE id_path=$id";
        return $this->executeAffected($query);
    }

    function deletePath($id)
    {
        $query = "DELETE FROM path WHERE id_path=$id";
        return $this->executeAffected($query);
    }
}
