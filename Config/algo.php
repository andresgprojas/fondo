<?php
        if (file_exists('config.xml')) {
            die('ok');
            $xml = simplexml_load_file('config.xml');

            print_r($xml);
        } else {
            exit('Error abriendo config.xml.');
        }die();
?>