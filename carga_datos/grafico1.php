<style>
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
</style>
 <style>
 .buttons {
 font-family: Verdana, Arial, Helvetica, sans-serif;
 font-size: 9px;
 }
  .textos {
 font-family: Verdana, Arial, Helvetica, sans-serif;
 font-size: 10px;
}
</style>


<?php

$campaign_id = $_REQUEST["campaign_id"];
include ("../includes/charts/FusionCharts.php");

require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");


$connect = new DB_mysql ;
$connect->conectar();
$NOW = date("Y-m-d H:i:s");
$NOW2 = date("Y-m-d");

$i=1;$n=1;
$intervalo[1]='08';
$intervalo[2]='09';
$intervalo[3]='10';
$intervalo[4]='11';
$intervalo[5]='12';
$intervalo[6]='13';
$intervalo[7]='14';
$intervalo[8]='15';
$intervalo[9]='16';
$intervalo[10]='17';
$intervalo[11]='18';
$intervalo[12]='19';
$intervalo[13]='20';
$intervalo[14]='21';
$intervalo[15]='22';
$intervalo[16]='23';
$intervalo[17]='00';

print_r($intervalo[1][7]);

?>
<script language='javascript' src="../formulario/inc/popcalendar.js"></script>
<form name="form1" action='#' method="post">
<table border='0' cellspacing='0' align='left' width='100%'>
 <tr>
 <td width=''></td>
 <td width='350'>
<input name="fecha_inicio" class='textos' type="text" value='CLICK' id="dateArrival" onClick="popUpCalendar(this, form1.dateArrival, 'dd-mm-yyyy');" size="15">
<input name="fecha_fin" class='textos' type="text" value='CLICK' id="dateArrival2" onClick="popUpCalendar(this, form1.dateArrival2, 'dd-mm-yyyy');" size="15">
 <input type='submit' value='CONSULTAR' class='buttons'>
</td></tr>
</table>
</form>
<br><br>

<?php
$result=$connect->consulta("SELECT count(id_gestion) AS llamadas,date_format(fecha,'%H' )as intervalo FROM sistema_gestiones where  sistema_gestiones.campaign = '$campaign_id' GROUP BY date_format(fecha,'%H' )");


while($row = mysql_fetch_array($result))
{
for($n=1;$n<18;$n++)
{
 if($intervalo[$n] == $row["intervalo"])	
  	$intTotalAnio[$n] = $row["llamadas"];
}
$i=$i+1;
}


// $strXML: Para concatenar los par�metros finales para el gr�fico.
$strXML = "";
// Armo los par�metros para el gr�fico. Todos estos datos se concatenan en una variable.
// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
// caption: define el t�tulo del gr�fico.
// bgColor: define el color de fondo que tendr� el gr�fico.
// baseFontSize: Tama�o de la fuente que se usar� en el gr�fico.
// showValues: = 1 indica que se mostrar�n los valores de cada barra. = 0 No mostrar� los valores en el gr�fico.
// xAxisName: define el texto que ir� sobre el eje X. Abajo del gr�fico. Tambi�n est� xAxisName.

$strXML = "<chart caption = 'Grafico 1: Total de gestiones realizadas por intervalo en  $campaign_id' bgColor='#CDDEE5' baseFontSize='10' showValues='1' xAxisName='Intervalos' >";
// Genero los enlaces que ir� en cada barra del gr�fico.
// Llamo a una funci�n javascript llamado "detalleAnios". Tambi�n envio par�metros como el t�tulo, total en semestre 1 y total en semestre 2
// La suma de las variables total de los semestres, enviados como par�metros, es igual al total del A�o en cuesti�n.
// La funci�n javascript que recibe estos datos se encuentra en el archivo "js/ajax.js"
// La funci�n javascript, lo que hace es enviar los par�metros a un archivo llamado "grafico2.php" para que genere el gr�fico detalle.
// Una vez generado el gr�fico detalle, se desplegar� en el DIV "detalle_chart". Haci�ndose ahora visible.

