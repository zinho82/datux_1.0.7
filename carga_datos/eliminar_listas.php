<?php
require("includes/inc.est");
include_once("includes/class/class_global.php");
$connect = new DB_mysql ;
$connect->conectar();

$listas = $_REQUEST["option"];
$campaign_id = $_REQUEST["campaign_id"];

foreach($listas as $listas)
{
	echo "listas a borrar: ".$listas."<br>";
	$result = $connect->consulta("delete from vicidial_lists where list_id = '$listas'");
	$result = $connect->consulta("delete from vicidial_list where list_id = '$listas'");
	
}
echo "se han borrado las listas seleccionadas. <a href='javascript:window.history.back();'>Volver</a>";

echo "ID CAMPAÑA:".$campaign_id;

?>
<script>
//window.alert("Ha ingresado un Rut y/o password incorrecto ");
top.frames['mainFrame'].location.href = 'ver_listas.php?campaign_id=<?php echo $campaign_id; ?>';
</script>