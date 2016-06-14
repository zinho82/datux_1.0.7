<?php
require("../includes/inc.est");
include_once("../includes/class/class_mysql_inc.php");
?>
<style>
    body {
        background: url(../images/fondo_adm.jpg) no-repeat;
        background-size: 100%;

    } 
</style>
<style>
    .tcat
    {
        background: #80A9EA url(http://localhost/login/images/tablebg.gif) repeat-x top left;
        COLOR: #FFFFFF;
        FONT: 12px Verdana, Tahoma;
    }
    .tborder
    {
        background-color: #FFFFFF;
        color: #000000;
        border: 2px solid #D8D8D8;
    }
    .cabecera
    {
        background-color: #FAAC58;
        color: #000000;
        border: 2px solid #D8D8D8;
    }

</style>
<script language="JavaScript">
    function confirmar(mensaje) {
        return confirm(mensaje);
    }
</script>	

<br>
<fieldset>
    <legend ><font face="verdana,arial" size=1><b> MENU PRINCIPAL</b></font></legend>

    <table   cellspacing='2' cellpadding="2" align="left" border='0'>
        <tr>

            <td valign="top">       
                <button type="button"  onClick="top.frames['mainFrame'].location.href = '../carga_datos/campaign.php'" disabled>
                    <font class="main_text">GESTION DATOS<br>
                    <img src="../images/Crystal_Clear_app_kontact.png" width='45' height='45' alt="Gestor de art�culos"  />	
                </button>    
            </td>

            <td>
                <button type="button"   onClick="top.frames['mainFrame'].location.href = '../grilla/paginacion3.php'">
                    <font class="main_text">GESTIONES<br>
                    <img src="../images/Crystal_128_kaddressbook-crnagora.png" width='45' height='45' alt="Gestor de art�culos"  />	
                </button> 
            </td>
            <td>
                <button type="button"   onClick="top.frames['mainFrame'].location.href = '../genera_root.php'">
                    <font class="main_text">GENERAR ROOT<br>
                    <img src="../images/Crystal_Clear_mimetype_document2.png" width='45' height='45' alt="Gestor de art�culos"  />	
                </button> 
            </td>

            <td>	        
                <button type="button"  onClick="top.frames['mainFrame'].location.href = '../gestion_manual/index.php'">
                    <font class="main_text">GESTION MANUAL<br>
                    <img src="../images/clientes.png" width='45' height='45' alt="Gestion Manual"  />	
                </button>

            </td>

        </tr>
    </table>

</fieldset>

<script>
    function seleccionar_todo() {
        for (i = 0; i < document.f1.elements.length; i++)
            if (document.f1.elements[i].type == "checkbox")
                document.f1.elements[i].checked = 1
    }
    function deseleccionar_todo() {
        for (i = 0; i < document.f1.elements.length; i++)
            if (document.f1.elements[i].type == "checkbox")
                document.f1.elements[i].checked = 0
    }
