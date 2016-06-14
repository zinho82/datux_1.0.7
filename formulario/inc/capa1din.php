 
<title>FormSercall 2.0 Beta  -  Hecho Por Datux.cl</title>
<script>
    function envia_numero(numero)
    {
        $("#telefono_gestion").val(numero);
    }
    function llamar()
    {
        var telefono_gestion = $("#telefono_gestion").val();
        document.location.href = "sip:C" + telefono_gestion + "@192.168.1.12"

    }
</script>


<?php
include_once("../includes/class/class_mysql_inc.php");

//$url = "http://www.terra.cl/valores/";
//$palabra = "UF :";
//$x = 1; //evita tags <! (invisibles)
//$fd = @fopen($url, "r"); //abre la url y comienza desde el principio para solo lectura. Apertura para s?lo lectura; ubica el apuntador de archivo al comienzo del mismo.
//while ($line=@fgets($fd,1000)){
//$pos = strpos ($line, $palabra);
//if ($pos){
//$glosa = " ";
//$line2=fgets($fd,1000);
//$uf = strip_tags($glosa.trim($line2)); 
//$uf = str_replace(".", "", $uf);
//$uf = str_replace(",", ".", $uf);
//}
//}
//@fclose ($fd);




$connect = new DB_mysql;
$connect->conectar();

$id_datos = $_REQUEST["id_datos"];


$result = $connect->consulta("SELECT * from sistema_deudor where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]' ");

while ($row = mysql_fetch_array($result)) {
    $id_datos = $row["id_datos"];
    $rut_cliente = $row["rut"];
    $dv = $row["dv"];
    $nombre = $row["nombre"];
    $primer_apellido = $row["primer_apellido"];
    $segundo_apellido = $row["segundo_apellido"];

    $rut_rep_legal = $row["rut_rep_legal"];
    $nom_rep_legal = $row["nom_rep_legal"];
    $etapa_cobranza = $row["etapa_cobranza"];

    $actividad_economica = $row["actividad_economica"];
    $empleador = $row["empleador"];
}

$result = $connect->consulta("SELECT * from sistema_ubicabilidad where rut = '$rut_cliente' and campaign_id = '$_GET[campaign]' ");

while ($row = mysql_fetch_array($result)) {
    $rut = $row["rut"];
    $calle = $row["calle"];
    $numero = $row["numero"];
    $resto = $row["resto"];
    $comuna = $row["comuna"];
    $ciudad = $row["ciudad"];

    $telefono1 = $row["telefono1"];
    $telefono2 = $row["telefono2"];
    $telefono3 = $row["telefono3"];
    $telefono4 = $row["telefono4"];
    $telefono5 = $row["telefono5"];
    $telefono_adicional1 = $row["telefono_adicional1"];
    $telefono_adicional2 = $row["telefono_adicional2"];
    $email1 = $row["email1"];
    $email2 = $row["email2"];
}

$resultx = $connect->consulta("SELECT *,min(fec_venc) as fec_venc from sistema_deuda where rut = '$rut_cliente' and campaign_id = '$_GET[campaign]'");

while ($rowx = mysql_fetch_array($resultx)) {
    $nro_doc = $rowx["nro_doc"];
    $fec_venc = date("Ymd", strtotime($rowx["fec_venc"]));
    $monto = $rowx["monto"];

    $total_cuotas = $rowx["total_cuotas"];
    $tipo_doc = $rowx["tipo_doc"];
    $estado_deuda = $rowx["estado_deuda"];
    $cuotas_vencidas = $rowx["cuotas_vencidas"];
    $fec_venc = $rowx["fec_venc"];
    $fec_asignacion = $rowx["fec_asignacion"];
    $fec_colocacion = $rowx["fec_colocacion"];
    $monto = $rowx["monto"];
    $deuda_total = $rowx["deuda_total"];
    $abono = $rowx["abono"];
    $ofe1=$rowx['oferta1'];
    $fecha_abono = $rowx["fecha_abono"];
    $deuda_morosa = $rowx["deuda_morosa"];
    $cuotas_pagadas = $rowx["cuotas_pagadas"];
    $fecha_actualizacion = $rowx["fecha_actualizacion"];
    $cartera = $rowx["cartera"];
    $tramo = $rowx["tramo"];
    $codpro=$rowx['cod_producto'];
    $adicional1 = $rowx["adicional1"];
    $adicional2 = $rowx["adicional2"];
    $adicional3 = $rowx["adicional3"];
    $adicional4 = $rowx["adicional4"];
    $adicional5 = $rowx["adicional5"];
    $cod_cedente = $rowx["cod_cedente"];
    



    $id_deuda = $rowx["id_deuda"];
}

