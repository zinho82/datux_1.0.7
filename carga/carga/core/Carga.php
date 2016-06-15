<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carga
 *
 * @author zinho
 */
class Carga {
    public function Limpiar_caracteres($campo,$base,$tabla) {
        $conn=new Conexion();
        $caracteres=array('"',"'",';',"\\");
        //var_dump($caracteres);
        for($i=0;$i<count($caracteres);$i++){
         $sql="update ".$base.'.'.$tabla. ' set '.$campo.'=replace('.$campo.',"'."$caracteres[$i]".'"'.",'')";
        mysql_query($sql,$conn->conectar_db($base));
        }
        
    }
    public function cargadatos() {
        $conn = new Conexion();
        $sql = "update " . BASE_BD . ".sistema_temporal_abcdin tmp 
set 
tmp.campana='tstcampana'
,tmp.ad2=trim(substring(tmp.ad1,26,12))
,tmp.ad3=trim(substring(tmp.ad1,38,80))
,tmp.ad4=trim(substring(tmp.ad1,118,10))
,tmp.ad5=trim(substring(tmp.ad1,128,1))
,tmp.ad6=trim(substring(tmp.ad1,129,1))
,tmp.ad7=trim(substring(tmp.ad1,130,80))
,tmp.ad8=trim(substring(tmp.ad1,210,80))
,tmp.ad9=trim(substring(tmp.ad1,290,40))
,tmp.ad10=trim(substring(tmp.ad1,330,35))
,tmp.ad11=trim(substring(tmp.ad1,365,10))
,tmp.ad12=trim(substring(tmp.ad1,375,40))
,tmp.ad13=trim(substring(tmp.ad1,415,3))
,tmp.ad14=trim(substring(tmp.ad1,418,13))
,tmp.ad15=trim(substring(tmp.ad1,431,3))
,tmp.ad16=trim(substring(tmp.ad1,434,13))
,tmp.ad17=trim(substring(tmp.ad1,447,3))
,tmp.ad18=trim(substring(tmp.ad1,450,13))
,tmp.ad19=trim(substring(tmp.ad1,463,3))
,tmp.ad20=trim(substring(tmp.ad1,466,13))
,tmp.ad21=trim(substring(tmp.ad1,479,3))
,tmp.ad22=trim(substring(tmp.ad1,482,13))
,tmp.ad23=trim(substring(tmp.ad1,495,3))
,tmp.ad24=trim(substring(tmp.ad1,498,13))
,tmp.ad25=trim(substring(tmp.ad1,511,3))
,tmp.ad26=trim(substring(tmp.ad1,514,13))
,tmp.ad27=trim(substring(tmp.ad1,527,9))
,tmp.ad28=trim(substring(tmp.ad1,536,5))
,tmp.ad29=trim(substring(tmp.ad1,541,1))
,tmp.ad30=trim(substring(tmp.ad1,542,2))
,tmp.ad31=trim(substring(tmp.ad1,544,15))
,tmp.ad32=trim(substring(tmp.ad1,559,10))
,tmp.ad33=trim(substring(tmp.ad1,569,2))
,tmp.ad34=trim(substring(tmp.ad1,571,4))
,tmp.ad35=trim(substring(tmp.ad1,575,8))
,tmp.ad36=trim(substring(tmp.ad1,583,6))
,tmp.ad37=trim(substring(tmp.ad1,589,6))
,tmp.ad38=trim(substring(tmp.ad1,595,2))
,tmp.ad39=trim(substring(tmp.ad1,597,8))
,tmp.ad40=trim(substring(tmp.ad1,605,10))
,tmp.ad41=trim(substring(tmp.ad1,615,35))
,tmp.ad42=trim(substring(tmp.ad1,650,10))
,tmp.ad43=trim(substring(tmp.ad1,660,10))
,tmp.ad44=trim(substring(tmp.ad1,670,10))
,tmp.ad45=trim(substring(tmp.ad1,680,9))
,tmp.ad46=trim(substring(tmp.ad1,689,9))
,tmp.ad47=trim(substring(tmp.ad1,698,9))
,tmp.ad48=trim(substring(tmp.ad1,707,9))
,tmp.ad49=trim(substring(tmp.ad1,716,9))
,tmp.ad50=trim(substring(tmp.ad1,725,9))
,tmp.ad51=trim(substring(tmp.ad1,734,9))
,tmp.ad52=trim(substring(tmp.ad1,743,9))
,tmp.ad53=trim(substring(tmp.ad1,752,9))
,tmp.ad54=trim(substring(tmp.ad1,761,9))
,tmp.ad55=trim(substring(tmp.ad1,770,9))
,tmp.ad56=trim(substring(tmp.ad1,779,10))
,tmp.ad57=trim(substring(tmp.ad1,789,15))
,tmp.ad58=trim(substring(tmp.ad1,804,3))
,tmp.ad59=trim(substring(tmp.ad1,807,3))
,tmp.ad60=trim(substring(tmp.ad1,810,1))
,tmp.ad61=trim(substring(tmp.ad1,811,10))
,tmp.ad62=trim(substring(tmp.ad1,821,15))
,tmp.ad63=trim(substring(tmp.ad1,836,9))
,tmp.ad64=trim(substring(tmp.ad1,845,10))
,tmp.ad65=trim(substring(tmp.ad1,855,5))
,tmp.ad66=trim(substring(tmp.ad1,860,5))
,tmp.ad67=trim(substring(tmp.ad1,865,4))
,tmp.ad68=trim(substring(tmp.ad1,869,2))
,tmp.ad69=trim(substring(tmp.ad1,871,2))
,tmp.ad70=trim(substring(tmp.ad1,873,2))
,tmp.ad71=trim(substring(tmp.ad1,875,6))
,tmp.ad72=trim(substring(tmp.ad1,881,6))
,tmp.ad73=trim(substring(tmp.ad1,887,6))
,tmp.ad74=trim(substring(tmp.ad1,893,5))
,tmp.ad75=trim(substring(tmp.ad1,898,5))
,tmp.ad76=trim(substring(tmp.ad1,903,5))
,tmp.ad77=trim(substring(tmp.ad1,908,5))
,tmp.ad78=trim(substring(tmp.ad1,913,5))
,tmp.ad79=trim(substring(tmp.ad1,918,5))
,tmp.ad80=trim(substring(tmp.ad1,923,5))
,tmp.ad81=trim(substring(tmp.ad1,928,5))
,tmp.ad82=trim(substring(tmp.ad1,933,5))
,tmp.ad83=trim(substring(tmp.ad1,938,5))
,tmp.ad84=trim(substring(tmp.ad1,943,5))
,tmp.ad85=trim(substring(tmp.ad1,948,5))
,tmp.ad86=trim(substring(tmp.ad1,953,5))
,tmp.ad87=trim(substring(tmp.ad1,958,5))
,tmp.ad88=trim(substring(tmp.ad1,963,1))
,tmp.ad89=trim(substring(tmp.ad1,964,10))
,tmp.ad90=trim(substring(tmp.ad1,974,2))
,tmp.ad91=trim(substring(tmp.ad1,976,2))
,tmp.ad92=trim(substring(tmp.ad1,978,2))
,tmp.ad93=trim(substring(tmp.ad1,980,4))
,tmp.ad94=trim(substring(tmp.ad1,984,4))
,tmp.ad95=trim(substring(tmp.ad1,988,4))
,tmp.ad96=trim(substring(tmp.ad1,992,4))
,tmp.ad97=trim(substring(tmp.ad1,996,4))
,tmp.ad98=trim(substring(tmp.ad1,1000,4))
,tmp.ad99=trim(substring(tmp.ad1,1004,4))
,tmp.ad100=trim(substring(tmp.ad1,1008,4))
,tmp.ad101=trim(substring(tmp.ad1,1012,4))
,tmp.ad102=trim(substring(tmp.ad1,1016,4))
,tmp.ad103=trim(substring(tmp.ad1,1020,6))
,tmp.ad104=trim(substring(tmp.ad1,1026,4))
,tmp.ad105=trim(substring(tmp.ad1,1030,4))
,tmp.ad106=trim(substring(tmp.ad1,1034,4))
,tmp.ad107=trim(substring(tmp.ad1,1038,4))
,tmp.ad108=trim(substring(tmp.ad1,1042,4))
,tmp.ad109=trim(substring(tmp.ad1,1046,4))
,tmp.ad100=trim(substring(tmp.ad1,1050,4))
,tmp.ad111=trim(substring(tmp.ad1,1054,4))
,tmp.ad112=trim(substring(tmp.ad1,1058,5))
,tmp.ad113=trim(substring(tmp.ad1,1063,4))
,tmp.ad114=trim(substring(tmp.ad1,1067,10))
,tmp.ad115=trim(substring(tmp.ad1,1077,10))
,tmp.ad116=trim(substring(tmp.ad1,1087,10))
,tmp.ad117=trim(substring(tmp.ad1,1097,15))
,tmp.ad118=trim(substring(tmp.ad1,1112,4))
,tmp.ad119=trim(substring(tmp.ad1,1116,9))
,tmp.ad120=trim(substring(tmp.ad1,1125,13))
,tmp.ad121=trim(substring(tmp.ad1,1138,13))
,tmp.ad122=trim(substring(tmp.ad1,1155,13))
,tmp.ad123=trim(substring(tmp.ad1,1164,13))
,tmp.ad124=trim(substring(tmp.ad1,1177,13))
,tmp.ad125=trim(substring(tmp.ad1,1190,13))
,tmp.ad126=trim(substring(tmp.ad1,1203,10))
,tmp.ad127=trim(substring(tmp.ad1,1213,10))
,tmp.ad128=trim(substring(tmp.ad1,1223,10))
,tmp.ad129=trim(substring(tmp.ad1,1233,10))
,tmp.ad130=trim(substring(tmp.ad1,1243,10))
,tmp.ad131=trim(substring(tmp.ad1,1253,10))
,tmp.ad132=trim(substring(tmp.ad1,1263,10))
,tmp.ad133=trim(substring(tmp.ad1,1273,10))
,tmp.ad134=trim(substring(tmp.ad1,1283,10))
,tmp.ad135=trim(substring(tmp.ad1,1293,10))
,tmp.ad136=trim(substring(tmp.ad1,1303,10))
,tmp.ad137=trim(substring(tmp.ad1,1313,10))
,tmp.ad138=trim(substring(tmp.ad1,1323,10))
,tmp.ad139=trim(substring(tmp.ad1,1333,10))
,tmp.ad140=trim(substring(tmp.ad1,1343,10))
,tmp.ad141=trim(substring(tmp.ad1,1353,10))
,tmp.ad142=trim(substring(tmp.ad1,1363,10))
,tmp.ad143=trim(substring(tmp.ad1,1373,10))
,tmp.ad144=trim(substring(tmp.ad1,1383,10))
,tmp.ad145=trim(substring(tmp.ad1,1393,10))
,tmp.ad146=trim(substring(tmp.ad1,1403,10))
,tmp.ad147=trim(substring(tmp.ad1,1413,10))
,tmp.ad148=trim(substring(tmp.ad1,1423,10))
,tmp.ad149=trim(substring(tmp.ad1,1433,10))
,tmp.ad150=trim(substring(tmp.ad1,1443,10))
,tmp.ad151=trim(substring(tmp.ad1,1453,10))
,tmp.ad152=trim(substring(tmp.ad1,1463,10))
,tmp.ad153=trim(substring(tmp.ad1,1473,10))
,tmp.ad154=trim(substring(tmp.ad1,1483,10))
,tmp.ad155=trim(substring(tmp.ad1,1493,10))
,tmp.ad156=trim(substring(tmp.ad1,1503,10))
,tmp.ad1=trim(substring(tmp.ad1,1,25))
,tmp.ad2=concat(substring(tmp.ad2,1,length(tmp.ad2)-1),'-',substring(tmp.ad2,-1))"
        ;
        mysql_query($sql, $conn->conectar_db(BASE_BD));
    }

