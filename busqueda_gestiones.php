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
$prefix='56';
 
 /********************************************/
 
 
$row = 1;

$fp = fopen ("leads_up/$nombre_archivo","r");
while ($data = fgetcsv ($fp, 1000, ";"))
{
$num = count ($data);
$row++;

//if($data["26"] == '' or $data["25"] = '')
//$prefix = '';
//else 
//$prefix = '56';



//ingresa base de pagos
$connect->consulta("INSERT INTO ruts (rut)
VALUES
('$data[0]')");

 
} 




$titulos = $connect->consulta("SELECT  `fecha`, gestiones_tricot.list_id, gestiones_tricot.lead_id, `campaign`, `user`, `rut_cliente`,deuda_total, dias_morosidad,'tramo',gestiones_tricot.telefono, `nuevo_telefono`,  `cod_gestion`, `cod_contacto`, `fecha_compromiso`, `monto_compromiso`, `nombre_contacto`, fecha_proximo_venc,valor_cuota, `glosa` from gestiones_tricot,datos_campana2 where campaign = '$campaign_id' and gestiones_tricot.id_datos = datos_campana2.id_datos order by gestiones_tricot.id_datos limit 1");
$fix = $connect->consulta("UPDATE gestiones_tricot SET glosa = REPLACE(glosa,'\n',' ')");
$fix = $connect->consulta("UPDATE gestiones_tricot SET glosa = REPLACE(glosa,'\r',' ')");
//
$f = fopen("reporte.csv","w");
$separador = ";";

$sw=1;
while($row = mysql_fetch_assoc($titulos)) {
   
   
   
	foreach($row as $key => $value) 
   { 
   	  $linea .= $key.";"; 
      
   }
   $linea .="\n";
}
$datos = $connect->consulta("SELECT  `fecha`, gestiones_tricot.list_id, gestiones_tricot.lead_id, `campaign`, `user`, `rut_cliente`,deuda_total,dias_morosidad, 
(CASE  WHEN dias_morosidad <= 270 THEN 'TRAMO1'  WHEN dias_morosidad >= 271 and dias_morosidad <= 360 THEN 'TRAMO2'  WHEN dias_morosidad >= 361 and dias_morosidad <= 720 THEN 'TRAMO3'   WHEN dias_morosidad >= 721 and dias_morosidad <= 1080 THEN 'TRAMO4'  WHEN dias_morosidad > 1080 THEN 'TRAMO5'  ELSE 0 END) as tramo,
gestiones_tricot.telefono, `nuevo_telefono`,  `cod_gestion`, 
CASE 
WHEN cod_contacto = '1' THEN 'CONTACTO DIRECTO' 
WHEN cod_contacto = '2' THEN 'CONTACTO TERCERO'
WHEN cod_contacto = '3' THEN 'SIN CONTACTO'
WHEN cod_contacto = '4' THEN 'INUBICABLE'
ELSE 0 END AS cod_contacto
, `fecha_compromiso`, `monto_compromiso`,`nombre_contacto`, fecha_proximo_venc,valor_cuota,`glosa` from gestiones_tricot,datos_campana2 where campaign = '$campaign_id' and gestiones_tricot.id_datos = datos_campana2.id_datos and gestiones_tricot.rut_cliente2 IN (select rut from ruts) order by gestiones_tricot.id_datos");

while($row2 = mysql_fetch_assoc($datos)) {
   
	foreach($row2 as $key2 => $value) 
   { 
   	  $linea .= $value.";"; 
      
   }
   
   $linea .="\n";
}
fwrite($f,$linea);

$filename = $campaign_id."-Gestiones-RUTS-".date("YmdHi",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $linea;
exit;






$connect->consulta("truncate table ruts");

fclose ($fp);
?>














?>
 
