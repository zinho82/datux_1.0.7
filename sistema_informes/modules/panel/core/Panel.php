<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Panel
 *
 * @author zinho
 */  
class Panel {

    public function gestionados($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),datediff(now(),ges.fec_venc) from $bd.$tabla ges where ges.campaign='$campana'  and datediff(now(),ges.fec_venc) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 0));
    }

    public function Asignados($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        
         $sql = "select count(*),datediff(now(),ges.fec_venc) from $bd.$tabla ges where ges.campaign_id='$campana'  and datediff(now(),ges.fec_venc) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 0));
    }

    public function Montos($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),datediff(now(),ges.fec_venc),sum(ges.deuda_morosa) from $bd.$tabla ges where ges.campaign='$campana'  and datediff(now(),ges.fec_venc) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 2));
    }

    public function deuda_total($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),datediff(now(),ges.fec_venc),sum(ges.deuda_total) from $bd.$tabla ges where ges.campaign_id='$campana'  and datediff(now(),ges.fec_venc) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 2));
    }

    public function cantPagos($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),datediff(now(),ges.fec_venc),sum(ges.deuda_total) from $bd.$tabla ges where ges.campaign='$campana' and glosa like 'CLIENTE PAGO %'  and datediff(now(),ges.fec_venc) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 0));
    }

    public function montoPagos($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),datediff(now(),ges.fec_venc),sum(ges.deuda_total) from $bd.$tabla ges where ges.campaign='$campana' and glosa like 'CLIENTE PAGO %'  and datediff(now(),ges.fec_venc) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 2));
    }

    public function AsignadosMonto($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),round(ges.deuda_total/1000)from $bd.$tabla ges where ges.campaign_id='$campana'  and round(ges.deuda_total/1000) between $dia_ini and $dia_fin ";

        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 0));
    }

    public function gestionadosMonto($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),round(ges.deuda_total/1000) from $bd.$tabla ges where ges.campaign='$campana'  and round(ges.deuda_total/1000) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 0));
    }

    public function MontosGestionado($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),round(ges.deuda_total/1000),sum(ges.deuda_morosa)/1000 from $bd.$tabla ges where ges.campaign='$campana'  and round(ges.deuda_total/1000) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 2));
    } 

    public function deuda_totalmontos($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),round(ges.deuda_total/1000),round(sum(ges.deuda_total)/1000) from $bd.$tabla ges where ges.campaign_id='$campana'  and round(ges.deuda_total/1000) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 2));
    }

    public function cantPagosMontos($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),round(ges.deuda_total/1000),round(sum(ges.deuda_total)/1000) from $bd.$tabla ges where ges.campaign='$campana' and glosa like 'CLIENTE PAGO %'  and round(ges.deuda_total/1000) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 0));
    }

    public function montoPagosMontos($campana, $bd, $tabla, $dia_ini, $dia_fin) {
        $conn = new Conexion();
        $sql = "select count(*),round(ges.deuda_total/1000),round(sum(ges.deuda_total)/1000) from $bd.$tabla ges where ges.campaign='$campana' and glosa like 'CLIENTE PAGO %'  and round(ges.deuda_total/1000) between $dia_ini and $dia_fin ";
        $res = mysql_query($sql, $conn->conectar_db($bd)) or die(mysql_error());
        return number_format(mysql_result($res, 0, 2));
    }

    public function ContactabilidadGraph($campana, $bd,$nomDiv) {
        $conn = new Conexion();
         $sql = "  select count(*) as cantidad,ges.cod_gestion2,op1.opcion as nom from $bd.sistema_gestiones ges 
inner join $bd.arbol_opciones1 op1 on op1.cod_alt=ges.cod_gestion2 and ges.campaign='$campana'
group by ges.cod_gestion2";
        $res = mysql_query($sql, $conn->conectar_db($bd));

        $conf="jQuery(document).ready(function()
        {
          new  Morris.Donut({
  element: '".$nomDiv."',
  data: [";
        while($data=  mysql_fetch_array($res)){
   $conf.=" {value: ".$data['cantidad'].", label: '".$data['nom']."', formatted: '".$data['cantidad']."' },
   ";
        }
 $conf.=" ],
  formatter: function (x, data) { return data.formatted; }
});
         
    });";
                
    echo $conf;
    }
    public function PenetracionGraph($campana, $bd,$nomDiv) {
        $conn = new Conexion();
           $sql = "  select count(*) as cantidad,ges.cod_gestion2,op1.opcion as nom from $bd.sistema_gestiones ges 
inner join $bd.arbol_opciones1 op1 on op1.cod_alt=ges.cod_gestion2 and ges.campaign='$campana'  and ges.cod_gestion2 like '%PP%'
group by ges.cod_gestion2";
        $res = mysql_query($sql, $conn->conectar_db($bd));

        $conf="jQuery(document).ready(function()
        {
          new  Morris.Donut({
  element: '".$nomDiv."',
  data: [";
        while($data=  mysql_fetch_array($res)){
   $conf.=" {value: ".$data['cantidad'].", label: '".$data['nom']."', formatted: '".$data['cantidad'].' '.$data['cod_gestion2']."' },
   ";
        }
 $conf.=" ],
  formatter: function (x, data) { return data.formatted; }
});
         
    });";  
                
    echo $conf;
    }
    public function PenetracionRutGraph($campana, $bd,$nomDiv) {
        $conn = new Conexion();
           $sql = " select count(*) as cantidad,case when length(ges.rut_cliente)=8 then substring(ges.rut_cliente,1,2) else substring(ges.rut_cliente,1,1) end as rut,ges.cod_gestion2,op1.opcion as nom from $bd.sistema_gestiones ges 
inner join $bd.arbol_opciones1 op1 on op1.cod_alt=ges.cod_gestion2 and ges.campaign='$campana'  and ges.cod_gestion2 like '%PP%'
group by substring(ges.rut_cliente,1,2)";
        $res = mysql_query($sql, $conn->conectar_db($bd));

        $conf="jQuery(document).ready(function()
        {
          new  Morris.Line({
  element: '".$nomDiv."',
  data: [";
        while($data=  mysql_fetch_array($res)){
   $conf.=" {value: ".$data['cantidad'].", label: 'Rut: ".$data['rut']."', formatted: '".$data['cantidad'].' '.$data['cod_gestion2']."' },   "
           ;
        }
 $conf.=" ],
     xkey   :'Valoer x',
     ykeys: ['value'],
     labels: ['value'],
  formatter: function (x, data) { return data.formatted; }
});
         
    });";  
                
    echo $conf;
    }

}