$result_sum_deuda = $connect->consulta("SELECT sum(monto) as suma_monto from sistema_deuda where rut = '$_GET[vendor_id]' and campaign_id = '$_GET[campaign]' ");
while ($row_sum_deuda = mysql_fetch_array($result_sum_deuda)) {
    $suma_monto = $row_sum_deuda["suma_monto"];
}

$result_arbol = $connect->consulta("SELECT tipo_contacto from arbol_opciones1 WHERE id_opcion = '$_GET[opciones]' ");
while ($row_arbol = mysql_fetch_array($result_arbol)) {
    $tipo_contacto = $row_arbol["tipo_contacto"];
}
?> 




<fieldset class='field'>
    <legend ><font face="verdana,arial" size=1><b> ORIGEN VICIDIAL</b></font></legend>
    <table border='1' width='1050'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr>
            <td width='180'><font face="verdana,arial" size=2 >Telefono:   <b><?php echo $_GET['dialed_number']; ?></b> </td> 

            <td width='200'><font face="verdana,arial" size=2 >Rut Cliente: <b><?php echo $_GET['vendor_id']; ?></b> </td>
            <td width='200'><font face="verdana,arial" size=2>Campaign: <font face="verdana,arial" size=3 color='RED' ><b><?php echo $_GET['campaign']; ?></b></td>
            <td width='150'><font face="verdana,arial" size=2 >Registro <b><?php echo $id_datos; ?></b></td>
            <td width='150'><font face="verdana,arial" size=2 >Lista <b><?php echo $_GET['list_id']; ?></b></td>



        </tr>
    </table>
    <br>
</fieldset>




<fieldset class='field'>

    <legend ><font face="verdana,arial" size=1><b> DATOS DE CLIENTE</b></font></legend>

    <form name="form1" action='#' method="GET">
        <?php
        $hoy = date('d-m-Y');
        $no_pasar_max = date("Y/m/d", strtotime("$hoy + 3 days"));
        $no_pasar_min = date("Y/m/d", strtotime("$hoy - 1 days"));
        ?>
        <table border='1' width='1050'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

            <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>

                <td width='110'><font face="verdana,arial" size=1>RUT CLIENTE</td>
                <td width='230'><font face="verdana,arial" size=1 >NOMBRE CLIENTE</td>
                <td width='290'><font face="verdana,arial" size=1 >DIRECCION</td>
                <td  width='100'><font face="verdana,arial" size=1 >COMUNA</td>
                <td width='140'><font face="verdana,arial" size=1 >CIUDAD</td>

            </tr>
            <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">


                <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $rut_cliente; ?>' style="width:100%"  name='rut'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
                <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $nombre . " " . $primer_apellido . " (" . $segundo_apellido . ")"; ?>'  style="width:100%" size='8' class='tb10'  name=''></td>

                <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $calle . " " . $numero . " " . $resto; ?>' style="width:100%" size='20'   class='tb10'name=''></td>
                <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $comuna; ?>' style="width:100%" size='25'    class='tb10'name=''></td>
                <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $ciudad; ?>' style="width:100%;color:red;font-size:8pt;" size='20'   class='tb10'name=''></td>

            </tr>


            <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>

                <td width='110'><font face="verdana,arial" size=1>EMPLEADOR</td>
                <td width='200'><font face="verdana,arial" size=1 >DESCRIPCION ADICIONAL</td>
                <td width=''><font face="verdana,arial" size=1 >CUENTA</td>
                <td width=''><font face="verdana,arial" size=1 >FECHA NAC.</td>
            </tr>
            <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">

                <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $empleador; ?>'  style="width:100%" size='8' class='tb10'  name='empleador'></td>
                <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $actividad_economica; ?>' style="width:100%"  name='actividad_economica'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
                <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $rut_rep_legal; ?>' style="width:100%"  name='rut_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
                <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $nom_rep_legal; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>


            </tr>



        </table>

</fieldset>


