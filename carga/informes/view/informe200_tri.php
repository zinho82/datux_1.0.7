<?php
date_default_timezone_set ('America/Santiago' );
define("RUTA", "/var/www/html/sistema_gestion/archivos/informes/");
require_once '/var/www/html/sistema_gestion/carga/informes/core/Informes.php'; 
$fecha=date("Ymd");
        unlink(RUTA."200/".$fecha."_200SILCA_CAST_G2.txt");
        $fp=fopen(RUTA."200/".$fecha."_200SILCA_CAST_G2.txt","x") ;
        if(!is_file(RUTA."/200/".$fecha."_200SILCA_CAST_G2.txt")){
            echo "archivo no existe";
        }
       $infor=new Informes(); 
       $infor->LlenarArchivo_200_tri('','',$fecha,$fp,'G2');
       
	unlink(RUTA."200/".$fecha."_200SILCA_CAST_G3.txt");
        $fp=fopen(RUTA."200/".$fecha."_200SILCA_CAST_G3.txt","x") ;
        if(!is_file(RUTA."/200/".$fecha."_200SILCA_CAST_G3.txt")){
            echo "archivo no existe";
        }

       $infor->LlenarArchivo_200_tri('','',$fecha,$fp,'G3');
	unlink(RUTA."200/".$fecha."_200SILCA_CAST_G4.txt");
        $fp=fopen(RUTA."200/".$fecha."_200SILCA_CAST_G4.txt","x") ;
        if(!is_file(RUTA."/200/".$fecha."_200SILCA_CAST_G4.txt")){
            echo "archivo no existe";
        }
        $infor->LlenarArchivo_200_tri('','',$fecha,$fp,'G4');
