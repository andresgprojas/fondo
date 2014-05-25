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
class Usuario {

    private $TipoIdentificacionId;
    private $Identificacion;
    private $PrimerNombre;
    private $SegundoNombre;
    private $PrimerApellido;
    private $SegundoApellido;
    private $Password;
    private $Enable;
    private $Activo;
    private $UltimoLogin;
    private $Sede_Id;
    private $conn;

    const Tabla = "Usuario";

    public function __construct($link) {
        $this->conn = $link;
    }

    public function getTipoIdentificacionId() {
        return $this->TipoIdentificacionId;
    }

    public function setTipoIdentificacionId($TipoIdentificacionId) {
        $this->TipoIdentificacionId = $TipoIdentificacionId;
    }

    public function getIdentificacion() {
        return $this->Identificacion;
    }

    public function setIdentificacion($Identificacion) {
        $this->Identificacion = $Identificacion;
    }

    public function getPrimerNombre() {
        return $this->PrimerNombre;
    }

    public function setPrimerNombre($PrimerNombre) {
        $this->PrimerNombre = $PrimerNombre;
    }

    public function getSegundoNombre() {
        return $this->SegundoNombre;
    }

    public function setSegundoNombre($SegundoNombre) {
        $this->SegundoNombre = $SegundoNombre;
    }

    public function getPrimerApellido() {
        return $this->PrimerApellido;
    }

    public function setPrimerApellido($PrimerApellido) {
        $this->PrimerApellido = $PrimerApellido;
    }

    public function getSegundoApellido() {
        return $this->SegundoApellido;
    }

    public function setSegundoApellido($SegundoApellido) {
        $this->SegundoApellido = $SegundoApellido;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function getEnable() {
        return $this->Enable;
    }

    public function setEnable($Enable) {
        $this->Enable = $Enable;
    }

    public function getActivo() {
        return $this->Activo;
    }

    public function setActivo($Activo) {
        $this->Activo = $Activo;
    }

    public function getUltimoLogin() {
        return $this->UltimoLogin;
    }

    public function setUltimoLogin($UltimoLogin) {
        $this->UltimoLogin = $UltimoLogin;
    }

    public function getSedeId() {
        return $this->Sede_Id;
    }

    public function setSedeId($Sede_Id) {
        $this->Sede_Id = $Sede_Id;
    }

    /**
     * Guardar un usuario.
     * 
     * @param type $conn link de conexión a la BD.
     * @return bool TRUE si realiza la transacción, FALSE de no realzarla
     */
    public function setUsuario() {
        $str = "INSERT INTO " . $this::Tabla . " (" .
                "Tipo_Identificacion_id, " .
                "Identificacion, " .
                "PrimerNombre, " .
                "SegundoNombre, " .
                "PrimerApellido, " .
                "SegundoApellido, " .
                "Password, " .
                "Enable, " .
                "Activo, " .
                "UltimoLogin, " .
                "Sede_Id" .
                ")" .
                " VALUES ('{$this->getTipoIdentificacionId()}', " .
                "'{$this->getIdentificacion()}', " .
                "'{$this->getPrimerNombre()}', " .
                "'{$this->getSegundoNombre()}', " .
                "'{$this->getPrimerApellido()}', " .
                "'{$this->getSegundoApellido()}', " .
                "'{$this->getPassword()}', " .
                "'{$this->getEnable()}', " .
                "'{$this->getActivo()}', " .
                "'{$this->getUltimoLogin()}', " .
                "'{$this->getSedeId()}')";
        $qry = mysqli_query($this->conn, $str) or die(mysqli_error($this->conn));

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
            $filter = substr($filter, 0, -4);
        }

        $str = "SELECT * FROM " . $this::Tabla . " {$filter}";
        $qry = mysqli_query($this->conn, $str);

        if (mysqli_num_rows($qry) == 0)
            return FALSE;

        $arrayPadre = array();
        while ($row = mysqli_fetch_assoc($qry)) {
            
            $myClass = new Usuario();
            $myClass->setActivo($row['Activo']);
            $myClass->setEnable($row['Enable']);
            $myClass->setIdentificacion($row['Identificacion']);
            $myClass->setPassword($row['Password']);
            $myClass->setPrimerApellido($row['PrimerApellido']);
            $myClass->setPrimerNombre($row['PrimerNombre']);
            $myClass->setSedeId($row['Sede_Id']);
            $myClass->setSegundoApellido($row['SegundoApellido']);
            $myClass->setSegundoNombre($row['SegundoNombre']);
            $myClass->setTipoIdentificacionId($row['Tipo_Identificacion_id']);
            $myClass->setUltimoLogin($row['UltimoLogin']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

}

?>
