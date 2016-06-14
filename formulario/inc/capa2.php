<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();
 $cont=1;

?>



<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> ORIGEN VICIDIAL</b></font></legend>
<table border='1' width='1050'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

<tr>
<td width='180'><font face="verdana,arial" size=2 >Telefono:   <b><?php echo $_GET['dialed_number']; ?></b> </td> 
 
<td width='200'><font face="verdana,arial" size=2 >Rut Cliente: <b><?php echo $_GET['vendor_id']; ?></b> </td>
<td width='200'><font face="verdana,arial" size=2>Campaña: <font face="verdana,arial" size=3 color='RED' ><b><?php echo $_GET['campaign']; ?></b></td>
<td width='150'><font face="verdana,arial" size=2 >Registro <b><?php echo $id_datos; ?></b></td>
<td width='150'><font face="verdana,arial" size=2 >Lista <b><?php echo $_GET['list_id']; ?></b></td>

 
 
</tr>
</table>
<br>
</fieldset>

<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> DETALLE GESTIONES</b></font></legend>

<table border='1' width='1050'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='10'><font face="verdana,arial" size=1>Nº</td>
<td width='100'><font face="verdana,arial" size=1 >CAMPAÑA</td>
<td width='150'><font face="verdana,arial" size=1>FECHA GESTION</td>
<td width='100'><font face="verdana,arial" size=1>FECHA COMP..</td>
<td width='100'><font face="verdana,arial" size=1>TELEFONO</td>
<td width='100'><font face="verdana,arial" size=1>EMAIL</td>
<td width='50'><font face="verdana,arial"  size=1>GESTOR</td>
<td width='50'><font face="verdana,arial" size=1>LISTA</td>

<td width='50'><font face="verdana,arial" size=1 >CODIGO</td>
<td  width='350'><font face="verdana,arial" size=1 >GLOSA</td>
 
</tr>
<?php

$id_datos = $_REQUEST["id_datos"];

if($_REQUEST["id_datos"]!="")
{
//$result = $connect->consulta("SELECT * from gestiones_tricot where id_datos = $id_datos order by fecha desc");
$result = $connect->consulta("SELECT * from sistema_gestiones where rut_cliente = '$_GET[vendor_id]' or rut_cliente = '$rut-$dv' order by fecha desc");

}
else
{
$result = $connect->consulta("SELECT * from sistema_gestiones where rut_cliente = '$_GET[vendor_id]' or rut_cliente = '$rut-$dv' order by fecha desc");
//$result = $connect->consulta("SELECT * from gestiones_tricot where campaign = '$_GET[campaign]' and rut_cliente = '$_GET[vendor_id]' order by fecha desc");
}



while($row = mysql_fetch_array($result))
{
$fecha = $row["fecha"];
$user = $row["user"];
$list_id = $row["list_id"];	
$lead_id = $row["lead_id"];
$cod_gestion = $row["cod_gestion"];
$glosa = $row["glosa"];
$mail_toma_servicio = $row["mail_toma_servicio"];
$telefono = $row["telefono"];
$fecha_compromiso = $row["fecha_compromiso"];
$campaign = $row["campaign"];
 



?>



<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">

<td><font face="verdana,arial" size='1'><?php echo $cont; ?></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $campaign; ?>' style="width:100%"  name='usuario' class='tb10'></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fecha; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fecha_compromiso; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $telefono; ?>' style="width:100%"  name='usuario' class='tb10'></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $mail_toma_servicio; ?>' style="width:100%"  name='usuario' class='tb10'></td>


<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $user; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

<td><font face="verdana,arial" size=1><input type='text'  size='2' value='<?php echo $list_id; ?>'  name='DV'  style="width:100%"  class='tb10' readonly></td>

<td><font face="verdana,arial" size=1><input type='text' value='<?php echo $cod_gestion; ?>' style="width:100%" size='20'   class='tb10'name=''></td>
<td><font face="verdana,arial" size=1><input type='text' value='<?php echo $glosa; ?>' style="width:100%" size='25'    class='tb10'name=''></td>
</tr>



<?php
$cont=$cont+1;
}

?>
</table>
<br>
</fieldset>
