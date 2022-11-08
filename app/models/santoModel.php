<?php

class santoModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=santoral;charset=utf8', 'root', '');
    }

    function getSantos($attribute = null, $order = null)
    {
        if ($attribute != null && $order != null) {
            $sentencia = $this->db->prepare("select * FROM santo ORDER BY $attribute $order");
            $sentencia->execute();
        } else {
            $sentencia = $this->db->prepare("select * from santo");
            $sentencia->execute();
        }

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSanto($id)
    {

        $sentencia = $this->db->prepare("select * from santo WHERE id=?");
        $sentencia->execute(array($id));

        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }


    function getSantosXCategoria($categoria)
    {

        $sentencia = $this->db->prepare("select * from santo WHERE congregacion_fk=?");
        $sentencia->execute(array($categoria));

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }


    function insertSanto($nombre, $pais, $fecha_nac, $fecha_muerte, $fecha_canon, $congregacion, $name = null, $tmp = null)
    {

        $sentencia = $this->db->prepare("INSERT INTO santo(
                nombre, pais, fecha_nacimiento, fecha_muerte, fecha_canonizacion, congregacion_fk, foto, fotoNombre) 
                VALUES (?,?,?,?,?,?,?,?)");
        $sentencia->execute(array($nombre, $pais, $fecha_nac, $fecha_muerte, $fecha_canon, $congregacion, '', ''));


        return $this->db->lastInsertId();
        //return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    function editSanto($id, $nombre, $pais, $fecha_nac, $fecha_muerte, $fecha_canon, $congregacion, $name = null, $tmp = null)
    {


        $sentencia = $this->db->prepare("UPDATE santo SET
        nombre = ?,
        pais = ?,
        fecha_nacimiento = ?,
        fecha_muerte = ?,
        fecha_canonizacion = ?,
        congregacion_fk = ?,
        foto = ?,
        fotoNombre = ?
        WHERE id = ?");
      $sentencia->execute(array($nombre, $pais, $fecha_nac, $fecha_muerte, $fecha_canon, $congregacion,'', '', $id));

    }

    function borrarSanto($id)
    {

        $sentencia = $this->db->prepare("delete from santo where id=?");
        $sentencia->execute(array($id));
    }
}
