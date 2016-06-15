MAIL="erick.leal@datux.cl"
EMPRESA=' SILCA '
FECHA=$(date +"%Y%m%d")
echo "************ CREANDO ARCHIVO 200 *****************"
php -q /var/www/html/sistema_gestion/carga/informes/view/informe200_tri.php
echo "************ CREANDO ARCHIVO 600 *****************"
php -q /var/www/html/sistema_gestion/carga/informes/view/informe600_tri.php

echo "***********ENVIANDO EMAIL CON ARCHIVOS DE INFORMES 600 y 200*****************"

echo "INFORME 200 TRICOT ${EMPRESA}" | mutt $MAIL -s "INFORME 200 G2 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/200/${FECHA}_200SILCA_CAST_G2.txt
echo "INFORME 200 TRICOT ${EMPRESA}" | mutt $MAIL -s "INFORME 200 G3 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/200/${FECHA}_200SILCA_CAST_G3.txt
echo "INFORME 200 TRICOT ${EMPRESA}" | mutt $MAIL -s "INFORME 200 G4 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/200/${FECHA}_200SILCA_CAST_G4.txt

echo "INFORME 600 TRICOT ${EMPRESA}" | mutt $MAIL -s "INFORME 600 G2 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/600/${FECHA}_600SILCA_CAST_G2.txt
echo "INFORME 600 TRICOT ${EMPRESA}" | mutt $MAIL -s "INFORME 600 G3 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/600/${FECHA}_600SILCA_CAST_G3.txt
echo "INFORME 600 TRICOT ${EMPRESA}" | mutt $MAIL -s "INFORME 600 G4 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/600/${FECHA}_600SILCA_CAST_G4.txt

HOST='200.72.30.214'
USER='silca'
PASSWD='silca09'
FILE='test.txt'

lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/200/${FECHA}_200SILCA_CAST_G2.txt ;bye"
lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/200/${FECHA}_200SILCA_CAST_G3.txt ;bye"
lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/200/${FECHA}_200SILCA_CAST_G4.txt ;bye"


lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/600/${FECHA}_600SILCA_CAST_G4.txt;bye"
lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/600/${FECHA}_600SILCA_CAST_G3.txt;bye"
lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/600/${FECHA}_600SILCA_CAST_G2.txt;bye"



