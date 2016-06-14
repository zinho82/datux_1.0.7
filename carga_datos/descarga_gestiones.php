<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
 
$connect = new DB_mysql ;
$connect->conectar();

$campaign_id = $_GET["campaign_id"];


$titulos = $connect->consulta("SELECT 'fecha_gestion','list_id','lead_id','campaign','user','rut_cliente','telefono','nuevo_telefono','email','cod_gestion','opcion','cod_contacto','fecha_compromiso','monto_compromiso','nombre_contacto','glosa','nro_doc', 
'total_cuotas','tipo_doc','estado_deuda', 'cuotas_vencidas','fec_venc','fec_asignacion','fec_colocacion','monto','deuda_total','abono','fecha_abono','deuda_morosa','cuotas_pagadas','fecha_actualizacion','cartera','tramo','adicional1','adicional2','adicional3','adicional4','adicional5','cod_cedente',
 'seguro_contratado','monto_en_uf','nueva_patente','fono_contacto','email_contacto','telematics','acepta_contrato','cotiza_auto' limit 1");

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
$datos = $connect->consulta("SELECT fecha as fecha_gestion, sistema_gestiones.list_id, lead_id, campaign, user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, opcion,cod_contacto, fecha_compromiso, monto_compromiso, nombre_contacto, glosa, sistema_gestiones.nro_doc, 
sistema_gestiones.total_cuotas,sistema_gestiones.tipo_doc, sistema_gestiones.estado_deuda, sistema_gestiones.cuotas_vencidas, sistema_gestiones.fec_venc, sistema_gestiones.fec_asignacion,sistema_gestiones.fec_colocacion,sistema_gestiones.monto,sistema_gestiones.deuda_total,sistema_gestiones.abono,sistema_gestiones.fecha_abono,sistema_gestiones.deuda_morosa, sistema_gestiones.cuotas_pagadas, sistema_gestiones.fecha_actualizacion,sistema_gestiones.cartera, sistema_gestiones.tramo, sistema_gestiones.adicional1, sistema_gestiones.adicional2, sistema_gestiones.adicional3, sistema_gestiones.adicional4, sistema_gestiones.adicional5,sistema_gestiones.cod_cedente,
		seguro_contratado,monto_en_uf,nueva_patente,fono_contacto,email_contacto,telematics,acepta_contrato,cotiza_auto

 from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion group by sistema_gestiones.id_gestion");
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