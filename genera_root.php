<?php
require("includes/inc.est");
include_once("includes/class/class_global.php");
?>
<head>
  <link rel="stylesheet" href="includes/jquery-ui/jquery.ui.all.css">
  <script src="includes/jquery-ui/jquery-1.7.1.js"></script>
  <script src="includes/jquery-ui/jquery-ui-1.8.17.custom.min.js"></script>
</head>
<style>
body {
  background: url(images/fondo_adm.jpg) no-repeat;
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
  <script>
  $(function() {
	    $( "#asdf" ).click(function() {
	        $( "#dialog" ).dialog( "open" );
	      });
	  
	  $("#dialog").append($("<iframe />").attr({
		  	src: "../deltatry/grid-row-editing-php-backend.html",
		  	width: "600px",
		  	height: "500px",
		  	allowfullscreen: "yes",
		  })).dialog({
		  	autoOpen: false,
			modal: true,
		    resizable: true,
		    width: 655,
		    height: 555,
		    close: function () {
		    	iframe.attr("src", "");
			},
			show: {
		    	effect: "blind",
				duration: 1000
			},
		    hide: {
		    	effect: "explode",
		        duration: 1000
		    }
	    });
  });
  
  </script>


<br>
<fieldset>
<legend ><font face="verdana,arial" size=1><b> MENU PRINCIPAL</b></font></legend>

<table   cellspacing='2' cellpadding="2" align="left" border='0'>
<tr>

<td valign="top">       
<button type="button"  onClick="top.frames['mainFrame'].location.href = 'carga_datos/campaign.php'">
<font class="main_text">GESTION DATOS<br>
<img src="images/Crystal_Clear_app_kontact.png" width='45' height='45' alt="Gestor de art�culos"  />	
</button>    
</td>

<td>
<button type="button"   onClick="top.frames['mainFrame'].location.href = 'grilla/paginacion3.php'">
<font class="main_text">GESTIONES<br>
<img src="images/Crystal_128_kaddressbook-crnagora.png" width='45' height='45' alt="Gestor de art�culos"  />	
</button> 
</td>



<td>
<button type="button"   onClick="top.frames['mainFrame'].location.href = 'genera_root.php'">
<font class="main_text">GENERAR ROOT<br>
<img src="images/Crystal_Clear_mimetype_document2.png" width='45' height='45' alt="Gestor de art�culos"  />	
</button> 
</td>
     
         
<td>	        
<button type="button"  onClick="top.frames['mainFrame'].location.href = 'gestion_manual/index.php'">
<font class="main_text">GESTION MANUAL<br>
<img src="images/clientes.png" width='45' height='45' alt="Gestion Manual"  />	
</button>
</td>

</tr>
</table>
	
</fieldset>

<div id="dialog" title="Mantenedor de &Aacute;rboles">
</div>


<?php

echo "<fieldset><legend><font face='verdana,arial' size=1><b>ABCDIN CARGA TARJETA</font></legend>";
echo "<form action='genera_root.php' method='post'>";
echo "<input type='hidden' name='generar' value='generar'>";
echo "<input type='submit' value='    > GENERAR ROOT <    '>";
echo "</form>";
echo "</fieldset>";
echo "<br>";
echo "<fieldset><legend><font face='verdana,arial' size=1><b>ABCDIN CARGA CONVENIOS</font></legend>";
echo "<form action='genera_root.php' method='post'>";
echo "<input type='hidden' name='generar2' value='generar2'>";
echo "<input type='submit' value='    > GENERAR ROOT <    '>";
echo "</form>";
echo "</fieldset>";



if($_POST['generar']=="generar")
{
echo "<br>";
echo "<fieldset><legend><font size='2'>RESULTADO DE COMANDOS</font></legend>";

exec("sudo /usr/local/bin/scripts/abcdin/cargaABCDIN.sh",$genera);
foreach($genera as $line) { echo "$line<br>"; }

echo "</fieldset>";
}


if($_POST['generar2']=="generar2")
{
echo "<br>";
echo "<fieldset><legend><font size='2'>RESULTADO DE COMANDOS</font></legend>";

exec("sudo /usr/local/bin/scripts/abcdin/cargaABCDIN_conv.sh",$genera);
foreach($genera as $line) { echo "$line<br>"; }

echo "</fieldset>";
}

?> 
