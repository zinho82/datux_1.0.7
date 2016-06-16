MAIL="erick.leal@datux.cl"
USUARIOBD="-uroot"
PWDBD="" 
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_abcdin";
FECHA=$(date +"%Y%m%d");
FECHA_ARCH=$(date +"%y%m%d")
cd /var/www/html/sistema_gestion/archivos
echo "**************** Descargando Archivo de Cobranza desde ABC-DIN **********"

HOST='ftp.din.cl'
USER='usrsilca'
PASSWD='*S100l20c'

lftp -du $USER,$PASSWD $HOST  -e "get  ABCDIN_C_TARJ216_${FECHA_ARCH}.txt ;bye"






echo "archivos DEscargados"




echo "*************** INICIANDO CARGA ***********************"
rm -rf /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_actualiza_*_${FECHA}.csv
rm -rf /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado*${FECHA}.csv

cp /var/www/html/sistema_gestion/archivos/ABCDIN_C_TARJ216_${FECHA_ARCH}.txt /var/www/html/sistema_gestion/archivos/${TBL_TEMPORAL}.txt -v
echo " Limpiando Tabla Temporal "
mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL}"


echo " CARGANDO ARCHIVO ORIGINAL "
mysqlimport --local ${USUARIOBD} ${PWDBD} ${BASE_DATOS} /var/www/html/sistema_gestion/archivos/${TBL_TEMPORAL}.txt

