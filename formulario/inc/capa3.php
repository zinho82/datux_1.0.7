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

<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> DETALLE DOCUMENTOS</b></font></legend>

<table border='1' width='1050'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='10'><font face="verdana,arial" size=1>Nº</td>
<td width='50'><font face="verdana,arial" size=1>NRO.DOC.</td>
<td width='50'><font face="verdana,arial" size=1>TOT.CUOT.</td>
<td width='100'><font face="verdana,arial" size=1>TIPO DOC.</td>
<td width='100'><font face="verdana,arial" size=1>EST.CUOTA</td>
<td width='100'><font face="verdana,arial" size=1>FECHA VENC.</td>
<td width='50'><font face="verdana,arial" size=1>DIAS</td>
<td width='150'><font face="verdana,arial" size=1>VALOR CUOTA</td>
<td width='100'><font face="verdana,arial" size=1>INT. PENAL</td>
<td width='100'><font face="verdana,arial" size=1>GAST. COBR.</td>
<td width='100'><font face="verdana,arial" size=1>TOTAL DEUDA</td>
<td width='100'><font face="verdana,arial" size=1>DEUDA TOTAL</td>

<td width='20'><font face="verdana,arial" size=1>MONTO CAPITAL</td>
 
</tr>
<?php

if($_REQUEST["id_datos"]!="")
{
$result = $connect->consulta("SELECT * from sistema_deuda where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]' ");
}
else
{
$result = $connect->consulta("SELECT * from sistema_deuda where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]'");
}
while($row = mysql_fetch_array($result))
{
$nro_doc = $row["nro_doc"];
$total_cuotas = $row["total_cuotas"];
$tipo_doc = $row["tipo_doc"];
$protesto = $row["protesto"];
$estado_deuda = $row["estado_deuda"];
$fec_venc = date("Ymd",strtotime($row["fec_venc"]));
$fec_asignacion = $row["fec_asignacion"];
$fec_colocacion = $row["fec_asignacion"];

$monto = $row["valor_cuota"];

$deuda_total = $row["deuda_total"];
$abono = $row["abono"];
$fecha_abono = $row["fecha_abono"];
$deuda_morosa = $row["deuda_morosa"];

$adicional1 = $row["adicional1"];
$adicional2 = $row["adicional2"];
$adicional3 = $row["adicional3"];
$adicional4 = $row["adicional4"];
$adicional5 = $row["adicional5"];

$id_deuda = $row["id_deuda"];

$morosidad = 0;
$gastos_cobranza_pc = 0;
$interes_penal_pc = 0;
$total_deuda_pc = 0;

$segundos=strtotime($fec_venc) - strtotime('now');
$dias_mora=intval($segundos/60/60/24)*-1;
if($dias_mora > 0)
{
$morosidad = $dias_mora;
/////////////////////////////////////////////////////////////////////////////

//calculo interes penal , monto en UF, gastos cobranza y total deuda.
///INTERES PENAL
$interes_penal_pc = round((($row["valor_cuota"]*($morosidad)*3)/60)/100);
//MONTO EN UF
$monto_en_uf_pc = number_format($row["valor_cuota"]/$uf,2,'.','');

}
//GASTOS COBRANZA
if($monto_en_uf_pc <= 10 )
{
	
   $gastos_cobranza_pc = round(($row["valor_cuota"] /100)*9);
}
if($monto_en_uf_pc >= 10 && $monto_en_uf_pc < 50)
{
	
	$factor1 = (10*$uf)/100*9;
    $factor2 = (($monto_en_uf_pc -10)*$uf)/100*6;
    $gastos_cobranza_pc = round($factor1+$factor2);
}

if($monto_en_uf > 50)
{
	
	$factor1 = (10*$uf)/100*9;
    $factor2 = (40*$uf)/100*6;
    $factor3 = (($monto_en_uf_pc -50)*$uf)/100*3;
	$gastos_cobranza_pc = round($factor1+$factor2+$factor3);
}



$total_deuda_pc = $row["valor_cuota"] + $interes_penal_pc + $gastos_cobranza_pc;

$total_interes_penal_pc = $total_interes_penal_pc + $interes_penal_pc;
$total_gastos_cobranza_pc = $total_gastos_cobranza_pc + $gastos_cobranza_pc;
$total_total_deuda_pc = $total_total_deuda_pc + $total_deuda_pc;

$total_deuda_monto = $row["valor_cuota"] + $total_deuda_monto;

?>
 


<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">

<td><font face="verdana,arial" size='1'><?php echo $cont; ?></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $nro_doc; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $total_cuotas; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $tipo_doc; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $estado_deuda; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fec_venc; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $morosidad; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($monto)." (UF:".$monto_en_uf_pc.")"; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($interes_penal_pc); ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($gastos_cobranza_pc); ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($total_deuda_pc); ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($deuda_total); ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $deuda_morosa; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

<td><font face="verdana,arial" color='white'  ><a href="inc/ver_adicionales.php?vendor_id=<?php echo $row[rut]; ?>&campaign=<?php echo $row[campaign_id]; ?>&dialed_number=<?php echo $row[fono_celular]; ?>&list_id=<?php echo $row[list_id]; ?>&user=<?php echo $_SESSION[user]; ?>&id_datos=<?php echo $row[id_datos]; ?>&id_deuda=<?php echo $row[id_deuda]; ?>" target="popup" onClick="window.open(this.href, this.target, 'width=900,height=400'); return false;"><img src='../images/icons/application_view_detail.png'></a></a></td>


</tr>



<?php
$cont=$cont+1;
}


