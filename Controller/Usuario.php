<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Config/cab.inc.php';
extract($_POST);

switch ($action) {
    case 'Acceder':
        $Con = new Conn();
        $Con->conectar();
        
        $Usuario = new Usuario($Con->getLink());
        $rta = $Usuario->getByFilter(array('Identificacion'=>$nuip, 'Password'=>md5($psw)));
        $Con->cerrar();

        if($rta === FALSE){
            printf('%s', utf8_encode('Problemas para acceder, por favor verifique sus credenciales.'));
        }
        else{
            printf('%s', utf8_encode('TRUE'));
        }
        
        break;
        
    case 'Crear':
        $Con = new Conn();
        $Con->conectar();
        
        if (!$identificacion || !$primerApe || !$primerNom || !$Sede){
            exit('Existen campos obligatorios');
        }
        $Usuario = new Usuario($Con->getLink());
        $Usuario->setIdentificacion($identificacion);
        $Usuario->setPassword(md5($identificacion));
        $Usuario->setPrimerApellido($primerApe);
        $Usuario->setPrimerNombre($primerNom);
        $Usuario->setSedeId($Sede);
        $Usuario->setSegundoApellido($segundoApe);
        $Usuario->setSegundoNombre($segundoNom);
        $Usuario->setTipoIdentificacionId($TipoId);
        $rta = $Usuario->setUsuario();
        
        $Con->cerrar();
        
        if ($rta===FALSE){
            echo 'paila';
        }
        
        break;

    default:
        break;
}
?>
