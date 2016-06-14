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
<button type="button"  onClick="top.frames['mainFrame'].location.href = '../carga_datos/herramientas.php'">
<font class="main_text">HERRAMIENTAS<br>
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
<legend ><font face="verdana,arial" size=1><b> MENU HERRAMIENTAS DE SISTEMA</b></font></legend>

		<?php
$porcentaje_comision=9;
$connect = new DB_mysql ;
$connect->conectar();
$result = $connect->consulta("select * from vicidial_campaigns where active = 'Y' and voicemail_ext = 'general' order by active");
$cont = 0;


echo "<table border='0' class='tborder' cellspacing='1' cellpadding='0'>";
echo "<tr><th colspan=9 align='left' bgcolor='DADAd5'><font size='2'></font></th></tr>";
echo "<tr>";
?>
<td width="100"  bgcolor="DADAd5"><font class="main_text_c">ID CAMPAIGN</td>
<td  width='150' bgcolor="DADAd5"><font class="main_text_c">NOMBRE CAMPAIGN</td>

<td bgcolor="DADAd5"><font class="main_text_c">SUBIR BASE</td>
<td bgcolor="DADAd5"><font class="main_text_c">DD</td>
<td bgcolor="DADAd5"><font class="main_text_c">DE</td>
<td bgcolor="DADAd5"><font class="main_text_c">UB</td>
<td bgcolor="DADAd5"><font class="main_text_c">NDD</td>
<td bgcolor="DADAd5"><font class="main_text_c">NDE</td>
<td bgcolor="DADAd5"><font class="main_text_c">NUB</td>
</tr>


<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>
<?php
$result = $connect->consulta("select * from vicidial_campaigns where active = 'Y' and voicemail_ext = 'general' order by active");
while($row = mysql_fetch_array($result))
{
$cont ++;
$switch=0;
?> 

<tr onMouseover="this.style.backgroundColor='#81BEF7'" onMouseout="this.style.backgroundColor='#CEE3F6'" bgcolor='#CEE3F6'>

<td><font class="main_text_c"><?php echo $row["campaign_id"]; ?></td>
<td><font class="main_text_c"><?php echo strtoupper($row["campaign_name"]); ?></td>

 
<td ><font face="verdana,arial" color='white'  ><input type="submit" value="SUBIR BASE" name="invio" style='font-size:11px;'></td>
<td width='20'><font face="verdana,arial" color='white'  ><a href=''><img src='../images/icons/disk.png'></td>
<td width='20'><font face="verdana,arial" color='white'  ><a href=''><img src='../images/icons/disk.png'></td>
<td width='20'><font face="verdana,arial" color='white'  ><a href=''><img src='../images/icons/disk.png'></td>
<td width='20'><font face="verdana,arial" color='white'  ><a href=''><img src='../images/icons/disk.png'></td>
<td width='20'><font face="verdana,arial" color='white'  ><a href=''><img src='../images/icons/disk.png'></td>
<td width='20' ><font face="verdana,arial" color='white'  ><a href=''><img src='../images/icons/disk.png'></td>

</tr>

<?php

}
?>
</table>

