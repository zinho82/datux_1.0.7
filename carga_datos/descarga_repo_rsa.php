<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
 
$connect = new DB_mysql ;
$connect->conectar();

$campaign_id = $_GET["campaign_id"];


$titulos = $connect->consulta("SELECT
'area',
'telefono',
'rut_cliente',
'' as DV,
'' as valor_venta,
'fecha_venta',
'hora_venta',
'estado_registro',
'codigo_estado_registro',
'empresa',
'campana',
'cod_familia',
'cod_producto',
'ciclo',
'nombre_ejecutivo'
#'iempo_donacion',
#'nombre_toma_servicio',
#'rut_toma_servicio',
#'dv_toma_servicio',
#'celular_toma_servicio',
#'mail_toma_servicio'
FROM sistema_gestiones limit 1");

$fix = $connect->consulta("UPDATE sistema_gestiones SET glosa = REPLACE(glosa,'\n',' ') where campaign = '$campaign_id'");
$fix = $connect->consulta("UPDATE sistema_gestiones SET glosa = REPLACE(glosa,'\r',' ') where campaign = '$campaign_id'");


//
$f = fopen("reporte.csv","w");
$separador = ";";

$sw=1;
while($row = mysql_fetch_assoc($titulos)) {
   
   
   
	foreach($row as $key => $value) 
   { 
   	  $linea .= $key.";"; 
      
//      else 
//      $linea .= $value.";"; 
//      fwrite($f,$linea);
      
   }
   $linea .="\n";
}
$datos = $connect->consulta("
SELECT
'' as area,
telefono,
rut_cliente as rut_cliente,
'' as DV,
'' as valor_venta,
DATE_FORMAT(fecha,'%Y%m%d') as fecha_venta,
DATE_FORMAT(fecha,'%H%i%s') as hora_venta,
cod_gestion2 as estado_registro,
cod_gestion as codigo_estado_registro,
'05002' as empresa,
adicional1 as 'campaña',
'00002' as  cod_familia,
'000011' as cod_producto,
'' as ciclo,
user as nombre_ejecutivo
#tiempo_donacion,
#nombre_toma_servicio,
#rut_toma_servicio,
#dv_toma_servicio,
#celular_toma_servicio,
#mail_toma_servicio
FROM sistema_gestiones
WHERE campaign = '$campaign_id'");

while($row2 = mysql_fetch_assoc($datos)) {
   
	foreach($row2 as $key2 => $value) 
   { 
   	  $linea .= $value.";"; 
      
   }
   
   $linea .="\n";
}
fwrite($f,$linea);

$filename = $campaign_id."-Gestiones-".date("YmdHi",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $linea;
exit;

fclose($f); 

?>
