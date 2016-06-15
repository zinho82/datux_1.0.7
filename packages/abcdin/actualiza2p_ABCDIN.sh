MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD="-pzinho1982" 
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_abcdin";
FECHA=$(date +"%Y%m%d");
FECHA_ARCH=$(date +"%y%m%d")



echo "CARGANDO DEUDOR"
mysql ${USUARIOBD} ${PWDBD} -e "select  substring(tmp.dmssnum,1,length(tmp.dmssnum)-2) as rut,substring(tmp.dmssnum,-1)as dv,tmp.dmname as nombre,'' as app,'' as apm ,tmp.dmacct as rut_repLeg,tmp.u6fecnac as nom_repLegal,'' as etapa_Cob,'' as edad,'' as act_eco,tmp.dmlastlc as  empleador from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_act_deudores_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"

echo "CARGANDO DEUDA"
mysql ${USUARIOBD} ${PWDBD} -e "select  substring(tmp.dmssnum,1,length(tmp.dmssnum)-2) as rut,substring(tmp.dmssnum,-1)as dv,'','','' as tipodoc,'' as edeuda,'' as cuotasven,concat(substring(tmp.u6vencumo,-4),'-',substring(tmp.u6vencumo,4,2),'-',substring(tmp.u6vencumo,1,2)) as fecven,concat(substring(tmp.dmassagdt,-4),'-',substring(tmp.dmassagdt,4,2),'-',substring(tmp.dmassagdt,1,2)) as fecasig,'' as feccoloca
,tmp.u6deuvenc,tmp.u6totdeud,'' as abono,'' as fecabono,tmp.u6deuvenc,tmp.dmcurbal,'' as cotaspa,'' as fecatuali,'' as cartera,tmp.u6trammor,tmp.u6moncumo,'' as salcuo,'' as provcredi,'' as codprod,'' as of1,'' as of2,'' as ad1,'' as ad2,''as ad3,'' as ad4,'' as ad5,'' ascodcedente from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_act_deuda_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'
"

echo "**************CARGANDO FORMA DE CONTACTO***************"

mysql ${USUARIOBD} ${PWDBD} -e "
select replace(substring(tmp.dmssnum,1,length(tmp.dmssnum)-2),'.','') as rut,substring(tmp.dmssnum,-1) as dv,tmp.dmaddr1,'' as num,tmp.dmaddr2,tmp.dmcity,'',tmp.fono1,tmp.fono2,tmp.fono3,tmp.fono4,tmp.fono5
from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_act_UBICABILIDAD_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"

cd /var/www/html/sistema_gestion/archivos/cargar/

tar  cvf ABCDIN_act_${FECHA}.tar ABCDIN_act_*${FECHA}.csv

cd /root

echo "*************ENVIANDO ARCHIVO DE CARGA************************"
echo "CARGA ABCDIN" | mutt $MAIL -s "FORMATOS CARGA ABCDIN COBRANZA" -a /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_act_${FECHA}.tar 

echo "********** CARGA FINALIZADA **************"

echo "*************** ENVIANDO ARCHIVO RESULTADO DE LA CARGA****************"
mysql ${USUARIOBD} ${PWDBD} -e "select * from ${BASE_DATOS}.sistema_temporal_resultado tr where tr.numcarga=${FECHA} and tr.campana='${TBL_TEMPORAL}'
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY ';'" 

mysql ${USUARIOBD} ${PWDBD} -e "
select count(*), da.rut,da.dv from ${BASE_DATOS}.${TBL_TEMPORAL} ab
inner join ${BASE_DATOS}.sistema_deudor da on concat(da.rut,'-',da.dv)=ab.dmssnum group by da.rut,da.campaign_id

INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_ruts_exitentes_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"

cd /var/www/html/sistema_gestion/archivos/cargar/

tar cvf ABCDIN_resultado_${FECHA}.tar ABCDIN_resultado*${FECHA}.csv

echo "RESULTADO CARGA ABCDIN" | mutt $MAIL -s "RESULTADO CARGA ABCDIN COBRANZA" -a /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_${FECHA}.tar