<fieldset class='field'>

    <legend ><font face="verdana,arial" size=1><b> GESTIONES DE CLIENTE (ULTIMAS 3)</b></font></legend>
    <?php
    $result = $connect->consulta("SELECT * from sistema_gestiones where rut_cliente = '$rut_cliente'   order by fecha desc  limit 3");
    if (mysql_num_rows($result) != 0) {
        ?>

        <table border='1' width='1050'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">
            <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'>
                <td width='10'><font face="verdana,arial" size=1>Nº</td>
                <td width='100'><font face="verdana,arial" size=1 >CAMPAÑA</td>
                <td width='150'><font face="verdana,arial" size=1>FECHA GESTION</td>
                <td width='100'><font face="verdana,arial" size=1>FECHA COMP..</td>
                <td width='100'><font face="verdana,arial" size=1>TELEFONO</td>
                <td width='50'><font face="verdana,arial"  size=1>GESTOR</td>
                <td width='50'><font face="verdana,arial" size=1>LISTA</td>

                <td width='50'><font face="verdana,arial" size=1 >CODIGO</td>
                <td  width='350'><font face="verdana,arial" size=1 >GLOSA</td>

            </tr>
            <?php
            $cont = 1;


            if ($id_datos) {

                $result = $connect->consulta("SELECT * from sistema_gestiones where rut_cliente = '$rut_cliente'  order by fecha desc  limit 3");

                while ($row = mysql_fetch_array($result)) {
                    $fecha = $row["fecha"];
                    $user = $row["user"];
                    $list_id = $row["list_id"];
                    $lead_id = $row["lead_id"];
                    $cod_gestion = $row["cod_gestion"];
                    $glosa = $row["glosa"];
                    $telefono = $row["telefono"];
                    $fecha_compromiso = $row["fecha_compromiso"];
                    $campaign = $row["campaign"];
                    ?>



                    <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">

                        <td><font face="verdana,arial" size='1'><?php echo $cont; ?></td>

                        <td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $campaign; ?>' style="width:100%"  name='usuario' class='tb10'></td>

                        <td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fecha; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

                        <td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fecha_compromiso; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

                        <td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $telefono; ?>' style="width:100%"  name='usuario' class='tb10'></td>


                        <td><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $user; ?>' style="width:100%"  name='usuario' class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>

                        <td><font face="verdana,arial" size=1><input type='text'  size='2' value='<?php echo $list_id; ?>'  name='DV'  style="width:100%"  class='tb10' readonly></td>

                        <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $cod_gestion; ?>' style="width:100%" size='20'   class='tb10'name=''></td>
                        <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $glosa; ?>' style="width:100%" size='25'    class='tb10' name=''></td>
                    </tr>



                    <?php
                    $cont = $cont + 1;
                }
            }
        } else {
            echo "RUT no registra gestiones.<br>";
        }
        ?>
    </table>


    <br>
</fieldset>

<!--REUMEN DEUDA-->

<fieldset class='field'>
    <legend ><font face="verdana,arial" size=1><b> DEUDA CLIENTE</b></font></legend>


    <table border='1' width='725' cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>


            <td width='145'><font face="verdana,arial" size=1>DEUDA VENCIDA</td>
            <td width='145'><font face="verdana,arial" size=1>GASTOS COB</td>
            <td width='145'><font face="verdana,arial" size=1 >INT. MORA</td>
            <td width='145'><font face="verdana,arial" size=1 >OTR. CARGOS</td>
            <td width='145'><font face="verdana,arial" size=1 >TOT DEUDA VENCIDA</td>
            <td width='145'><font face="verdana,arial" size=1 >OFERTA DIN</td>
            <td width='145'><font face="verdana,arial" size=1 >DESC CAMP</td>
            <td width='145'><font face="verdana,arial" size=1 >OPC PAGO TOTAL</td>

        </tr>
        <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">

            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($deuda_morosa, 0); ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($tipo_doc,0); ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($ofe1,0); ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $codpro; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php //echo $deuda_morosa; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $nro_doc; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($adicional5,0); ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo 'adicional4' ; ?>' style="width:100%"  name='deu_total_conv'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            </td>
    </table>

    <table border='1' width='580' cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>


            <td width='145'><font face="verdana,arial" size=1 >FECH ULT PAGO</td>
            <td width='145'><font face="verdana,arial" size=1 >ULT PAGO</td>
            <td width='145'><font face="verdana,arial" size=1 >GESTIONES</td>
            <td width='145'><font face="verdana,arial" size=1 >FECHA COMP. PAGO</td>
            <td width='145'><font face="verdana,arial" size=1 >$ ULT COMPRO</td>
            <td width='145'><font face="verdana,arial" size=1 >FECH ULT GESTION</td>
            <td width='145'><font face="verdana,arial" size=1 >DEU X VENCER</td>

        </tr>
        <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">

            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $fecha_actualizacion; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo number_format($cuotas_pagadas,0); ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $cuantas; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional1; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $adicional2; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php echo $nom_rep_legal; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>
            <td height="19"><font face="verdana,arial" color='white'  ><input type='text' value='<?php ; ?>' style="width:100%"  name='nom_rep_legal'    class='tb10' onKeypress="return solo_numeros(event);"  onBlur="validar1(this.form)" ></td>





            </td>
    </table>



    <br>
