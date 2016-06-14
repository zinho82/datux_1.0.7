<!-- <META HTTP-EQUIV='Refresh' CONTENT='1'> !-->
<style>
/* Gradient 1 */
.tb10 {
	background-image:url(images/form_bg.jpg);
	background-repeat:repeat-x;
	border:1px solid #d1c7ac;
	/*width: 230px; */
	color:#333333;
	padding:0px;
	margin-right:4px;
	margin-bottom:8px;
	font-family:tahoma, arial, sans-serif;
	font-size:12;
}

.btn {
  display: inline-block;
  background: transparent url(http://2.bp.blogspot.com/_hljKDuw-cxQ/S32eVQZttxI/AAAAAAAAPKg/ZEPhOn59Rec/s00/demoBoton2.png) repeat-x 0 0;
  border: 1px solid rgba(0,0,0,0.4);
  padding: 1px 2px 2px 5px;
  font-weight: bold;
  text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
  -moz-border-radius: 10px;
  -moz-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
  -webkit-border-radius: 5px;
  -webkit-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
}



fieldset {
//border: 1px solid #CCA383;
border: outset gray 3px;   
width: 850;
background: #dfedf3;
padding: 3px;
}
fieldset legend {
background: #E0E0F8;
border: 1px solid #CCA383;
padding: 6px;
font-weight: bold;
}
input[type="text"]:focus  {
border: thin #000000 solid;
background: #F4FA58;
color: #000000;
}
input[type="text"]:focus:hover {
border: thin #000000 solid;
filter:alpha(opacity=100);-moz-opacity:1;opacity:1;
background: #F4FA58;
color: #000000;
}

</style>


<body bgcolor="TRANSPARENT"></body>
<?php
session_start();
include_once("class_mysql_inc.php");

$random = (rand(1000000, 9999999) + 10000000);

$connect = new DB_mysql ;
$connect->conectar();

//$result = $connect->consulta("SELECT * from datos where fono = $_GET[mark]");
//while($row = mysql_fetch_array($result))
//{
//
//$rut_empresa = $row["rut_empresa"];
//$nombre_razon_social = $row["nombre_razon_social"];
//$fono = $row["fono"];
//$alias = $row["alias"];
//$giro = $row["giro"];
//$direccion = $row["direccion"];
//$telefono = $row["telefono"];
//$celular = $row["celular"];
//$fax = $row["fax"];
//$mail = $row["mail"];
//$web = $row["web"];
//$observacion = $row["observacion"];
//$carpeta = $row["carpeta"];
//
//
////datos de contacto
//}

 /*

*/
////////////////////////////////////////////////
include("inc/validaciones.php");
?>
<script language='javascript' src="inc/popcalendar.js"></script>
<script language='javascript' src="inc/eventos_teclado.js"></script>

<form ' name='fvalida'  action='#' method="GET">
<fieldset>
<legend ><font face="verdana,arial" size=1><b> ORIGEN</b></font></legend>
<table border='0' cellspacing='2' cellpadding='0'>

<tr>
<td><font face="verdana,arial" size=1 >PCS: <input type='text'   class='tb10' value='<?php echo $_GET['phone_number']?>' disabled> </td> 
</tr>
<tr>
<td><font face="verdana,arial" size=1 >Promedio Recarga:<input type='text'   value='<?php echo $_GET['vendor_id']?>' class='tb10' disabled></td>
</tr>
<tr>
<td><font face="verdana,arial" size=1>Promedio Minutos:<input type='text'   value='<?php echo $_GET['title']?>' class='tb10' disabled></td>

</tr>
</table>
</fieldset>


<fieldset>
<legend ><font face="verdana,arial" size=1><b> DATOS DE CLIENTE</b></font></legend>

<table border='0' cellspacing='2' cellpadding='0'>

<tr>
<td><font face="verdana,arial" size=1 >Rut Cliente</td><td><font face="verdana,arial" size=1 >Nombres</td>
<td><font face="verdana,arial" size=1 >Apellidos</td><td><font face="verdana,arial" size=1 >Direccion particular</td>
</tr>
<tr>
<td><font face="verdana,arial" size=1 ><input type='text' size='8' name='rut' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" >-<input type='text' size='1' name='rut_g'  class='tb10' readonly></td>
<td><font face="verdana,arial" size=1><input type='text' size='25' class='tb10' name='nombres'></td>
<td><font face="verdana,arial" size=1><input type='text' size='20' class='tb10' name='apellidos'></td>
<td><font face="verdana,arial" size=1><input type='text' size='50' class='tb10' name='direccion'></td>
</tr>
</table>


<table border='0' cellspacing='0' cellpadding='0'>
<tr>
 
<td><font face="verdana,arial" size=1>Region</td>
<td><font face="verdana,arial" size=1>Ciudad</td>
<td><font face="verdana,arial" size=1>Comuna</td>
<td><font face="verdana,arial" size=1>Telefono</td>
<td><font face="verdana,arial" size=1>Fecha Nacimiento</td>
</tr>
 
<tr>
<td><font face="verdana,arial" size=1>
<select name='region' class='tb10'>
<option>REGION METROPOLITANA</option>
<option>REGIONES</option>
</select>
</td>
<td><font face="verdana,arial" size=1><input type='text' size='12' class='tb10' name='ciudad'></td>
<td><font face="verdana,arial" size=1><input type='text' size='12' class='tb10' name='comuna'></td>
<td><font face="verdana,arial" size=1><input type='text' size='35' class='tb10' name='telefono'></td>
<td><font face="verdana,arial" size=1>
<select name='ano'>
<option>1994</option>
<option>1993</option>
<option>1992</option>
<option>1991</option>
<option>1990</option>
<option>1989</option>
<option>1988</option>
<option>1987</option>
<option>1986</option>
<option>1985</option>
<option>1984</option>
<option>1983</option>
<option>1982</option>
<option>1981</option>
<option>1980</option>
<option>1979</option>
<option>1978</option>
<option>1977</option>
<option>1976</option>
<option>1975</option>
<option>1974</option>
<option>1973</option>
<option>1972</option>
<option>1971</option>
<option>1970</option>
<option>1969</option>
<option>1968</option>
<option>1967</option>
<option>1966</option>
<option>1965</option>
<option>1964</option>
<option>1963</option>
<option>1962</option>
<option>1961</option>
<option>1960</option>
<option>1959</option>
<option>1958</option>
<option>1957</option>
<option>1956</option>
<option>1955</option>
<option>1954</option>
<option>1953</option>
<option>1952</option>
<option>1951</option>
<option>1950</option>
<option>1949</option>
<option>1948</option>
<option>1947</option>
<option>1946</option>
<option>1945</option>
<option>1944</option>
<option>1943</option>
<option>1942</option>
<option>1941</option>
<option>1940</option>
<option>1939</option>
<option>1938</option>
<option>1937</option>
<option>1936</option>
<option>1935</option>
<option>1934</option>
<option>1933</option>
<option>1932</option>
<option>1931</option>
<option>1930</option>
</select>
<select name='mes'>
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
</select>
<select name='dia'>
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>



</td>

</tr>
</table>

<table border='0' cellspacing='0' cellpadding='0'>
<tr>
 
<td><font face="verdana,arial" size=1>Situacion Laboral</td>
<td><font face="verdana,arial" size=1>Plan Ofrecido</td>
<td><font face="verdana,arial" size=1>Email</td>

</tr>
<tr>
<td>
<select name='situacion_laboral' class='tb10'>
<option>DEPENDIENTE</option>
<option>INDEPENDIENTE</option>
<td>
<select name='plan_ofrecido' class='tb10'>
<option>MIGRACION CTA EXACTA 4990</option>
<option>MIGRACION CTA EXACTA 6990</option>
<option>MIGRACION CTA EXACTA 8990</option>
<option>MIGRACION CTA EXACTA 11990</option>
</td>
<td><font face="verdana,arial" size=1><input type='text' size='40' class='tb10' name='email' value='ejemplo@dominio.cl' onBlur="isMail(fvalida.email.value);"></td>
</tr>
</table>

</fieldset>
<input type='hidden' name='sw' value='ingresando'>
<input type='hidden' name='pcs' value='<?php echo $_GET['phone_number']?>'>
<input type='hidden' name='lead_id' value='<?php echo $_GET['lead_id']?>'>
<input type='hidden' name='recording_id' value='<?php echo $_GET['recording_id']?>'>
<input type='hidden' name='prom_rec' value='<?php echo $_GET['vendor_id']?>'>
<input type='hidden' name='prom_min' value='<?php echo $_GET['title']?>'>
<fieldset>
<center><input type='button' value='Ingresar' onclick="valida_envia()" >
</fieldset>
</form>
 

 <?php

 
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET["sw"]=="ingresando")
{
$result = $connect->consulta("INSERT INTO formulariogea (recording_id,lead_id,pcs,prom_rec,prom_min,rut,nombres,apellidos,direccion,fecha_nacimiento,region,ciudad,comuna,telefono,situacion_laboral,plan_ofrecido,email) 
values('$_GET[recording_id]','$_GET[lead_id]','$_GET[pcs]','$_GET[prom_rec]','$_GET[prom_min]','$_GET[rut]','$_GET[nombres]','$_GET[apellidos]','$_GET[direccion]','$_GET[ano]-$_GET[mes]-$_GET[dia]','$_GET[region]','$_GET[ciudad]','$_GET[comuna]','$_GET[telefono]','$_GET[situacion_laboral]','$_GET[plan_ofrecido]','$_GET[email]')");

?>

<script language="JavaScript">
window.close();
</script> 


<?php
}