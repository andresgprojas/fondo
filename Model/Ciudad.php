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
class Ciudad {

    //put your code here
    private $Id;
    private $NombreCiudad;
    private $Activo;
    private $conn;

    const Tabla = "Perfil";

    public function __construct($Con) {
        $this->conn = $Con;
    }

    public function getId() {
        return $this->Id;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    public function getNombreCiudad() {
        return $this->NombreCiudad;
    }

    public function setNombreCiudad($NombreCiudad) {
        $this->NombreCiudad = $NombreCiudad;
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
            $myClass = new Ciudad();
            $myClass->setActivo($row['Activo']);
            $myClass->setId($row['Id']);
            $myClass->setNombreCiudad($row['NombreCiudad']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

    /**
     * Guardar una Ciudad.
     * 
     * @param type $conn link de conexión a la BD.
     * @return bool TRUE si realiza la transacción, FALSE de no realzarla
     */
    public function setCiudad() {
        $str = "INSERT INTO " . $this::Tabla . " (" .
                "NombreCiudad, " .
                "Activo" .
                ")" .
                " VALUES (" .
                "'{$this->getNombreCiudad()}', " .
                "'{$this->getActivo()}'" .
                ")";
        $qry = mysqli_query($this->conn->getLink(), $str) or die(mysqli_error($this->conn->getLink()));

        return $qry;
    }

}

?>
