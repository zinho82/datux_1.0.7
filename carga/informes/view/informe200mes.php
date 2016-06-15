<?php
require_once '../../ppal/superior.php'; 
if($_POST['fecha']){
        if(!is_dir(__ROOT__.MODULO_ACCESORIOS. "/archivos")) {
            mkdir(__ROOT__.MODULO_ACCESORIOS."/archivos", 0777);
            echo "<br>creado archivos<br>";
        }
        if(!is_dir(__ROOT__.MODULO_ACCESORIOS. "/archivos/informes")) {
            mkdir(__ROOT__.MODULO_ACCESORIOS."/archivos/informes", 0777);
            echo "<br>creado informes<br>";
        }
        if(!is_dir(__ROOT__.MODULO_ACCESORIOS. "/archivos/informes/200")) {
            mkdir(__ROOT__.MODULO_ACCESORIOS."/archivos/informes/200", 0777);
            echo "<br>creado 200<br>";
        }
        
        unlink(__ROOT__.MODULO_ACCESORIOS. "archivos/informes/200/b200_sa017_".date("ymd").".txt");
        $fp=fopen(__ROOT__.MODULO_ACCESORIOS. "archivos/informes/200/b200_sa017_".date("ymd").".txt","x") ;
        if(!is_file(__ROOT__.MODULO_ACCESORIOS."archivos/informes/200/b200_sa017_".date("ymd").".txt")){
            echo "archivo no existe";
        }
        
 
        Predictivo::traer_datos_llamadas_informe('', "call_center",  str_replace('/', '-', $_POST['fecha']));
       
        Predictivo::traer_carpeta('call_center','idcliente','id_carpeta');
        Predictivo::traer_carpeta('call_center','campana','id_cartera');
        
     /////////////////////
     //// base altoriesgo
     /////////////////////
        
         $sql="select 
'2006' as campo1,case
	when length(origen.dmacct)<8 then concat(origen.dmacct,' ')
else
origen.dmacct
end 
as cuenta
,case when hour(datos.fecha_gestion)<10 then date_format(datos.fecha_gestion,'%m%d%Y 0%k:%i:%s') 
else date_format(datos.fecha_gestion,'%m%d%Y %k:%i:%s') end as fechayhora
,'001' as campo2
,rra.cod_accion
,rrs.cod_resultado
,substring(datos.comentario,1,56) as observacion
,fono_contacto
from data_altoriesgo_abcdin.historico_gestion datos 
inner join data_altoriesgo_abcdin.data_altoriesgo_abcdin_datos origen on origen.id_cartera=datos.cartera_id_cartera
inner join callcenter.resp_rapida_accion rra on rra.id_resp_rapida_accion=datos.resp_rapida_resultado_id_resp_rapida_resultado
inner join callcenter.resp_rapida_resultado rrs on rrs.id_resp_rapida_resultado=datos.resp_rapida_accion_id_resp_rapida_accion where date(datos.fecha_gestion) like '2015-12%'";
        $res=mysql_query($sql,  Config::conectar_db('callcenter')) or die(mysql_error());
                while($consu=mysql_fetch_array($res)){
                      $contenido=$consu['campo1'].  Config::espacios_izq($consu['cuenta'],25)
                            .$consu['fechayhora']
                            .$consu['campo2']
                            .trim($consu['cod_accion'])
                            .$consu['cod_resultado']
                            .  Config::espacios('063',10)
                            .str_replace(chr(10), '',str_replace(chr(13), '',$consu['fono_contacto'].'.'.$consu['observacion']))
                            .chr(13).chr(10);
                    fwrite($fp,$contenido);
                }
        /////////////////////  
     //// base especial
     /////////////////////      
       echo $sql="select 
'2006' as campo1,case
	when length(origen.dmacct)<8 then concat(origen.dmacct,' ')
else
origen.dmacct
end 
as cuenta
,case when hour(datos.fecha_gestion)<10 then date_format(datos.fecha_gestion,'%m%d%Y 0%k:%i:%s') 
else date_format(datos.fecha_gestion,'%m%d%Y %k:%i:%s') end as fechayhora
,'001' as campo2
,rra.cod_accion
,rrs.cod_resultado
,substring(datos.comentario,1,56) as observacion
,fono_contacto
from data_especial_abcdin.historico_gestion datos 
inner join data_especial_abcdin.data_especial_abcdin_datos origen on origen.id_cartera=datos.cartera_id_cartera
inner join callcenter.resp_rapida_accion rra on rra.id_resp_rapida_accion=datos.resp_rapida_resultado_id_resp_rapida_resultado
inner join callcenter.resp_rapida_resultado rrs on rrs.id_resp_rapida_resultado=datos.resp_rapida_accion_id_resp_rapida_accion where date(datos.fecha_gestion) like '2015-12%'";
        $res=mysql_query($sql,  Config::conectar_db('callcenter')) or die(mysql_error());
                while($consu=mysql_fetch_array($res)){
                      $contenido=$consu['campo1'].  Config::espacios_izq($consu['cuenta'],25)
                            .$consu['fechayhora']
                            .$consu['campo2']
                            .trim($consu['cod_accion'])
                            .$consu['cod_resultado']
                            .  Config::espacios('063',10)
                            .str_replace(chr(10), '',str_replace(chr(13), '',$consu['fono_contacto'].'.'.$consu['observacion']))
                            .chr(13).chr(10);
                    fwrite($fp,$contenido);
                }
            /////////////////////
     //// base nresto
     /////////////////////
               $sql="select 
'2006' as campo1,case
	when length(origen.dmacct)<8 then concat(origen.dmacct,' ')
else
origen.dmacct
end 
as cuenta 
,case when hour(datos.fecha_gestion)<10 then date_format(datos.fecha_gestion,'%m%d%Y 0%k:%i:%s') 
else date_format(datos.fecha_gestion,'%m%d%Y %k:%i:%s') end as fechayhora
,'001' as campo2
,rra.cod_accion
,rrs.cod_resultado
,substring(datos.comentario,1,56) as observacion
,fono_contacto
from data_nresto_abcdin.historico_gestion datos 
inner join data_nresto_abcdin.data_nresto_abcdin_datos origen on origen.id_cartera=datos.cartera_id_cartera
inner join callcenter.resp_rapida_accion rra on rra.id_resp_rapida_accion=datos.resp_rapida_resultado_id_resp_rapida_resultado
inner join callcenter.resp_rapida_resultado rrs on rrs.id_resp_rapida_resultado=datos.resp_rapida_accion_id_resp_rapida_accion where date(datos.fecha_gestion) like '2015-12%'";
        $res=mysql_query($sql,  Config::conectar_db('callcenter')) or die(mysql_error());
                while($consu=mysql_fetch_array($res)){
                      $contenido=$consu['campo1'].Config::espacios_izq($consu['cuenta'],25)
                            .$consu['fechayhora']
                            .$consu['campo2']
                            .trim($consu['cod_accion'])
                            .$consu['cod_resultado']
                            .  Config::espacios('063',10)
                            .str_replace(chr(10), '',str_replace(chr(13), '',$consu['fono_contacto'].'.'.$consu['observacion']))
                            .chr(13).chr(10);
                    fwrite($fp,$contenido);
                }
            /////////////////////
     //// Recorrido Predictivo
     /////////////////////
                 '<br>extrayendo gesition predictivo';
   /*       $sql="select '2006' as campo1
,case when length(ar.dmacct)<11 then concat(ar.dmacct,' ') else ar.dmacct end as cuenta, case when hour(fecha_gestion)<10 then date_format(fecha_gestion,'%m%d%Y 0%k:%i:%s') else date_format(fecha_gestion,'%m%d%Y %k:%i:%s') end as fecha_hora,'SM' as cod_accion,'001' as campo2,fono,id_llamada,case when failure_cause=17 or failure_cause=18 or failure_cause=20 or failure_cause='19' or failure_cause='21' or failure_cause='58' or status='ShortCall' then 'Z1' when failure_cause=16 then 'Z0' when failure_cause=28 or failure_cause=1 or failure_cause=22 or failure_cause=127 then 'Z4' when (status='Failure' or status='NoAnswer') and failure_cause='' then 'Z4' end as rrs,case when failure_cause=16 or failure_cause=20 then '.No Contesta' when failure_cause=17 or failure_cause='19' or failure_cause='21' or failure_cause='58' then '.Telefono Ocupado' when failure_cause=28 or failure_cause=1 or failure_cause=22 or failure_cause=127 then '.Telefono No Existe' when status='Failure' and failure_cause='' then '.Telefono sin Servicio' when status='ShortCall' and failure_cause='' then 'Telefono No Existe' when status='NoAnswer' and failure_cause='' then 'Telefono No Existe' end as comen 
from callcenter.recorrido_predictivo rp
inner join callcenter.campanas camp on camp.idcampanas=rp.id_cartera
inner join data_altoriesgo_abcdin.data_altoriesgo_abcdin_datos ar on ar.id_cartera=rp.id_carpeta";   
        
        $res=  mysql_query($sql,  Config::conectar_db('callcenter')) or die(mysql_error());
        while($consu=mysql_fetch_array($res)){
              $contenido=$consu['campo1'].$consu['cuenta']
                        . Config::espacios($consu['fecha_hora'],31)
                        .$consu['campo2']
                        .$consu['cod_accion']
                        .$consu['rrs'] 
                        . Config::espacios('063',10)  
                        .$consu['fono'].$consu['comen']
                        .chr(13).chr(10);
            fwrite($fp,$contenido);
        }*/  
            fclose($fp) ; 
}
 ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Archivo de Gestion
    </div>
    <div class="panel-body">
        <form method="post">
            <div class='input-group date' id='datetimepicker2'>
                <span class="input-group-addon">
                    Fecha
                    <span class="glyphicon glyphicon-calendar"></span>
                 </span>
                <input type='text' name="fecha" class="form-control" />
            </div>
            <input type="submit" class="btn btn-block btn-info" value="Crear Informe">
        </form>
        <?php if(isset($_POST['fecha'])):?>
        <br>
        <a class="btn btn-block btn-warning" href="<?php echo BASE_URL.MODULO_ACCESORIOS."archivos/informes/200/b200_sa017_".  date("ymd").".txt" ?>">Descargar Informe Gestion</a>
        <?php endif;?>
    </div>
           
    
</div>
<?php require_once '../../ppal/footer.php';?>