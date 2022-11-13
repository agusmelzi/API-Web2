<?php

class santoModel
{
    private $db;
    private $select;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=santoral;charset=utf8', 'root', '');
    }

    function getSantos($attribute = null, $order = null, $filter = null, $data = null, $size = null, $offset = null)
    {
        $params = [];
        $query = "SELECT * FROM santo";

        if ($filter != null && $data != null) {

            $query .= " where $filter = ?";
            array_push($params,$data);
            //$sentencia->execute(array($data));

        }

        if ($attribute != null && $order != null) {

            $query .= " ORDER BY $attribute $order";
            //$sentencia->execute();

        } 
        
        if (($size != null && $offset != null) || ($size != null && $offset == 0)) {
            
            if ($offset == 0) {
                $query .= " limit $size";
            } else {
                $query .= " limit $size offset $offset";
            }
            
            //$sentencia->execute();    

        }
        
        $sentencia = $this->db->prepare($query);
        $sentencia->execute($params);
        

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSanto($id)
    {

        $sentencia = $this->db->prepare("SELECT * from santo WHERE id=?");
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
        $sentencia->execute(array($nombre, $pais, $fecha_nac, $fecha_muerte, $fecha_canon, $congregacion, '', '', $id));
    }

    function borrarSanto($id)
    {

        $sentencia = $this->db->prepare("delete from santo where id=?");
        $sentencia->execute(array($id));
    }
}
