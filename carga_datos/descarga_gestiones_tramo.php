<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
 
$connect = new DB_mysql ;
$connect->conectar();

$campaign_id = $_GET["campaign_id"];
$tramo = $_GET["tramo"];


$titulos = $connect->consulta("SELECT 'fecha_gestion','list_id','lead_id','campaign','user','rut_cliente','telefono','nuevo_telefono','email','cod_gestion','opcion','cod_contacto','fecha_compromiso','monto_compromiso','nombre_contacto','glosa','nro_doc', 
'total_cuotas','tipo_doc','estado_deuda', 'cuotas_vencidas','fec_venc','fec_asignacion','fec_colocacion','monto','deuda_total','abono','fecha_abono','deuda_morosa','cuotas_pagadas','fecha_actualizacion','cartera','tramo','adicional1','adicional2','adicional3','adicional4','adicional5','cod_cedente'
,'seguro_contratado','monto_en_uf','nueva_patente','fono_contacto','email_contacto'
 limit 1
");
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
$rango1=270;
$rango2=360;
$rango3=720;
$rango4=1080;
$rango5=1081;


if($tramo == '270')
{
$datos = $connect->consulta("SELECT * FROM (SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente
,'TRAMO1' from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) <= $rango1 and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY prioridad,cod_contacto)sub GROUP BY rut_cliente ");
}
if($tramo == '360')
{
$datos = $connect->consulta("
SELECT * FROM (SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente
,'TRAMO2' from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and 
ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) <=$rango2 and ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) > $rango1
and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY prioridad,cod_contacto)sub GROUP BY rut_cliente");
}

if($tramo == '720')
{
$datos = $connect->consulta("SELECT * FROM (SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente
,'TRAMO3'
 from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and 
ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) <=$rango3 and ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) > $rango2
and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY prioridad,cod_contacto)sub GROUP BY rut_cliente");
}
if($tramo == '1080')
{
$datos = $connect->consulta("SELECT * FROM (SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente
,'TRAMO4'
 from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and 
ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) <=$rango4 and ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) > $rango3
and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY prioridad,cod_contacto)sub GROUP BY rut_cliente");
}
if($tramo == '1081')
{
$datos = $connect->consulta("SELECT * FROM (SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente
,'TRAMO5'
 from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and 
ABS(DATEDIFF(sistema_gestiones.fec_venc,CURDATE())) > $rango2 and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY prioridad,cod_contacto )sub GROUP BY rut_cliente");
}
if($tramo == 'full')
{
$datos = $connect->consulta("SELECT * FROM (SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente,
sistema_gestiones.seguro_contratado,sistema_gestiones.monto_en_uf,sistema_gestiones.nueva_patente,sistema_gestiones.fono_contacto,sistema_gestiones.email_contacto
 from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut  and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY arbol_opciones1.prioridad,cod_contacto)sub GROUP BY rut_cliente"); 
}

while($row2 = mysql_fetch_assoc($datos)) {
   
	foreach($row2 as $key2 => $value) 
   { 
   	  $linea .= $value.";"; 
      
   }
   
   $linea .="\n";
}
fwrite($f,$linea);


$filename = $campaign_id."-$tramo-".date("YmdHi",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $linea;
exit;

fclose($f); 

?>