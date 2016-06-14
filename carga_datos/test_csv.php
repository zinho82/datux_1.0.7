<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
 
$connect = new DB_mysql ;
$connect->conectar();

$campaign_id = $_GET["campaign_id"];


$titulos = $connect->consulta("SELECT * from sistema_deuda where campaign_id = '$campaign_id' limit 1");

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
$datos = $connect->consulta("SELECT * from sistema_deuda where campaign_id = '$campaign_id' order by id_deuda");
while($row2 = mysql_fetch_assoc($datos)) {
   
	foreach($row2 as $key2 => $value) 
   { 
   	  $linea .= $value.";"; 
      
   }
   
   $linea .="\n";
}
fwrite($f,$linea);



$filename = $campaign_id."-".date("YmdHi",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $linea;
exit;

fclose($f); 

?>