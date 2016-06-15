BASE="asterisk"
USRBD="-uroot"
PWDBD=""
MAIL="soporte@datux.cl"
FECHA=$(date +"%Y%m%d")
TBL_TEMPORAL="sistema_tricot_carga"

echo "******* Limpiando tablas temporales **********"
rm -rf /var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_deudor_${FECHA}.csv
rm -rf /var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_deuda_${FECHA}.csv
rm -rf /var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_ubicabilidad_${FECHA}.csv
mysql ${USRBD} ${PWDBD} -e "truncate ${BASE}.${TBL_TEMPORAL}"

cp /var/www/html/sistema/archivos/Asignacion_abril_2015_Silca.csv /var/www/html/sistema_gestion/archivos/sistema_tricot_carga.csv

echo "*********** cargando tabla temporal *************"

mysqlimport ${USRBD} ${PWDBD} ${BASE} /var/www/html/sistema_gestion/archivos/sistema_tricot_carga.csv  --fields-terminated-by=';'

echo "************ Reparando telefonos****************"
 php /var/www/html/sistema_gestion/carga/carga/view/index_TRICOT.php

echo  "***********Creando Archivo Deudor************"
mysql ${USRBD} ${PWDBD} -e "select  tmp.rut_cliente as rut,'' as dv,tmp.nombre as nombre,'' as app,'' as apm ,'' as rut_rep_legal,'' as nom_rep_legal,'' as etapa_cobranza,'' as edad,'' as act_econom,'' as empleador from ${BASE}.${TBL_TEMPORAL} tmp
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_deudor_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"


echo  "***********Creando Archivo Deuda************"
mysql ${USRBD} ${PWDBD} -e "select  rut_cliente as rut,'' as dv,'' as num_doc,'' as tot_cuotas,'' as tipodoc,tmp.estado as edeuda,'' as cuotasven,concat(substring(tmp.fecha_proceso,-4),'-',substring(tmp.fecha_proceso,4,2),'-',substring(tmp.fecha_proceso,1,2)) as fecven,'' as fecasig,'' as feccoloca
,tmp.capital as monto,tmp.otros as deu_total,'' as abono,'' as fecabono,'' as deu_morosa,'' as cuotaspag,'' as fecatuali,'' as cartera,'' as tramo,'' as val_cuota,'' as salcuo,'' as provcredi,'' as codprod,'' as of1,'' as of2,'' as ad1,'' as ad2,''as ad3,'' as ad4,'' as ad5,'' as codcedente
from ${BASE}.${TBL_TEMPORAL} tmp
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_deuda_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"


echo  "***********Creando Archivo ubicabilidad************"
mysql ${USRBD} ${PWDBD} -e "select tmp.rut_cliente as rut,'' as dv,tmp.calle_part as calle,tmp.numero_part as numero,concat(tmp.dpto_part,' ',tmp.villa_part) as resto,tmp.nom_comu as comuna,tmp.nom_region as ciudad
,case
when length(tmp.fono_part)=9              then concat(56,tmp.fono_part)
when length(tmp.num_cel)=9     then concat(56,tmp.num_cel)
when length(tmp.telefono_cel)=9    then concat(56,tmp.telefono_cel)
when length(tmp.fono_ref)=9 then concat(56,tmp.fono_ref)

end as f1
,case

when length(tmp.num_cel)=9     then concat(56,tmp.num_cel)
when length(tmp.telefono_cel)=9    then concat(56,tmp.telefono_cel)
when length(tmp.fono_ref)=9 then concat(56,tmp.fono_ref)
end as f2
,case


when length(tmp.telefono_cel)=9    then concat(56,tmp.telefono_cel)
when length(tmp.fono_ref)=9 then concat(56,tmp.fono_ref)
end as f3
,case


when length(concat(tmp.fono_ref))=9 then concat(56,tmp.fono_ref)
end as f4
from ${BASE}.${TBL_TEMPORAL} tmp
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_ubicabilidad_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"

cd /var/www/html/sistema_gestion/archivos/cargar/
echo "********* Enviando Archivos de Carga*************"

tar cvf TRICOT_carga_${FECHA}.tar TRICOT_carga*${FECHA}.csv

echo "ARCHIVOS CARGA TRICOT" | mutt $MAIL -s "ARCHIVOS CARGA TRICOT COBRANZA" -a /var/www/html/sistema_gestion/archivos/cargar/TRICOT_carga_${FECHA}.tar
