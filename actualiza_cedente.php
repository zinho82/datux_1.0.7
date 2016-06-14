<?php
 
   session_start();  
/* INCLUDE HOJA DE ESTILOS */
   include("includes/inc.est");
/* INCLUDE CLASE GLOBAL */
   include_once("includes/class/class_mysql_inc.php");
/* DECLARACION DE CONEXION */
   $connect = new DB_mysql;
    
   $connect->conectar();
 
 
  
if($_REQUEST[actualizar] == 'actualizar')
 {
 $cod_cedente = $_REQUEST["cod_cedente"];
 $id_arbol = $_REQUEST["id_arbol"];
  $id_categoria = $_REQUEST["id_categoria"];
$campaign_id_new = $_REQUEST["campaign_id"];
//////////////////////////////////////////////////////////////////////////////////////////////////
$n=0;
$m=0;

foreach($cod_cedente as $cod_cedente)
{   
	$n=$n+1;
//	echo $ip_exten."<br>";
	$array1[$n]=$cod_cedente;
}
foreach($campaign_id_new as $campaign_id_new)
{    
	$m=$m+1;
//	echo $extension."<br>";
	$array2[$m]=$campaign_id_new;
}
$long1= sizeof($array1);
$long2= sizeof($array2);

$result = $connect->consulta("DELETE from sistema_codigos_cedentes_asociacion");
for($i=1;$i<=$long1;++$i)
{
$result = $connect->consulta("INSERT INTO sistema_codigos_cedentes_asociacion(cod_cedente,campana)  values ('$array1[$i]','$array2[$i]')");
//echo "CEDENTE:".$array1[$i]." ";
//echo "CAMPANA:".$array2[$i]."<br>";

}
//////////////////////////////////////////
$result = $connect->consulta("DELETE from sistema_codigos_cedentes_asociacion where cod_cedente = ''");
//////////////////////////////////////////
$n=0;
$m=0;

foreach($id_arbol as $id_arbol)
{   
	$n=$n+1;
//	echo $ip_exten."<br>";
	$array1[$n]=$id_arbol;
}
foreach($campaign_id_new as $campaign_id_new)
{    
	$m=$m+1;
//	echo $extension."<br>";
	$array2[$m]=$campaign_id_new;
}
$long1= sizeof($array1);
$long2= sizeof($array2);

$result = $connect->consulta("DELETE from sistema_arboles_asociacion");
for($i=1;$i<=$long1;++$i)
{
$result = $connect->consulta("INSERT INTO sistema_arboles_asociacion(id_arbol,campaign)  values ('$array1[$i]','$array2[$i]')");
//echo "CEDENTE:".$array1[$i]." ";
//echo "CAMPANA:".$array2[$i]."<br>";
}

$result = $connect->consulta("DELETE from sistema_arboles_asociacion where id_arbol = ''");

//////////////////////////////////////////
$n=0;
$m=0;

foreach($id_categoria as $id_categoria)
{   
	$n=$n+1;
//	echo $ip_exten."<br>";
	$array1[$n]=$id_categoria;
}
foreach($campaign_id_new as $campaign_id_new)
{    
	$m=$m+1;
//	echo $extension."<br>";
	$array2[$m]=$campaign_id_new;
}
$long1= sizeof($array1);
$long2= sizeof($array2);

$result = $connect->consulta("DELETE from sistema_subcategorias_asociacion");
for($i=1;$i<=$long1;++$i)
{
$result = $connect->consulta("INSERT INTO sistema_subcategorias_asociacion(id_categoria,campaign)  values ('$array1[$i]','$array2[$i]')");
//echo "CEDENTE:".$array1[$i]." ";
//echo "CAMPANA:".$array2[$i]."<br>";
}

$result = $connect->consulta("DELETE from sistema_subcategorias_asociacion where id_categoria = ''");


?>


<script>
//window.alert("Ha ingresado un Rut y/o password incorrecto ");
top.frames['mainFrame'].location.href = 'menu_central.php';
</script>

<?php
 
}