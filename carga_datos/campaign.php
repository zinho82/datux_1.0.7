<?php
require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");
?>
<style>
body {
  background: url(../images/fondo_adm.jpg) no-repeat;
  background-size: 100%;

} 
</style>
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


<br>
<fieldset>
<legend ><font face="verdana,arial" size=2><b> MENU PRINCIPAL GENERAL</b></font></legend>

<table   cellspacing='2' cellpadding="2" align="left" border='0'>
<tr>

<td valign="top">       
<button type="button"  onClick="top.frames['mainFrame'].location.href = 'campaign.php'">
<font class="main_text">GESTION DATOS<br>
<img src="../images/Crystal_Clear_app_kontact.png" width='45' height='45' alt="Gestor de artículos"  />	
</button>    
</td>

<td>
<button type="button"   onClick="top.frames['mainFrame'].location.href = '../grilla/paginacion3.php'">
<font class="main_text">GESTIONES<br>
<img src="../images/Crystal_128_kaddressbook-crnagora.png" width='45' height='45' alt="Gestor de artículos"  />	
</button> 
</td>



<td>
<button type="button"   onClick="top.frames['mainFrame'].location.href = '../genera_root.php'">
<font class="main_text">GENERAR ROOT<br>
<img src="../images/Crystal_Clear_mimetype_document2.png" width='45' height='45' alt="Gestor de artículos"  />	
</button> 
</td>
        
     
         
<td>	        
<button type="button"  onClick="top.frames['mainFrame'].location.href = '../reportes'">
<font class="main_text">ARCHIVOS<br>
<img src="../images/Crystal_Clear_app_Network_Connection_Manager.png" width='45' height='45' alt="Gestor de artículos"  />	
</button>

</td>
<td>	        
<button type="button"  onClick="top.frames['mainFrame'].location.href = '../gestion_manual/index.php'">
<font class="main_text">GESTION MANUAL<br>
<img src="../images/clientes.png" width='45' height='45' alt="Gestion Manual"  />	
</button>
</td>

</tr>
</table>
	
</fieldset>

 
 
   
   <script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
}
</script>	
	 <fieldset>
<legend ><font face="verdana,arial" size=1><b> CAMPAÑAS VICIDIAL</b></font></legend>

		<?php
