<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();
 $cont=1;

?>


<script Language="JavaScript">
function ventanita() {
msg1=open("www.google.cl","Homepage","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=500,height=500");
}
</script>


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
<?php
$result = $connect->consulta("SELECT * from sistema_deudor where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]'");
while($row = mysql_fetch_array($result))
{
$rut = $row["rut"];
$id_datos = $row["id_datos"];
}
?>



<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> INGRESO DATOS ADICIONALES</b></font></legend>
<table border = '2' cellspacing="2" cellpadding="2">
<tr height='20'>
<td><font face="verdana,arial" color='white'  ><a href="inc/subir_archivo.php?vendor_id=<?php echo $rut; ?>&campaign=<?php echo $_GET[campaign]; ?>&list_id=<?php echo $row[list_id]; ?>&user=<?php echo $_SESSION[user]; ?>&id_datos=<?php echo $id_datos; ?>" target="popup" onClick="window.open(this.href, this.target, 'width=500,height=100'); return false;"><img src='../images/icons/explore.png'></a></a></td>
<td><font face="verdana,arial" color='white'  ><a href="inc/ingresar_datos.php?vendor_id=<?php echo $rut; ?>&campaign=<?php echo $_GET[campaign]; ?>&list_id=<?php echo $row[list_id]; ?>&user=<?php echo $_SESSION[user]; ?>&id_datos=<?php echo $id_datos; ?>" target="popup" onClick="window.open(this.href, this.target, 'width=500,height=100'); return false;"><img src='../images/icons/explore.png'></a></a></td>
</tr>
</table>
</fieldset>
<br>
<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> ARCHIVOS</b></font></legend>

<table border='1' width='650'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='10'><font face="verdana,arial" size=1>Nº</td>
<td width='240'><font face="verdana,arial" size=1>NOMBRE ARCHIVO</td>
<td width='50'><font face="verdana,arial" size=1>USUARIO</td>
<td width='150'><font face="verdana,arial" size=1>FECHA SUBIDO</td>
<td width='200'><font face="verdana,arial" size=1>DESCRIPCION.</td>
 
</tr>

<?php
$result = $connect->consulta("SELECT * from sistema_deudor_archivos where id_datos = '$id_datos'");
while($row = mysql_fetch_array($result))
{ ?>

<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">

<td><font face="verdana,arial" size='1'><?php echo $cont; ?></td>
<td><font face="verdana,arial" color='white'  ><a href='inc/archivos_up/<?php echo $row["nombre_archivo"]; ?>'> <font face="verdana,arial" size='2'> <?php echo $row["nombre_archivo"]; ?></font></a></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["user"]; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["fecha"]; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["descripcion"]; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
</tr>
<?php
}
?>

</table>

<br>
</fieldset>

<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> NUEVOS DATOS CLIENTE</b></font></legend>
<table border='1' width='450'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='10'><font face="verdana,arial" size=1>Nº</td>
<td width='100'><font face="verdana,arial" size=1>NUEVA DIRECCION</td>
<td width='100'><font face="verdana,arial" size=1>NUEVO TELEFONO</td>
<td width='190'><font face="verdana,arial" size=1>NUEVO MAIL.</td>
 
</tr>
<?php

if($_REQUEST["id_datos"]!="")
{
$result = $connect->consulta("SELECT * from sistema_deuda where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]' limit 1 ");
}
else
{
$result = $connect->consulta("SELECT * from sistema_deuda where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]' limit 1");
}
while($row = mysql_fetch_array($result))
{
$nro_doc = $row["nro_doc"];
$cuota = $row["cuota"];
$tipo_doc = $row["tipo_doc"];
$protesto = $row["protesto"];
$estado_cuota = $row["estado_cuota"];


 ?>


<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">

<td><font face="verdana,arial" size='1'><?php echo $cont; ?></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $a; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $b; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $c; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>



</tr>



<?php
$cont=$cont+1;
}


?>

</table>
</field>