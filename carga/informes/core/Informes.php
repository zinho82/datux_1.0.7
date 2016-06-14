<?php

$fecha = date('Y-m-d');
//echo $fecha;
$fecha = '2016-06-07';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Informes
 *
 * @author zinho
 */
class Informes {

    function conectar_db($db) {
        $conn = mysql_connect("localhost", "root", "") or die(mysql_error() . ' ' . mysql_errno());
        if (!$conn) {
            echo "<h2 align='center'>ERROR: 1 Imposible establecer conecci&oacute;n con el servidor de BD</h2>";
        }
//Seleccionamos la base
        mysql_select_db($db, $conn);
        mysql_query("SET NAMES 'utf8'");
        return $conn;
    }

    public function LlenarArchivo($bd, $tabla, $fecha, $fp, $campana) {
        $sqls = "update asterisk.sistema_gestiones cg inner join asterisk.arbol_opciones1 op1 on op1.id_opcion=cg.cod_gestion and op1.arbol=4 set cg.cod_gestion2=op1.cod_alt";
        mysql_query($sqls, $this->conectar_db($bd)) or die(mysql_error());


        $sql = "select distinct
'2006' as campo1,case
        when length(datos.rut_rep_legal)<8 then concat(datos.rut_rep_legal,' ') else datos.rut_rep_legal end as cuenta
,date_FORMAT(ges.fecha,'%m%d%Y %H:%i:%s' ) as fechayhora
,'001' as campo2,cod_gestion2 as cod_accion, trim(substring(ges.glosa,1,56)) as observacion,substring(trim(ges.telefono),-9) as fono_contacto, case when ges.user='VDAD' then 100 else ges.user end as operador
,length(cod_gestion2)
,de.cartera
from asterisk.sistema_deudor datos
inner join asterisk.sistema_gestiones ges on ges.rut_cliente=datos.rut and ges.campaign like 'ABC%' and ges.campaign=datos.campaign_id  and ges.cod_gestion2!=''
inner join asterisk.sistema_deuda de on de.rut=datos.rut
and date(ges.fecha)=date(now())
group by ges.id_gestion
order by fecha  asc 

  ";
       
        $res = mysql_query($sql, $this->conectar_db($bd)) or die(mysql_error());
        while ($consu = mysql_fetch_array($res)) {
            if ((substr(trim($consu['fono_contacto']), 0, 1) != 9) and ( substr($consu['fono_contacto'], 0, 1) != 2)) {
                $fono = substr($consu['fono_contacto'], -7);
                $area = substr($consu['fono_contacto'], 1, 2);
            } else {  
                $fono = substr($consu['fono_contacto'], -8);
                $area = substr($consu['fono_contacto'], 1, 1);
            }
            $observa=str_replace(chr(10), '', $consu['observacion']);
            $observa=str_replace(chr(13), '', $observa);
            $contenido = $consu['campo1']
                    . $this->espacios_izq(trim($consu['cuenta']), 25)
                    . $consu['fechayhora']
                    . $consu['campo2']
                    . trim($consu['cod_accion'])
		    . $this->espacios_izq(trim($consu['cartera']), 2)
                    . $this->espacios_izq($campana, 8)
                    . $this->espacios_izq($observa, 56)
                    . $this->ceros_izq($fono, 13)
                    . $this->ceros_izq($area, 5)
                    . $this->ceros_izq(0, 8)  
                    . chr(10);
            fwrite($fp, $contenido);
        }
    }

    public function LlenarArchivo600($fp, $campana) {
        $sql = "select distinct
'600' as campo1,case
        when length(de.rut)<8 then concat(origen.rut,' ')
else
origen.rut
end
as cuenta
,'216' as empresa
,date_format(ges.fecha,'%d%m%Y') as fechayhora
,'001' as campo2
,'CD' as cod_accion
,'PP' as cod_resultado
,'comentario' as observacion
,substring(trim(origen.telefono1),-9) as  fono_contacto
,date_format(de.fecha_abono,'%d%m%Y') as dmppmade
,de.monto
from asterisk.sistema_deudor datos
inner join asterisk.sistema_ubicabilidad origen on origen.rut=datos.rut
inner join asterisk.sistema_deuda de on de.rut=datos.rut  and de.campaign_id like 'ABC%'
inner join asterisk.sistema_gestiones ges on ges.rut_cliente=de.rut and ges.cod_gestion in ('PP')
and date(ges.fecha)=date(now())
group by ges.id_gestion 
order by fecha  asc";
      
        $res = mysql_query($sql, $this->conectar_db('asterisk')) or die(mysql_error());
        while ($consu = mysql_fetch_array($res)) {
            $contenido = $consu['campo1'] . $this->espacios_izq($consu['cuenta'], 26)
                    . $this->espacios_izq($campana, 8)
                    . trim($consu['cod_accion'])
                    . $consu['cod_resultado']
                    . $consu['fechayhora']
                    . $consu['campo2']
                    . $consu['campo2']
                    . $this->ceros($consu['dmppmade'],8)
                    . $this->ceros($consu['monto'] . ".00", 15)
                    . chr(10);
            fwrite($fp, $contenido);
        }
    }

