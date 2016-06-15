<?php
date_default_timezone_set ('America/Santiago' );
define("RUTA", "/var/www/html/sistema_gestion/archivos/informes/");
require_once '/var/www/html/sistema_gestion/carga/informes/core/Informes.php';
    $fecha=date("Ymd");

         $a600=new Informes();
 
        unlink(RUTA. "600/".$fecha."_600SILCA_CAST_G2.txt");
        $fp=fopen(RUTA. "600/".$fecha."_600SILCA_CAST_G2.txt","x") ;
        if(!is_file(RUTA."600/".$fecha."_600SILCA_CAST_G2.txt")){
            echo "archivo no existe";
        }

        $a600->LlenarArchivo600_tri($fp, 'G2');
 unlink(RUTA. "600/".$fecha."_600SILCA_CAST_G3.txt");
        $fp=fopen(RUTA. "600/".$fecha."_600SILCA_CAST_G3.txt","x") ;
        if(!is_file(RUTA."600/".$fecha."_600SILCA_CAST_G3.txt")){
            echo "archivo no existe";
        }

        $a600->LlenarArchivo600_tri($fp, 'G3');
 unlink(RUTA. "600/".$fecha."_600SILCA_CAST_G4.txt");
        $fp=fopen(RUTA. "600/".$fecha."_600SILCA_CAST_G4.txt","x") ;
        if(!is_file(RUTA."600/".$fecha."_600SILCA_CAST_G4.txt")){
            echo "archivo no existe";
        }

        $a600->LlenarArchivo600_tri($fp, 'G4');

