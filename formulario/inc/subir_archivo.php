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
<legend ><font face="verdana,arial" size=1><b> SUBIR ARCHIVO A SISTEMA</b></font></legend>

<form enctype="multipart/form-data" method="post" action="subir_archivo.php" name="uploadform">
				


<table border='1' width='480'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>

<td width='300'><font face="verdana,arial" size=1>DESCRIPCION</td>
<td width='180'><font face="verdana,arial" size=1>ARCHIVO</td>
<td width=''><font face="verdana,arial" size=1></td>
</tr>
<tr bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">
<td height="15"><font face="verdana,arial" color='white'  ><input type='text'  style="width:100%"  name='descripcion' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type="file" name="file1" class="tb10"></td>
<td><font face="verdana,arial" color='white'  ><input type="submit" value="SUBIR" name="invio" style='font-size:11px;'></td>
</tr>
</table>
<input type='hidden' name='sw' value='ingresando'>
<input type='hidden' name='id_datos' value='<?php echo $_GET["id_datos"]; ?>'>
<input type='hidden' name='user' value='<?php echo $_GET["user"]; ?>'>
</form>
<br>
</fieldset>


<?php


if($_POST["sw"]=="ingresando")
{
	
if (isset($_POST["invio"])) {
	
  $percorso = "archivos_up/";
  if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    if (move_uploaded_file($_FILES['file1']['tmp_name'], $percorso.$_FILES['file1']['name'])) {
   ?><table border="0" cellspacing="10" align="left">
     <tr><td><font class="main_text_c"><?php   echo 'Nombre archivo: <b>'.$_FILES['file1']['name'].'</td></tr>';
      echo '<tr><td><font class="main_text_c">tipo MIME: <b>'.$_FILES['file1']['type'].'</b></td></tr>';
      echo '<tr><td><font class="main_text_c">Dimensiones: <b>'.$_FILES['file1']['size'].'</b> byte</td></tr>';
      echo '<tr><td>======================</td></tr></table>';
     
    } else {
      echo "No se ha podido completar la instruccion: ".$_FILES["file1"]["error"];
    }
  } else {
    echo "no se a podido completar la instruccion: ".$_FILES["file1"]["error"];
  }
}
$nombre_archivo=$_FILES['file1']['name'];


$result = $connect->consulta("INSERT INTO sistema_deudor_archivos (id_datos,user,nombre_archivo,descripcion) 
values('$_POST[id_datos]','$_POST[user]','$nombre_archivo','$_POST[descripcion]')");


?>
<script language="JavaScript">
window.close();
</script> 

<?php
}
?>
















