DATE=`date +%Y-%m-%d`
#DATE=2016-02-02

echo "
USE asterisk;
TRUNCATE TABLE gestiones_sin_uniqueid;
INSERT INTO  gestiones_sin_uniqueid SELECT * FROM sistema_gestiones WHERE uniqueid = '' and campaign like '%TR%' and lead_id <> '' and DATE_FORMAT(fecha,'%Y-%m-%d') = '${DATE}' ;
DELETE FROM sistema_gestion where id_gestion IN (select id_gestion FROM gestiones_sin_uniqueid);
INSERT INTO sistema_gestiones SELECT NULL, fecha, id_datos, vicidial_log.uniqueid, gestiones_sin_uniqueid.list_id, gestiones_sin_uniqueid.lead_id,  campaign , gestiones_sin_uniqueid.user, rut_cliente, telefono, nuevo_telefono, email, cod_gestion, fecha_compromiso, monto_compromiso, nombre_contacto, glosa
FROM gestiones_sin_uniqueid, vicidial_log
WHERE vicidial_log.lead_id = gestiones_sin_uniqueid.lead_id
AND vicidial_log.campaign_id = gestiones_sin_uniqueid.campaign
AND vicidial_log.user = gestiones_sin_uniqueid.user;" | mysql -uroot 
