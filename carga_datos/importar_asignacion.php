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
  $percorso = "/var/www/html/sistema_gestion/archivos/";
  if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
   //echo   move_uploaded_file($_FILES['file1']['tmp_name'], $percorso.$_FILES['file1']['name']);
    if (move_uploaded_file($_FILES['file1']['tmp_name'], $percorso."sistema_temporal_asig_hites.csv")) {
         if (move_uploaded_file($_FILES['file2']['tmp_name'], $percorso."sistema_temporal_pob_hites.csv")) {
   ?><table border="0" cellspacing="10" align="left">
     <tr><td><font class="main_text_c"><?php   echo 'Nombre archivo: <b>'.$_FILES['file1']['name'].'</td></tr>';
      echo '<tr><td><font class="main_text_c">tipo MIME: <b>'.$_FILES['file1']['type'].'</b></td></tr>';
      echo '<tr><td><font class="main_text_c">Dimensiones: <b>'.$_FILES['file1']['size'].'</b> byte</td></tr>';
      echo '<tr><td>======================</td></tr></table>';
         }
         echo shell_exec("/usr/local/bin/scripts/hites/carga_Hites.sh");
         define("BASE_BD", "asterisk");
define("TBL_TEMPORAL", "sistema_temporal_pob_hites");
date_default_timezone_set('America/Santiago');
require_once '/var/www/html/sistema_gestion/carga/carga/core/conexion.php';
require_once '/var/www/html/sistema_gestion/carga/carga/core/Carga.php';
$carga=new Carga();
$carga->Reparar_fonos_1campo("celca2", TBL_TEMPORAL, BASE_BD, "estado");
$carga->Reparar_fonos_1campo("celca1", TBL_TEMPORAL, BASE_BD, "estado");
$carga->Reparar_fonos_1campo("celpa1", TBL_TEMPORAL, BASE_BD, "estado");
$carga->Reparar_fonos_1campo("celpa2", TBL_TEMPORAL, BASE_BD, "estado");
$carga->Reparar_fonos_1campo("fonal", TBL_TEMPORAL, BASE_BD, "estado");
echo shell_exec(" /usr/local/bin/scripts/hites/carga_Hites_2.sh");
    } else {
      echo "No se ha podido completar la instruccion 1: ".$_FILES["file1"]["error"];
    }
  } else {
    echo "no se a podido completar la instruccion 2: ".$_FILES["file1"]["error"];
  }
}
$nombre_archivo=$_FILES['file1']['name'];
 
 /********************************************/
  
 


?>
<br><br><br><br><br><br><br>
<table border="0" cellspacing="10" align="left">
<tr><td><font class="main_text_c">Total Registros</td><td><font class="main_text_c">Unicos</td><td><font class="main_text_c">Pendientes por procesar</td></tr>
<tr><td><font class="main_text_c"><center><b><?php // echo $row-1; ?></b></td><td><font class="main_text_c"></td><td><font class="main_text_c"></td></tr>
     
      <br><b>  Archivos</b><br/>
                             <?php if(is_file("/var/www/html/sistema_gestion/archivos/cargar/HITES_carga_deuda_".date('Ymd').".csv")):?>
                             <a href="http://sistema.dev/archivos/cargar/HITES_carga_deuda_<?php echo date('Ymd') ?>.csv"> Descargar Deuda</a>
                             <?php else:?>
                             Sin Arhivo de Deuda
                             <?php                                endif;?>
                             <br/>
                              <?php if(is_file("/var/www/html/sistema_gestion/archivos/cargar/HITES_carga_deudor_".date('Ymd').".csv")):?>
                             <a href="http://sistema.dev/archivos/cargar/HITES_carga_deudor_<?php echo date('Ymd') ?>.csv"> Descargar Deudores</a>
                             <?php else:?>
                             Sin Arhivo de deudor
                             <?php                                endif;?>
                             <br>
                              <?php if(is_file("/var/www/html/sistema_gestion/archivos/cargar/HITES_carga_ubicabilidad_".date('Ymd').".csv")):?>
                             <a href="http://sistema.dev/archivos/cargar/HITES_carga_ubicabilidad_<?php echo date('Ymd') ?>.csv"> Descargar Ubicabilidad</a>
                             <?php else:?>
                             Sin Arhivo de Ubicabilidad
                             <?php                                endif;?>
                             <br>
</table>

 