    public function campos_null() {
        $conn = new Conexion();
        for ($i = 1; $i < 157; $i++) {
            $sql = "update  vicidial_datux.sistema_temporal_abc set ad$i=null where ad$i=''or ad$i=0";
            if (!mysql_query($sql, $conn->conectar_db('vicidial_datux'))) {
                echo "  El Campo:  ad$i No se ha actualizado  ";
                die(mysql_error());
            } else {
                echo "  El Campo:  ad$i  Se  ha actualizado";
            }
        }
    }

    public function campos_null_esp($inicio, $fin) {
        $conn = new Conexion();
        for ($i = $inicio; $i <= $fin; $i++) {
            $sql = "update  vicidial_datux.sistema_temporal_abc set ad$i=null where ad$i=''or ad$i=0";
            if (!mysql_query($sql, $conn->conectar_db('vicidial_datux'))) {
                echo "  El Campo:  ad$i No se ha actualizado  ";
                die(mysql_error());
            } else {
                echo "  El Campo:  ad$i  Se  ha actualizado";
            }
        }
    }

    public function Reparar_fonos($area, $fono, $tabla, $base, $fcom) {
        $conn = new Conexion();
        #Arreglando formato fonos 
     echo   $sql = "update " . $base . ".$tabla  
set
$fcom=
case 
when length($fono)=6 and $area=2 then '1'
when length($fono)=5 and length($area)=2 then '1'
when length($fono)=7 and $area!=2 and length($area)=1 then '1'
when length($fono)=7 and $area=2 then '1'
when length($fono)=6 and length($area)=2 then '1'
when length($fono)=9 and length($area)=1 then 1
when length($fono)=6 and length($area)=1 then '1'
    when length($fono)=8 and length($area) is null and substring($fono,1,1)=2 then 1
when length($fono)=8 and length($area) is null and substring($fono,1,1)!=2 then 1
when length($fono)=6 and length($area) is null and substring($fono,1,1)=2 then 1
when length($fono)=6 and length($area) is null and substring($fono,1,1)!=2 then 1
else null
end,
$fono=
case 
when length($fono)=6 and $area=2 then concat(22,$area,$fono)
when length($fono)=6 and length($area)=2 then concat(2,$area,$fono)
when length($fono)=7 and $area=2 then concat(2,$area,$fono)
when length($fono)=5 and length($area)=2 then concat(22,$area,$fono)
when length($fono)=7 and $area!=2 and length($area)=1 then concat(9,$area,$fono)
when length($fono)=9 and length($area)=1 then $fono
when length($fono)=6 and length($area)=1 then concat(99,$area,$fono)
when length($fono)=8 and length($area) is null and substring($fono,1,1)=2 then concat(2,$fono)
when length($fono)=8 and length($area) is null and substring($fono,1,1)!=2 then concat(9,$fono)
when length($fono)=6 and length($area) is null and substring($fono,1,1)=2 then concat(222,$fono)
when length($fono)=6 and length($area) is null and substring($fono,1,1)!=2 then concat(999,$fono)
 
else 
concat($area,$fono)
end    ";
        if (!mysql_query($sql, $conn->conectar_db(BASE_BD))) {
            echo "  Fono No Actualizado  ";
            die(mysql_error());
        } else {
            echo "  Fono  Actualizado  ";
        }
    }

