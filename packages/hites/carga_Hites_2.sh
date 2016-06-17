MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD="-pzinho1982"
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_asig_hites";
TBL_TEMPORAL2="sistema_temporal_pob_hites";

FECHA=$(date +"%Y%m%d");
FECHA_ARCH=$(date +"%y%m%d")


"****** DEUDOR *****"
mysql ${USUARIOBD} ${PWDBD} -e "
select  tmp.rut as rut,tmp.dv as dv,tmp.nom as nombre,tmp.app app,tmp.apm as apm ,'' as rut_rep_legal,'' as nom_rep_legal,'' as etapa_cobranza,tmp.fecnac as edad,'' as act_econom,'' as empleador 
from ${BASE_DATOS}.${TBL_TEMPORAL} tmp
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/HITES_carga_deudor_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'
"

"**** DEUDA *******"

mysql ${USUARIOBD} ${PWDBD} -e "select  tmp.rut as rut,tmp.dv as dv,tmp.repactaciones as num_doc,'' as tot_cuotas,asig.ven1 as tipodoc,tmp.estado as edeuda,'' as cuotasven,concat(substring(tmp.fecha_vcto,-4),'-',substring(tmp.fecha_vcto,4,2),'-',substring(tmp.fecha_vcto,1,2)) as fecven,'' as fecasig,'' as feccoloca
,asig.deuda_contado as monto,asig.deudamora as deu_total,'' as abono,'' as fecabono, asig.deudamora as deu_morosa,'' as cuotaspag,'' as fecatuali,'' as cartera,asig.trmofinal as tramo,'' as val_cuota,'' as salcuo,'' as provcredi,'' as codprod,'' as of1,'' as of2,'' as ad1,'' as ad2,''as ad3,'' as ad4,'' as ad5,'' as codcedente

from  ${BASE_DATOS}.${TBL_TEMPORAL2} tmp
inner join ${BASE_DATOS}.${TBL_TEMPORAL} asig on tmp.rut=asig.rut
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/HITES_carga_deuda_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'
"


"***** UBICABILIDAD ******"
mysql ${USUARIOBD} ${PWDBD} -e "select tmp.rut as rut,tmp.dv as dv,tmp.caldp as calle,tmp.brodp as numero,concat(tmp.blodp,' ',tmp.depdp) as resto,tmp.comuna as comuna,tmp.ciudad as ciudad
,case
when length(pob.fondp)=9              then concat(56,pob.fondp)
when length(pob.celca2)=9     then concat(56,pob.celca2)
when length(pob.celca1)=9     then concat(56,pob.celca1)
when length(pob.celpa1)=9     then concat(56,pob.celpa1)
when length(pob.celpa2)=9     then concat(56,pob.celpa2)
end as f1
,case


when length(tmp.celca2)=9     then concat(56,tmp.celca2)
when length(tmp.celca1)=9     then concat(56,tmp.celca1)
when length(pob.celpa1)=9     then concat(56,pob.celpa1)
when length(pob.celpa2)=9     then concat(56,pob.celpa2)
end as f2
,case



when length(tmp.celca1)=9     then concat(56,tmp.celca1)
when length(pob.celpa1)=9     then concat(56,pob.celpa1)
when length(pob.celpa2)=9     then concat(56,pob.celpa2)

end as f3


from ${BASE_DATOS}.${TBL_TEMPORAL} tmp
inner join ${BASE_DATOS}.${TBL_TEMPORAL2} pob on pob.rut=tmp.rut

INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/HITES_carga_ubicabilidad_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"

