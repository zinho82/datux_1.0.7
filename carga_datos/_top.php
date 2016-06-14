<?php
   session_start();  
/* INCLUDE HOJA DE ESTILOS */
   include("includes/inc.est");
/* INCLUDE CLASE GLOBAL */
 
if($_SESSION[usuario]=="")
{ ?>
<script>
parent.location.href = 'index.php';
</script><?php
}
?>
<table border="0" align="left" cellspacing="5">
<tr><td><font class="main_text_c"><b><a href="logout.php">CERRAR SESIÓN</a></b>
</td></tr>
</table> 
 
 
<table border="0" align="right" cellspacing="5">
<tr><td><font class="main_text_c"><b>Usuario:</b></td><TD><?php echo "<font class=main_text><i>".$_SESSION[nombres]." ".$_SESSION[apellidos]."</b></font>"; ?>
</td></tr>
<tr><td><font class="main_text_c"><b>Nivel:</b></td>
<TD>
<?php if($_SESSION[nivel]== 4) { echo "<font class=main_text><i>SuperAdministrator</b></font>";}  ?>
<?php if($_SESSION[nivel]== 3) { echo "<font class=main_text><i>Administrator</b></font>";}  ?>
<?php if($_SESSION[nivel]== 1) { echo "<font class=main_text><i>Supervisor</b></font>";}  ?>
</td>
</tr>

</table>
 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" background="images/top_bg.gif">
