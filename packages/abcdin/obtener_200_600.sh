MAIL="reportesmkc@datux.cl"
EMPRESA='MKC'
FECHA=$(date +"%y%m%d")
#FECHA=160607
echo "************ CREANDO ARCHIVO 200 *****************"
php -q /var/www/html/sistema_gestion/carga/informes/view/informe200.php
echo "************ CREANDO ARCHIVO 600 *****************"
php -q /var/www/html/sistema_gestion/carga/informes/view/informe600.php

echo "***********ENVIANDO EMAIL CON ARCHIVOS DE INFORMES 600 y 200*****************"
echo "INFORME 600 ABCDIN ${EMPRESA}" | mutt $MAIL -s "INFORME 600 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/600/b600_sa138_${FECHA}.txt
echo "INFORME 200 ABCDIN ${EMPRESA}" | mutt $MAIL -s "INFORME 200 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/200/b200_sa138_${FECHA}.txt

#echo "INFORME 600 ABCDIN ${EMPRESA}" | mutt $MAIL -s "INFORME 600 ${EMPRESA}" -a /var/www/html/sistema_gestion/archivos/informes/600/b600_sa138_${FECHA}.txt

HOST='ftp.mkyc.cl'
USER='abcdin@mkyc.cl'
PASSWD='46824682'
FILE='test.txt'

lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/200/b200_sa138_${FECHA}.txt ;bye"
lftp -du $USER,$PASSWD $HOST  -e "put /var/www/html/sistema_gestion/archivos/informes/600/b600_sa138_${FECHA}.txt ;bye"



