MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD=""
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_abcdin";
FECHA=$(date +"%Y%m%d");
FECHA_CAMPA=$(date +"%m%y");
echo "********* Cargando deudores no registrados **********"
mysql ${USUARIOBD} ${PWDBD} -e "insert into ${BASE_DATOS}.sistema_deudor 

select null,'ABCC${FECHA_CAMPA}',null,  substring(tmp.dmssnum,1,length(tmp.dmssnum)-2) as rut,substring(tmp.dmssnum,-1)as dv,tmp.dmname as nombre,'' as app,'' as apm ,tmp.dmacct as rut_repLeg,tmp.u6fecnac as nom_repLegal,'' as etapa_Cob,'' as edad,'nvo' as act_eco,tmp.dmlastlc as  empleador
from ${BASE_DATOS}.${TBL_TEMPORAL} tmp where tmp.estado is null;
"

echo "********* CARGANDO DEUDAS NUEVAS **************"
mysql ${USUARIOBD} ${PWDBD}   -e "insert into ${BASE_DATOS}.sistema_deuda

select null, 'ABCC${FECHA_CAMPA}' as campana,  substring(tmp.dmssnum,1,length(tmp.dmssnum)-2) as rut,substring(tmp.dmssnum,-1)as dv,'' as num_doc,'' as total_cuotas,'' as tipodoc,'' as edeuda,'' as cuotasven,concat(substring(tmp.u6vencumo,-4),'-',substring(tmp.u6vencumo,4,2),'-',substring(tmp.u6vencumo,1,2)) as fecven,concat(substring(tmp.dmassagdt,-4),'-',substring(tmp.dmassagdt,4,2),'-',substring(tmp.dmassagdt,1,2)) as fecasig,'' as feccoloca
,tmp.u6deuvenc,tmp.u6totdeud,'' as abono,'' as fecabono,tmp.u6deuvenc,tmp.dmcurbal,'' as cotaspa,'' as fecatuali,'' as cartera,tmp.u6trammor,tmp.u6moncumo,'' as salcuo,'' as provcredi,'' as codprod,'' as of1,'' as of2,'' as ad1,'' as ad2,''as ad3,'' as ad4,'' as ad5,'' ascodcedente  
from sistema_temporal_abcdin tmp where tmp.estado is null"


mysql ${USUARIOBD} ${PWDBD} -e "insert into ${BASE_DATOS}.sistema_ubicabilidad
select null,'ABCC0616' as  camp, (select ubi.list_id  from  sistema_ubicabilidad ubi where ubi.campaign_id='ABCC0616' group by ubi.campaign_id) as id_lista,replace(substring(tmp.dmssnum,1,length(tmp.dmssnum)-2),'.','') as rut,substring(tmp.dmssnum,-1) as dv,tmp.dmaddr1,'' as num,tmp.dmaddr2,tmp.dmcity,'',tmp.fono1,tmp.fono2,tmp.fono3,tmp.fono4,tmp.fono5,'' as email1,'' as email2

from ${BASE_DATOS}.${TBL_TEMPORAL} tmp;"

