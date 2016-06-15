
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
 

<?php
$list_id = $_REQUEST["list_id"];
$campaign_id = $_REQUEST["campaign_id"];
$cod_cedente = $_REQUEST["cod_cedente"];

require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");
?>
 
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
 

<fieldset>
<legend ><font face="verdana,arial" size=1><b> CARGA DE BASE ORIGINAL </b></font></legend>

 <table border="0" cellspacing="0" align="center" width="95%">
 <tr><td>
<center> <FONT CLASS="main_text"><b>Agregar Registros a la lista (DEUDAS)<?php echo $list_id; ?>, Campaña: <?php echo $_GET[campaign_id]; ?>
		</td></tr>
		</table>
	<br>
	<table border="0" cellspacing="0" align="center" width="95%">
 <tr><td background="imagenes/sesion.gif">
<center> <FONT CLASS="main_text"><b>Importar desde planilla CVS 
		</td></tr>
		<tr><td>
		<center><br><font class="main_text_c">Seleccione su archivo CSV<br><br> 
<form enctype="multipart/form-data" method="post" action="importar_deuda.php" name="uploadform">
				<input type="file" name="file1">
				<input type="hidden" name="list_id" value="<?php echo $list_id; ?>">
				<input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
				<input type="hidden" name="cod_cedente" value="<?php echo $cod_cedente; ?>">
			 <input type="submit" value="enviar" name="invio">
		
</form>
		</tD></tr> 
	 
		</table>	
	 
    </fieldset>