echo " Cargando formateando campos"
mysql ${USUARIOBD} ${PWDBD} -e "update ${BASE_DATOS}.${TBL_TEMPORAL}  tmp 
set 
tmp.numero_de_carga=20160424
,tmp.dmssnum=trim(substring(tmp.dmacct,26,12))
,tmp.dmssnum=trim(concat(substring(tmp.dmssnum,1,length(tmp.dmssnum)-1),'-',substring(tmp.dmssnum,-1)))
,tmp.dmname=trim(substring(tmp.dmacct,38,80))
,tmp.u6fecnac=trim(substring(tmp.dmacct,118,10))
,tmp.u6estciv=trim(substring(tmp.dmacct,128,1))
,tmp.u6sexo=trim(substring(tmp.dmacct,129,1))
,tmp.dmaddr1=trim(substring(tmp.dmacct,130,80))
,tmp.dmaddr2=trim(substring(tmp.dmacct,210,80))
,tmp.dmcity=trim(substring(tmp.dmacct,290,40))
,tmp.u6desccomu=trim(substring(tmp.dmacct,330,35))
,tmp.dmzip=trim(substring(tmp.dmacct,365,10))
,tmp.u6mailper=trim(substring(tmp.dmacct,375,40))
,tmp.u6catelcasa=trim(substring(tmp.dmacct,415,3))
,tmp.dmphone=trim(substring(tmp.dmacct,418,13))
,tmp.u6catelofic=trim(substring(tmp.dmacct,431,3))
,tmp.dmbphone=trim(substring(tmp.dmacct,434,13))
,tmp.u6catelcelu=trim(substring(tmp.dmacct,447,3))
,tmp.u6telcelu=trim(substring(tmp.dmacct,450,13))
,tmp.u6catelcont=trim(substring(tmp.dmacct,463,3))
,tmp.u6telconta=trim(substring(tmp.dmacct,466,13))
,tmp.u6catelotr1=trim(substring(tmp.dmacct,479,3))
,tmp.u6telotro1=trim(substring(tmp.dmacct,482,13))
,tmp.u6catelotr2=trim(substring(tmp.dmacct,495,3))
,tmp.u6telotro2=trim(substring(tmp.dmacct,498,13))
,tmp.u6catelotr3=trim(substring(tmp.dmacct,511,3))
,tmp.u6telotro3=trim(substring(tmp.dmacct,514,13))
,tmp.u6cupodisp=trim(substring(tmp.dmacct,527,9))
,tmp.dmdays=trim(substring(tmp.dmacct,536,5))
,tmp.u6trammor=trim(substring(tmp.dmacct,541,1))
,tmp.u6trampro=trim(substring(tmp.dmacct,542,2))
,tmp.dmpayamt=trim(substring(tmp.dmacct,544,15))
,tmp.dmpaydt=trim(substring(tmp.dmacct,559,10))
,tmp.u6diavenc=trim(substring(tmp.dmacct,569,2))
,tmp.u6clasifcli=trim(substring(tmp.dmacct,571,4))
,tmp.u6sucapertur=trim(substring(tmp.dmacct,575,8))
,tmp.u6scrbehavio=trim(substring(tmp.dmacct,583,6))
,tmp.u6scrcobra=trim(substring(tmp.dmacct,589,6))
,tmp.u6orplanc=trim(substring(tmp.dmacct,595,2))
,tmp.dmagency=trim(substring(tmp.dmacct,597,8))
,tmp.dmassagdt=trim(substring(tmp.dmacct,605,10))
,tmp.u6codcam=trim(substring(tmp.dmacct,615,35))
,tmp.u6fecinicam=trim(substring(tmp.dmacct,650,10))
,tmp.u6fecfincam=trim(substring(tmp.dmacct,660,10))
,tmp.dmdlqdt=trim(substring(tmp.dmacct,670,10))
,tmp.dmcurbal=trim(substring(tmp.dmacct,680,9))
,tmp.u6carxtrve=trim(substring(tmp.dmacct,689,9))
,tmp.u6gastcob=trim(substring(tmp.dmacct,698,9))
,tmp.u6intxmora=trim(substring(tmp.dmacct,707,9))
,tmp.u6otrcarv=trim(substring(tmp.dmacct,716,9))
,tmp.u6deuvenc=trim(substring(tmp.dmacct,725,9))
,tmp.u6mondeuxven=trim(substring(tmp.dmacct,734,9))
,tmp.u6carxtrxv=trim(substring(tmp.dmacct,743,9))
,tmp.u6carxven=trim(substring(tmp.dmacct,752,9))
,tmp.u6tdeuxven=trim(substring(tmp.dmacct,761,9))
,tmp.u6totdeud=trim(substring(tmp.dmacct,770,9))
,tmp.dmppdue=trim(substring(tmp.dmacct,779,10))
,tmp.dmresv1=trim(substring(tmp.dmacct,789,15))
,tmp.dmppkept=trim(substring(tmp.dmacct,804,3))
,tmp.dmppbrok=trim(substring(tmp.dmacct,807,3))
,tmp.dmppflag=trim(substring(tmp.dmacct,810,1))
,tmp.dmppmade=trim(substring(tmp.dmacct,811,10))
,tmp.dmppamt=trim(substring(tmp.dmacct,821,15))
,tmp.u6moncumo=trim(substring(tmp.dmacct,836,9))
,tmp.u6vencumo=trim(substring(tmp.dmacct,845,10))
,tmp.u6pcodestra=trim(substring(tmp.dmacct,855,5))
,tmp.u6pnivestra=trim(substring(tmp.dmacct,860,5))
,tmp.dmpri=trim(substring(tmp.dmacct,865,4))
,tmp.dmlastac=trim(substring(tmp.dmacct,869,2))
,tmp.dmlastrc=trim(substring(tmp.dmacct,871,2))
,tmp.dmlastlc=trim(substring(tmp.dmacct,873,2))
,tmp.dmacsc1=trim(substring(tmp.dmacct,875,6))
,tmp.dmacsc2=trim(substring(tmp.dmacct,881,6))
,tmp.dmacsc3=trim(substring(tmp.dmacct,887,6))
,tmp.u6congespos=trim(substring(tmp.dmacct,893,5))
,tmp.u6congesneg=trim(substring(tmp.dmacct,898,5))
,tmp.dmstate=trim(substring(tmp.dmacct,903,5))
,tmp.u6conptint=trim(substring(tmp.dmacct,908,5))
,tmp.u6conptgas=trim(substring(tmp.dmacct,913,5))
,tmp.u6conptotr=trim(substring(tmp.dmacct,918,5))
,tmp.u6conptcar=trim(substring(tmp.dmacct,923,5))
,tmp.u6conptcuo=trim(substring(tmp.dmacct,928,5))
,tmp.u6conreint=trim(substring(tmp.dmacct,933,5))
,tmp.u6conregas=trim(substring(tmp.dmacct,938,5))
,tmp.u6conreotr=trim(substring(tmp.dmacct,943,5))
,tmp.u6conrecar=trim(substring(tmp.dmacct,948,5))
,tmp.u6conrecuo=trim(substring(tmp.dmacct,953,5))
,tmp.u6conrepie=trim(substring(tmp.dmacct,958,5))
,tmp.u6ctaacad=trim(substring(tmp.dmacct,963,1))
,tmp.u6fecold=trim(substring(tmp.dmacct,964,10))
,tmp.u6codref1=trim(substring(tmp.dmacct,974,2))
,tmp.u6codref2=trim(substring(tmp.dmacct,976,2))
,tmp.u6codref3=trim(substring(tmp.dmacct,978,2))
,tmp.dmque=trim(substring(tmp.dmacct,980,4))
,tmp.dmque2=trim(substring(tmp.dmacct,984,4))
,tmp.dmque3=trim(substring(tmp.dmacct,988,4))
,tmp.dmque4=trim(substring(tmp.dmacct,992,4))
,tmp.dmlabel1=trim(substring(tmp.dmacct,996,4))
,tmp.dmlabel2=trim(substring(tmp.dmacct,1000,4))
,tmp.dmlabel3=trim(substring(tmp.dmacct,1004,4))
,tmp.dmlabel4=trim(substring(tmp.dmacct,1008,4))
,tmp.dmlabel5=trim(substring(tmp.dmacct,1012,4))
,tmp.dmlabel6=trim(substring(tmp.dmacct,1016,4))
,tmp.dmprod=trim(substring(tmp.dmacct,1020,6))
,tmp.u6estadohoy=trim(substring(tmp.dmacct,1026,4))
,tmp.u6estado1=trim(substring(tmp.dmacct,1030,4))
,tmp.u6estado2=trim(substring(tmp.dmacct,1034,4))
,tmp.u6estado3=trim(substring(tmp.dmacct,1038,4))
,tmp.u6estado4=trim(substring(tmp.dmacct,1042,4))
,tmp.u6estado5=trim(substring(tmp.dmacct,1046,4))
,tmp.u6estado6=trim(substring(tmp.dmacct,1050,4))
,tmp.u6mapcol=trim(substring(tmp.dmacct,1054,4))
,tmp.u6mapfila=trim(substring(tmp.dmacct,1058,5))
,tmp.u6mappag=trim(substring(tmp.dmacct,1063,4))
,tmp.dmlstact=trim(substring(tmp.dmacct,1067,10))
,tmp.dmlstcon=trim(substring(tmp.dmacct,1077,10))
,tmp.dmpayoff=trim(substring(tmp.dmacct,1087,10))
,tmp.dmnxtcon=trim(substring(tmp.dmacct,1097,15))
,tmp.dmpayoff=trim(substring(tmp.dmacct,1112,4))
,tmp.u6scrimpago=trim(substring(tmp.dmacct,1116,9))
,tmp.u6salprov=trim(substring(tmp.dmacct,1125,13))
,tmp.n_area_telefono_contacto=trim(substring(tmp.dmacct,1138,13))
,tmp.n_telefono_contacto=trim(substring(tmp.dmacct,1155,13))
,tmp.n_area_telefono_otro_1=trim(substring(tmp.dmacct,1164,13))
,tmp.n_telefono_otrop_1=trim(substring(tmp.dmacct,1177,13))
,tmp.n_area_telefono_otro_2=trim(substring(tmp.dmacct,1190,13))
,tmp.n_telefono_otro_2=trim(substring(tmp.dmacct,1203,10))
,tmp.observacion=trim(substring(tmp.dmacct,1213,10))
,tmp.fecha_cumple_promesa=trim(substring(tmp.dmacct,1223,10))
,tmp.direccion1C=trim(substring(tmp.dmacct,1233,10))
,tmp.direccion2C=trim(substring(tmp.dmacct,1243,10))
,tmp.direccion3C=trim(substring(tmp.dmacct,1253,10))
,tmp.tribunal_ex=trim(substring(tmp.dmacct,1263,10))
,tmp.rol_ex=trim(substring(tmp.dmacct,1273,10))
,tmp.check_tel1=trim(substring(tmp.dmacct,1283,10))
,tmp.check_tel2=trim(substring(tmp.dmacct,1293,10))
,tmp.check_tel3=trim(substring(tmp.dmacct,1303,10))
,tmp.check_tel4=trim(substring(tmp.dmacct,1313,10))
,tmp.check_tel5=trim(substring(tmp.dmacct,1323,10))
,tmp.check_tel6=trim(substring(tmp.dmacct,1333,10))
,tmp.check_tel7=trim(substring(tmp.dmacct,1343,10))
,tmp.check_tel8=trim(substring(tmp.dmacct,1353,10))
,tmp.check_tel9=trim(substring(tmp.dmacct,1363,10))
,tmp.check_tel10=trim(substring(tmp.dmacct,1373,10))
,tmp.u6telotro4=trim(substring(tmp.dmacct,1383,10))
,tmp.u6telotro5=trim(substring(tmp.dmacct,1393,10))
,tmp.u6telotro6=trim(substring(tmp.dmacct,1403,10))
,tmp.u6telotro7=trim(substring(tmp.dmacct,1413,10))
,tmp.u6telotro8=trim(substring(tmp.dmacct,1423,10))
,tmp.u6telotro9=trim(substring(tmp.dmacct,1433,10))
,tmp.u6fonestofic=trim(substring(tmp.dmacct,1443,10))
,tmp.u6fonestcasa=trim(substring(tmp.dmacct,1453,10))
,tmp.u6fonestcelu=trim(substring(tmp.dmacct,1463,10))
,tmp.u6fonestotr1=trim(substring(tmp.dmacct,1473,10))
,tmp.u6fecactotr2=trim(substring(tmp.dmacct,1483,10))
,tmp.u6fecactotr3=trim(substring(tmp.dmacct,1493,10))
,tmp.dmacct=trim(substring(tmp.dmacct,1,25))
"


