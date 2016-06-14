<?php
include_once("../includes/class/class_mysql_inc.php");
$num_cuotas= $_REQUEST['num_cuotas'];
$total_deuda_vencida_vencer= $_REQUEST['total_deuda_vencida_vencer'];
$pie= $_REQUEST['pie'];
$fecha_vencimiento = $_REQUEST['fecha_vencimiento'];

///FIXEAR
//$porcentaje_pie=40;


$connect = new DB_mysql ;
$connect->conectar();



//CALCULOS INICIALES
$total_deuda_vencida_vencer = $total_deuda_vencida_vencer-$pie;

//$pie = ceil($total_vencida_vencer/100*$porcentaje_pie);


?>
<table border='1' width='300'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='50' height="19"><font face="verdana,arial" size=1>CUOTA</td>
<td width='150'><font face="verdana,arial" size=1>VALOR</td>
<td width='150'><font face="verdana,arial" size=1>FECHA VENC.</td>
</tr>
<?php

if($_REQUEST['num_cuotas'])
{
			
    for($i=0;$i<$num_cuotas;++$i)
    {
?>
	   	<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">
		<td><font face="verdana,arial" size=1><?php echo $i+1; ?></td>
		<td height="18"><font face="verdana,arial" size=1><?php echo number_format(ceil(($total_deuda_vencida_vencer-$pie)/$num_cuotas), 0, '', '.'); ?></td>
		<td height="18"><font face="verdana,arial" size=1><?php 
		$fecha_vencimiento = date("Y-m-d", strtotime("$fecha_vencimiento + 1 months"));
		echo $fecha_vencimiento; 
		
		
		?></td>
        </tr>		
		    	
    	
    	
<?php    	
    }
			
}
?>

</table>