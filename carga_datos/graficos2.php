<?php
require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");
?>
<style>
body {
  background: url(../images/fondo_adm.jpg) repeat;
  background-size: 100%;
  background-repeat: repeat;

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
<legend ><font face="verdana,arial" size=1><b> MENU PRINCIPAL</b></font></legend>

<table   cellspacing='2' cellpadding="2" align="left" border='0'>
<tr>

<td valign="top">       
<button type="button"  onClick="top.frames['mainFrame'].location.href = '../carga_datos/campaign.php'" disabled>
<font class="main_text">GESTION DATOS<br>
<img src="../images/Crystal_Clear_app_kontact.png" width='45' height='45' alt="Gestor de art�culos"  />	
</button>    
</td>

<td>
<button type="button"   onClick="top.frames['mainFrame'].location.href = '../grilla/paginacion3.php'">
<font class="main_text">GESTIONES<br>
<img src="../images/Crystal_128_kaddressbook-crnagora.png" width='45' height='45' alt="Gestor de art�culos"  />	
</button> 
</td>
<td>
<button type="button"   onClick="top.frames['mainFrame'].location.href = '../genera_root.php'">
<font class="main_text">GENERAR ROOT<br>
<img src="../images/Crystal_Clear_mimetype_document2.png" width='45' height='45' alt="Gestor de art�culos"  />	
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
 


<?php
$campaign_id = $_REQUEST["campaign_id"];
$cod_cedente = $_REQUEST["cod_cedente"];


?>


<fieldset>
<legend ><font face="verdana,arial" size=1><b> GRAFICOS - RENDIMIENTO CAMPA&Ntilde;AS</b></font></legend>	 
 
<table border='0' cellspacing=0 cellpading=0>
<tr><td width=720 valign="top">
<iframe src ="grafico3.php?campaign_id=<?php echo $campaign_id;?>&cod_cedente=<?php echo $cod_cedente;?>" width=720p height="800px"  scrolling="yes" frameborder="0">
  <p>Your browser does not support iframes.</p>
</iframe>
</td>
<td>
<iframe src ="grafico4.php?campaign_id=<?php echo $campaign_id;?>&cod_cedente=<?php echo $cod_cedente;?>" width="720" height="800" scrolling="no" frameborder="0">
  <p>Your browser does not support iframes.</p>
</iframe>
</td>
</tr>

</table>
</fieldset>
