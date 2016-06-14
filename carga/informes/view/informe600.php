<?php
date_default_timezone_set ('America/Santiago' );
define("RUTA", "/var/www/html/sistema_gestion/archivos/informes/");
require_once '/var/www/html/sistema_gestion/carga/informes/core/Informes.php';


        
        unlink(RUTA. "600/b600_sa138".date("ymd").".txt");
        $fp=fopen(RUTA. "600/b600_sa138_".date("ymd").".txt","x") ;
        if(!is_file(RUTA."600/b600_sa138_".date("ymd").".txt")){
            echo "archivo no existe";
        }
        $a600=new Informes();
        $a600->LlenarArchivo600($fp, 194);