    public function Reparar_fonos_1campo($fono, $tabla, $base, $fcom) {
        $conn = new Conexion();
        #Arreglando formato fonos 
        $sql = "update " . $base . ".$tabla  
set
$fcom=
case 
when length($fono)=6 and substring($fono,1,1)=2 then 1
when length($fono)=6 and substring($fono,1,1)=9 then 1
when length($fono)=6 and substring($fono,1,2) between 30 and 69 then 1
when length($fono)=7 and substring($fono,1,2) between 30 and 63 then 1
when length($fono)=7 and substring($fono,1,2) >63 then 1
when length($fono)=7 and substring($fono,1,1)=2 then 1
when length($fono)=8 and substring($fono,1,1)=9 then 1
when length($fono)=8 and substring($fono,1,1)=2 then 1
when length($fono)=7 and substring($fono,1,1) between 7 and 9  then 1
when length($fono)=6 and substring($fono,1,1) between 7 and 9  then 1
else null
end,
$fono=
case 
when length($fono)=6 and substring($fono,1,1)=2 then concat(222,$fono)
when length($fono)=6 and substring($fono,1,1)=9 then concat(999,$fono)
when length($fono)=6 and substring($fono,1,2) between 30 and 69 then concat(substring($fono,1,2),222,substring($fono,-4))
when length($fono)=7 and substring($fono,1,2) between 30 and 63 then concat(substring($fono,1,2),22,substring($fono,-5))
when length($fono)=7 and substring($fono,1,2) >63 then concat(99,$fono)
when length($fono)=7 and substring($fono,1,1)=2 then concat(22,$fono)
when length($fono)=8 and substring($fono,1,1)=9 then concat(9,$fono)
when length($fono)=8 and substring($fono,1,1)=2 then concat(9,$fono)
when length($fono)=7 and substring($fono,1,1) between 7 and 9  then concat(99,$fono)
when length($fono)=6 and substring($fono,1,1) between 7 and 9  then concat(999,$fono)
else
$fono
end    ";
        if (!mysql_query($sql, $conn->conectar_db(BASE_BD))) {
            echo "  Fono No Actualizado  ";
            die(mysql_error());
        } else {
            echo "  Fono  Actualizado  ";
        }
    }