</script>
<fieldset>
    <legend ><font face="verdana,arial" size=1><b> LISTAS</b></font></legend>	 

    <?php
    $campaign_id = $_REQUEST["campaign_id"];
    $cod_cedente = $_REQUEST["cod_cedente"];
    $connect = new DB_mysql;
    $connect->conectar();
    $result = $connect->consulta("select * from vicidial_lists where campaign_id = '$campaign_id' order by list_lastcalldate");
    $cont = 0;
    if (!$result) {
        echo "error!";
    } else {
        ?>


        <table border='0' width='300' class='tborder' cellspacing='1' cellpadding='0'>
            <tr>
                <td width="150"  bgcolor="DADAd5"><font class="main_text_c"><center>NOMBRES DEUDORES</center></td>
            <td width="150"  bgcolor="DADAd5"><font class="main_text_c"><center>INFORMACION DEUDA</center></td>
            <td width="150"  bgcolor="DADAd5"><font class="main_text_c"><center>ACTUALIZAR BD</center></td>
            </tr>
            <tr onMouseover="this.style.backgroundColor = '#81BEF7'" onMouseout="this.style.backgroundColor = '#CEE3F6'" bgcolor='#CEE3F6'>
                <td width="150" align="center">
                    <button type="button"   onClick="top.frames['mainFrame'].location.href = 'ingreso_listas.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>&cod_cedente=<?php echo $cod_cedente; ?>'"> <font class="main_text">INGRESAR</font><br>
                        <img src="../images/Crystal_Clear_app_kontact.png" width='45' height='10'></button>
                </td>
                <td width="150" align="center">
                    <button type="button"   onClick="top.frames['mainFrame'].location.href = 'ingreso_deudas.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>&cod_cedente=<?php echo $cod_cedente; ?>'"> <font class="main_text">INGRESAR</font><br>
                        <img src="../images/Crystal_Clear_app_kontact.png" width='45' height='10'></button>
                </td>
                <td width="150" align="center">
                    <button type="button"   onClick="top.frames['mainFrame'].location.href = 'act_campana.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>&cod_cedente=<?php echo $cod_cedente; ?>'"> <font class="main_text">ACTUALIZAR</font><br>
                        <img src="../images/Crystal_Clear_app_kontact.png" width='45' height='10'></button>
                </td>

            </tr>
            <td width="20" align="center"><a href="vaciado_nombres.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>" onclick="return confirmar('¿Esta seguro que desea vaciar los registros de nombres?')" title="Vaciar registros de nombres"><img src="../images/icons/basket_delete.png" border="0"></a></td>
            <td width="20" align="center"><a href="vaciado_deudas.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>" onclick="return confirmar('¿Esta seguro que desea vaciar los registros de deuda?')" title="Vaciar registros de deudas"><img src="../images/icons/basket_delete.png" border="0"></a></td>


        </table>

        <table border='0'   cellspacing='1' cellpadding='0'>
            <tr>
                <td> <a href="javascript:seleccionar_todo()"><font face='verdana,arial' size=2>Marcar todas</font></a> |
                    <a href="javascript:deseleccionar_todo()"><font face='verdana,arial' size=2>Marcar ninguna</font></a> 
                </td>
            </tr> 
        </table>


        <table border='0' width='700' class='tborder' cellspacing='1' cellpadding='0'>
            <tr>
                <td width="15"  bgcolor="DADAd5"><font class="main_text_c">Nº</td>
                <td width="100"  bgcolor="DADAd5"><font class="main_text_c">ID LISTA</td>
                <td  bgcolor="DADAd5"><font class="main_text_c">NOMBRE LISTA</td>
                <td  bgcolor="DADAd5"><font class="main_text_c">ULTIMO CAMBIO</td>
                <td bgcolor="DADAd5" width="20"><font class="main_text_c">Active</td>
                <td  bgcolor="DADAd5" width='20'><font class="main_text_c">I</td>

                <td bgcolor="DADAd5"><font class="main_text_c">U</td>
                <td bgcolor="DADAd5"><font class="main_text_c">V</td>

                <td bgcolor="DADAd5"><font class="main_text_c"></td>
            </tr>


            <form action='eliminar_listas.php' name='f1' method='GET'>
                <?php
                while ($row = mysql_fetch_array($result)) {
                    $cont ++;
                    ?> 

                    <tr onMouseover="this.style.backgroundColor = '#81BEF7'" onMouseout="this.style.backgroundColor = '#CEE3F6'" bgcolor='#CEE3F6'>
                        <td width="15"><font class="main_text_c"><?php echo $cont; ?></td>
                        <td><font class="main_text_c"><b><?php echo $row["list_id"]; ?></td>
                        <td><font class="main_text_c"><b><?php echo strtoupper($row["list_name"]); ?></td>
                        <td><font class="main_text_c"><b><?php echo strtoupper($row["list_lastcalldate"]); ?></td>
                        <td width="20" align="center"><font class="main_text_c"><b><?php echo $row["active"]; ?></td>

                        <td width="20" align="center"><a href="inhibir_casos.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>" title="Inhibir casos a la lista"><img src="../images/icons/application_delete.png" border="0"></a></td>



                        <td width="20" align="center"><a href="ingreso_ubicabilidad.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>" title="A�adir datos de ubicabilidad"><img src="../images/icons/application_add.png" border="0"></a></td>


                        <td width="20" align="center"><a href="vaciado_listas.php?list_id=<?php echo $row["list_id"]; ?>&campaign_id=<?php echo $campaign_id; ?>" onclick="return confirmar('�Est� seguro que desea vaciar la lista?')" title="Vaciar registros de lista"><img src="../images/icons/basket_delete.png" border="0"></a></td>

                        <td width="20" align='center'><input type='checkbox' name='option[]' value='<?php echo $row["list_id"]; ?>'></td>
                    </tr>



                    <?php
                }
                ?> </table>

        <input type='hidden' name='campaign_id' value='<?php echo $campaign_id; ?>'>
        <input type='submit' class='main_text_c' value='Borrar listas seleccionadas'> 
        </form>
        <?php
    }
    ?>


    <!-- FIN AREA CENTRAL !-->
    </td>	

    </tr>

    </table>