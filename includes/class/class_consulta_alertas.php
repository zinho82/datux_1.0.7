<?php
include_once("class_mysql_inc.php");
class consulta_alertas extends DB_mysql
{
function verconsulta_alertas() 
{// mostrarmos los registros
if ($this->Conexion_ID and $this->Consulta_ID ) 
{
?>
<table border="0" cellspacing="0" cellpading="0" width="95%" align="center">
<TR align="center"> 
          <TH COLSPAN="4" width="100%" height="30" bgcolor="DCE2C6" background="images/noticias_nacionales.png"> 
        	</th>
</tr>
<?php
if($row = mysql_fetch_array($this->Consulta_ID)) 
{
?>
<tr><td width="400" valign="top">
<font class="main_text_c"><b><?php  echo $row["titulo"]; ?><br>
<font class="main_text_c">
<div align="justify">
<?php  echo $row["descripcion"]; ?><br><br>
<font class="main_text_c"><b>Fuente:</b>&nbsp;<a href="http://<?php echo $row["fuente_alerta"]; ?>"><?php echo $row["fuente_alerta"]; ?></a>
</div></td>
<td><img src="images/<?php echo $row["imagen"]; ?>" width="150"></td>
</tr>
<?php 
}
?>
</table>
 <?php

 }
 }
 }