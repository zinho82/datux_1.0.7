<?php
session_start();  
/* INCLUDE HOJA DE ESTILOS */
require("../includes/inc.est");

include_once("../includes/class/class_mysql_inc.php");


/* DECLARACION DE CONEXION */
   $connect = new DB_mysql;
    
   $connect->conectar();
   

?>
 

 
<?php
$list_id = $_REQUEST["list_id"];
$campaign_id = $_REQUEST["campaign_id"];



//$connect->consulta("delete from sistema_deuda where campaign_id  = '$campaign_id'");
//$connect->consulta("delete from sistema_deudor where list_id  = '$list_id'");
$connect->consulta("delete from sistema_deuda where campaign_id  = '$campaign_id'");

?>
<script>
//window.alert("Ha ingresado un Rut y/o password incorrecto ");
top.frames['mainFrame'].location.href = 'ver_listas.php?campaign_id=<?php echo $campaign_id; ?>';
</script>


