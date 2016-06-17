<?php
define("BASE_BD", "asterisk");
define("TBL_TEMPORAL", "sistema_temporal_pob_hites");
date_default_timezone_set('America/Santiago');
require_once '/var/www/html/sistema_gestion/carga/carga/core/conexion.php';
require_once '/var/www/html/sistema_gestion/carga/carga/core/Carga.php';
$carga=new Carga();
$carga->Reparar_fonos_1campo("celca2", TBL_TEMPORAL, BASE_BD, "estado");
