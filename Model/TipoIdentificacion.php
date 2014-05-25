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
class TipoIdentificacion {

    //put your code here
    private $Id;
    private $TipoIdentificacion;
    private $Activo;
    private $conn;

    const Tabla = "Tipo_Identificacion";

    public function __construct($Con) {
        $this->conn = $Con;
    }

    public function getId() {
        return $this->Id;
    }

    public function setId($id) {
        $this->Id = $id;
    }

    public function getTipoIdentificacion() {
        return $this->TipoIdentificacion;
    }

    public function setTipoIdentificacion($TipoIdentificacion) {
        $this->TipoIdentificacion = $TipoIdentificacion;
    }

    public function getActivo() {
        return $this->Activo;
    }

    public function setActivo($Activo) {
        $this->Activo = $Activo;
    }

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
            $myClass = new TipoIdentificacion();
            $myClass->setActivo($row['Activo']);
            $myClass->setId($row['Id']);
            $myClass->setTipoIdentificacion($row['TipoIdentificacion']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

}

?>
