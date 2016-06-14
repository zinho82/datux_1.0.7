
<?php
// archivos incluidos. Librerías PHP para poder graficar.
include ("../includes/charts/FusionCharts.php");

$campaign_id = $_REQUEST["campaign_id"];

require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();

$NOW2 = date("Y-m-d");

	$id_arbol = $connect->consulta("SELECT id_arbol from sistema_arboles_asociacion where campaign = '$campaign_id'");
	while($row2 = mysql_fetch_array($id_arbol))
	{
	   $id_arbol = $row2["id_arbol"];
	}


$result=$connect->consulta("
SELECT opcion as gestion,cod_gestion,count(*) as cantidad FROM  sistema_gestiones,arbol_opciones1
WHERE arbol_opciones1.id_opcion = sistema_gestiones.cod_gestion  and arbol_opciones1.arbol = $id_arbol and sistema_gestiones.campaign = '$campaign_id' group by cod_gestion");


$strXML = "";
$strXML = "<chart formatNumberScale='0' caption = 'Grafico: Distribucion de gestiones por estado en $campaign_id".$titulo."' bgColor='#CDDEE5' baseFontSize='9' showValues='1'>";

while($row = mysql_fetch_array($result))
{
	
	$strXML .= "<set label = '".$row['gestion']."' value ='".$row['cantidad']."' />";
}
$strXML .= "</chart>";

echo renderChartHTML("../includes/charts/swf_charts/Pie3D.swf", "",$strXML, "detalle", 500, 350, false);

///////////////////////// segundo grafico
echo "<br><br>";


 $result=$connect->consulta("Select count(id_gestion) as con_gestion from sistema_gestiones,sistema_deuda where campaign = '$campaign_id' and sistema_deuda.rut = sistema_gestiones.rut_cliente group by rut_cliente ");
 while($row = mysql_fetch_array($result))
{
	$con_gestion = $con_gestion+1;
}
 $result=$connect->consulta("SELECT * FROM sistema_deuda where  sistema_deuda.campaign_id = '$campaign_id' group by rut");
 while($row = mysql_fetch_array($result))
{
	$total_asignados = $total_asignados +1;
}

$sin_gestion = $total_asignados-$con_gestion;

$strXML = "";
$strXML = "<chart formatNumberScale='0' caption = 'Grafico: Sin gestion / Gestionados en $campaign_id".$titulo."' bgColor='#CDDEE5' baseFontSize='10' showValues='1'>";

	
	$strXML .= "<set label = 'SIN GESTION' value ='".$sin_gestion."' />";
	$strXML .= "<set label = 'GESTIONADOS' value ='".$con_gestion."' />";
$strXML .= "</chart>";

echo renderChartHTML("../includes/charts/swf_charts/Pie3D.swf", "",$strXML, "detalle", 500, 350, false);



?>