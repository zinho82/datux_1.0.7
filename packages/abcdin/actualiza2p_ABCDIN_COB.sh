MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD="" 
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
mysql ${USUARIOBD} ${PWDBD} -e "select  substring(tmp.dmssnum,1,length(tmp.dmssnum-2)) as rut,substring(tmp.dmssnum,-1)as dv,concat('K=',tmp.u6conptint,'% I=',tmp.u6conptcuo)  as nro_doc,'' as tot_cuotas,tmp.u6gastcob as tipodoc,'' as edeuda,'' as cuotasven,concat(substring(tmp.u6vencumo,-4),'-',substring(tmp.u6vencumo,4,2),'-',substring(tmp.u6vencumo,1,2)) as fecven,concat(substring(tmp.dmassagdt,-4),'-',substring(tmp.dmassagdt,4,2),'-',substring(tmp.dmassagdt,1,2)) as fecasig,'' as feccoloca
,tmp.u6deuvenc as monto,tmp.u6totdeud as deuda_total,'' as abono,'' as fecabono,tmp.u6deuvenc as deuda_morosa,tmp.dmpayamt as cuotaspa,concat(substring(tmp.dmpaydt,-4),'-',substring(tmp.dmpaydt,3,2),'-',substring(tmp.dmpaydt,1,2)) as fecatuali,'' as cartera,tmp.u6trammor as tramo,tmp.u6moncumo as val_cuota,'' as sald_cuo,'' as provcredi,'' as dias_mora,tmp.u6deuvenc as codprod,tmp.u6intxmora as of1,round((tmp.u6deuvenc+ tmp.u6tdeuxven+tmp.u6carxtrve+ tmp.u6carxtrxv)) as of2,tmp.dmppdue as ad1,tmp.dmresv1 as ad2,tmp.u6tdeuxven as ad3,
round(((tmp.u6deuvenc+ tmp.u6tdeuxven)*(tmp.u6conptint/100))+((tmp.u6carxtrve+ tmp.u6carxtrxv)*(tmp.u6conptgas/100))+((tmp.u6otrcarv+ tmp.u6carxven)*(tmp.u6conptgas/100))+(tmp.u6gastcob*(tmp.u6conptotr/100))+(tmp.u6intxmora*(tmp.u6conptcar/100))) as ad4, round((tmp.u6deuvenc+ tmp.u6tdeuxven+tmp.u6carxtrve+ tmp.u6carxtrxv)*(tmp.u6conrepie/100)) as ad5,'' as codcedente   from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
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

#echo "*************ENVIANDO ARCHIVO DE CARGA************************"
#echo "CARGA ABCDIN" | mutt $MAIL -s "FORMATOS CARGA ABCDIN COBRANZA" -a /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_act_${FECHA}.tar 

echo "********** CARGA FINALIZADA **************"

#echo "*************** ENVIANDO ARCHIVO RESULTADO DE LA CARGA****************"
#mysql ${USUARIOBD} ${PWDBD} -e "select * from ${BASE_DATOS}.sistema_temporal_resultado tr where tr.numcarga=${FECHA} and tr.campana='${TBL_TEMPORAL}'
#INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_${FECHA}.csv'
#FIELDS TERMINATED BY ';'
#ENCLOSED BY ''
#LINES TERMINATED BY ';'" 

#mysql ${USUARIOBD} ${PWDBD} -e "
#select count(*), da.rut,da.dv from ${BASE_DATOS}.${TBL_TEMPORAL} ab
#inner join ${BASE_DATOS}.sistema_deudor da on concat(da.rut,'-',da.dv)=ab.dmssnum group by da.rut,da.campaign_id

#INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_ruts_exitentes_${FECHA}.csv'
#FIELDS TERMINATED BY ';'
#ENCLOSED BY ''
#LINES TERMINATED BY '\n'"

#cd /var/www/html/sistema_gestion/archivos/cargar/

#tar cvf ABCDIN_resultado_${FECHA}.tar ABCDIN_resultado*${FECHA}.csv

#echo "RESULTADO CARGA ABCDIN" | mutt $MAIL -s "RESULTADO CARGA ABCDIN COBRANZA" -a /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_${FECHA}.tar

