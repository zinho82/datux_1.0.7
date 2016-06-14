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


//borra pagos que no esten en la asignacion
$connect->consulta("delete FROM ruts_pagos where rut NOT IN (select rut from sistema_deuda where campaign_id = '$campaign_id') and campaign_id = '$campaign_id'");


/////////////////////////////////////////////////
$connect->consulta("insert into sistema_pagos (campaign, rut, dv, tipo_documento, num_documento,fec_venc,monto, intereses, honoriarios, total_pagado, forma_pago,fec_pago,tipo_pago) 
values ('$campaign_id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[HONO7]','$data[8]','$data[9]','$data[10]','$data[11]')");

$connect->consulta("insert into ruts_pagos (rut,fecha_pago,monto_pago,campaign_id,archivo) values ('$data[0]','$data[10]','$data[8]','$campaign_id','$nombre_archivo')");

//borra pagos que no esten en la asignacion
$connect->consulta("delete FROM sistema_pagos where rut NOT IN (select rut from sistema_deuda where campaign_id = '$campaign_id') and campaign = '$campaign_id'");
$connect->consulta("delete FROM ruts_pagos where rut NOT IN (select rut from sistema_deuda where campaign_id = '$campaign_id') and campaign_id = '$campaign_id'");

$connect->consulta("INSERT INTO sistema_gestiones
		select NULL,now(),sd.id_deuda,'','','',sd.campaign_id,'VDAD',sd.rut,'','','','','','GFONO','CANC','','','',CONCAT('CLIENTE PAGO EL ',sistema_pagos.fecha,' LA SUMA DE ',sistema_pagos.total_pagado),sistema_pagos.num_documento,sd.total_cuotas,sd.tipo_doc,sd.estado_deuda,sd.cuotas_vencidas,sd.fec_venc,sd.fec_asignacion,sd.fec_colocacion,sd.monto,sd.deuda_total,sd.abono,sd.fecha_abono,sd.deuda_morosa,sd.cuotas_pagadas,sd.fecha_actualizacion,sd.cartera,sd.tramo,sd.adicional1,sd.adicional2,sd.adicional3,sd.adicional4,sd.adicional5,sd.cod_cedente,'','','','','','','',''
		FROM sistema_pagos,sistema_deuda sd
		where sistema_pagos.rut = sd.rut
		AND sd.campaign_id = '$campaign_id'
		AND sd.nro_doc = sistema_pagos.num_documento
		AND sistema_pagos.num_documento = '$data[3]'
		AND sistema_pagos.rut = '$data[0]'
		limit 1;");

//ingresa informacion de pagos en tabla temporal
//ingresa gestiones CANC cruzado con tabla temporal


//vacia tabla temporal
//$connect->consulta("truncate table ruts_pagos");
//CAMBIA A ESTADO PAGT los registros de PAGO TOTAL.
//$connect->consulta("UPDATE  vicidial_list,pagos_corona  set vicidial_list.status = 'SPC' where vendor_lead_code = rut and  id_campana = '$campaign_id' and tipo_pago = 'Pago Total' and source_id = '$campaign_id'");

}


$connect->consulta("UPDATE vicidial_list SET status = 'ALDIA' where vendor_lead_code IN (select rut_cliente from sistema_gestiones where user = 'VDAD' and glosa LIKE 'CLIENTE PAGO EL %' AND source_id = '$campaign_id') AND source_id = '$campaign_id'");


fclose ($fp);
/////////////////////////////////////////////////////







?>
<br><br><br><br><br><br><br>
<table border="0" cellspacing="10" align="left">
<tr><td><font class="main_text_c">Total Registros</td><td><font class="main_text_c">Unicos</td><td><font class="main_text_c">Pendientes por procesar</td></tr>
<tr><td><font class="main_text_c"><center><b><?php echo $row-1; ?></b></td><td><font class="main_text_c"></td><td><font class="main_text_c"></td></tr>
</table>