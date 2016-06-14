
<?php
// archivos incluidos. Librerías PHP para poder graficar.
include ("../includes/charts/FusionCharts.php");

$campaign_id = $_REQUEST["campaign_id"];

require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();

$NOW2 = date("Y-m-d");

$result=$connect->consulta("
SELECT count(id_datos) AS llamadas,date_format(fecha,'%H' )as intervalo,vicidial_users.full_name FROM sistema_gestiones,vicidial_users 
where   vicidial_users.user = sistema_gestiones.user and sistema_gestiones.campaign = '$campaign_id' GROUP BY sistema_gestiones.user");


$strXML = "";
$strXML = "<chart caption = 'Grafico: Distribucion de gestiones por agente en $campaign_id".$titulo."' bgColor='#CDDEE5' baseFontSize='10' showValues='1'>";

while($row = mysql_fetch_array($result))
{
	
	$strXML .= "<set label = '".$row['full_name']."' value ='".$row['llamadas']."' />";
}
$strXML .= "</chart>";

echo renderChartHTML("../includes/charts/swf_charts/Pie3D.swf", "",$strXML, "detalle", 410, 350, false);
?>