</fieldset>
<!--FIN RESUMEN DEUDA-->
<fieldset class='field'>
    <legend ><font face="verdana,arial" size=1><b> TELEFONOS</b></font></legend>


    <table border='1' width='725' cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>


            <td width='145'><font face="verdana,arial" size=1>TELEFONO 1</td>
            <td width='145'><font face="verdana,arial" size=1>TELEFONO 2</td>
            <td width='145'><font face="verdana,arial" size=1 >TELEFONO 3</td>
            <td width='145'><font face="verdana,arial" size=1 >TELEFONO 4</td>
            <td width='145'><font face="verdana,arial" size=1 >TELEFONO 5</td>

        </tr>
        <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">

            <td height="19" ><font face="verdana,arial" size=1><input type='text' value='<?php echo $telefono1; ?>' style="width:85%"      class='tb10' name='telefono1' id='telefono1' > <?php if ($fono1 <> 'NO TIENE') { ?> <a  id='fono1' Onclick="envia_numero($('#telefono1').val());"><img src='../images/icons/add.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a><?php } ?></td>
            <td ><font face="verdana,arial" size=1><input type='text'  value='<?php echo $telefono2; ?>'  style="width:85%"  class='tb10' name='telefono2' id='telefono2'  ><?php if ($fono2 <> 'NO TIENE') { ?> <a  id='fono2' Onclick="envia_numero($('#telefono2').val());"><img src='../images/icons/add.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a><?php } ?></td>
            <td ><font face="verdana,arial" size=1><input type='text' value='<?php echo $telefono3; ?>' style="width:85%"    class='tb10' name='telefono3' id='telefono3'  ><?php if ($fono3 <> 'NO TIENE') { ?> <a  id='fono3' Onclick="envia_numero($('#telefono3').val());"><img src='../images/icons/add.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a><?php } ?></td>
            <td ><font face="verdana,arial" size=1><input type='text' value='<?php echo $telefono4; ?>' style="width:85%"    class='tb10' name='telefono_adicional1' id='telefono_adicional1'  ><?php if ($fono3 <> 'NO TIENE') { ?> <a  id='fonoa1' Onclick="envia_numero($('#telefono_adicional1').val());"><img src='../images/icons/add.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a><?php } ?></td>
            <td ><font face="verdana,arial" size=1><input type='text' value='<?php echo $telefono5; ?>' style="width:85%"    class='tb10' name='telefono_adicional2' id='telefono_adicional2'  ><?php if ($fono3 <> 'NO TIENE') { ?> <a  id='fonoa2' Onclick="envia_numero($('#telefono_adicional2').val());"><img src='../images/icons/add.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a><?php } ?></td>
            </td>
    </table>

    <table border='1' width='580' cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>


            <td width='145'><font face="verdana,arial" size=1 >TELEFONO GESTION</td>
            <td width='145'><font face="verdana,arial" size=1 >NUEVO TELEFONO</td>
            <td width='145'><font face="verdana,arial" size=1 >EMAIL1</td>
            <td width='145'><font face="verdana,arial" size=1 >EMAIL2</td>

        </tr>
        <tr  bgcolor="white" onMouseover="this.style.backgroundColor = '#DDF'" onMouseout="this.style.backgroundColor = 'white'">

            <td ><font face="verdana,arial" size=1><input type='text' value='<?php echo $_GET['dialed_number']; ?>' style="width:85%"  id='telefono_gestion'  class='tb10' name='telefono_gestion' readonly><a OnClick='llamar();' ><img src='../images/icons/phone.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a></td>
            <td ><font face="verdana,arial" size=1><input type='text' value='' style="width:85%"    class='tb10' name='nuevo_telefono' id='nuevo_telefono'  ><a  id='nuevo_fono' Onclick="envia_numero($('#nuevo_telefono').val());"><img src='../images/icons/add.png' width="15" heigth='15' border="0" style="border:none; background:transparent; cursor: pointer;"></a></td>



            <td ><font face="verdana,arial" size=1><input type='text'   style="width:100%"  value='<?php echo $email1; ?>'  class='tb10' name='email1' id=''  ></td>
            <td ><font face="verdana,arial" size=1><input type='text'   style="width:100%"   value='<?php echo $email2; ?>'  class='tb10' name='email2' id=''  ></td>




            </td>
    </table>



    <br>
</fieldset>
<!--
<fieldset class='field'>
<legend ><font face="verdana,arial" size=1><b> PARA USO VENTAS RSA</b></font></legend>
<table border='1' width='960' cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>

 
<td width='120'><font face="verdana,arial" size=1>SEGURO CONTRATADO</td>
<td width='120'><font face="verdana,arial" size=1>MONTO EN U.F.</td>
<td width='120'><font face="verdana,arial" size=1 >NUEVA PATENTE</td>
<td width='120'><font face="verdana,arial" size=1 >FONO CONTACTO</td>
<td width='120'><font face="verdana,arial" size=1 >EMAIL CONTACTO</td>
<td width='120'><font face="verdana,arial" size=1 >TELEMATICS</td>
<td width='120'><font face="verdana,arial" size=1 >ACEPTA CONTRATO</td>
<td width='120'><font face="verdana,arial" size=1 >COTIZA AUTO</td>
 
</tr>
<tr  bgcolor="white" onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='white'">

<td height="19" >
<select name='seguro_contratado' style="width:120;" class='tb10'>
<option value=''>--SELECCIONE--</option>
<option value='SEGUROS AUTOS SOLIDARIO RESPONSABLE'>SEGUROS AUTOS SOLIDARIO RESPONSABLE</option>
<option value='SEGUROS AUTO SOLIDARIO TOTAL'>SEGUROS AUTO SOLIDARIO TOTAL</option>
<option value='SEGURO AUTO SOLIDARIO FULL DEDUCIBLE UF 0'>SEGURO AUTO SOLIDARIO FULL DEDUCIBLE UF 0</option>
<option value='SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 3'>SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 3</option>
<option value='SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 5'>SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 5</option>
<option value='SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 10'>SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 10</option>
<option value='SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 15'>SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 15</option>
<option value='SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 20'>SEGUROS AUTO SOLIDARIO FULL DEDUCIBLE UF 20</option>

</select>
</td>
<td height="19" ><font face="verdana,arial" size=1><input type='text' style="width:85%"      class='tb10' name='monto_en_uf' ></td>
<td height="19" ><font face="verdana,arial" size=1><input type='text' style="width:85%"  value='<?php echo $etapa_cobranza; ?>'    class='tb10' name='nueva_patente' ></td>
<td height="19" ><font face="verdana,arial" size=1><input type='text' style="width:85%"      class='tb10' name='fono_contacto' ></td>
<td height="19" ><font face="verdana,arial" size=1><input type='text' style="width:85%"      class='tb10' name='email_contacto' ></td>

<td height="19" >
<select name='telematics' style="width:120;" class='tb10'>
<option value=''>--SELECCIONE--</option>
<option value='SEGURO FULL CON TELEMATICS'>SEGURO FULL CON TELEMATICS</option>
<option value='SEGURO FULL SIN TELEMATICS'>SEGURO FULL SIN TELEMATICS</option>
</select>
</td>
<td height="19" >
<select name='acepta_contrato' style="width:120;" class='tb10'>
<option value=''>--SELECCIONE--</option>
<option value='CONFIRMA PROPUESTA'>CONFIRMA PROPUESTA</option>
<option value='NO CONFIRMA PROPUESTA'>NO CONFIRMA PROPUESTA</option>  
</select>
</td>

<td height="19" >
<select name='cotiza_auto' style="width:120;" class='tb10'>
<option value=''>--SELECCIONE--</option>
<option value='SI'>SI</option>
<option value='NO'>NO</option>
</select>
</td>

</tr>
</table>



</fieldset>
-->

<script language='javascript' src="inc/popcalendar.js"></script>

<fieldset class='field'>
    <legend ><font face="verdana,arial" size=1><b> ARBOL DE GESTION</b></font></legend>



    <table border='1' width='450' cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>

            <td width='200'><font face="verdana,arial" size=1>TIPO CONTACTO</td>
            <td width='200'><font face="verdana,arial" size=1>GESTION</td>

            <td width='150'><font face="verdana,arial" size=1>F.CONTROL</td>
            <!-- <td width='150'><font face="verdana,arial" size=1>M.COMPROMISO</td>
            <td width='200'><font face="verdana,arial" size=1>NOM.CONTACTO</td> -->
        </tr>

        <tr bgcolor="white">
            <td  width="200"><?php arbol(); ?></td>
            <td height="22"><?php opciones(); ?></td>

            <td>
                <input name="fecha_compromiso" class='tb10' type="text" value='' id="dateArrival" onClick="popUpCalendar(this, form1.dateArrival, 'yyyymmdd');" style="width:100%" >
            </td>
            <!-- <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $monto_compromiso; ?>'  size='10' class='tb10' name='monto_compromiso' style="width:100%"></td>
            <td><font face="verdana,arial" size=1><input type='text' value='<?php echo $nombre_contacto; ?>'  size='10' class='tb10' name='nombre_contacto' style="width:100%"></td>
            -->
        </tr>
    </table>


    <table border='1' width='900'cellspacing='1' cellpadding='1' style="border-top-color:WHITE; border-top-width:1px;border-top-style:solid;border-left-color:WHITE; border-left-width:1px;border-left-style:solid;border-collapse: collapse;">

        <tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='16'>

            <td><font face="verdana,arial" size=1>GLOSA GESTION</td>
        </tr>
        <tr>
            <td><textarea name='glosa' style="width:100%" rows="1" id='glosa' ></textarea></td>
        </tr>
    </table>
    <br>
</fieldset>


<fieldset class='field'>
    <input type='hidden' name='sw' value='ingresando'>
    <input type='hidden' name='no_pasar_max' value='<?php echo $no_pasar_max; ?>'>
    <input type='hidden' name='no_pasar_min' value='<?php echo $no_pasar_min; ?>'>
    <input type='hidden' name='id_datos' value='<?php echo $id_datos; ?>'>
    <input type='hidden' name='uniqueid' value='<?php echo $_GET["uniqueid"]; ?>'>
    <input type='hidden' name='list_id'  value='<?php echo $_GET["list_id"]; ?>'>
    <input type='hidden' name='lead_id'  value='<?php echo $_GET["lead_id"]; ?>'>
    <input type='hidden' name='user'  value='<?php echo $_GET["user"]; ?>'>
    <input type='hidden' name='telefono'  value='<?php echo $_GET["dialed_number"]; ?>'>
    <input type='hidden' name='campaign'  value='<?php echo $_GET["campaign"]; ?>'>


    <input type='hidden' name='nro_doc' value='<?php echo $nro_doc; ?>'>
    <input type='hidden' name='monto' value='<?php echo $monto; ?>'>

    <input type='hidden' name='total_cuotas' value='<?php echo $total_cuotas; ?>'>
    <input type='hidden' name='tipo_doc' value='<?php echo $tipo_doc; ?>'>
    <input type='hidden' name='estado_deuda' value='<?php echo $estado_deuda; ?>'>
    <input type='hidden' name='cuotas_vencidas' value='<?php echo $cuotas_vencidas; ?>'>
    <input type='hidden' name='fec_venc' value='<?php echo $fec_venc; ?>'>
    <input type='hidden' name='fec_asignacion' value='<?php echo $fec_asignacion; ?>'>
    <input type='hidden' name='fec_colocacion' value='<?php echo $fec_colocacion; ?>'>
    <input type='hidden' name='monto' value='<?php echo $monto; ?>'>
    <input type='hidden' name='deuda_total' value='<?php echo $deuda_total; ?>'>
    <input type='hidden' name='abono' value='<?php echo $abono; ?>'>
    <input type='hidden' name='fecha_abono' value='<?php echo $fecha_abono; ?>'>
    <input type='hidden' name='deuda_morosa' value='<?php echo $deuda_morosa; ?>'>
    <input type='hidden' name='cuotas_pagadas' value='<?php echo $cuotas_pagadas; ?>'>
    <input type='hidden' name='fecha_actualizacion' value='<?php echo $fecha_actualizacion; ?>'>
    <input type='hidden' name='cartera' value='<?php echo $cartera; ?>'>
    <input type='hidden' name='tramo' value='<?php echo $tramo; ?>'>


    <input type='hidden' name='adicional1' value='<?php echo $adicional1; ?>'>
    <input type='hidden' name='adicional2' value='<?php echo $adicional2; ?>'>
    <input type='hidden' name='adicional3' value='<?php echo $adicional3; ?>'>
    <input type='hidden' name='adicional4' value='<?php echo $adicional4; ?>'>
    <input type='hidden' name='adicional5' value='<?php echo $adicional5; ?>'>
    <input type='hidden' name='cod_cedente' value='<?php echo $cod_cedente; ?>'>


    <input type='hidden' name='fecha_proximo_venc'  value='<?php echo $fecha_proximo_venc; ?>'>
    <input type='hidden' name='valor_cuota'  value='<?php echo $valor_cuota; ?>'>
    <input type='hidden' name='suma_monto'  value='<?php echo $suma_monto; ?>'>
    <input type='hidden' name='tipo_contacto'  value='<?php echo $tipo_contacto; ?>'>



    <input type='hidden' name='fecha_vencimiento' id='fecha_vencimiento' value='<?php echo $fecha_vencimiento; ?>'>
    <center><input type='button' value='GUARDAR GESTION Y SALIR' style='font-size:11px;' name='cierra1' id='cierra1' Onclick='valida_envia()'>
        <input type='button' value='GUARDAR GESTION' style='font-size:11px;' name='cierra2' id='cierra2' Onclick='valida_envia()' disabled>
    </center>

</fieldset>
</form>



<?php
//////////////////////////////////////////////////////////////////////////////////////////////////




if ($_GET["sw"] == "ingresando") {

    $result = $connect->consulta("INSERT INTO sistema_gestiones (id_datos,uniqueid,list_id,lead_id,campaign,user,rut_cliente,telefono,nuevo_telefono,email,cod_gestion,cod_gestion2,cod_contacto,fecha_compromiso,monto_compromiso,nombre_contacto,glosa,nro_doc,total_cuotas,tipo_doc,estado_deuda,cuotas_vencidas,fec_venc,fec_asignacion,fec_colocacion,monto,deuda_total,abono,fecha_abono,deuda_morosa,cuotas_pagadas,fecha_actualizacion,cartera,tramo,adicional1,adicional2,adicional3,adicional4,adicional5,cod_cedente,seguro_contratado,monto_en_uf,nueva_patente,fono_contacto,email_contacto,telematics,acepta_contrato,cotiza_auto) 																																																										
values('$_GET[id_datos]','$_GET[uniqueid]','$_GET[list_id]','$_GET[lead_id]','$_GET[campaign]','$_GET[user]','$_GET[rut]','$_GET[telefono_gestion]','$_GET[nuevo_telefono]','$_GET[email]','$_GET[opciones]','$tipo_contacto','$_GET[id_arbol]','$_GET[fecha_compromiso]','$_GET[monto_compromiso]','$_GET[nombre_contacto]','$_GET[glosa]','$_GET[nro_doc]','$_GET[total_cuotas]','$_GET[tipo_doc]','$_GET[estado_deuda]','$_GET[cuotas_vencidas]','$_GET[fec_venc]','$_GET[fec_asignacion]','$_GET[fec_colocacion]','$_GET[monto]','$_GET[deuda_total]','$_GET[abono]','$_GET[fecha_abono]','$_GET[deuda_morosa]','$_GET[cuotas_pagadas]','$_GET[fecha_actualizacion]','$_GET[cartera]','$_GET[tramo]','$_GET[adicional1]','$_GET[adicional2]','$_GET[adicional3]','$_GET[adicional4]','$_GET[adicional5]','$_GET[cod_cedente]','$_GET[seguro_contratado]','$_GET[monto_en_uf]','$_GET[nueva_patente]','$_GET[fono_contacto]','$_GET[email_contacto]','$_GET[telematics]','$_GET[acepta_contrato]','$_GET[cotiza_auto]')");
    ?>
    <script language="JavaScript">
        //if(document.form1.cierra.value =='GUARDAR GESTION Y SALIR')
        //{
        //	alert("me cerrare");
        var boton1 = $("#cierra1").val();
        var boton2 = $("#cierra2").val();
        window.close();

        //}
    </script> 

    <?php
}
