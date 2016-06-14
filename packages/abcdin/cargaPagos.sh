MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD=""
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_pagos";
FECHA=$(date +"%Y%m%d");
FECHA_ARCH=$(date +"%y%m%d")
FECHA_NORM=$(date + "%Y-%m")

cd /var/www/html/sistema_gestion/archivos
echo "CaMP 096"
echo "**************** Descargando Archivo de Cobranza desde ABC-DIN **********"
HOST='ftp.mkyc.cl'
USER='abcdin@mkyc.cl'
PASSWD='46824682'
mkdir  /var/www/html/sistema_gestion/archivos/pagos/
cd /var/www/html/sistema_gestion/archivos/pagos/
lftp -du $USER,$PASSWD $HOST  -e "get  ABCDIN_C_PAGO096_${FECHA_ARCH}.txt ;bye"

echo "archivos DEscargado"

cp /var/www/html/sistema_gestion/archivos/pagos/ABCDIN_C_PAGO096_${FECHA_ARCH}.txt /var/www/html/sistema_gestion/archivos/pagos/${TBL_TEMPORAL}.txt -v
echo " Limpiando Tabla Temporal "
mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL}"

echo " CARGANDO ARCHIVO ORIGINAL "
mysqlimport --local ${USUARIOBD} ${PWDBD} ${BASE_DATOS} /var/www/html/sistema_gestion/archivos/pagos/${TBL_TEMPORAL}.txt

echo " Cargando formateando campos"
mysql ${USUARIOBD} ${PWDBD} -e "update ${BASE_DATOS}.${TBL_TEMPORAL}  tmp
set
tmp.fecha1=trim(substring(tmp.cuenta,20,20))
,tmp.monto=trim(substring(tmp.cuenta,40,11))
,tmp.codigo=trim(substring(tmp.cuenta,51,5))
,tmp.fecha2=trim(substring(tmp.cuenta,56,12))
,tmp.cuenta=trim(substring(tmp.cuenta,1,19))

"
echo "Cargando Pagos"
mysql ${USUARIOBD} ${PWDBD} -e  "delete from   ${BASE_DATOS}.sistema_temporal_pagos  where codigo!='0'"



mysql ${USUARIOBD} ${PWDBD} -e "insert into  ${BASE_DATOS}.sistema_pagos (fecha,monto,total_pagado,fec_pago,rut,dv,campaign,fec_venc) 
select concat( substring(pa.fecha2,-4),'-',substring(pa.fecha2,4,2),'-',substring(pa.fecha2,1,2)),pa.monto,pa.monto,concat( substring(pa.fecha2,-4),'-',substring(pa.fecha2,4,2),'-',substring(pa.fecha2,1,2)) 
,de.rut,de.dv,de.campaign_id,deu.fec_venc
from  ${BASE_DATOS}.sistema_temporal_pagos pa

inner join  ${BASE_DATOS}.sistema_deudor de on de.rut_rep_legal=pa.cuenta 
inner join ${BASE_DATOS}.sistema_deuda deu on deu.rut=de.rut and de.campaign_id like 'abcdi%'
  
"


echo "CAMP. 138"

cd /var/www/html/sistema_gestion/archivos/pagos/
lftp -du $USER,$PASSWD $HOST  -e "get  ABCDIN_C_PAGO194_${FECHA_ARCH}.txt ;bye"

echo "archivos DEscargado"

cp /var/www/html/sistema_gestion/archivos/pagos/ABCDIN_C_PAGO194_${FECHA_ARCH}.txt /var/www/html/sistema_gestion/archivos/pagos/${TBL_TEMPORAL}.txt -v
echo " Limpiando Tabla Temporal "
mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL}"

echo " CARGANDO ARCHIVO ORIGINAL "
mysqlimport --local ${USUARIOBD} ${PWDBD} ${BASE_DATOS} /var/www/html/sistema_gestion/archivos/pagos/${TBL_TEMPORAL}.txt

echo " Cargando formateando campos"
mysql ${USUARIOBD} ${PWDBD} -e "update ${BASE_DATOS}.${TBL_TEMPORAL}  tmp
set
tmp.fecha1=trim(substring(tmp.cuenta,20,20))
,tmp.monto=trim(substring(tmp.cuenta,40,11))
,tmp.codigo=trim(substring(tmp.cuenta,51,5))
,tmp.fecha2=trim(substring(tmp.cuenta,56,12))
,tmp.cuenta=trim(substring(tmp.cuenta,1,19))

"



mysql ${USUARIOBD} ${PWDBD} -e "insert into  ${BASE_DATOS}.sistema_pagos (fecha,monto,total_pagado,fec_pago,rut,dv,campaign,fec_venc)
select concat( substring(pa.fecha2,-4),'-',substring(pa.fecha2,4,2),'-',substring(pa.fecha2,1,2)),pa.monto,pa.monto,concat( substring(pa.fecha2,-4),'-',substring(pa.fecha2,4,2),'-',substring(pa.fecha2,1,2))
,de.rut,de.dv,de.campaign_id,deu.fec_venc
from  ${BASE_DATOS}.sistema_temporal_pagos pa
inner join  ${BASE_DATOS}.sistema_deudor de on de.rut_rep_legal=pa.cuenta 
inner join ${BASE_DATOS}.sistema_deuda deu on deu.rut=de.rut and deu.campaign_id like 'ABCD0%'"
                                                                                