    public function Convertir_numero($area, $fono) {
        $conn = new Conexion();
        $sql = "alter table vicidial_datux.sistema_temporal_abc  change column `$area` `$area`  int null , change column `$fono` `$fono` int null  ";
        if (!mysql_query($sql, $conn->conectar_db('vicidial_datux'))) {
            echo " Columna no  Convertida ";
            die(mysql_error());
        } else {
            echo " Columna   Convertida ";
        }
    }

    public function Convertir_texto($area, $fono) {
        $conn = new Conexion();
        $sql = "alter table vicidial_datux.sistema_temporal_abc  change column `$area` `$area`  varchar(200) null , change column `$fono` `$fono` varchar(200) null  ";
        if (!mysql_query($sql, $conn->conectar_db('vicidial_datux'))) {
            echo " Columna no  Convertida ";
            die(mysql_error());
        } else {
            echo " Columna   Convertida ";
        }
    }

    public function total_registros($base, $tbla) {
        #REGISTROS
        $conn = new Conexion();
        mysql_query("truncate $base.sistema_temporal_resultado", $conn->conectar_db($base));
        $sql = "insert into $base.sistema_temporal_resultado
        select tmp.numero_de_carga,'$tbla',count(*),'Total Registros','" . date('Y-m-d G:i:s') . "' from $base.$tbla tmp ";
        mysql_query($sql, $conn->conectar_db($base));
    }