$porcentaje_comision=9;
$connect = new DB_mysql ;
$connect->conectar();
$result = $connect->consulta("select * from vicidial_campaigns where active = 'Y' and voicemail_ext = 'general' order by active");
$cont = 0;
if (!$result)
{echo "error!";
}else 
{
echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr>";
?>
<td width="15"  bgcolor="DADAd5"><font class="main_text_c">N°</td>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">ID CAMPAIGN</td>
<td  width='150' bgcolor="DADAd5"><font class="main_text_c">NOMBRE CAMPAIGN</td>
<td bgcolor='DADAd5' width='10'><font class="main_text_c">LISTAS</td>


<td width='300' bgcolor="DADAd5"><font class="main_text_c">DIAL STATUSES</td>
<td bgcolor='DADAd5' width='80'><font class="main_text_c">REG PEND.</td>
<td bgcolor="DADAd5"><font class="main_text_c">Active</td>

<td bgcolor="DADAd5"><font class="main_text_c">E</td>
<td bgcolor="DADAd5"><font class="main_text_c">L</td>
<td bgcolor="DADAd5"><font class="main_text_c">R</td>
<td bgcolor="DADAd5"><font class="main_text_c">I</td>
<td bgcolor="DADAd5"><font class="main_text_c">P</td>
<td bgcolor="DADAd5"><font class="main_text_c">F</td>
<td bgcolor="DADAd5"><font class="main_text_c">G1</td>
<td bgcolor="DADAd5"><font class="main_text_c">G2</td>
<td bgcolor="DADAd5"><font class="main_text_c">G3</td>
<td bgcolor="DADAd5"><font class="main_text_c">CE</td>

</tr>
<?php
while($row = mysql_fetch_array($result))
{
$cont ++;
$switch=0;
?> 

<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>

 <td width="15"><font class="main_text_c"><?php echo $cont; ?></td>
 <td><font class="main_text_c"><?php echo $row["campaign_id"]; ?></td>
 <td><font class="main_text_c"><?php echo strtoupper($row["campaign_name"]); ?></td>
 
<?php
$campaign_id = $row["campaign_id"];
$result2 = $connect->consulta("select count(*) as cuantas from vicidial_lists where campaign_id = '$campaign_id'");
while($row2 = mysql_fetch_array($result2))
{
	echo "<td><font class='main_text_c'>".$row2["cuantas"]."</td>";	
	if ($row2["cuantas"]>0)
	{
		$switch = 1;
	}
}
?>
 
 <!--<td><font class="main_text_c"><b><?php echo $row["dial_status_a"]," ",$row["dial_status_b"]," ",$row["dial_status_c"]," ",$row["dial_status_d"]," ",$row["dial_status_e"]; ?></td>!-->
 <td><font class="main_text_c"><?php echo $row["dial_statuses"];
 
 //calcular arreglo de status
 $status = substr(str_replace(",","','",str_replace(" ",",",$row["dial_statuses"])),2,-3); 
//  $cons = $connect->consulta("select count(*) as cantidad from vicidial_list where source_id = '$campaign_id' and status IN ($status) and called_since_last_reset = 'N'");
// while($rowz = mysql_fetch_array($cons))
//    {
//       $total_por_llamar = $rowz["cantidad"];	
//    }
 
    ?>
 
 
 </td>
 <td width="20" ><font class="main_text_c"><?php echo $total_por_llamar; ?></td>
 <td width="20" align="center"><font class="main_text_c"><b><?php echo $row["active"]; ?></td>
 <?php
 if($switch==0)
 {
 ?>
 <td width="20" align="center"><a href='campaign.php?opcion=eliminar&campaign_id=<?php echo $campaign_id; ?>' onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><img src="../images/icons/delete.png" border="0"></a></td>
 <?php
 }
 else 
 echo "<td width='20' align='center'></td>";
 ?>
 
 <td width="20" align="center"><a href="ver_listas.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Ver listas de la campana"><img src="../images/icons/application_cascade.png" border="0"></a></td>
  <td width="20" align="center"><a href="subir_base.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Ver listas de la campana"><img src="../images/icons/database_gear.png" border="0"></a></td>
 <td width="20" align="center"><a href="test_csv.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Reporte registros ingresados a campana"><img src="../images/icons/doc_excel_csv.png" border="0"></a></td>
 <td width="20" align="center"><a href="ver_listas.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Inhibir registros de campaña"><img src="../images/icons/application_delete.png" border="0"></a></td>
 <td width="20" align="center"><a href="carga_pagos.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>" title="Cargar Pagos"><img src="../images/icons/money_dollar.png" border="0"></a></td>
 <td width="20" align="center"><a href="informe_pagos.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>&porcentaje_comision=<?php echo $porcentaje_comision; ?>" title="Informe Pagos"><img src="../images/icons/report.png" border="0"></a></td>
 
 <td width="20" align="center"><a href="graficos.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Grafico de rendimiento"><img src="../images/icons/chart_bar.png" border="0"></a></td>
  <td width="20" align="center"><a href="graficos2.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Grafico de rendimiento"><img src="../images/icons/chart_bar.png" border="0"></a></td>
<td width="20" align="center"><a href="graficos3.php?campaign_id=<?php echo $row["campaign_id"]; ?>" title="Pagos vs compromisos"><img src="../images/icons/chart_bar.png" border="0"></a></td>

 </tr>
 
 
 
     <?php
 }
 ?> </table><?php
 }

if($_GET["opcion"]=="eliminar")
{
$resultn = $connect->consulta("delete from vicidial_campaigns where campaign_id = '$_GET[campaign_id]'");
?>
<script>
//window.alert("Ha ingresado un Rut y/o password incorrecto ");
top.frames['mainFrame'].location.href = 'campaign.php';
</script>
<?php
}		
	?>	
		<!-- FIN AREA CENTRAL !-->
    </td>	
	 
	 </tr>
	
</table>
