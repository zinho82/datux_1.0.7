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
$cod_cedente = $_REQUEST["cod_cedente"];

echo $campaign_id;
  
 //*****************************************
 
if (isset($_POST["invio"])) {
  $percorso = "leads_up/";
  if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    if (move_uploaded_file($_FILES['file1']['tmp_name'], $percorso.$_FILES['file1']['name'])) {
   ?><table border="0" cellspacing="10" align="left">
     <tr><td><font class="main_text_c"><?php   echo 'Nombre archivo: <b>'.$_FILES['file1']['name'].'</td></tr>';
      echo '<tr><td><font class="main_text_c">tipo MIME: <b>'.$_FILES['file1']['type'].'</b></td></tr>';
      echo '<tr><td><font class="main_text_c">Dimensiones: <b>'.$_FILES['file1']['size'].'</b> byte</td></tr>';
      echo '<tr><td>======================</td></tr></table>';
      
     
    } else {
      echo "No se ha podido completar la instruccion: ".$_FILES["file1"]["error"];
    }
  } else {
    echo "no se a podido completar la instruccion: ".$_FILES["file1"]["error"];
  }
}
$nombre_archivo=$_FILES['file1']['name'];
 
 /********************************************/
 
 
$row = 1;


$fp = fopen ("leads_up/$nombre_archivo","r");
while ($data = fgetcsv ($fp, 1000, ";"))
{
$num = count ($data);
$row++;

$connect->consulta("INSERT INTO sistema_deuda (
`campaign_id`, `rut`, `dv`, `nro_doc`, `total_cuotas`, `tipo_doc`, `estado_deuda`, `cuotas_vencidas`, `fec_venc`, `fec_asignacion`, `fec_colocacion`, `monto`, `deuda_total`, `abono`, `fecha_abono`, `deuda_morosa`, `cuotas_pagadas`, `fecha_actualizacion`, `cartera`, `tramo`, `valor_cuota`, `saldo_cuota`, `provision_credito`, `dias_de_mora`, `cod_producto`, `oferta1`, `oferta2`, `adicional1`, `adicional2`, `adicional3`, `adicional4`, `adicional5`, `cod_cedente`
) 
VALUES
('$campaign_id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]','$cod_cedente')");
}


fclose ($fp);



?>
<br><br><br><br><br><br><br>
<table border="0" cellspacing="10" align="left">
<tr><td><font class="main_text_c">Total Registros</td><td><font class="main_text_c">Unicos</td><td><font class="main_text_c">Pendientes por procesar</td></tr>
<tr><td><font class="main_text_c"><center><b><?php echo $row-1; ?></b></td><td><font class="main_text_c"></td><td><font class="main_text_c"></td></tr>
</table>

 
