MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD="-pzinho1982"
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_asig_hites";
TBL_TEMPORAL2="sistema_temporal_pob_hites";

FECHA=$(date +"%Y%m%d");
FECHA_ARCH=$(date +"%y%m%d")
mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL}"
mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL2}"
rm -rf /var/www/html/sistema_gestion/archivos/cargar/HITES_carga_deudor_${FECHA}.csv
rm -rf /var/www/html/sistema_gestion/archivos/cargar/HITES_carga_deuda_${FECHA}.csv
rm -rf /var/www/html/sistema_gestion/archivos/cargar/HITES_carga_ubicabilidad_${FECHA}.csv


mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL}"

echo " CARGANDO ARCHIVO ORIGINAL "
mysqlimport --local ${USUARIOBD} ${PWDBD} ${BASE_DATOS} /var/www/html/sistema_gestion/archivos/${TBL_TEMPORAL}.csv  --fields-terminated-by=';'
mysqlimport --local ${USUARIOBD} ${PWDBD} ${BASE_DATOS} /var/www/html/sistema_gestion/archivos/${TBL_TEMPORAL2}.csv  --fields-terminated-by=';'