echo "VERIFICANDO DATOS"

#php /var/www/html/sistema_gestion/carga/carga/view/index.php 
echo "Ordenando Telefonos"
mysql ${USUARIOBD} ${PWDBD} -e "update  ${BASE_DATOS}.${TBL_TEMPORAL} tmp set
tmp.fono1=
case
when length(concat(tmp.u6telconta))=9 then concat(56,tmp.u6telconta)
when length(concat(tmp.u6telcelu))=9  then concat(56,tmp.u6telcelu)
when length(concat(tmp.dmphone))=9    then concat(56,tmp.dmphone)
when length(concat(tmp.dmbphone))=9   then concat(56,tmp.dmbphone)
when length(concat(tmp.u6telotro1))=9 then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 then concat(56,tmp.u6telotro9)
end 
,tmp.fono2=
case

when length(concat(tmp.u6telcelu))=9  and tmp.fono1!= concat(56,tmp.u6telcelu) 	then concat(56,tmp.u6telcelu)
when length(concat(tmp.dmphone))=9    and tmp.fono1!= concat(56,tmp.dmphone) 		then concat(56,tmp.dmphone)
when length(concat(tmp.dmbphone))=9   and tmp.fono1!= concat(56,tmp.dmbphone)    then concat(56,tmp.dmbphone)
when length(concat(tmp.u6telotro1))=9 and tmp.fono1!= concat(56,tmp.u6telotro1) 	then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2) 	then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3) 	then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4) 	then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5) 	then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6) 	then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7) 	then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8) 	then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9) 	then concat(56,tmp.u6telotro9)
end
,tmp.fono3=
case
when length(concat(tmp.dmphone))=9    and tmp.fono1!= concat(56,tmp.dmphone) 		and tmp.fono2!= concat(56,tmp.dmphone)			then concat(56,tmp.dmphone)
when length(concat(tmp.dmbphone))=9   and tmp.fono1!= concat(56,tmp.dmbphone)    and tmp.fono2!= concat(56,tmp.dmbphone)		then concat(56,tmp.dmbphone)
when length(concat(tmp.u6telotro1))=9 and tmp.fono1!= concat(56,tmp.u6telotro1) 	and tmp.fono2!= concat(56,tmp.u6telotro1)		then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2) 	and tmp.fono2!= concat(56,tmp.u6telotro2)		then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3) 	and tmp.fono2!= concat(56,tmp.u6telotro3)		then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4) 	and tmp.fono2!= concat(56,tmp.u6telotro4)		then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5) 	and tmp.fono2!= concat(56,tmp.u6telotro5)		then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6) 	and tmp.fono2!= concat(56,tmp.u6telotro6)		then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7) 	and tmp.fono2!= concat(56,tmp.u6telotro7)		then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8) 	and tmp.fono2!= concat(56,tmp.u6telotro8)		then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9) 	and tmp.fono2!= concat(56,tmp.u6telotro9)		then concat(56,tmp.u6telotro9)
end
,tmp.fono4=
case