    public function LlenarArchivo600_tri($fp, $campana) {
         $sql = "select '6006' as campo1
                , origen.rut as cuenta
                ,' ' as empresa
                , date_format(ges.fecha,'%m%d%Y %H:%i:%s') as fechayhora
                ,'  1' as campo2,'L1' as cod_accion 
                ,'PP' as cod_resultado
                ,de.fecha_abono
                ,ges.monto_compromiso
                ,date_format(ges.fecha_compromiso,'%d%m%Y') as dmppmade
                ,de.monto,usr.full_name as operador 
                from asterisk.sistema_deudor datos 
                inner join asterisk.sistema_ubicabilidad origen on origen.rut=datos.rut 
                inner join asterisk.sistema_deuda de on de.rut=datos.rut  and de.campaign_id like 'TRI%' and de.tramo like '%$campana%'
                   inner join asterisk.sistema_gestiones ges on ges.rut_cliente=de.rut and ges.cod_gestion2 in ('PP')  and datos.campaign_id=ges.campaign and  date(fecha)=date(now())
                   inner join asterisk.vicidial_users usr on usr.user=ges.user";
        "and date(fecha)=date(now())";
        $res = mysql_query($sql, $this->conectar_db($bd)) or die(mysql_error());
        while ($consu = mysql_fetch_array($res)) {
            $app = explode(' ', $consu['operador']);
            if (sizeof($app) > 3) {
                $nomop = $app[2];
            } else {
                $nomop = $app[1];
            }

            $contenido = $consu['campo1'] . 'TRI' . $this->espacios_izq($this->ceros_izq($consu['cuenta'], 8), 22)
                    . $this->espacios(substr($nomop, 0, 8), 8)
                    . trim($consu['cod_accion'])
                    . $consu['cod_resultado']
                    . $consu['fechayhora']
                    . $consu['campo2']
                    . $consu['campo2']
                    . $this->ceros($consu['dmppmade'], 8)
                    . $this->ceros("0", 15)
                    . chr(13);
            fwrite($fp, $contenido);
        }
    }

    public function LlenarArchivo_200_tri($bd, $tabla, $fecha, $fp, $campana) {
        $sqls = "update asterisk.sistema_gestiones cg inner join asterisk.arbol_opciones1 op1 on op1.id_opcion=cg.cod_gestion and op1.arbol=3 set cg.cod_gestion2=op1.cod_alt";
        mysql_query($sqls, $this->conectar_db($bd)) or die(mysql_error());


        $sql = "select
'2006' as campo1,datos.rut  as cuenta
,date_FORMAT(ges.fecha,'%m%d%Y %H:%i:%s' ) as fechayhora,de.tramo
,'   ' as campo2,cod_gestion2 as cod_accion,trim(ges.glosa)  as observacion,substring(trim(ges.telefono),-9) as fono_contacto,usr.full_name as operador
from asterisk.sistema_deudor datos
inner join asterisk.sistema_deuda de on de.rut=datos.rut and de.campaign_id=datos.campaign_id
inner join asterisk.sistema_gestiones ges on ges.rut_cliente=datos.rut and datos.campaign_id=ges.campaign
inner join asterisk.vicidial_users usr on usr.user=ges.user 
where datos.campaign_id like 'tri%' and length(ges.cod_gestion2)=2 and de.tramo like '%$campana%' and date(fecha)='2016-06-07' ";
                 "and date(fecha)=date(now()) ";
        $res = mysql_query($sql, $this->conectar_db($bd)) or die(mysql_error());
        while ($consu = mysql_fetch_array($res)) {
            $app = explode(' ', $consu['operador']);
            if (sizeof($app) > 3) {
                $nomop = $app[2];
            } else {
                $nomop = $app[1];
            }
            if ((substr(trim($consu['fono_contacto']), 0, 1) != 9) and ( substr($consu['fono_contacto'], 0, 1) != 2)) {
                $fono = substr($consu['fono_contacto'], -7);
                $area = substr($consu['fono_contacto'], 1, 2);
            } else {
                $fono = substr($consu['fono_contacto'], -8);
                $area = substr($consu['fono_contacto'], 1, 1);
            }
            $contenido = $consu['campo1']
                    . $this->espacios_izq('TRI' . $this->ceros_izq($consu['cuenta'], 8), 25)
                    . $consu['fechayhora']
                    . '   '
                    . 'L1' . trim($consu['cod_accion'])
                    . $this->espacios_izq('  ' . $nomop, 10)
                    . $this->espacios_izq(str_replace(chr(10), '', str_replace(chr(13), '', substr($consu['observacion'], 0, 56))), 56)
                    . chr(10);
            fwrite($fp, $contenido);
        }
    }

    private function espacios($campo, $largo) {
        $lcampo = strlen($campo);
        $tcampo = $largo - $lcampo;
        $lcampo;
        for ($i = 0; $i < $tcampo; $i++) {
            $campo = ' ' . $campo;
        }
        return $campo;
    }

    private function espacios_izq($campo, $largo) {
        $lcampo = strlen($campo);
        $tcampo = $largo - $lcampo;
        $lcampo;
        for ($i = 0; $i < $tcampo; $i++) {
            $campo = $campo . ' ';
        }
        return $campo;
    }

    private function ceros($campo, $largo) {
        $lcampo = strlen($campo);
        $tcampo = $largo - $lcampo;
        $lcampo;
        for ($i = 0; $i < $tcampo; $i++) {
            $campo = '0' . $campo;
        }
        return $campo;
    }

    private function ceros_izq($campo, $largo) {
        $lcampo = strlen($campo);
        $tcampo = $largo - $lcampo;
        $lcampo;
        for ($i = 0; $i < $tcampo; $i++) {
            $campo = '0' . $campo;
        }
        return $campo;
    }
	private function sanear_string($string)
{

    //$string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ã', 'ç', 'Ã'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );


    return $string;
}
}
