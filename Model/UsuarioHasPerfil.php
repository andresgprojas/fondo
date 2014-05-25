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
class UsuarioHasPerfil {

    //put your code here
    private $UsuarioIdentificacion;
    private $PerfilId;
    private $conn;

    const Tabla = "Usuario_has_Perfil";

    public function __construct($Con) {
        $this->conn = $Con;
    }

    public function getUsuarioIdentificacion() {
        return $this->UsuarioIdentificacion;
    }

    public function setUsuarioIdentificacion($UsuarioIdentificacion) {
        $this->UsuarioIdentificacion = $UsuarioIdentificacion;
    }

    public function getPerfilId() {
        return $this->PerfilId;
    }

    public function setPerfilId($PerfilId) {
        $this->PerfilId = $PerfilId;
    }

    public function setUsuarioPerfil() {
        $str = "INSERT INTO " . $this::Tabla . " (" .
                "Usuario_Identificacion, " .
                "Perfil_Id" .
                ") VALUES (" .
                "'{$this->getUsuarioIdentificacion()}', " .
                "'{$this->getPerfilId()}'" .
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
            $myClass = new UsuarioHasPerfil();
            $myClass->setUsuarioIdentificacion($row['Usuario_Identificacion']);
            $myClass->setPerfilId($row['Perfil_Id']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

}

?>