when length(concat(tmp.u6telotro1))=9 and tmp.fono1!= concat(56,tmp.u6telotro1) 	and tmp.fono2!= concat(56,tmp.u6telotro1)		and tmp.fono3!= concat(56,tmp.u6telotro1)	then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2) 	and tmp.fono2!= concat(56,tmp.u6telotro2)		and tmp.fono3!= concat(56,tmp.u6telotro2)	then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3) 	and tmp.fono2!= concat(56,tmp.u6telotro3)		and tmp.fono3!= concat(56,tmp.u6telotro3)	then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4) 	and tmp.fono2!= concat(56,tmp.u6telotro4)		and tmp.fono3!= concat(56,tmp.u6telotro4)	then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5) 	and tmp.fono2!= concat(56,tmp.u6telotro5)		and tmp.fono3!= concat(56,tmp.u6telotro5)	then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6) 	and tmp.fono2!= concat(56,tmp.u6telotro6)		and tmp.fono3!= concat(56,tmp.u6telotro6)	then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7) 	and tmp.fono2!= concat(56,tmp.u6telotro7)		and tmp.fono3!= concat(56,tmp.u6telotro7)	then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8) 	and tmp.fono2!= concat(56,tmp.u6telotro8)		and tmp.fono3!= concat(56,tmp.u6telotro8)	then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9) 	and tmp.fono2!= concat(56,tmp.u6telotro9)		and tmp.fono3!= concat(56,tmp.u6telotro9)	then concat(56,tmp.u6telotro9)
end

