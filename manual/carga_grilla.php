<?php
session_start();
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

//echo $limite_inf.",".$limite_sup;


if($_REQUEST['pagina'] && $_REQUEST['avance'] != 1)
{  
	$opciones = $connect->consulta("SELECT * FROM sistema_deudor where rut like '%$rut%' and campaign_id = '$_SESSION[campaign_id]' group by rut order by id_datos  limit $limite_inf,$limite_sup ");

	if(mysql_num_rows($opciones) == 0)
	{
		echo "NO HAY DATOS PARA MOSTRAR";
		echo "<div id='pagina_actual' value='$pagina'>Pagina Actual: $pagina Mostrando: $cuantas Registros FILTRO: $desde,$hasta</div>";
        echo "<div id='cuantas' value='$cuantas'></div>";
	}
	else
	{   
		//echo "<fieldset style='width:1024;'>";
		echo "<table border='0' width='1024'   cellspacing='1' cellpadding='0' >";
		echo "<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>";
		echo "<div id='pagina_actual' value='$pagina'>Pagina Actual: $pagina Mostrando: $cuantas Registros FILTRO: $desde,$hasta</div>";
        echo "<div id='cuantas' value='$cuantas'></div>";

		echo "<td width='50'>LISTA</td>";
		echo "<td width='100'>CAMPAÑA</td>";
		echo "<td width='100'>RUT CLIENTE</td>";
		echo "<td width='400'>NOMBRES</td>";
		echo "<td width='120'>APELLIDO 1</td>";
		echo "<td width='120'>APELLIDO 2</td>";
		echo "<td width='120'>DEUDA MOROSA</td>";
		
		echo "<td width='10'>F</td>";
		echo "<td width='10'>E</td>";
			
		while($row = mysql_fetch_array($opciones))
		{
			 
            echo "<tr>";
            echo "<td><font face='verdana,arial' size='1'>$row[list_id]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[campaign_id]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[rut]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[nombre]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[apellido_paterno]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[apellido_materno]</td>";
            echo "<td><font face='verdana,arial' size='1'>$row[deuda_morosa]</td>";


          //  echo "<td><a href='#' OnClick=modificar_registro($row[id_gestion],'$row[id_gestion]fecha'); >m</a></td>";
          //  echo "<td><a href='#' OnClick='eliminar_registro();' >e</a></td>";
          //  echo "<td><a href='../formulario/index.php?id_datos=$row[id_datos]'>M</a></td>";
             
          //echo "<td><a href='../formulario/index.php?vendor_id=$row[rut]&campaign=$row[campaign_id]&dialed_number=$row[fono1]&list_id=$row[list_id]&user=$_SESSION[user]'><img src='../images/icons/application_view_detail.png'></a></td>";
	      //    echo "<td><a href=javascript:window.open('../formulario/index.php?vendor_id=$row[rut]&campaign=$row[campaign_id]&dialed_number=$row[fono1]&list_id=$row[list_id]&user=$_SESSION[user]','','toolbar=1,scrollbars=1,location=1,statusbar=0,menubar=1,resizable=1,width=950,height=690')><img src='../images/icons/application_view_detail.png'></a></td>";
          //  echo "<a href='http://www.google.com' target='ventanita' onclick='window.open('', 'ventanita', 'width=400,height=400')' > abrir </a>";
          //echo "<a href='#' onclick='javascript:window.open('../formulario/index.php?vendor_id=$row[rut]&campaign=$row[campaign_id]&dialed_number=$row[fono1]&list_id=$row[list_id]&user=$_SESSION[user]','ventanita','width=400,height=400');return false'>abrir</a>";
          //echo "<td>"; 

          ?> <td><a href='#' onclick="javascript:window.open('../formulario/index.php?vendor_id=<?php echo $row[rut]; ?>&campaign=<?php echo $row[campaign_id]; ?>&dialed_number=<?php echo $row[fono_celular]; ?>&list_id=<?php echo $row[list_id]; ?>&user=<?php echo $_SESSION[user]; ?>&id_datos=<?php echo $row[id_deuda]; ?>','ventanita','statusbar=no,width=1100,height=600,location=no' );return false"><img src='../images/icons/application_view_detail.png'></a> </td><?php
          //echo "</td>";
            echo "<td><a href='#'><img src='../images/icons/delete.png'></a></td>";
     
            echo "</tr>";
						
			
		}
          echo "</table>"; 
          
          //echo "</fieldset>";
	}	
 
}

 ?>
<!-- <a href="javascript:pon_prefijo(<?php echo $codfamilia?>,'<?php echo $referencia?>','js_endode(<?php echo addslashes($descripcion)?>)','<? echo $codarticulo?>')"><img src="../img/convertir.png" border="0" title="Seleccionar"></a>-->
