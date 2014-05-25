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
class PerfilHasContenido {

    //put your code here
    private $PerfilId;
    private $ContenidoId;
    private $conn;

    const Tabla = "Perfil_has_Contenido";

    public function __construct($Con) {
        $this->conn = $Con;
    }

    public function getPerfilId() {
        return $this->PerfilId;
    }

    public function setPerfilId($PerfilId) {
        $this->PerfilId = $PerfilId;
    }

    public function getContenidoId() {
        return $this->ContenidoId;
    }

    public function setContenidoId($ContenidoId) {
        $this->ContenidoId = $ContenidoId;
    }

    public function setPerfilContenido() {
        $str = "INSERT INTO " . $this::Tabla . " (" .
                "Perfil_Id, " .
                "Contenido_Id" .
                ") VALUES (" .
                "'{$this->getPerfilId()}', " .
                "'{$this->getContenidoId()}'" .
                ")";
        $qry = mysqli_query($this->conn->getLink(), $str);
        return $qry;
    }

    /**
     * 
     * @param type $filtro
     * @return bool|array
     */
    public function getByFilter($filtro = array()) {

        $filter = "";
        if (count($filtro) > 0) {
            $filter = "WHERE ";
            foreach ($filtro as $key => $value) {
                $filter .= "{$key} = '{$value}' AND ";
            }
        }

        $filter = substr($filter, 0, -4);

        $str = "SELECT * FROM " . $this::Tabla . " {$filter}";
        $qry = mysqli_query($this->conn->getLink(), $str) or die(mysqli_error($this->conn->getLink()));

        if (mysqli_num_rows($qry) == 0)
            return FALSE;

        $arrayPadre = array();
        while ($row = mysqli_fetch_assoc($qry)) {
            $myClass = new PerfilHasContenido();
            $myClass->setContenidoId($row['Contenido_Id']);
            $myClass->setPerfilId($row['Perfil_Id']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

}

?>
