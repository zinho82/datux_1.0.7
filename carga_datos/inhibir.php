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
$connect->consulta("truncate table ruts");

while ($data = fgetcsv ($fp, 1000, ";"))
{
$num = count ($data);
$row++;

$connect->consulta("INSERT INTO ruts (rut) VALUES ('$data[0]')");

}
$connect->consulta("insert into vicidial_list_pagados select * from vicidial_list where vendor_lead_code IN (select rut from ruts) and list_id = '$list_id'");
$connect->consulta("delete FROM vicidial_list WHERE vendor_lead_code IN (select vendor_lead_code from vicidial_list_pagados) and list_id = '$list_id'");
$opciones1 = $connect->consulta("delete FROM sistema_deuda WHERE rut IN (select vendor_lead_code from vicidial_list_pagados WHERE list_id = '$list_id')");
$opciones2 = $connect->consulta("delete FROM sistema_deudor WHERE rut IN (select vendor_lead_code from vicidial_list_pagados WHERE list_id = '$list_id')");
$opciones3 = $connect->consulta("delete FROM sistema_ubicabilidad WHERE rut IN (select vendor_lead_code from vicidial_list_pagados WHERE list_id = '$list_id')");
$opciones3 = mysql_affected_rows();
$connect->consulta("truncate table ruts");


fclose ($fp);
echo "Se han eliminado los registros, filas afectadas: ".$opciones3;


?>
<br><br><br><br><br><br><br>

 
