<?php

class Element extends DB
{
    function getElement()
    {
        $query = "SELECT * FROM element";
        return $this->execute($query);
    }

    function getElementById($id)
    {
        $query = "SELECT * FROM element WHERE id_element=$id";
        return $this->execute($query);
    }

    function addElement($data)
    {
        $nama_element = $data['nama_element'];
        $query = "INSERT INTO element VALUES ('', '$nama_element')";
        return $this->executeAffected($query);
    }

    function updateElement($id, $data)
    {
        $nama_element = $data['nama_element'];
        $query = "UPDATE element SET nama_element='$nama_element' WHERE id_element=$id";
        return $this->executeAffected($query);
    }

    function deleteElement($id)
    {
        $query = "DELETE FROM element WHERE id_element=$id";
        return $this->executeAffected($query);
    }
}
