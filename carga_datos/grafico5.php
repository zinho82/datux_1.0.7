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
<head>
<meta http-equiv="refresh" content="60" />
</head>

<?php

$campaign_id = $_REQUEST["campaign_id"];
include ("../includes/charts/FusionCharts.php");

require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");


$connect = new DB_mysql ;
$connect->conectar();




$strXML = "";
$strXML = "<chart caption = 'Grafico 1: Total de gestiones compromisos de pago en  $campaign_id' bgColor='#CDDEE5' baseFontSize='9' showValues='1' yAxisName='TOTAL COMPROMISOS'  xAxisName='EJECUTIVOS' >";

$linkAnio1 = urlencode("\"javascript:detalleAnios('INT 1', '210', '100');\"");
$linkAnio2 = urlencode("\"javascript:detalleAnios('INT 2', '175', '265');\"");
$linkAnio3 = urlencode("\"javascript:detalleAnios('INT 3', '74', '44');\"");
$linkAnio4 = urlencode("\"javascript:detalleAnios('INT 4', '50', '95');\"");
$linkAnio5 = urlencode("\"javascript:detalleAnios('INT 5', '50', '95');\"");
$linkAnio5 = urlencode("\"javascript:detalleAnios('INT 6', '50', '95');\"");

$result=$connect->consulta("SELECT vicidial_users.full_name,count(*) as gestiones from sistema_gestiones,vicidial_users where sistema_gestiones.user = vicidial_users.user and  campaign = '$campaign_id' and cod_gestion = 'CP' group by sistema_gestiones.user order by gestiones desc");

while($row = mysql_fetch_array($result))
{
$strXML .= "<set label = '$row[full_name]' value ='".$row[gestiones]."' color = '6D8D16' link = ".$linkAnio1." />";
}

$strXML .= "</chart>";
echo renderChartHTML("../includes/charts/swf_charts/Column3D.swf", "",$strXML, "GRAFICO", 1024, 300, false);

///////////////////////////////////////////////// SEGUNDO GRAFICO

$strXML2 = "";
$strXML2 = "<chart caption = 'Grafico 2: Total de gestiones compromisos de pago cancelados en  $campaign_id' bgColor='#CDDEE5' baseFontSize='9' showValues='1' yAxisName='TOTAL COMPROMISOS'  xAxisName='EJECUTIVOS' >";

$linkAnio1 = urlencode("\"javascript:detalleAnios('INT 1', '210', '100');\"");
$linkAnio2 = urlencode("\"javascript:detalleAnios('INT 2', '175', '265');\"");
$linkAnio3 = urlencode("\"javascript:detalleAnios('INT 3', '74', '44');\"");
$linkAnio4 = urlencode("\"javascript:detalleAnios('INT 4', '50', '95');\"");
$linkAnio5 = urlencode("\"javascript:detalleAnios('INT 5', '50', '95');\"");
$linkAnio5 = urlencode("\"javascript:detalleAnios('INT 6', '50', '95');\"");

$result=$connect->consulta("SELECT vicidial_users.full_name,count(*) as gestiones from sistema_gestiones,vicidial_users,pagos_corona where sistema_gestiones.user = vicidial_users.user and  campaign = '$campaign_id' and cod_gestion = 'CP' and sistema_gestiones.rut_cliente = pagos_corona.rut group by sistema_gestiones.user order by gestiones desc");

while($row = mysql_fetch_array($result))
{
$strXML2 .= "<set label = '$row[full_name]' value ='".$row[gestiones]."' color = 'FFBA00' link = ".$linkAnio1." />";
}

$strXML2 .= "</chart>";
echo renderChartHTML("../includes/charts/swf_charts/Column3D.swf", "",$strXML2, "GRAFICO", 1024, 300, false);








?>
