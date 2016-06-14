
<?php
include_once("class_mysql_inc.php");


$pagina= $_REQUEST['pagina'];
$cuantas= $_REQUEST['cuantas'];

if($_REQUEST['desde'] && $_REQUEST['hasta'])
{
$desde= date('Y-m-d',strtotime($_REQUEST['desde']));
$hasta= date('Y-m-d',strtotime($_REQUEST['hasta']));
}


$today = date("Y-m-d");  


$connect = new DB_mysql ;
$connect->conectar();

$limite_inf = ($pagina -1)*$cuantas;
$limite_sup = $cuantas;

//echo $limite_inf.",".$limite_sup;



if($_REQUEST['pagina'] && $_REQUEST['avance'] != 1)
{  
	if($desde && $hasta)
	{
	$opciones = $connect->consulta("SELECT * FROM gestiones_tricot where DATE_FORMAT(fecha,'%Y-%m-%d') >= '$desde' and DATE_FORMAT(fecha,'%Y-%m-%d') <= '$hasta' order by id_gestion limit $limite_inf,$limite_sup ");
	}
	else
	{
	$opciones = $connect->consulta("SELECT * FROM gestiones_tricot order by id_gestion limit $limite_inf,$limite_sup ");
	}
	if(mysql_num_rows($opciones) == 0)
	{
		echo "NO HAY DATOS PARA MOSTRAR";
		echo "<div id='pagina_actual' value='$pagina'>Pagina Actual: $pagina Mostrando: $cuantas Registros FILTRO: $desde,$hasta</div>";
        echo "<div id='cuantas' value='$cuantas'></div>";
	}
	else
	{   
		//echo "<fieldset style='width:1024;'>";
		echo "<table border='1' width='1024'   cellspacing='0' cellpadding='0' >";
		echo "<tr>";
		echo "<div id='pagina_actual' value='$pagina'>Pagina Actual: $pagina Mostrando: $cuantas Registros FILTRO: $desde,$hasta</div>";
        echo "<div id='cuantas' value='$cuantas'></div>";

		echo "<td width='10'><a href='#' onclick='submit();' id=''>IDG</a></td>";
		echo "<td width='160'>FECHA</td>";
		echo "<td width='160'>USUARIO</td>";
		echo "<td width='160'>RUT</td>";
		echo "<td width='160'>TELEFONO</td>";
		echo "<td width='20'>CODIGO</td>";
		echo "<td width='250'>glosa</td>";
		echo "<td width='10'>m</td>";
		echo "<td width='10'>e</td>";
			
		while($row = mysql_fetch_array($opciones))
		{
			 
            echo "<tr>";
            echo "<td><font size='1'>$row[id_gestion]</td>";
            echo "<td><font size='1'>$row[fecha]</td>";
            echo "<td><font size='1'>$row[user]</td>";
            echo "<td><font size='1'>$row[rut_cliente]</td>";
            echo "<td><font size='1'>$row[telefono]</td>";
            echo "<td><font size='1'>$row[cod_gestion]</td>";
            echo "<td><font size='1'>$row[glosa]</td>";
            echo "<td><a href='#' OnClick=modificar_registro($row[id_gestion],'$row[id_gestion]fecha'); >m</a></td>";
            echo "<td><a href='#' OnClick='eliminar_registro();' >e</a></td>";
            echo "</tr>";
						
			
		}
          echo "</table>"; 
          
          //echo "</fieldset>";
	}	
 
}

 ?>
<!-- <a href="javascript:pon_prefijo(<?php echo $codfamilia?>,'<?php echo $referencia?>','js_endode(<?php echo addslashes($descripcion)?>)','<? echo $codarticulo?>')"><img src="../img/convertir.png" border="0" title="Seleccionar"></a>-->