    public function FonosOK($area, $fono, $numfono, $base, $tbl) {
        $conn = new Conexion();
        #FONOS OK
        $sql = "insert into $base.sistema_temporal_resultado  
select tmp.numero_de_carga,'$tbl',count(*),' $numfono correctos formato','" . date('Y-m-d G:i:s') . "' from $base.$tbl tmp where length(concat(tmp.$area,tmp.$fono))=9";
        mysql_query($sql, $conn->conectar_db($base)) or die(mysql_error());
    }

    public function fonosError($fono, $area, $numfono, $base, $tabla) {
        $conn = new Conexion();

        #FONOS ERRONEOS
        $sql = "insert into $base.sistema_temporal_resultado
            select tmp.numero_de_carga,'$tabla',count(*),'$numfono fonos erroneos','" . date('Y-m-d G:i:s') . "' from $base.$tabla tmp where length(concat(tmp.$area,tmp.$fono))!=9 and tmp.$area is not null";
        mysql_query($sql, $conn->conectar_db($base));
    }

    public function FonosNulos($fono, $area, $numfono, $base, $tabla) {
        #FONOS NULOS
        $conn = new Conexion();
        $sql = "insert into $base.sistema_temporal_resultado  
select tmp.numero_de_carga,'$tabla',count(*),'$numfono fonos Nulos','" . date('Y-m-d G:i:s') . "' from $base.$tabla tmp where tmp.$area is null and tmp.$fono is null or tmp.$fono=0";
        mysql_query($sql, $conn->conectar_db($base));
    }

    public function FonosNoReparables($fono, $area, $numfono, $base, $tbl) {
        $conn = new Conexion();
#FONOS NO REPARABLES
        $sql = "insert into $base.sistema_temporal_resultado  
select tmp.numero_de_carga,'$tbl',count(*),'$numfono fonos No Reparables','" . date('Y-m-d G:i:s') . "' from $base.$tbl tmp where length(concat(tmp.$area,tmp.$fono))<6 and tmp.$area is not null and tmp.$fono!=0";
        mysql_query($sql, $conn->conectar_db($base));
    }

    public function fonosReparados($nomfono, $campo, $base, $tabla, $campana) {
        $conn = new Conexion();
        #FONOS REPARADOS
        $sql = "insert into $base.sistema_temporal_resultado  
select tmp.numero_de_carga,'$tabla',count(*),'$nomfono fonos Reparados formato','" . date('Y-m-d G:i:s') . "' from $base.$tabla tmp where tmp.$campo=1";
        mysql_query($sql, $conn->conectar_db($base)) or die(mysql_error());
    }

    public function RegistrosExiste($campana) {
        $conn=new Conexion();
         $sql="update sistema_temporal_abcdin tmp inner join sistema_deudor de on concat(de.rut,'-',de.dv)=tmp.dmssnum and de.campaign_id='$campana' set tmp.estado=1  ";
        mysql_query($sql,$conn->conectar_db("asterisk"));
    }

}
