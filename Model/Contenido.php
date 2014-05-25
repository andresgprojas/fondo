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
class Contenido {

    private $Id;
    private $TituloContenido;
    private $Nivel;
    private $Activo;
    private $URL;
    private $ContenidoIdPadre;
    private $conn;

    const Tabla = "Contenido";

    public function __construct($link) {
        $this->conn = $link;
    }

    public function getId() {
        return $this->Id;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    public function getTituloContenido() {
        return $this->TituloContenido;
    }

    public function setTituloContenido($TituloContenido) {
        $this->TituloContenido = $TituloContenido;
    }

    public function getNivel() {
        return $this->Nivel;
    }

    public function setNivel($Nivel) {
        $this->Nivel = $Nivel;
    }

    public function getActivo() {
        return $this->Activo;
    }

    public function setActivo($Activo) {
        $this->Activo = $Activo;
    }

    public function getURL() {
        return $this->URL;
    }

    public function setURL($URL) {
        $this->URL = $URL;
    }

    public function getContenidoIdPadre() {
        return $this->ContenidoIdPadre;
    }

    public function setContenidoIdPadre($ContenidoIdPadre) {
        $this->ContenidoIdPadre = $ContenidoIdPadre;
    }

    /**
     * Guardar un Contenido.
     * 
     * @param type $conn link de conexión a la BD.
     * @return bool TRUE si realiza la transacción, FALSE de no realzarla
     */
    public function setContenido() {
        $str = "INSERT INTO " . $this::Tabla . " (" .
                "TituloContenido, " .
                "Activo, " .
                "URL, " .
                "Contenido_idPadre" .
                ")" .
                " VALUES (" .
                "'{$this->getTituloContenido()}', " .
                "'{$this->getActivo()}', " .
                "'{$this->getURL()}', " .
                "'{$this->getContenidoIdPadre()}')";
        $qry = mysqli_query($this->conn->getLink(), $str) or die(mysqli_error($this->conn->getLink()));

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
        $qry = mysqli_query($this->conn->getLink(), $str);

        if (mysqli_num_rows($qry) == 0)
            return FALSE;

        $arrayPadre = array();
        while ($row = mysqli_fetch_assoc($qry)) {
            $myClass = new Contenido();
            $myClass->setActivo($row['Activo']);
            $myClass->setContenido($row['Contenido']);
            $myClass->setContenidoIdPadre($row['Contenido_idPadre']);
            $myClass->setId($row['Id']);
            $myClass->setTituloContenido($row['TituloContenido']);
            $myClass->setURL($row['URL']);

            array_push($arrayPadre, $myClass);
        }

        return $arrayPadre;
    }

}

?>
