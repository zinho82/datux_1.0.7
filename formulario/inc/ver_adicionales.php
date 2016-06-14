<?php
session_start();
include_once("../../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();
 $cont=1;

?>
<style>
/* Gradient 1 */
.tb10 {
	border:0px solid #d1c7ac;
	/*width: 230px; */
	background: transparent;
 
	color:#333333;
	padding:0px;
	margin-right:0px;
	margin-bottom:0px;
	font-family:tahoma, arial, sans-serif;
	font-size:11;
}
</style>

<link href="../inc/template.css" rel="stylesheet" type="text/css" />

 


<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> DETALLE DOCUMENTOS (INFORMACION ADICIONAL)</b></font></legend>

<table border='1' width='890'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='10'><font face="verdana,arial" size=1>Nº</td>
<td width='50'><font face="verdana,arial" size=1>NRO.DOC.</td>
<td width='100'><font face="verdana,arial" size=1>ADICIONAL 1</td>
<td width='100'><font face="verdana,arial" size=1>ADICIONAL 2</td>
<td width='100'><font face="verdana,arial" size=1>ADICIONAL 3</td>
<td width='100'><font face="verdana,arial" size=1>ADICIONAL 4</td>
<td width='100'><font face="verdana,arial" size=1>ADICIONAL 5</td>
<td width='100'><font face="verdana,arial" size=1>FEC.ACTUALIZACION</td>

 
</tr>
<?php
 
$result = $connect->consulta("SELECT * from sistema_deuda where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]'");
 
while($row = mysql_fetch_array($result))
{
$nro_doc = $row["nro_doc"];
$total_cuotas = $row["total_cuotas"];
$tipo_doc = $row["tipo_doc"];
$protesto = $row["protesto"];
$estado_deuda = $row["estado_deuda"];
$fec_venc = date("Ymd",strtotime($row["fec_venc"]));
$fec_asignacion = $row["fec_asignacion"];
$fec_colocacion = $row["fec_asignacion"];
$fecha_actualizacion = $row["fecha_actualizacion"];

$monto = $row["monto"];

$deuda_total = $row["deuda_total"];
$abono = $row["abono"];
$fecha_abono = $row["fecha_abono"];
$deuda_morosa = $row["deuda_morosa"];

$adicional1 = $row["adicional1"];
$adicional2 = $row["adicional2"];
$adicional3 = $row["adicional3"];
$adicional4 = $row["adicional4"];
$adicional5 = $row["adicional5"];



?>
 


<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">

<td><font face="verdana,arial" size='1'><?php echo $cont; ?></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $nro_doc; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional1; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional2; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional3; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional4; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional5; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fecha_actualizacion; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>




</tr>



<?php
$cont=$cont+1;
}


?>


</table>
<br>
</fieldset>