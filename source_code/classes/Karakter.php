<?php

class Karakter extends DB
{
    function getKarakterJoin()
    {
        $query = "SELECT * FROM karakter 
                  JOIN path ON karakter.id_path=path.id_path 
                  JOIN element ON karakter.id_element=element.id_element 
                  ORDER BY karakter.id_karakter";

        return $this->execute($query);
    }

    function getKarakter()
    {
        $query = "SELECT * FROM karakter";
        return $this->execute($query);
    }

    function getKarakterById($id)
    {
        $query = "SELECT * FROM karakter 
                  JOIN path ON karakter.id_path=path.id_path 
                  JOIN element ON karakter.id_element=element.id_element 
                  WHERE id_karakter=$id";
        return $this->execute($query);
    }

    function searchKarakter($keyword)
    {
        $query = "SELECT * FROM karakter 
                  JOIN path ON karakter.id_path=path.id_path 
                  JOIN element ON karakter.id_element=element.id_element 
                  WHERE nama LIKE '%$keyword%' OR jenis_kelamin LIKE '%$keyword%' 
                  ORDER BY id_karakter";
        return $this->execute($query);
    }

    function addData($data, $files)
    {
        // Ambil nama file foto dari $_FILES
        $foto = $files['foto']['name'];
        $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $tinggi = $data['tinggi'];
        $id_path = $data['id_path'];
        $id_element = $data['id_element'];

        $query = "INSERT INTO karakter (foto, nama, jenis_kelamin, tinggi, id_path, id_element) 
                VALUES ('$foto', '$nama', '$jenis_kelamin', '$tinggi', '$id_path', '$id_element')";
        
        // Upload foto ke direktori tertentu
        move_uploaded_file($files['foto']['tmp_name'], 'assests/images/' . $foto);

        return $this->executeAffected($query);
    }

    function updateData($id, $data, $files)
    {
        $nama = $data['nama'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $tinggi = $data['tinggi'];
        $id_path = $data['id_path'];
        $id_element = $data['id_element'];

        // Periksa apakah ada foto baru diunggah
        if (!empty($files['foto']['name'])) {
            // Ambil nama file foto dari $_FILES
            $foto = $files['foto']['name'];
            // Upload foto baru ke direktori tertentu
            move_uploaded_file($files['foto']['tmp_name'], 'assets/images/' . $foto);
            // Sertakan nama file foto baru dalam query update
            $query = "UPDATE karakter 
                    SET nama='$nama', jenis_kelamin='$jenis_kelamin', tinggi='$tinggi', 
                        id_path='$id_path', id_element='$id_element', foto='$foto' 
                    WHERE id_karakter=$id";
        } else {
            // Jika tidak ada foto baru, gunakan query update tanpa menyertakan kolom foto
            $query = "UPDATE karakter 
                    SET nama='$nama', jenis_kelamin='$jenis_kelamin', tinggi='$tinggi', 
                        id_path='$id_path', id_element='$id_element' 
                    WHERE id_karakter=$id";
        }

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM karakter WHERE id_karakter=$id";
        return $this->executeAffected($query);
    }

    function getKarakterJoinSorted($order)
    {
        $query = "SELECT * FROM karakter 
                  JOIN path ON karakter.id_path=path.id_path 
                  JOIN element ON karakter.id_element=element.id_element 
                  ORDER BY karakter.nama $order";

        return $this->execute($query);
    }
}
