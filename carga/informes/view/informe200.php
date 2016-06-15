<?php
date_default_timezone_set ('America/Santiago' );
define("RUTA", "/var/www/html/sistema_gestion/archivos/informes/");
require_once '/var/www/html/sistema_gestion/carga/informes/core/Informes.php'; 

        unlink(RUTA."200/b200_sa138_".date("ymd").".txt");
        $fp=fopen(RUTA."200/b200_sa138_".date("ymd").".txt","x") ;
        if(!is_file(RUTA."/200/b200_sa138_".date("ymd").".txt")){
            echo "archivo no existe";
        }
       $infor=new Informes(); 
       $infor->LlenarArchivo('','',date('Ymd'),$fp,'194');
       
