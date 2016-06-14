MAIL="eleal@codigozeta.cl"
EMPRESA='DATUX'
FECHA=$(date +"%y%m%d")
php -q /var/www/html/cargaDatux/informes/view/informe200.php
echo "***********ENVIANDO EMAIL CON ARCHIVOS CARGA*****************"

echo "INFORME 200 ABCDIN ${EMPRESA}" | mutt $MAIL -s "INFORME 200 ${EMPRESA}" -a /var/www/html/sistema/archivos/informes/200/b200_sa017_${FECHA}.txt
