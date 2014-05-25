<?php

require_once '../Config/cab.inc.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Perfil
 *
 * @author andresprojas
 */
class Perfil {

    //put your code here
    private $Id;
    private $NombrePerfil;
    private $Activo;
    private $conn;

    const Tabla = "Perfil";

    public function __construct($Con) {
        $this->conn = $Con;
    }

    public function getId() {
        return $this->Id;
    }

    public function setId($id) {
        $this->Id = $id;
    }

    public function getNombrePerfil() {
        return $this->NombrePerfil;
    }

    public function setNombrePerfil($NombrePerfil) {
        $this->NombrePerfil = $NombrePerfil;
    }

    public function getActivo() {
        return $this->Activo;
    }

    public function setActivo($Activo) {
        $this->Activo = $Activo;
    }

    /**
     * 
     * @param type $filtro
     * @param type $activo
     * @return boolean|array
     */
    public function getByFilter($filtro = array(), $activo = TRUE) {
        $filter = "WHERE ";

        if (count($filtro) > 0) {
            foreach ($filtro as $key => $value) {
                $filter .= "{$key} = '{$value}' AND ";
            }
        }

        $filter .= ($activo === TRUE) ? "Activo = 1" : "(Activo = 1 OR Activo = 0)";

        $str = "SELECT * FROM " . $this::Tabla . " {$filter}";
        $qry = mysqli_query($this->conn->getLink(), $str) or die(mysqli_error($this->conn->getLink()));

        if (mysqli_num_rows($qry) == 0)
            return FALSE;

        $arrayPadre = array();
        while ($row = mysqli_fetch_assoc($qry)) {
            $myClass = new Perfil();
            $myClass->setActivo($row['Activo']);
            $myClass->setId($row['Id']);
            $myClass->setNombrePerfil($row['NombrePerfil']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

    /**
     * Guardar un Perfil.
     * 
     * @param type $conn link de conexión a la BD.
     * @return bool TRUE si realiza la transacción, FALSE de no realzarla
     */
    public function setPerfil() {
        $str = "INSERT INTO " . $this::Tabla . " (" .
                "NombrePerfil, " .
                "Activo" .
                ")" .
                " VALUES (" .
                "'{$this->getNombrePerfil()}', " .
                "'{$this->getActivo()}'" .
                ")";
        $qry = mysqli_query($this->conn->getLink(), $str) or die(mysqli_error($this->conn->getLink()));

        return $qry;
    }

}

?>
