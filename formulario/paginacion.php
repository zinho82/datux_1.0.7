<?php
include_once("class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();
 
$result = $connect->consulta("SELECT * from gestiones_tricot");


?>

		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
		</style>

		<!-- <META HTTP-EQUIV='Refresh' CONTENT='1'> !-->
<style>
/* Gradient 1 */
.tb10 {
	background-image:url(images/form_bg.jpg);
	background-repeat:repeat-x;
	border:1px solid #d1c7ac;
	/*width: 230px; */
	color:#333333;
	padding:0px;
	margin-right:4px;
	margin-bottom:8px;
	font-family:tahoma, arial, sans-serif;
	font-size:12;
}

.btn {
  display: inline-block;
  background: transparent url(http://2.bp.blogspot.com/_hljKDuw-cxQ/S32eVQZttxI/AAAAAAAAPKg/ZEPhOn59Rec/s00/demoBoton2.png) repeat-x 0 0;
  border: 1px solid rgba(0,0,0,0.4);
  padding: 1px 2px 2px 5px;
  font-weight: bold;
  text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
  -moz-border-radius: 10px;
  -moz-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
  -webkit-border-radius: 5px;
  -webkit-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
}



fieldset {
//border: 1px solid #CCA383;
border: outset gray 3px;   
width: 1024;
background: #dfedf3;
padding: 3px;
}
fieldset legend {
background: #e0e0e0;
border: 1px solid #CCA383;
padding: 1px;
font-weight: bold;



input[type="text"]:focus  {
border: thin #000000 solid;
background: #F4FA58;
color: #000000;
}
input[type="text"]:focus:hover {
border: thin #000000 solid;
filter:alpha(opacity=100);-moz-opacity:1;opacity:1;
background: #F4FA58;
color: #000000;
}

</style>

		
		
		
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>
	</head>
	
<fieldset>
	<legend>Base de Gestiones</legend>
	<body id="dt_example" class="example_alt_pagination">
		 	
			<div id="demo">
			
			<table border='1' width='1024'   cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;"  id="example">
			

	<thead >
		<tr  background='images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
			<th width='160'><font face="verdana,arial" size=2 >FECHA</th>
			<th><font face="verdana,arial" size=2 >USUARIO</th>
			<th><font face="verdana,arial" size=2 >RUT</th>
			<th><font face="verdana,arial" size=2 >TELEFONO</th>
			<th width='10'><font face="verdana,arial" size=2 >COD</th>
			<th><font face="verdana,arial" size=2 >GLOSA</th>
 
			<th width="10"><font face="verdana,arial" size=2 ></th>
			<th width="10"><font face="verdana,arial" size=2 ></th>
			</tr>
	</thead>
	
	<tbody>
	
	<?php
	while($row = mysql_fetch_array($result))
{
	
    ?>
	
		<tr>
			<td><font face="verdana,arial" size=2 ><?php echo $row["fecha"]; ?></td>
			<td><font face="verdana,arial" size=2 ><?php echo $row["user"]; ?></td>
				
			<td><font face="verdana,arial" size=2 ><?php echo $row["rut_cliente"]; ?></td>
			<td class="center"><font face="verdana,arial" size=2 ><?php echo $row["telefono"]; ?></td>
 <td class="center"><font face="verdana,arial" size=2 ><?php echo $row["cod_gestion"]; ?></td>
			<td class="center"><font face="verdana,arial" size=2 ><?php echo $row["glosa"]; ?></td>
			
			<td class="center"><a href='<?php echo $row["user"]; ?>'><img src='images/icons/accept.png'></a></td>
			<td class="center"><a href='<?php echo $row["rut_cliente"]; ?>'><img src='images/icons/delete.png'></a></td>
		</tr>
		
   <?php
}
?>		
		
	</tbody>
	
	<tfoot>
	<tr  background='images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
			<th><font face="verdana,arial" size=2 >FECHA</th>
			<th><font face="verdana,arial" size=2 >USUARIO</th>
			<th><font face="verdana,arial" size=2 >RUT</th>
			<th><font face="verdana,arial" size=2 >TELEFONO</th>
			<th><font face="verdana,arial" size=2 >COD.GESTION</th>
 
			<th><font face="verdana,arial" size=2 >GLOSA</th>
			<th width="10"><font face="verdana,arial" size=2 ></th>
			<th width="10"><font face="verdana,arial" size=2 ></th>
			</tr>
	</tfoot>
</table>

			</div>
			</div>
 </fieldset>