#!/bin/bash
#!/bin/bash
DATE2=`date +%Y-%m-%d`
#DATE2=2015-04-09


function printUse() {

        echo "Uso: `basename $0` <nombres-archivos-gsm>"
}
if [ $# -lt 1 ]; then
        echo "Nú de parátros incorrecto."
        printUse
        exit
fi

for file in /var/www/html/recordings/grabaciones_tricot/$@; do
       echo "Covirtiendo archivo '$file' a '$file.mp3'."
      lame -b 32 --resample 8 -a $file $file.mp3
done
rm -rf /var/www/html/recordings/grabaciones_tricot/${DATE2}/*.wav
cd /var/www/html/recordings/grabaciones_tricot/${DATE2}
rename .wav.mp3 .mp3 *.mp3