?>
<tr height='16'>

<td width=''><font face="verdana,arial" size=1></td>
<td width=''><font face="verdana,arial" size=1 ></td>
<td width=''><font face="verdana,arial" size=1 ></td>
<td width=''><font face="verdana,arial" size=1 ></td>
<td width=''><font face="verdana,arial" size=1 ></td>
<td width=''><font face="verdana,arial" size=1 ></td>
<td width=''><font face="verdana,arial" size=1 >TOTALES:</td>
<td width=''><font face="verdana,arial" size=1 ><b><?php echo number_format($total_deuda_monto); ?></b></td>
<td width=''><font face="verdana,arial" size=1 ><b><?php echo number_format($total_interes_penal_pc); ?></b></td>
<td width=''><font face="verdana,arial" size=1 ><b><?php echo number_format($total_gastos_cobranza_pc); ?></td>
<td width=''><font face="verdana,arial" size=1 ><b><?php echo number_format($total_total_deuda_pc); ?></td>
</tr>

</table>
<br>
</fieldset>
<?php
$calc_cedente = $connect->consulta("SELECT sistema_codigos_cedentes.cod_cedente,sistema_codigos_cedentes.cedente from sistema_codigos_cedentes_asociacion,sistema_codigos_cedentes where campana = '$_GET[campaign]' and sistema_codigos_cedentes.cod_cedente = sistema_codigos_cedentes_asociacion.cod_cedente");
while($row2 = mysql_fetch_array($calc_cedente))
{
	$cedente = $row2["cedente"];
}

if($cedente == 'CORONA')
{

$result_docs_corona = $connect->consulta("SELECT * from sistema_documentos_corona where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]'");

while($row = mysql_fetch_array($result_docs_corona))
{
?>
<br><br>
<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> DETALLE DOCUMENTOS CORONA</b></font></legend>
<table border='1' width='760'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='150'><font face="verdana,arial" size=1>CAMPAÑA</td>
<td width='150'><font face="verdana,arial" size=1>A PAGAR DESCUENTO</td>
<td width='150'><font face="verdana,arial" size=1>A PAGAR CONVENIO</td>
<td width='150'><font face="verdana,arial" size=1>NUMERO CUOTAS</td>
<td width='150'><font face="verdana,arial" size=1>VALOR CADA CUOTA</td>
</tr>

<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["campaign_id"]; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["apagar"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["pagarok2"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["numero_cuotas"]; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["total_a_pagar"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
</tr>
</table>
<br>  
</fieldset>

<?php	
} 
}



if($cedente == 'TRICOT')
{

$result_docs_tricot = $connect->consulta("SELECT * from sistema_documentos_tricot where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]'");


?>
<br><br>
<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> DETALLE DOCUMENTOS TRICOT</b></font></legend>
<table border='1' width='760'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
<td width='150'><font face="verdana,arial" size=1>CAMPAÑA</td>
<td width='150'><font face="verdana,arial" size=1>VALOR</td>
<td width='150'><font face="verdana,arial" size=1>TOTAL CAPITAL</td>
<td width='150'><font face="verdana,arial" size=1>FECHA VENC. CUOTA</td>
<td width='150'><font face="verdana,arial" size=1>MC2</td>
<td width='150'><font face="verdana,arial" size=1>TC2</td>
</tr>
<?php
while($row = mysql_fetch_array($result_docs_tricot))
{?>
<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["campaign_id"]; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["valor"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["total_capital"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $row["fecha_vencimiento_cuota"]; ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["mc2"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
<td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($row["tc2"],0); ?>' style="width:100%"  name='usuario' class='tb10'></td>
</tr>

<?php	
}
?></table>
<br>  
</fieldset>
<?php 
}
?>