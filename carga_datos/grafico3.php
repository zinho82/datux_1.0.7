
<style>
.tcat
{
        background: #80A9EA url(http://localhost/login/images/tablebg.gif) repeat-x top left;
    COLOR: #FFFFFF;
        FONT: 12px Verdana, Tahoma;
}
.tborder
{
        background-color: #FFFFFF;
        color: #000000;
        border: 2px solid #D8D8D8;
}
.cabecera
{
        background-color: #FAAC58;
        color: #000000;
        border: 2px solid #D8D8D8;
}

</style>
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
$cod_cedente = $_REQUEST["cod_cedente"];
 

require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();
$NOW = date("Y-m-d H:i:s");
$NOW2 = date("Y-m-d");

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
 
<?php

////////////////RANGOS TRAMOS
$rango1=270;
$rango2=360;
$rango3=720;
$rango4=1080;
$rango5=1081;

$tramo1 = 0;



//////////////////////////////////////////////////////////////////////////////////////
//if($cod_cedente == '')
 $result=$connect->consulta("SELECT rut,fec_venc,sistema_deuda.monto,fec_venc FROM sistema_deuda
WHERE sistema_deuda.campaign_id = '$campaign_id' group by rut ");

 // else 
// $result=$connect->consulta("SELECT rut,fec_venc,sistema_deuda.monto,fec_venc FROM sistema_deuda
//WHERE sistema_deuda.cod_cedente = '$cod_cedente' group by rut ");
 
 
 while($row = mysql_fetch_array($result))
{
$rut_cliente = $row["rut"];

//if($cod_cedente == '')
$min1=$connect->consulta("SELECT MIN(fec_venc) as fec_venc,SUM(monto) as sum_monto,count(*) as cantidad FROM sistema_deuda
WHERE sistema_deuda.campaign_id = '$campaign_id' and rut = '$rut_cliente'");
//else
//$min1=$connect->consulta("SELECT MIN(fec_venc) as fec_venc,SUM(monto) as sum_monto,count(*) as cantidad FROM sistema_deuda
//WHERE sistema_deuda.cod_cedente = '$cod_cedente' and rut = '$rut_cliente'");


while($deuda_min = mysql_fetch_array($min1))
{
	$fec_venc = $deuda_min["fec_venc"];
	$sum_monto = $deuda_min["sum_monto"];
	$cantidad = $deuda_min["cantidad"];
}
$segundos=strtotime($fec_venc) - strtotime('now');
$dias_mora=intval($segundos/60/60/24)*-1;


if($dias_mora <= $rango1)
{
	if($rut_cli != $rut_cliente)
	{
	$rut_cli = $rut_cliente;
	$tramo1 = $tramo1+1;

//if($cod_cedente == '')
$gestionados=$connect->consulta("SELECT  count(*) as gestionados,SUM(sistema_deuda.monto) as deuda_total from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.rut_cliente = '$rut_cliente' and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  group by  rut_cliente ");
//else 
//$gestionados=$connect->consulta("SELECT  count(*) as gestionados,SUM(sistema_deuda.monto) as deuda_total from sistema_gestiones,sistema_deuda,arbol_opciones1 where sistema_deuda.cod_cedente = '$cod_cedente' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.rut_cliente = '$rut_cliente' and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  group by  rut_cliente ");		

	while($row2 = mysql_fetch_array($gestionados))
		{
			$gestionados1 = $gestionados1+1;
			//$total_deuda_gestionados1 = $total_deuda_gestionados1 + $row2["deuda_total"];
		}
	

	}

$deuda_total1 = $deuda_total1 +$sum_monto;	

}

if($dias_mora <=$rango2 and $dias_mora > $rango1)
{
    if($rut_cli != $rut_cliente)
	{
	$rut_cli = $rut_cliente;
	$tramo2 = $tramo2+1;
	
$gestionados=$connect->consulta("SELECT  count(*) as gestionados,SUM(sistema_deuda.monto) as deuda_total from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.rut_cliente = '$rut_cliente' and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  group by  rut_cliente  ");		
	while($row2 = mysql_fetch_array($gestionados))
		{
			$gestionados2 = $gestionados2+1;
			//$total_deuda_gestionados1 = $total_deuda_gestionados1 + $row2["deuda_total"];
		}
	}


$deuda_total2 = $deuda_total2 +$sum_monto;

}
if($dias_mora <=$rango3 and $dias_mora > $rango2)
{
   	if($rut_cli != $rut_cliente)
	{
	$rut_cli = $rut_cliente;
	$tramo3 = $tramo3+1;
	
$gestionados=$connect->consulta("SELECT  count(*) as gestionados,SUM(sistema_deuda.monto) as deuda_total from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.rut_cliente = '$rut_cliente' and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  group by  rut_cliente  ");		
	while($row2 = mysql_fetch_array($gestionados))
		{
			$gestionados3 = $gestionados3+1;
			//$total_deuda_gestionados1 = $total_deuda_gestionados1 + $row2["deuda_total"];
		}
		
	}

	
$deuda_total3 = $deuda_total3 +$sum_monto;

}
if($dias_mora <=$rango4 and $dias_mora > $rango3)
{
  	if($rut_cli != $rut_cliente)
	{
	$rut_cli = $rut_cliente;
	$tramo4 = $tramo4+1;
	
$gestionados=$connect->consulta("SELECT  count(*) as gestionados,SUM(sistema_deuda.monto) as deuda_total from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.rut_cliente = '$rut_cliente' and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  group by  rut_cliente  ");		
	while($row2 = mysql_fetch_array($gestionados))
		{
			$gestionados4 = $gestionados4+1;
			//$total_deuda_gestionados1 = $total_deuda_gestionados1 + $row2["deuda_total"];
		}
	}

$deuda_total4 = $deuda_total4 +$sum_monto;

}

if($dias_mora >= $rango5)
{
    if($rut_cli != $rut_cliente)
	{
	$rut_cli = $rut_cliente;
	$tramo5 = $tramo5+1;
	
$gestionados=$connect->consulta("SELECT  count(*) as gestionados,SUM(sistema_deuda.monto) as deuda_total from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut and sistema_gestiones.rut_cliente = '$rut_cliente' and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  group by  rut_cliente  ");		
	while($row2 = mysql_fetch_array($gestionados))
		{
			$gestionados5 = $gestionados5+1;
			//$total_deuda_gestionados1 = $total_deuda_gestionados1 + $row2["deuda_total"];
		}
	}

$deuda_total5 = $deuda_total5 +$sum_monto;

}


	
}

$pagados = $connect->consulta("SELECT count(*) as pagados FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %'  AND DATEDIFF(NOW(), fec_venc)  between '1' and '$rango1'");
$cantidad_pagos1 = mysql_fetch_array($pagados);
$cantidad_pagos1 = $cantidad_pagos1["pagados"];

$pagados = $connect->consulta("SELECT count(*) as pagados FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc) between ".($rango1 + 1) ." and '$rango2'");
$cantidad_pagos2 = mysql_fetch_array($pagados);
$cantidad_pagos2 = $cantidad_pagos2["pagados"];

$pagados = $connect->consulta("SELECT count(*) as pagados FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc) between ".($rango2 + 1) ." and '$rango3'");
$cantidad_pagos3 = mysql_fetch_array($pagados);
$cantidad_pagos3 = $cantidad_pagos3["pagados"];

$pagados = $connect->consulta("SELECT count(*) as pagados FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc) between ".($rango3 + 1) ." and '$rango4'");
$cantidad_pagos4 = mysql_fetch_array($pagados);
$cantidad_pagos4 = $cantidad_pagos4["pagados"];

$pagados = $connect->consulta("SELECT count(*) as pagados FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc)  >= '$rango5'");
$cantidad_pagos5 = mysql_fetch_array($pagados);
$cantidad_pagos5 = $cantidad_pagos5["pagados"];

$pagados = $connect->consulta("SELECT DISTINCT count(nro_doc) as pagados FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND (DATEDIFF(NOW(), fec_venc) IS NULL OR DATEDIFF(NOW(), fec_venc) < 1) ");
$cantidad_pagos6 = mysql_fetch_array($pagados);
$cantidad_pagos6 = $cantidad_pagos6["pagados"];

$cantidad_pagos5 = $cantidad_pagos5 +$cantidad_pagos6;
$montos_pagos = $connect->consulta("SELECT SUM(deuda_total) as montos_pagos FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc)  between '1' and '$rango1'");
$montos_pagos1 = mysql_fetch_array($montos_pagos);
$montos_pagos1 = $montos_pagos1["montos_pagos"];

$montos_pagos = $connect->consulta("SELECT SUM(deuda_total) as montos_pagos FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc)  between ".($rango1 + 1) ." and '$rango2'");
$montos_pagos2 = mysql_fetch_array($montos_pagos);
$montos_pagos2 = $montos_pagos2["montos_pagos"];

$montos_pagos = $connect->consulta("SELECT SUM(deuda_total) as montos_pagos FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc)  between ".($rango2 + 1) ." and '$rango3'");
$montos_pagos3 = mysql_fetch_array($montos_pagos);
$montos_pagos3 = $montos_pagos3["montos_pagos"];

$montos_pagos = $connect->consulta("SELECT SUM(deuda_total) as montos_pagos FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc)  between ".($rango3 + 1) ." and '$rango4'");
$montos_pagos4 = mysql_fetch_array($montos_pagos);
$montos_pagos4 = $montos_pagos4["montos_pagos"];

$montos_pagos = $connect->consulta("SELECT SUM(deuda_total) as montos_pagos FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND DATEDIFF(NOW(), fec_venc) >= '$rango5' AND fec_venc = 0");
$montos_pagos5 = mysql_fetch_array($montos_pagos);
$montos_pagos5 = $montos_pagos5["montos_pagos"];

$montos_pagos = $connect->consulta("SELECT SUM(deuda_total) as montos_pagos FROM `sistema_gestiones` WHERE user = 'VDAD' AND campaign = '$campaign_id' AND glosa LIKE 'CLIENTE PAGO EL %' AND (DATEDIFF(NOW(), fec_venc) IS NULL OR DATEDIFF(NOW(), fec_venc) < 1) ");
$montos_pagos6 = mysql_fetch_array($montos_pagos);
$montos_pagos6 = $montos_pagos6["montos_pagos"];
$montos_pagos5 = $montos_pagos5 + $montos_pagos6;
/////////////////////////////////////////////////////////////////


echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>DESGLOSE POR TRAMO</tr>";
echo "<tr>";
?>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">TRAMO</td>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">ASIG.</td>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">GEST.</td>
<td width="150"  bgcolor="DADAd5"><font class="main_text_c">MONTO GEST.</td>
<td width="150"  bgcolor="DADAd5"><font class="main_text_c">DEUDA TOTAL</td>
<td width="150"  bgcolor="DADAd5"><font class="main_text_c">CANT. PAGOS</td>
<td width="150"  bgcolor="DADAd5"><font class="main_text_c">MONTO PAGOS</td>
<td width="10"  bgcolor="DADAd5"><font class="main_text_c">C</td>
</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"><?php echo "180-270"; ?></td>
<td><font class="main_text_c"><?php echo $tramo1; ?></td>
<td><font class="main_text_c"><?php echo $gestionados1; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_gestionados1,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($deuda_total1,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo $cantidad_pagos1; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($montos_pagos1,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c"><a href='descarga_gestiones_tramo.php?campaign_id=<?php echo $campaign_id; ?>&tramo=<?php echo $rango1; ?>' title='Descarga detalle contactabilidad'><img src='../images/icons/doc_excel_csv.png'></a></td>

</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"><?php echo "271-360"; ?></td>
<td><font class="main_text_c"><?php echo $tramo2; ?></td>
<td><font class="main_text_c"><?php echo $gestionados2; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_gestionados2,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($deuda_total2,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo $cantidad_pagos2; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($montos_pagos2,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c"><a href='descarga_gestiones_tramo.php?campaign_id=<?php echo $campaign_id; ?>&tramo=<?php echo $rango2; ?>' title='Descarga detalle contactabilidad'><img src='../images/icons/doc_excel_csv.png'></a></td>

</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"><?php echo "361-720"; ?></td>
<td><font class="main_text_c"><?php echo $tramo3; ?></td>
<td><font class="main_text_c"><?php echo $gestionados3; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_gestionados3,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($deuda_total3,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo $cantidad_pagos3; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($montos_pagos3,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c"><a href='descarga_gestiones_tramo.php?campaign_id=<?php echo $campaign_id; ?>&tramo=<?php echo $rango3; ?>' title='Descarga detalle contactabilidad'><img src='../images/icons/doc_excel_csv.png'></a></td>

</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"><?php echo "721-1080"; ?></td>
<td><font class="main_text_c"><?php echo $tramo4; ?></td>
<td><font class="main_text_c"><?php echo $gestionados4; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_gestionados4,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($deuda_total4,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo $cantidad_pagos4; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($montos_pagos4,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c"><a href='descarga_gestiones_tramo.php?campaign_id=<?php echo $campaign_id; ?>&tramo=<?php echo $rango4; ?>' title='Descarga detalle contactabilidad'><img src='../images/icons/doc_excel_csv.png'></a></td>

</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"><?php echo "1080+"; ?></td>
<td><font class="main_text_c"><?php echo $tramo5; ?></td>
<td><font class="main_text_c"><?php echo $gestionados5; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_gestionados5,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($deuda_total5,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo $cantidad_pagos5; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($montos_pagos5,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c"><a href='descarga_gestiones_tramo.php?campaign_id=<?php echo $campaign_id; ?>&tramo=<?php echo $rango5; ?>' title='Descarga detalle contactabilidad'><img src='../images/icons/doc_excel_csv.png' border="0"></a></td>

</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"></td>
<td><font class="main_text_c"><?php echo number_format($tramo1+$tramo2+$tramo3+$tramo4+$tramo5,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo number_format($gestionados1+$gestionados2+$gestionados3+$gestionados4+$gestionados5,0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_gestionados1+$total_deuda_gestionados2+$total_deuda_gestionados3+$total_deuda_gestionados4+$total_deuda_gestionados5,0,'.','.'); ?></td>

<td><font class="main_text_c"><?php echo "$ ".number_format($deuda_total1+$deuda_total2+$deuda_total3+$deuda_total4+$deuda_total5,0,'.','.'); ?></td>

<td><font class="main_text_c"><?php echo $cantidad_pagos1+$cantidad_pagos2+$cantidad_pagos3+$cantidad_pagos4+$cantidad_pagos5; ?></td>
<td><font class="main_text_c"><?php echo "$ ".number_format($montos_pagos1+$montos_pagos2+$montos_pagos3+$montos_pagos4+$montos_pagos5,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c"><a href='descarga_gestiones_tramo.php?campaign_id=<?php echo $campaign_id; ?>&tramo=full' title='Descarga detalle contactabilidad compilado'><img src='../images/icons/doc_excel_csv.png' border="0"></a></td>

</tr>



</table>

<?php
echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>HISTORIAL DE PAGOS</tr>";
echo "<tr>";
?>
<td width="150"  bgcolor="DADAd5"><font class="main_text_c">FECHA INGRESO</td>
<td width="300"  bgcolor="DADAd5"><font class="main_text_c">ARCHIVO</td>
<td width="150"  bgcolor="DADAd5"><font class="main_text_c">CANTIDAD PAGOS</td>
</tr>
<?php $pagos=$connect->consulta("SELECT fecha_ingreso, archivo, count( * ) AS cantidad_pagos
FROM ruts_pagos where campaign_id = '$campaign_id'  GROUP BY archivo order by fecha_ingreso");
 while($row3 = mysql_fetch_array($pagos))
{
?>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td><font class="main_text_c"><?php echo $row3[fecha_ingreso]; ?></td>
<td><font class="main_text_c"><?php echo substr($row3[archivo],0,40); ?></td>
<td><font class="main_text_c"><?php echo $row3[cantidad_pagos]; ?></td>
</tr>
<?php } ?>
</table>


<?php
	$id_arbol = $connect->consulta("SELECT id_arbol from sistema_arboles_asociacion where campaign = '$campaign_id'");
	while($row2 = mysql_fetch_array($id_arbol))
	{
	   $id_arbol = $row2["id_arbol"];
	}

 $result=$connect->consulta("SELECT count(*) as cantidad FROM  sistema_gestiones,arbol_opciones1
WHERE  arbol_opciones1.id_opcion = sistema_gestiones.cod_gestion  and arbol_opciones1.arbol = $id_arbol and sistema_gestiones.campaign = '$campaign_id'");
 while($row = mysql_fetch_array($result))
{
	$total = $row["cantidad"];
}

$result=$connect->consulta("SELECT SUM(deuda_total) as total_deuda FROM  sistema_gestiones,arbol_opciones1
WHERE  arbol_opciones1.id_opcion = sistema_gestiones.cod_gestion and arbol_opciones1.arbol = $id_arbol  and sistema_gestiones.campaign = '$campaign_id'");
$row = mysql_fetch_array($result);
$total_deuda_suma = $row["total_deuda"];


$result=$connect->consulta("SELECT opcion as gestion,cod_gestion,count(*) as cantidad, SUM(deuda_total) as total_deuda FROM  sistema_gestiones,arbol_opciones1
WHERE  arbol_opciones1.id_opcion = sistema_gestiones.cod_gestion and arbol_opciones1.arbol = $id_arbol  and sistema_gestiones.campaign = '$campaign_id' group by cod_gestion");



echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>TOTALES POR SEGUNDO NIVEL DE ARBOL DE GESTION (TOTAL DE GESTIONES)</tr>";
echo "<tr>";
?>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">COD GESTION</td>
<td width="300"  bgcolor="DADAd5"><font class="main_text_c">NOMBRE</td>
<td width="60"  bgcolor="DADAd5"><font class="main_text_c">CANTIDAD</td>
<td  width='150' bgcolor="DADAd5"><font class="main_text_c">DEUDA TOTAL</td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c">PORCENTAJE</td>
</tr>

<?php

while($row = mysql_fetch_array($result))
{
?>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>

 <td width="15"><font class="main_text_c"><?php echo $row["cod_gestion"]; ?></td>
 <td width="15"><font class="main_text_c"><?php echo $row["gestion"]; ?></td>
 <td><font class="main_text_c"><?php echo $row["cantidad"]; ?></td>
 <td><font class="main_text_c"><?php echo "$ ".number_format($row["total_deuda"],0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo round($row["cantidad"]/$total*100,2)."%"; ?></td>
</tr>

<?php
		
}
?>
<tr>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c"></td>
<td width="300"  bgcolor="DADAd5"><font class="main_text_c"></td>
<td width="60"  bgcolor="DADAd5"><font class="main_text_c"><?php echo $total; ?></td>
<td  width='150' bgcolor="DADAd5"><font class="main_text_c"><?php echo "$ ".number_format($total_deuda_suma,0,'.','.'); ?></td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c">100%</td>
</tr>
<tr>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c"></td>
<td width="300"  bgcolor="DADAd5"><font class="main_text_c"></td>
<td width="60"  bgcolor="DADAd5"><font class="main_text_c"></td>
<td  width='150' bgcolor="DADAd5"><font class="main_text_c"></td>
<td bgcolor='DADAd5' width='70'><font class="main_text_c">
<a href='descarga_gestiones.php?campaign_id=<?php echo $campaign_id; ?>' title='Descarga gestiones (totales)'><img src='../images/icons/doc_excel_csv.png'></a> 
<a href='descarga_nogestionado.php?campaign_id=<?php echo $campaign_id; ?>' title='Descarga gestiones consolidado de CAMPA�A (asignacion)'><img src='../images/icons/doc_excel_csv.png'></a>
<a href='descarga_repo_rsa.php?campaign_id=<?php echo $campaign_id; ?>' title='Descarga gestiones (totales) RSA'><img src='../images/icons/doc_excel_csv.png'></a><br>
</td>
</tr>
</table>


<?php 


$result=$connect->consulta("
		SELECT sg.cod_gestion, ao.opcion, sg.deuda_total, count(cod_gestion) as cantidad_gestiones 
		FROM sistema_gestiones sg  
		INNER JOIN arbol_opciones1 ao 
		ON ao.id_opcion = sg.cod_gestion 
		WHERE ao.arbol = 2 
		AND sg.campaign = '$campaign_id' 
		GROUP BY sg.cod_gestion 
		ORDER BY ao.prioridad 
		LIMIT 5
		");


echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>TOTALES MEJOR GESTI&Oacute;N </tr>";
echo "<tr>";
?>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">COD GESTION</td>
<td width="300"  bgcolor="DADAd5"><font class="main_text_c">NOMBRE</td>
<td width="60"  bgcolor="DADAd5"><font class="main_text_c">CANTIDAD</td>
<td  width='150' bgcolor="DADAd5"><font class="main_text_c">DEUDA TOTAL</td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c">PORCENTAJE</td>
</tr>

<?php

while($row = mysql_fetch_array($result))
{
?>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>

 <td width="15"><font class="main_text_c"><?php echo $row["cod_gestion"]; ?></td>
 <td width="15"><font class="main_text_c"><?php echo $row["opcion"]; ?></td>
 <td><font class="main_text_c"><?php echo $row["cantidad_gestiones"]; ?></td>
 <td><font class="main_text_c"><?php echo "$ ".number_format($row["deuda_total"],0,'.','.'); ?></td>
<td><font class="main_text_c"><?php echo round($row["cantidad_gestiones"]/$total*100,2)."%"; ?></td>
</tr>

<?php
		
}
?>
</table>









<?php
//obtener asignados.
 $result=$connect->consulta("SELECT count(*) as total_asignados FROM sistema_deuda where  sistema_deuda.campaign_id = '$campaign_id' group by rut");
 while($row = mysql_fetch_array($result))
{
	$total_asignados = $total_asignados+1;
}


 $result=$connect->consulta("select count(id_gestion) as con_gestion from sistema_gestiones,sistema_deuda where campaign = '$campaign_id' and sistema_deuda.rut = sistema_gestiones.rut_cliente group by rut_cliente ");
 while($row = mysql_fetch_array($result))
{
	$con_gestion = $con_gestion + 1;
}

echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>BUSQUEDA DE GESTIONES POR ARCHIVO</tr>";
?>

<td width="300"  bgcolor="DADAd5"><font class="main_text_c">
<form enctype="multipart/form-data" method="post" action="busqueda_gestiones.php" name="uploadform">
				<input type="file" name="file1" value='EXAMINAR' class='buttons' >
				<input type="hidden" name="list_id" value="<?php echo $list_id; ?>">
				<input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
				
<td width="140"  bgcolor="DADAd5" valign='top'><font class="main_text_c"><input type="submit" value="Obtener" name="invio" class='buttons' ></td>
			 
		
</form>

</td>
<?php echo "</table>";



echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>INDICADOR DE PROGRESO DE CAMPA&Ntilde;A</tr>";

?>
<tr>
<td width="140"  bgcolor="DADAd5"><font class="main_text_c">ASIGNADOS</td>
<td width="140"  bgcolor="DADAd5"><font class="main_text_c">CASOS SIN GESTION</td>
<td width="140"  bgcolor="DADAd5"><font class="main_text_c">CASOS GESTIONADOS</td>
<td bgcolor='DADAd5' width='140'><font class="main_text_c">% AVANCE</td>
</tr>
<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<td width="140"  "><font class="main_text_c"><a href='asignados.php'><?php echo $total_asignados;?></a></td>
<td width="140"  ><font class="main_text_c"><?php echo $total_asignados-$con_gestion; ?></td>
<td width="140" ><font class="main_text_c"><?php echo $con_gestion; ?></td>
<td width='140'><font class="main_text_c"><?php echo round(($con_gestion/$total_asignados)*100,2); ?>%</td>
</tr>
</table>

<?php

echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr><font class=main_text_c>TOTALES POR PRIMER NIVEL DE ARBOL DE GESTION</tr>";

	$id_arbol = $connect->consulta("SELECT id_arbol from sistema_arboles_asociacion where campaign = '$campaign_id'");
	while($row2 = mysql_fetch_array($id_arbol))
	{
	   $id_arbol = $row2["id_arbol"];
	}
	
 $result=$connect->consulta("SELECT * FROM arbol_inicio where arbol = '$id_arbol'");
 while($row = mysql_fetch_array($result))
{
	$opcion = $row["opcion"];
	$id_arbol = $row["id_arbol"];
    $arboles = $arboles+1;
?>
<tr>
<td width="160"  bgcolor="DADAd5"><font class="main_text_c"><?php echo $opcion."(".$id_arbol.")"; ?></td>
<td width="160" onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6' ><font class="main_text_c">
<?php
$cantidad_gestiones=0;
 $calculo=$connect->consulta("SELECT * FROM (SELECT rut_cliente,cod_contacto
 from sistema_gestiones,sistema_deuda,arbol_opciones1 where campaign_id = '$campaign_id' and campaign = '$campaign_id' and sistema_gestiones.rut_cliente = sistema_deuda.rut  and sistema_gestiones.cod_gestion = arbol_opciones1.id_opcion  ORDER BY arbol_opciones1.prioridad,cod_contacto )sub GROUP BY rut_cliente");

 	 $fam1 = 0;
 $fam2 = 0;
 $fam3 = 0;
 $fam4 = 0;
 $fam5 = 0;
 $fam6 = 0;
 $fam7 = 0;
 
 
 //$calculo=$connect->consulta("SELECT rut_cliente FROM sistema_gestiones where cod_contacto = '$id_arbol' and sistema_gestiones.campaign = '$campaign_id'");
 while($row2 = mysql_fetch_array($calculo))
{

 
	if($row2["cod_contacto"] == $id_arbol)
	$fam1=$fam1+1;

	
	
	//echo $fam1;	if($row2["cod_contacto"] == $id_arbol)

	$cantidad_gestiones = $cantidad_gestiones+1;

//echo $id_arbol;
}
echo $fam1;


?>

</td>
</tr>

<?php	
	
}

?>
</tr>
</table>









