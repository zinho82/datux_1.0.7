<?php

define("__ROOT__", "/var/www/html/sistema/carga/");
define("BASE_BD", "asterisk");
define("TBL_TEMPORAL_ABC", "sistema_tricot_carga");
date_default_timezone_set('America/Santiago');
require_once __ROOT__.'carga/core/conexion.php';
require_once '/var/www/html/sistema/carga/carga/core/Carga.php';
$conn=new Conexion();

$carga = new Carga();
echo "  comenzando segunda parte de la carga  ";
 //$sql="update ".BASE_BD.'.'.TBL_TEMPORAL_ABC. ' set nombre=replace(nombre,"'."'".'"'.",'')"; 
 
//mysql_query($sql,$conn->conectar_db(BASE_BD));
echo "  Reparando Telefonos  ";
$carga->Limpiar_caracteres('nombre', BASE_BD, TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('calle_part', BASE_BD, TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('villa_part', BASE_BD, TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('nom_region', BASE_BD, TBL_TEMPORAL_ABC);
$carga->Limpiar_caracteres('nom_comu', BASE_BD, TBL_TEMPORAL_ABC);
/*
 $sql="update ".BASE_BD.'.'.TBL_TEMPORAL_ABC. ' set calle_part=replace(calle_part,"'."'".'"'.",'')"; 
mysql_query($sql,$conn->conectar_db(BASE_BD));
$sql="update ".BASE_BD.'.'.TBL_TEMPORAL_ABC. ' set villa_part=replace(villa_part,"'."'".'"'.",'')"; 
mysql_query($sql,$conn->conectar_db(BASE_BD));
$sql="update ".BASE_BD.'.'.TBL_TEMPORAL_ABC. ' set nom_region=replace(nom_region,,"'."'".'"'.",'')"; 
mysql_query($sql,$conn->conectar_db(BASE_BD));
$sql="update ".BASE_BD.'.'.TBL_TEMPORAL_ABC. ' set nom_comu=replace(nom_ccomu,,"'."'".'"'.",'')"; 
mysql_query($sql,$conn->conectar_db(BASE_BD));
*/
$carga->Reparar_fonos_1campo('fono_part', TBL_TEMPORAL_ABC, BASE_BD, 'efono');
$carga->Reparar_fonos_1campo('num_cel', TBL_TEMPORAL_ABC, BASE_BD, 'efono');
$carga->Reparar_fonos_1campo('telefono_cel', TBL_TEMPORAL_ABC, BASE_BD, 'efono');
$carga->Reparar_fonos_1campo('fono_ref', TBL_TEMPORAL_ABC, BASE_BD, 'efono');