,tmp.fono5=
case


when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2) 	and tmp.fono2!= concat(56,tmp.u6telotro2)		and tmp.fono3!= concat(56,tmp.u6telotro2)	and tmp.fono4!= concat(56,tmp.u6telotro2)	then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3) 	and tmp.fono2!= concat(56,tmp.u6telotro3)		and tmp.fono3!= concat(56,tmp.u6telotro3)	and tmp.fono4!= concat(56,tmp.u6telotro3)	then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4) 	and tmp.fono2!= concat(56,tmp.u6telotro4)		and tmp.fono3!= concat(56,tmp.u6telotro4)	and tmp.fono4!= concat(56,tmp.u6telotro4)	then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5) 	and tmp.fono2!= concat(56,tmp.u6telotro5)		and tmp.fono3!= concat(56,tmp.u6telotro5)	and tmp.fono4!= concat(56,tmp.u6telotro5)	then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6) 	and tmp.fono2!= concat(56,tmp.u6telotro6)		and tmp.fono3!= concat(56,tmp.u6telotro6)	and tmp.fono4!= concat(56,tmp.u6telotro6)	then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7) 	and tmp.fono2!= concat(56,tmp.u6telotro7)		and tmp.fono3!= concat(56,tmp.u6telotro7)	and tmp.fono4!= concat(56,tmp.u6telotro7)	then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8) 	and tmp.fono2!= concat(56,tmp.u6telotro8)		and tmp.fono3!= concat(56,tmp.u6telotro8)	and tmp.fono4!= concat(56,tmp.u6telotro8)then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9) 	and tmp.fono2!= concat(56,tmp.u6telotro9)		and tmp.fono3!= concat(56,tmp.u6telotro9)	and tmp.fono4!= concat(56,tmp.u6telotro9)	then concat(56,tmp.u6telotro9)
end
"
