<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conn
 *
 * @author andresprojas
 */
class Conn {

    private $_HOST;
    private $_USUARIO;
    private $_PASSWORD;
    private $_DATABASE;
    private $link;
    private $c;


    public function __construct() {
        
//        $Credenciales = simplexml_load_file('config.xml') or die('paila');
//        print_r($Credenciales);die('a');
//        $c = (array) $Credenciales->credencial;
        $this->_HOST    = 'localhost';
        $this->_USUARIO = 'root';
        $this->_PASSWORD= 'root';
        $this->_DATABASE= 'Simulador';
    }

    public function conectar(){
        $link = @mysqli_connect($this->_HOST, $this->_USUARIO, $this->_PASSWORD, $this->_DATABASE) or die(mysql_error());
        $this->setLink($link);
    }
    
    public function cerrar(){
        mysqli_close($this->getLink());
    }
    
    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
    }
    
    public function getSesion() {
        @session_start();
        if (count($_SESSION)>0)
            return $_SESSION['usuario'];
        else
            return FALSE;
    }
}

?>