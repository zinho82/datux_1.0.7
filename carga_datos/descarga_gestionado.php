<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
 
$connect = new DB_mysql ;
$connect->conectar();

$campaign_id = $_GET["campaign_id"];
$cod_cedente = $_GET["cod_cedente"];


$titulos = $connect->consulta("SELECT 'rut','dv','nombre','rut_rep_legal','nom_rep_legal','etapa_cobranza ','rut','dv',' nro_doc',' total_cuotas',' tipo_doc',' estado_deuda',' cuotas_vencidas',' fec_venc',' fec_asignacion',' fec_colocacion',' monto',' deuda_total',' abono',' fecha_abono',' deuda_morosa',' cuotas_pagadas',' fecha_actualizacion',' cartera',' tramo',' adicional1',' adicional2',' adicional3',' adicional4',' adicional5',' cod_cedente','fecha_ultima_gestion','telefono_ultima_gestion','cod_gestion_ultima_gestion',' cod_contacto_utima_gestion',' glosa_ultima_gestion'");

$fix = $connect->consulta("UPDATE sistema_gestiones SET glosa = REPLACE(glosa,'\n',' ') where cod_cedente = $cod_cedente");
$fix = $connect->consulta("UPDATE sistema_gestiones SET glosa = REPLACE(glosa,'\r',' ') where cod_cedente = $cod_cedente");


//
$f = fopen("reporte.csv","w");
$separador = ";";

$sw=1;
while($row = mysql_fetch_assoc($titulos)) {
   
   
   
	foreach($row as $key => $value) 
   { 
   	  $linea .= $key.";"; 
      
     
   }
   $linea .="\n";
}
$datos = $connect->consulta("
SELECT 
sistema_deudor.rut,sistema_deudor.dv,sistema_deudor.nombre,sistema_deudor.rut_rep_legal,sistema_deudor.nom_rep_legal,sistema_deudor.etapa_cobranza ,
sistema_deuda.rut,sistema_deuda.dv, sistema_deuda.nro_doc,sistema_deuda.total_cuotas,sistema_deuda.tipo_doc,sistema_deuda.estado_deuda,sistema_deuda.cuotas_vencidas,sistema_deuda.fec_venc,sistema_deuda.fec_asignacion,sistema_deuda.fec_colocacion,sistema_deuda.monto,sistema_deuda.deuda_total,sistema_deuda.abono,sistema_deuda.fecha_abono,sistema_deuda.deuda_morosa,sistema_deuda.cuotas_pagadas,sistema_deuda.fecha_actualizacion,sistema_deuda.cartera,sistema_deuda.tramo,sistema_deuda.adicional1,sistema_deuda.adicional2,sistema_deuda.adicional3,sistema_deuda.adicional4,sistema_deuda.adicional5,sistema_deuda.cod_cedente,
sistema_gestiones.fecha as fecha_ultima_gestion,sistema_gestiones.telefono as telefono_ultima_gestion,sistema_gestiones.cod_gestion as cod_gestion_ultima_gestion,sistema_gestiones.cod_contacto as cod_contacto_ultima_gestion,sistema_gestiones.glosa as glosa_ultima_gestion

FROM sistema_deudor, sistema_deuda
LEFT JOIN sistema_gestiones on sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.cod_cedente = sistema_deuda.cod_cedente
WHERE sistema_deuda.cod_cedente = '$cod_cedente'
AND sistema_deuda.rut = sistema_deudor.rut

GROUP BY sistema_deuda.rut
ORDER BY sistema_gestiones.fecha DESC

");
while($row2 = mysql_fetch_assoc($datos)) {
   
	foreach($row2 as $key2 => $value) 
   { 
   	  $linea .= $value.";"; 
      
   }
   
   $linea .="\n";
}
//////////////////////////////////////////////////////






fwrite($f,$linea);



$filename = $campaign_id."-NOGESTIONADO-".date("YmdHi",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $linea;
exit;

fclose($f); 

//fecha,uniqueid,list_id,lead_id,campaign,user,rut_cliente,telefono,nuevo_telefono,email,cod_gestion,cod_contacto,fecha_compromiso,monto_compromiso,nombre_contacto,glosa

?>