#!/bin/bash
function printUse() {

        echo "Uso: `basename $0` <nombres-archivos-gsm>"
}
if [ $# -lt 1 ]; then
        echo "Nú de parátros incorrecto."
        printUse
        exit
fi
for file in /var/www/html/grabaciones_tricot/$@; do
        echo "Covirtiendo archivo '$file' a '$file.wav'."
        sox $file -r 8000 -c 1 -w -s $file.wav
done

rm -rf /var/www/html/grabaciones_tricot/*.gsm