$linkAnio1 = urlencode("\"javascript:detalleAnios('INT 1', '210', '100');\"");
$linkAnio2 = urlencode("\"javascript:detalleAnios('INT 2', '175', '265');\"");
$linkAnio3 = urlencode("\"javascript:detalleAnios('INT 3', '74', '44');\"");
$linkAnio4 = urlencode("\"javascript:detalleAnios('INT 4', '50', '95');\"");
$linkAnio5 = urlencode("\"javascript:detalleAnios('INT 5', '50', '95');\"");
$linkAnio5 = urlencode("\"javascript:detalleAnios('INT 6', '50', '95');\"");
// Armado de cada barra.
// set label: asigno el nombre de cada barra.
// value: asigno el valor para cada barra.
// color: color que tendr� cada barra. Si no lo defino, tomar� colores por defecto.
// Asigno los enlaces para cada barra.

$strXML .= "<set label = '08:00 08:59' value ='".$intTotalAnio[1]."' color = 'EA1000' link = ".$linkAnio1." />";
$strXML .= "<set label = '09:00 09:59' value ='".$intTotalAnio[2]."' color = '6D8D16' link = ".$linkAnio2." />";
$strXML .= "<set label = '10:00 10:59' value ='".$intTotalAnio[3]."' color = 'FFBA00' link = ".$linkAnio3." />";
$strXML .= "<set label = '11:00 11:59' value ='".$intTotalAnio[4]."' color = '0000FF' link = ".$linkAnio4." />";
$strXML .= "<set label = '12:00 12:59' value ='".$intTotalAnio[5]."' color = '6D8D16' link = ".$linkAnio5." />";
$strXML .= "<set label = '13:00 13:59' value ='".$intTotalAnio[6]."' color = 'FFBA00' link = ".$linkAnio5." />";
$strXML .= "<set label = '14:00 14:59' value ='".$intTotalAnio[7]."' color = '0000FF' link = ".$linkAnio5." />";
$strXML .= "<set label = '15:00 15:59' value ='".$intTotalAnio[8]."' color = '6D8D16' link = ".$linkAnio5." />";
$strXML .= "<set label = '16:00 16:59' value ='".$intTotalAnio[9]."' color = 'FFBA00' link = ".$linkAnio5." />";
$strXML .= "<set label = '17:00 17:59' value ='".$intTotalAnio[10]."' color = '0000FF' link = ".$linkAnio5." />";
$strXML .= "<set label = '18:00 18:59' value ='".$intTotalAnio[11]."' color = '6D8D16' link = ".$linkAnio5." />";
$strXML .= "<set label = '19:00 19:59' value ='".$intTotalAnio[12]."' color = 'FFBA00' link = ".$linkAnio5." />";
$strXML .= "<set label = '20:00 20:59' value ='".$intTotalAnio[13]."' color = '0000FF' link = ".$linkAnio5." />";
$strXML .= "<set label = '21:00 21:59' value ='".$intTotalAnio[14]."' color = '6D8D16' link = ".$linkAnio5." />";
$strXML .= "<set label = '22:00 22:59' value ='".$intTotalAnio[15]."' color = 'FFBA00' link = ".$linkAnio5." />";
$strXML .= "<set label = '23:00 23:59' value ='".$intTotalAnio[16]."' color = '6D8D16' link = ".$linkAnio5." />";
$strXML .= "<set label = '00:00 01:00' value ='".$intTotalAnio[17]."' color = '0000FF' link = ".$linkAnio5." />";

// Cerramos la etiqueta "chart".
$strXML .= "</chart>";
// Por �ltimo imprimo el gr�fico.
// renderChartHTML: funci�n que se encuentra en el archivo FusionCharts.php
// Env�a varios par�metros.
// 1er par�metro: indica la ruta y nombre del archivo "swf" que contiene el gr�fico. En este caso Columnas ( barras) 3D
// 2do par�metro: indica el archivo "xml" a usarse para graficar. En este caso queda vac�o "", ya que los par�metros lo pasamos por PHP.
// 3er par�metro: $strXML, es el archivo par�metro para el gr�fico. 
// 4to par�metro: "ejemplo". Es el identificador del gr�fico. Puede ser cualquier nombre.
// 5to y 6to par�metro: indica ancho y alto que tendr� el gr�fico.
// 7mo par�metro: "false". Trata del "modo debug". No es im,portante en nuestro caso, pero pueden ponerlo a true ara probarlo.
echo renderChartHTML("../includes/charts/swf_charts/Column3D.swf", "",$strXML, "GRAFICO", 820, 320, false);


?>
