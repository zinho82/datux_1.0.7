DATE=`date +%d%m%Y`
DATE3=`date +%d%m%Y`
DATE2=`date +%Y-%m-%d`
#DATE2=2016-02-02
echo $DATE2
rm -rf /var/www/html/recordings/grabaciones_tricot/${DATE2}/*
cd /var/www/html/recordings/grabaciones_tricot/
mkdir -p /var/www/html/recordings/grabaciones_tricot/${DATE2}

mysql -e "use asterisk;
SELECT
CONCAT(DATE_FORMAT(vicidial_log.call_date,'%d%m%y'),'_',
DATE_FORMAT(vicidial_log.call_date,'%H%i'),'_',
'SILC','_',LPAD(vicidial_log.user,8,'0'),'_',
LPAD(sistema_gestiones.rut_cliente,8,'0'),'_',
LPAD(MINUTE(SEC_TO_TIME(vicidial_log.length_in_sec)),2,'0'),
LPAD(SECOND(SEC_TO_TIME(vicidial_log.length_in_sec)),2,'0'),'.mp3') as GRABACION,
vicidial_users.full_name AS NOMBRE_EJECUTIVO,
DATE_FORMAT(vicidial_log.call_date,'%d%m%y') AS FECHA_GRABACION,
DATE_FORMAT(vicidial_log.call_date,'%H%i') AS HORA_GRABACION,
'SILC' as CALL_CENTER
FROM recording_log,vicidial_log,sistema_gestiones,vicidial_users
WHERE
vicidial_log.lead_id = sistema_gestiones.lead_id
AND(vicidial_log.campaign_id like '%TR%' or vicidial_log.campaign_id like '%tr%' ) and (vicidial_log.campaign_id NOT IN('SGTRVIG','CCTRVIG','CPTRVIG'))
AND SUBSTRING( vicidial_log.uniqueid, 1, 12 ) = SUBSTRING(sistema_gestiones.uniqueid, 1, 12 )
AND DATE_FORMAT(call_date,'%Y-%m-%d') = '${DATE2}' and vicidial_log.user <> 'VDAD'
AND vicidial_log.lead_id = recording_log.lead_id
AND vicidial_users.user = vicidial_log.user
group by sistema_gestiones.id_gestion; " >  /var/www/html/recordings/grabaciones_tricot/${DATE2}/$DATE3.xls


#| while read fecha hora minuto segundo rutcliente longitud filename user fullname status; do
#    # use $theme_name and $guid variables
#    mkdir -p /var/www/html/recordings/grabaciones_tricot/
#    cd /var/www/html/recordings/grabaciones_tricot/${DATE2}
#    echo $fecha"_"$hora"_"SILC"_"$user"_"$rutcliente"_"$minuto$segundo.mp3.";" $fullname ";" $fecha ";" $hora ";" SILC >> $DATE3.xls
#done



