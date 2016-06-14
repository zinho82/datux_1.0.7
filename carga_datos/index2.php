<?php
   session_start();  
/* INCLUDE HOJA DE ESTILOS */
   include("includes/inc.est");
/* INCLUDE CLASE GLOBAL */
   include_once("includes/class/class_global.php");
/* DECLARACION DE CONEXION */
   $connect = new DB_mysql;
    
   $connect->conectar();
 
 ?>
<?php include("includes/ips.php"); ?>
 


<table border="0" cellspading="0" cellspacing="0" align="center" width="100%">
 <tr>

	  <td width="100%" height="350" valign="top">
		<!--  AREA CENTRAL !-->
		<center><br>
		<font class="main_text_c"><b>ADMINISTRACIÓN SISTEMA - VICIDIAL
		<br><br><br>
		<table border="0" align="center" cellspacing="10" align="middle">
		<tr>
		<td><a href="campaign.php"><img src="images/copy.gif"  border="0"></td>
	 
		<td><a href="reportes/index.php"><img src="images/report.gif"  border="0"></td>
		<td><a href="graphs/index.php"><img src="images/bar_chart_v5.gif"  border="0"></td>
		<td><a href="<?php echo $_SESSION[server]; ?>"><img src="images/properties.gif"  border="0"></td>
		<td><a href="backups.php"><img src="images/backup_data.gif"  border="0"></td>
	
		 		</tr>
		<tr>
		<td>
		<font class="main_text_c"><center><b>Carga 
		</td>
  <td>
		<font class="main_text_c"><center><b>Reportes
		</td>
  <td>
		<font class="main_text_c"><center><b>Gráficos
		</td>
		<td>
		<font class="main_text_c"><center><b>Monitor
		</td>
		<td>
		<font class="main_text_c"><center><b>Backups
		</td>
		</tr>
		
		
		</table>
		<hr width="500" align="center">
 
<img src="images/logo.jpg" width="300">
		
		<!-- FIN AREA CENTRAL !-->
    </td>	
	 
	 </tr>
	
</table>



 