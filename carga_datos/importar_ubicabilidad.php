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

$connect->consulta("INSERT INTO vicidial_list (`entry_date`, `modify_date`, `status`, `user`, `vendor_lead_code`, `source_id`, `list_id`, `gmt_offset_now`, `called_since_last_reset`, `phone_code`, `phone_number`, `title`, `first_name`, `middle_initial`, `last_name`, `address1`, `address2`, `address3`, `city`, `state`, `province`, `postal_code`, `country_code`, `gender`, `date_of_birth`, `alt_phone`, `email`, `security_phrase`, `comments`, `called_count`, `owner`) 
VALUES ( NOW(),'0000-00-00 00:00:00','NEW','', '$data[0]','$campaign_id','$list_id', '-4.00', 'N','888','$data[7]','SR','','X','','','','$data[9]','','SA','','Chile',2,'','0000-00-00','$data[8]','test@test.com','','', '0','');");

}

//$connect->consulta("UPDATE from vicidial_list set status = 'NOTEL' where list_id = '$list_id' and phone_number =''");
$connect->consulta("DELETE FROM vicidial_list  where list_id = '$list_id' and phone_number =''");





$row = 1;


$fp = fopen ("leads_up/$nombre_archivo","r");
while ($data = fgetcsv ($fp, 1000, ";"))
{
$num = count ($data);
$row++;

$connect->consulta("INSERT INTO sistema_ubicabilidad (`campaign_id`, `list_id`, `rut`, dv,`calle`, `numero`, `resto`, `comuna`, `ciudad`, `telefono1`, `telefono2`, `telefono3`, `telefono4`,`telefono5`,`email1`, `email2`) 
VALUES
('$campaign_id','$list_id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]')");
}

//$connect->consulta("INSERT INTO sistema_datos_campana_notel SELECT NULL,campaign_id,list_id,rut FROM `sistema_ubicabilidad` WHERE telefono_particular ='' and campaign_id = '$campaign_id'");
////ingreso gestiones fantasma (sin telefonos).
//$connect->consulta("insert into sistema_gestiones SELECT 
// NULL, NOW(), `id_datos`, '', sistema_deuda.list_id, '', sistema_deuda.campaign_id, '6666', sistema_deuda.rut, '', '', '', 'NOTEL', '4', '', '', '', 'REGISTRO NO TIENE TELEFONOS', `nro_doc`, `cuota`, `tipo_doc`, `estado_cuota`, `protesto`, MIN(fec_venc), `fec_protesto`, `fec_emision`, `monto`, 'suma_monto',`monto_protesto`, `banco`, `observaciones`, `adicional1`, `adicional2`, `adicional3`, `adicional4`, `adicional5`, `custodio`
// FROM sistema_deuda,sistema_datos_campana_notel where sistema_deuda.campaign_id = '$campaign_id' and sistema_datos_campana_notel.rut = sistema_deuda.rut group by sistema_deuda.rut");

$connect->consulta("TRUNCATE TABLE sistema_datos_campana_notel");

//$connect->consulta("delete FROM  datos_campana2 where list_id = '$list_id' and fono_celular =''");

////Agregar solo pares unicos de telefonos (BORRA DUPLICADOS)
$connect->consulta("insert into vicidial_list_temps  SELECT * FROM vicidial_list where list_id = '$list_id' group by vendor_lead_code,phone_number;");
$connect->consulta("delete from vicidial_list_temps where phone_number = ''");
$connect->consulta("delete from vicidial_list_temps where LENGTH(phone_number) < 8 ");
$connect->consulta("delete from vicidial_list where list_id = '$list_id'");
$connect->consulta("insert into vicidial_list select * from vicidial_list_temps");
$connect->consulta("truncate table vicidial_list_temps");




fclose ($fp);


?>
<br><br><br><br><br><br><br>
<table border="0" cellspacing="10" align="left">
<tr><td><font class="main_text_c">Total Registros</td><td><font class="main_text_c">Unicos</td><td><font class="main_text_c">Pendientes por procesar</td></tr>
<tr><td><font class="main_text_c"><center><b><?php echo $row-1; ?></b></td><td><font class="main_text_c"></td><td><font class="main_text_c"></td></tr>
</table>

 
