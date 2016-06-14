<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
 
$connect = new DB_mysql ;
$connect->conectar();

$campaign_id = $_GET["campaign_id"];
$porcentaje_comision = $_GET["porcentaje_comision"];
$porcentaje_multicob = 20;

$titulos = $connect->consulta("SELECT id_pago as ID, fecha , campaign as 'Campaña',rut ,dv ,tipo_documento as 'Tipo Documento', num_documento as 'Numero Documento',fec_venc as 'Fecha Vencimiento', monto,total_pagado as 'Total Pago', forma_pago as 'Forma Pago', fec_pago as 'Fecha de Pago', tipo_pago as 'Tipo de Pago'
FROM sistema_pagos
WHERE campaign =  '$campaign_id'
ORDER BY rut limit 1");

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
$datos = $connect->consulta("SELECT id_pago as ID, fecha , campaign as 'Campaña',rut ,dv ,tipo_documento as 'Tipo Documento', num_documento as 'Numero Documento',fec_venc as 'Fecha Vencimiento', monto,sistema_pagos.total_pagado as 'Total Pago', forma_pago as 'Forma Pago', fec_pago as 'Fecha de Pago', tipo_pago as 'Tipo de Pago'
FROM sistema_pagos
WHERE campaign =  '$campaign_id'
ORDER BY rut ");

while($row2 = mysql_fetch_assoc($datos)) {

	$rut_cliente2 = $row2["rut_cliente2"];
	
$cuantos = $connect->consulta("SELECT count(*) as cuantos
FROM sistema_pagos
WHERE campaign =  '$campaign_id'
ORDER BY rut limit 1");

while($row3 = mysql_fetch_array($cuantos))
{   
	$cuantos_usuarios = $row3["cuantos"];
	//$cuantos_usuarios2 = $cuantos_usuarios2 +1;
}

	
	

$contador=0;	
	foreach($row2 as $key2 => $value) 
   { 
   	$contador++;
   	if($contador == 9)
   	{
   		//$value = number_format(((($value/100)*$porcentaje_comision)/100)*$porcentaje_multicob/$cuantos_usuarios, 0, ",", ".");
//    		$value = number_format(((($value/100)*$porcentaje_comision)/100)*$porcentaje_multicob, 0, ",", ".");
   	}
   	if($contador == 10)
   	{
   		//$value = number_format(($value/100)*$porcentaje_multicob/$cuantos_usuarios, 0, ",", ".");
//    		$value = number_format(($value/100)*$porcentaje_multicob, 0, ",", ".");
   	}
    $linea .= $value.";"; 
   }

   $linea .="\n";

   
	
}
fwrite($f,$linea);
//$linea .= "id_datos".$separador."campaign_id".$separador."list_id".$separador."comercio".$separador."rut".$separador."dv".$separador."tipo_cartera".$separador."nombre".$separador."direccion".$separador."villa_poblacion".$separador."comuna".$separador."ciudad".$separador."region".$separador."deuda_total".$separador."deuda_capital".$separador."oferta_pago_total".$separador."pago_mes".$separador."cantidad_cuotas_impagas".$separador."fecha_mora".$separador."fe_com_pago".$separador."td_ult_gestion".$separador."cant_gestion".$separador."convenio".$separador."pie".$separador."cuota".$separador."primer_vencimiento".$separador."cod_fono1".$separador."fono1".$separador."cod_fono2".$separador."fono2".$separador."cod_fono3".$separador."fono3".$separador."\n"; 

//while($reg = mysql_fetch_array($datos) ) {
//	
//$linea .= $reg['id_datos'].$separador.$reg['campaign_id'].$separador.$reg['list_id'].$separador.$reg['comercio'].$separador.$reg['rut'].$separador.$reg['dv'].$separador.$reg['tipo_cartera'].$separador.$reg['nombre'].$separador.$reg['direccion'].$separador.$reg['villa_poblacion'].$separador.$reg['comuna'].$separador.$reg['ciudad'].$separador.$reg['region'].$separador.$reg['deuda_total'].$separador.$reg['deuda_capital'].$separador.$reg['oferta_pago_total'].$separador.$reg['pago_mes'].$separador.$reg['cantidad_cuotas_impagas'].$separador.$reg['fecha_mora'].$separador.$reg['fe_com_pago'].$separador.$reg['td_ult_gestion'].$separador.$reg['cant_gestion'].$separador.$reg['convenio'].$separador.$reg['pie'].$separador.$reg['cuota'].$separador.$reg['primer_vencimiento'].$separador.$reg['cod_fono1'].$separador.$reg['fono1'].$separador.$reg['cod_fono2'].$separador.$reg['fono2'].$separador.$reg['cod_fono3'].$separador.$reg['fono3'].$separador."\n"; 
//
//fwrite($f,$linea);
//}


$filename = $campaign_id."-INFORME_PAGOS-".date("YmdHi",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $linea;
exit;

fclose($f); 

?>