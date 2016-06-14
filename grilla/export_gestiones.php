<?PHP
  include_once("../includes/class/class_mysql_inc.php");
  $connect = new DB_mysql ;
  $connect->conectar();  
  $result = $connect->consulta("SELECT `id_gestion` as ID, `fecha` as FECHA, `id_datos` as 'ID DATOS', `uniqueid` as 'ID UNICO', `list_id` as 'LISTA', `lead_id` as 'LEAD ID', `campaign` 'CAMPAÑA', `user` AS 'USUARIO', `rut_cliente` as 'RUT CLIENTE', `telefono` as 'TELEFONO CONTACTO', `nuevo_telefono` as 'NUEVO TELEFONO', `email` as 'EMAIL', `cod_gestion` as 'CODIGO GESTION',  `cod_gestion2` as 'CODIGO GESTION ', `cod_contacto` as 'CODIGO CONTACTO', `prioridad` as 'PRIORIDAD', `fecha_compromiso` as 'FECHA COMPROMISO', `monto_compromiso` as 'MONTO COMPROMISO', `nombre_contacto` as 'NOMBRE CONTACTO', `glosa` as 'GLOSA', `nro_doc` as 'NUMERO DOCUMENTO', `total_cuotas` as 'TOTAL CUOTAS', `tipo_doc` as 'TIPO DOCUMENTO', `estado_deuda` as 'ESTADO DEUDA', `cuotas_vencidas` as 'CUOTAS VENCIDAS', `fec_venc` as 'FECHA VENCIMIENTO', `fec_asignacion` as 'FECHA ASIGNACION', `fec_colocacion` as 'FECHA COLOCACION', `monto` as 'MONTO', `deuda_total` as 'DEUDA TOTAL', `abono` as 'ABONO', `fecha_abono` as 'FECHA ABONO', `deuda_morosa` as 'DEUDA MOROSA', `cuotas_pagadas` as 'CUOTAS PAGADAS', `fecha_actualizacion` as 'FECHA ACTUALIZACION', `cartera` as 'CARTERA', `cod_cedente` as 'CODIGO CEDENTE', `seguro_contratado` as 'SEGURO CONTRATAOD' FROM `sistema_gestiones` order by fecha");
  $file_ending = "xls";
  $filename="sistema_gestiones_acumulado_".date('Y-m-d');
  header("Content-Type: application/xls");
  header("Content-Disposition: attachment; filename=$filename.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  $sep = "\t"; //tabbed character
  for ($i = 0; $i < mysql_num_fields($result); $i++) {
  	echo mysql_field_name($result,$i) . "\t";
  }
  print("\n");
  while($row = mysql_fetch_row($result))
  {
  	$schema_insert = "";
  	for($j=0; $j<mysql_num_fields($result);$j++)
  	{
  	if(!isset($row[$j]))
  		$schema_insert .= "NULL".$sep;
  		elseif ($row[$j] != "")
  		$schema_insert .= "$row[$j]".$sep;
  		else
  		$schema_insert .= "".$sep;
  	}
  	$schema_insert = str_replace($sep."$", "", $schema_insert);
  	$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
  			$schema_insert .= "\t";
  	print(trim($schema_insert));
  	print "\n";
  }
  ?>
  
?>