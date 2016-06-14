
<?php
include_once("../includes/class/class_mysql_inc.php");


$pagina= $_REQUEST['pagina'];
$cuantas= $_REQUEST['cuantas'];

if($_REQUEST['desde'] && $_REQUEST['hasta'])
{
$desde= date('Y-m-d',strtotime($_REQUEST['desde']));
$hasta= date('Y-m-d',strtotime($_REQUEST['hasta']));
}
else 
{
$desde= date('Y-m-d');
$hasta= date('Y-m-d');
}

$today = date("Y-m-d");  
$rut = $_REQUEST["rut"];

$connect = new DB_mysql ;
$connect->conectar();

$limite_inf = ($pagina -1)*$cuantas;
$limite_sup = $cuantas;




if($_REQUEST['pagina'] && $_REQUEST['avance'] != 1)
{  
	if($desde && $hasta)
	{
	$opciones = $connect->consulta("SELECT * FROM sistema_gestiones where DATE_FORMAT(fecha,'%Y-%m-%d') >= '$desde' and DATE_FORMAT(fecha,'%Y-%m-%d') <= '$hasta' and rut_cliente like '%$rut%'  group by id_gestion  order by id_gestion limit $limite_inf,$limite_sup ");
	}
	else
	{
	$opciones = $connect->consulta("SELECT * FROM sistema_gestiones where DATE_FORMAT(fecha,'%Y-%m-%d') >= '$desde' and DATE_FORMAT(fecha,'%Y-%m-%d') <= '$hasta' and rut_cliente like '%$rut%'  group by id_gestion  order by id_gestion limit $limite_inf,$limite_sup ");
	}
	if(mysql_num_rows($opciones) == 0)
	{
		echo "NO HAY DATOS PARA MOSTRAR";
		echo "<div id='pagina_actual' value='$pagina'>Pagina Actual: $pagina Mostrando: $cuantas Registros FILTRO: $desde,$hasta</div>";
        echo "<div id='cuantas' value='$cuantas'></div>";
	}
	else
	{   
		foreach($opciones as $key2 => $value) 
   			{ 
   	  			$linea .= $value.";"; 
       	   }
   
		//echo "<fieldset style='width:1024;'>";
		echo "<table border='0' width='1024'   cellspacing='1' cellpadding='1' >";
		echo "<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>";
		echo "<div id='pagina_actual' value='$pagina'>Pagina Actual: $pagina Mostrando: $cuantas Registros FILTRO: $desde,$hasta</div>";
        echo "<div id='cuantas' value='$cuantas'></div>";
        
		echo "<td width='70'><a href='#' onclick='submit();' id=''>CAMPA&Ntilde;A</a></td>";
		echo "<td width='150'>FECHA</td>";
		echo "<td width='100'>USUARIO</td>";
		echo "<td width='100'>RUT</td>";
		echo "<td width='100'>TELEFONO</td>";
		echo "<td width='50'>CODIGO</td>";
		echo "<td width='480'>GLOSA</td>";
		echo "<td width='10'>G</td>";
		echo "<td width='10'>F</td>";

////// exporte
//

 
   

}
// 
		
		
			
		while($row = mysql_fetch_array($opciones))
		{
			 
			?> <tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">
 <?php
        
            echo "<td><font face='verdana,arial' size='1'>$row[campaign]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[fecha]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[user]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[rut_cliente]</td>";
            echo "<td><font face='verdana,arial' size='1''>$row[telefono]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[cod_gestion]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[glosa]</td>";
            echo "<td><font face='verdana,arial' size='1'><a href='http://192.168.25.3/RecordingsAPI/rec.php?datux=recordings&lead_id=$row[user]&phone_number=$row[telefono]&user=$row[user]&campaign_id=$row[campaign]' title='Descargar grabacion'><img src='../images/icons/1293025016_folder_explore.png'></a></td>";
//             echo "<td><font face='verdana,arial' size='1'><a href='http://192.168.60.107/RecordingsAPI/rec.php?datux=recordings&lead_id=$row[user]&phone_number=$row[telefono]&user=$row[user]&campaign_id=$row[campaign]' title='Descargar grabacion'><img src='../images/icons/1293025016_folder_explore.png'></a></td>";
//             echo "http://192.168.60.107/RecordingsAPI/rec.php?datux=recordings&lead_id=$row[lead_id]&phone_number=$row[telefono]&user=$row[user]&campaign_id=$row[campaign]";
          //  echo "<td><a href='#' OnClick=modificar_registro($row[id_gestion],'$row[id_gestion]fecha'); >m</a></td>";
          //  echo "<td><a href='#' OnClick='eliminar_registro();' >e</a></td>";
            echo "<td>
            ";?><a href='#' onclick="javascript:window.open('../formulario/index.php?vendor_id=<?php echo $row[rut_cliente]; ?>&campaign=<?php echo $row[campaign]; ?>&dialed_number=<?php echo $row[telefono]; ?>&list_id=<?php echo $row[list_id]; ?>&user=<?php echo $_SESSION[user]; ?>&id_datos=<?php echo $row[id_datos]; ?>','ventanita','statusbar=no,width=1100,height=650,location=no' );return false"><img src='../images/icons/application_view_detail.png'></a>
            </td>
            <?php
            
     
            echo "</tr>";
						
			
		}
          echo "</table>"; 
          
          //echo "</fieldset>";
	}	
 


 ?>
<!-- <a href="javascript:pon_prefijo(<?php echo $codfamilia?>,'<?php echo $referencia?>','js_endode(<?php echo addslashes($descripcion)?>)','<? echo $codarticulo?>')"><img src="../img/convertir.png" border="0" title="Seleccionar"></a>-->
