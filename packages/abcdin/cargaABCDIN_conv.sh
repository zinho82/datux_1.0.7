#MAIL="reportessilca@datux.cl"
USUARIOBD="-uroot"
PWDBD="" 
BASE_DATOS="asterisk";
TBL_TEMPORAL="sistema_temporal_abcdin"; 
FECHA=$(date +"%Y%m%d");
FECHA_ARCH="$(date +"%y%m%d")"
HOST='ftp.din.cl'
USER='usrsilca'
PASSWD='*S100l20c'
FILE='test.txt'
cd /var/www/html/sistema_gestion/archivos/
lftp -du $USER,$PASSWD $HOST  -e "get ABCDIN_C_CONV123_${FECHA_ARCH}.txt ;bye"




echo "*************** INICIANDO CARGA ***********************"
rm -rf /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_carga_*_${FECHA}.csv
rm -rf /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado*${FECHA}.csv

cp /var/www/html/sistema_gestion/archivos/ABCDIN_C_CONV123_${FECHA_ARCH}.txt /var/www/html/sistema_gestion/archivos/${TBL_TEMPORAL}.txt -v
echo " Limpiando Tabla Temporal "
mysql ${USUARIOBD} ${PWDBD} -e "truncate ${BASE_DATOS}.${TBL_TEMPORAL}"


echo " CARGANDO ARCHIVO ORIGINAL "
mysqlimport --local ${USUARIOBD} ${PWDBD} ${BASE_DATOS} /var/www/html/sistema_gestion/archivos/${TBL_TEMPORAL}.txt


echo " Cargando formateando campos"
mysql ${USUARIOBD} ${PWDBD} -e "update ${BASE_DATOS}.${TBL_TEMPORAL}  tmp 
set 
tmp.dmssnum=trim(substring(tmp.dmacct,26,12))
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
,tmp.dmpayamt=trim(substring(tmp.dmacct,536,15))
,tmp.dmpaydt=trim(substring(tmp.dmacct,551,10))
,tmp.u6diavenc=trim(substring(tmp.dmacct,561,2))
,tmp.u6sucapertur=trim(substring(tmp.dmacct,563,8))
,tmp.u6scrcobra=trim(substring(tmp.dmacct,571,6))
,tmp.u6orplanc=trim(substring(tmp.dmacct,577,2))
,tmp.dmagency=trim(substring(tmp.dmacct,579,8))
,tmp.dmassagdt=trim(substring(tmp.dmacct,587,10))
,tmp.u6codcam=trim(substring(tmp.dmacct,597,35))
,tmp.u6fecinicam=trim(substring(tmp.dmacct,632,10))
,tmp.u6fecfincam=trim(substring(tmp.dmacct,642,10))
,tmp.dmdlqdt=trim(substring(tmp.dmacct,652,10))
,tmp.u6totdeud=trim(substring(tmp.dmacct,662,9))
,tmp.dmppdue=trim(substring(tmp.dmacct,671,10))
,tmp.dmresv1=trim(substring(tmp.dmacct,681,15))
,tmp.dmppkept=trim(substring(tmp.dmacct,696,3))
,tmp.dmppbrok=trim(substring(tmp.dmacct,699,3))
,tmp.dmppflag=trim(substring(tmp.dmacct,702,1))
,tmp.dmppmade=trim(substring(tmp.dmacct,703,10))
,tmp.dmppamt=trim(substring(tmp.dmacct,713,15))
,tmp.u6pcodestra=trim(substring(tmp.dmacct,728,5))
,tmp.u6pnivestra=trim(substring(tmp.dmacct,733,5))
,tmp.dmpri=trim(substring(tmp.dmacct,738,4))
,tmp.dmlastac=trim(substring(tmp.dmacct,742,2))
,tmp.dmlastrc=trim(substring(tmp.dmacct,744,2))
,tmp.dmlastlc=trim(substring(tmp.dmacct,746,2))
,tmp.dmacsc1=trim(substring(tmp.dmacct,748,6))
,tmp.dmacsc2=trim(substring(tmp.dmacct,754,6))
,tmp.dmacsc3=trim(substring(tmp.dmacct,760,6))
,tmp.u6congespos=trim(substring(tmp.dmacct,766,5))
,tmp.u6congesneg=trim(substring(tmp.dmacct,771,5))
,tmp.dmstate=trim(substring(tmp.dmacct,776,5))
,tmp.u6conptint=trim(substring(tmp.dmacct,781,5))
,tmp.u6conptgas=trim(substring(tmp.dmacct,786,5))
,tmp.u6conptotr=trim(substring(tmp.dmacct,791,5))
,tmp.u6conptcar=trim(substring(tmp.dmacct,796,5))
,tmp.u6conptcuo=trim(substring(tmp.dmacct,801,5))
,tmp.u6conreint=trim(substring(tmp.dmacct,806,5))
,tmp.u6conregas=trim(substring(tmp.dmacct,811,5))
,tmp.u6conreotr=trim(substring(tmp.dmacct,816,5))
,tmp.u6conrecar=trim(substring(tmp.dmacct,821,5))
,tmp.u6conrecuo=trim(substring(tmp.dmacct,826,5))
,tmp.u6conrepie=trim(substring(tmp.dmacct,831,5))
,tmp.u6ctaacad=trim(substring(tmp.dmacct,836,1))
,tmp.u6fecold=trim(substring(tmp.dmacct,837,10))
,tmp.u6codref1=trim(substring(tmp.dmacct,847,2))
,tmp.u6codref2=trim(substring(tmp.dmacct,849,2))
,tmp.u6codref3=trim(substring(tmp.dmacct,851,2))
,tmp.dmque=trim(substring(tmp.dmacct,1098,4))
,tmp.dmque2=trim(substring(tmp.dmacct,1102,4))
,tmp.dmque3=trim(substring(tmp.dmacct,1106,4))
,tmp.dmque4=trim(substring(tmp.dmacct,1110,4))
,tmp.dmlabel1=trim(substring(tmp.dmacct,1114,4))
,tmp.dmlabel2=trim(substring(tmp.dmacct,1118,4))
,tmp.dmlabel3=trim(substring(tmp.dmacct,1122,4))
,tmp.dmlabel4=trim(substring(tmp.dmacct,1126,4))
,tmp.dmlabel5=trim(substring(tmp.dmacct,1130,4))
,tmp.dmlabel6=trim(substring(tmp.dmacct,1134,4))
,tmp.dmprod=trim(substring(tmp.dmacct,1138,6))
,tmp.u6estadohoy=trim(substring(tmp.dmacct,1144,4))
,tmp.u6estado1=trim(substring(tmp.dmacct,1148,4))
,tmp.u6estado2=trim(substring(tmp.dmacct,1152,4))
,tmp.u6estado3=trim(substring(tmp.dmacct,1156,4))
,tmp.u6estado4=trim(substring(tmp.dmacct,1160,4))
,tmp.u6estado5=trim(substring(tmp.dmacct,1164,4))
,tmp.u6estado6=trim(substring(tmp.dmacct,1168,4))
,tmp.u6mapcol=trim(substring(tmp.dmacct,1172,4))
,tmp.u6mapfila=trim(substring(tmp.dmacct,1176,5))
,tmp.u6mappag=trim(substring(tmp.dmacct,1181,4))
,tmp.dmlstact=trim(substring(tmp.dmacct,1185,10))
,tmp.dmlstcon=trim(substring(tmp.dmacct,1195,10))
,tmp.dmnxtcon=trim(substring(tmp.dmacct,1205,15))
,tmp.u6telotro4=trim(substring(tmp.dmacct,1218,13))
,tmp.u6telotro5=trim(substring(tmp.dmacct,1231,13))
,tmp.u6telotro6=trim(substring(tmp.dmacct,1244,13))
,tmp.u6telotro7=trim(substring(tmp.dmacct,1257,13))
,tmp.u6telotro8=trim(substring(tmp.dmacct,1270,13))
,tmp.u6telotro9=trim(substring(tmp.dmacct,1283,13))
,tmp.u6fonestofic=trim(substring(tmp.dmacct,1296,10))
,tmp.u6fonestcasa=trim(substring(tmp.dmacct,1306,10))
,tmp.u6fonestcelu=trim(substring(tmp.dmacct,1316,10))
,tmp.u6fonestotr1=trim(substring(tmp.dmacct,1326,10))
,tmp.u6fonestotr2=trim(substring(tmp.dmacct,1336,10))
,tmp.u6fonestotr3=trim(substring(tmp.dmacct,1346,10))
,tmp.u6fonestotr4=trim(substring(tmp.dmacct,1356,10))
,tmp.u6fonestotr5=trim(substring(tmp.dmacct,1366,10))
,tmp.u6fonestotr6=trim(substring(tmp.dmacct,1376,10))
,tmp.u6fonestotr7=trim(substring(tmp.dmacct,1386,10))
,tmp.u6fonestotr8=trim(substring(tmp.dmacct,1396,10))
,tmp.u6fonestotr9=trim(substring(tmp.dmacct,1406,10))
,tmp.u6fecactlabo=trim(substring(tmp.dmacct,1416,10))
,tmp.u6fecactcelu=trim(substring(tmp.dmacct,1426,10))
,tmp.u6fecactcasa=trim(substring(tmp.dmacct,1436,10))
,tmp.u6fecactlabo=trim(substring(tmp.dmacct,1416,10))
,tmp.u6fecactdef=trim(substring(tmp.dmacct,1446,10))
,tmp.u6fecactotr1=trim(substring(tmp.dmacct,1456,10))
,tmp.u6fecactotr2=trim(substring(tmp.dmacct,1466,10))
,tmp.u6fecactotr3=trim(substring(tmp.dmacct,1476,10))
,tmp.u6fecactotr4=trim(substring(tmp.dmacct,1486,10))
,tmp.u6fecactotr5=trim(substring(tmp.dmacct,1496,10))
,tmp.u6fecactotr6=trim(substring(tmp.dmacct,1506,10))
,tmp.u6fecactotr7=trim(substring(tmp.dmacct,1516,10))
,tmp.u6fecactotr8=trim(substring(tmp.dmacct,1526,10))
,tmp.u6fecactotr9=trim(substring(tmp.dmacct,1536,10))
,tmp.u6catelotr4=trim(substring(tmp.dmacct,1546,10))
,tmp.u6catelotr5=trim(substring(tmp.dmacct,1556,10))
,tmp.u6catelotr6=trim(substring(tmp.dmacct,1566,10))
,tmp.u6catelotr7=trim(substring(tmp.dmacct,1576,10))
,tmp.u6catelotr8=trim(substring(tmp.dmacct,1586,10))
,tmp.u6catelotr9=trim(substring(tmp.dmacct,1596,10))
,tmp.conconv=trim(substring(tmp.dmacct,1215,3))
,tmp.u6monconv=trim(substring(tmp.dmacct,883,9))
,tmp.u6fecconv=trim(substring(tmp.dmacct,862,10))
,tmp.u6fpvconv=trim(substring(tmp.dmacct,872,10))
,tmp.u6ncconv=trim(substring(tmp.dmacct,882,3))
,tmp.u6totpagconv=trim(substring(tmp.dmacct,885,9))
,tmp.u6saldoconv=trim(substring(tmp.dmacct,894,9))
,tmp.u6dmdaysconv=trim(substring(tmp.dmacct,903,5))
,tmp.u6cc1moncuo=trim(substring(tmp.dmacct,908,9))
,tmp.u6cc1fvcto=trim(substring(tmp.dmacct,917,10))
,tmp.u6cc1monpag=trim(substring(tmp.dmacct,927,9))
,tmp.u6cc1estcuo =trim(substring(tmp.dmacct,936,10))

,tmp.u6cc2moncuo=trim(substring(tmp.dmacct,946,9))
,tmp.u6cc2fvcto=trim(substring(tmp.dmacct,955,10))
,tmp.u6cc2monpag=trim(substring(tmp.dmacct,965,9))
,tmp.u6cc2estcuo =trim(substring(tmp.dmacct,974,10))

,tmp.u6cc3moncuo=trim(substring(tmp.dmacct,984,9))
,tmp.u6cc3fvcto=trim(substring(tmp.dmacct,993,10))
,tmp.u6cc3monpag=trim(substring(tmp.dmacct,1003,9))
,tmp.u6cc3estcuo =trim(substring(tmp.dmacct,1012,10))

,tmp.u6cc4moncuo=trim(substring(tmp.dmacct,1022,9))
,tmp.u6cc4fvcto=trim(substring(tmp.dmacct,1031,10))
,tmp.u6cc4monpag=trim(substring(tmp.dmacct,1041,9))
,tmp.u6cc4estcuo =trim(substring(tmp.dmacct,1050,10))

,tmp.u6cc5moncuo=trim(substring(tmp.dmacct,1060,9))
,tmp.u6cc5fvcto=trim(substring(tmp.dmacct,1069,10))
,tmp.u6cc5monpag=trim(substring(tmp.dmacct,1079,9))
,tmp.u6cc5estcuo =trim(substring(tmp.dmacct,1088,10))
,tmp.dmacct=trim(substring(tmp.dmacct,1,25))

"

echo "VERIFICANDO DATOS"

php /var/www/html/sistema_gestion/carga/carga/view/index.php 

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

when length(concat(tmp.u6telcelu))=9  and tmp.fono1!= concat(56,tmp.u6telcelu)  then concat(56,tmp.u6telcelu)
when length(concat(tmp.dmphone))=9    and tmp.fono1!= concat(56,tmp.dmphone)            then concat(56,tmp.dmphone)
when length(concat(tmp.dmbphone))=9   and tmp.fono1!= concat(56,tmp.dmbphone)    then concat(56,tmp.dmbphone)
when length(concat(tmp.u6telotro1))=9 and tmp.fono1!= concat(56,tmp.u6telotro1)         then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2)         then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3)         then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4)         then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5)         then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6)         then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7)         then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8)         then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9)         then concat(56,tmp.u6telotro9)
end
,tmp.fono3=
case
when length(concat(tmp.dmphone))=9    and tmp.fono1!= concat(56,tmp.dmphone)            and tmp.fono2!= concat(56,tmp.dmphone)                  then concat(56,tmp.dmphone)
when length(concat(tmp.dmbphone))=9   and tmp.fono1!= concat(56,tmp.dmbphone)    and tmp.fono2!= concat(56,tmp.dmbphone)                then concat(56,tmp.dmbphone)
when length(concat(tmp.u6telotro1))=9 and tmp.fono1!= concat(56,tmp.u6telotro1)         and tmp.fono2!= concat(56,tmp.u6telotro1)               then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2)         and tmp.fono2!= concat(56,tmp.u6telotro2)               then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3)         and tmp.fono2!= concat(56,tmp.u6telotro3)               then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4)         and tmp.fono2!= concat(56,tmp.u6telotro4)               then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5)         and tmp.fono2!= concat(56,tmp.u6telotro5)               then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6)         and tmp.fono2!= concat(56,tmp.u6telotro6)               then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7)         and tmp.fono2!= concat(56,tmp.u6telotro7)               then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8)         and tmp.fono2!= concat(56,tmp.u6telotro8)               then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9)         and tmp.fono2!= concat(56,tmp.u6telotro9)               then concat(56,tmp.u6telotro9)
end
,tmp.fono4=
case
when length(concat(tmp.u6telotro1))=9 and tmp.fono1!= concat(56,tmp.u6telotro1)         and tmp.fono2!= concat(56,tmp.u6telotro1)               and tmp.fono3!= concat(56,tmp.u6telotro1)       then concat(56,tmp.u6telotro1)
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2)         and tmp.fono2!= concat(56,tmp.u6telotro2)               and tmp.fono3!= concat(56,tmp.u6telotro2)       then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3)         and tmp.fono2!= concat(56,tmp.u6telotro3)               and tmp.fono3!= concat(56,tmp.u6telotro3)       then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4)         and tmp.fono2!= concat(56,tmp.u6telotro4)               and tmp.fono3!= concat(56,tmp.u6telotro4)       then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5)         and tmp.fono2!= concat(56,tmp.u6telotro5)               and tmp.fono3!= concat(56,tmp.u6telotro5)       then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6)         and tmp.fono2!= concat(56,tmp.u6telotro6)               and tmp.fono3!= concat(56,tmp.u6telotro6)       then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7)         and tmp.fono2!= concat(56,tmp.u6telotro7)               and tmp.fono3!= concat(56,tmp.u6telotro7)       then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8)         and tmp.fono2!= concat(56,tmp.u6telotro8)               and tmp.fono3!= concat(56,tmp.u6telotro8)       then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9)         and tmp.fono2!= concat(56,tmp.u6telotro9)               and tmp.fono3!= concat(56,tmp.u6telotro9)       then concat(56,tmp.u6telotro9)
end
,tmp.fono5=
case
when length(concat(tmp.u6telotro2))=9 and tmp.fono1!= concat(56,tmp.u6telotro2)         and tmp.fono2!= concat(56,tmp.u6telotro2)               and tmp.fono3!= concat(56,tmp.u6telotro2)       and tmp.fono4!= concat(56,tmp.u6telotro2)       then concat(56,tmp.u6telotro2)
when length(concat(tmp.u6telotro3))=9 and tmp.fono1!= concat(56,tmp.u6telotro3)         and tmp.fono2!= concat(56,tmp.u6telotro3)               and tmp.fono3!= concat(56,tmp.u6telotro3)       and tmp.fono4!= concat(56,tmp.u6telotro3)       then concat(56,tmp.u6telotro3)
when length(concat(tmp.u6telotro4))=9 and tmp.fono1!= concat(56,tmp.u6telotro4)         and tmp.fono2!= concat(56,tmp.u6telotro4)               and tmp.fono3!= concat(56,tmp.u6telotro4)       and tmp.fono4!= concat(56,tmp.u6telotro4)       then concat(56,tmp.u6telotro4)
when length(concat(tmp.u6telotro5))=9 and tmp.fono1!= concat(56,tmp.u6telotro5)         and tmp.fono2!= concat(56,tmp.u6telotro5)               and tmp.fono3!= concat(56,tmp.u6telotro5)       and tmp.fono4!= concat(56,tmp.u6telotro5)       then concat(56,tmp.u6telotro5)
when length(concat(tmp.u6telotro6))=9 and tmp.fono1!= concat(56,tmp.u6telotro6)         and tmp.fono2!= concat(56,tmp.u6telotro6)               and tmp.fono3!= concat(56,tmp.u6telotro6)       and tmp.fono4!= concat(56,tmp.u6telotro6)       then concat(56,tmp.u6telotro6)
when length(concat(tmp.u6telotro7))=9 and tmp.fono1!= concat(56,tmp.u6telotro7)         and tmp.fono2!= concat(56,tmp.u6telotro7)               and tmp.fono3!= concat(56,tmp.u6telotro7)       and tmp.fono4!= concat(56,tmp.u6telotro7)       then concat(56,tmp.u6telotro7)
when length(concat(tmp.u6telotro8))=9 and tmp.fono1!= concat(56,tmp.u6telotro8)         and tmp.fono2!= concat(56,tmp.u6telotro8)               and tmp.fono3!= concat(56,tmp.u6telotro8)       and tmp.fono4!= concat(56,tmp.u6telotro8)then concat(56,tmp.u6telotro8)
when length(concat(tmp.u6telotro9))=9 and tmp.fono1!= concat(56,tmp.u6telotro9)         and tmp.fono2!= concat(56,tmp.u6telotro9)               and tmp.fono3!= concat(56,tmp.u6telotro9)       and tmp.fono4!= concat(56,tmp.u6telotro9)       then concat(56,tmp.u6telotro9)
end

"


echo "CARGANDO DEUDOR"
mysql ${USUARIOBD} ${PWDBD} -e "select  substring(tmp.dmssnum,1,length(tmp.dmssnum)-2) as rut,substring(tmp.dmssnum,-1)as dv,tmp.dmname,'','',tmp.dmacct,'','','','','' from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_carga_deudores_conv_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"



echo "CARGANDO DEUDA"
mysql ${USUARIOBD} ${PWDBD} -e "select  substring(tmp.dmssnum,1,length(tmp.dmssnum-2)) as rut,substring(tmp.dmssnum,-1)as dv,concat('K=',tmp.u6conptint,'% I=',tmp.u6conptcuo)  as nro_doc,'' as tot_cuotas,tmp.u6gastcob as tipodoc,'' as edeuda,'' as cuotasven,concat(substring(tmp.u6vencumo,-4),'-',substring(tmp.u6vencumo,4,2),'-',substring(tmp.u6vencumo,1,2)) as fecven,concat(substring(tmp.dmassagdt,-4),'-',substring(tmp.dmassagdt,4,2),'-',substring(tmp.dmassagdt,1,2)) as fecasig,'' as feccoloca
,tmp.u6deuvenc as monto,tmp.u6totdeud as deuda_total,'' as abono,'' as fecabono,tmp.u6deuvenc as deuda_morosa,tmp.dmpayamt as cuotaspa,concat(substring(tmp.dmpaydt,-4),'-',substring(tmp.dmpaydt,3,2),'-',substring(tmp.dmpaydt,1,2)) as fecatuali,'' as cartera,tmp.u6trammor as tramo,tmp.u6moncumo as val_cuota,'' as sald_cuo,'' as provcredi,'' as dias_mora,tmp.u6deuvenc as codprod,tmp.u6intxmora as of1,round((tmp.u6deuvenc+ tmp.u6tdeuxven+tmp.u6carxtrve+ tmp.u6carxtrxv)) as of2,tmp.dmppdue as ad1,tmp.dmresv1 as ad2,tmp.u6tdeuxven as ad3,
round(((tmp.u6deuvenc+ tmp.u6tdeuxven)*(tmp.u6conptint/100))+((tmp.u6carxtrve+ tmp.u6carxtrxv)*(tmp.u6conptgas/100))+((tmp.u6otrcarv+ tmp.u6carxven)*(tmp.u6conptgas/100))+(tmp.u6gastcob*(tmp.u6conptotr/100))+(tmp.u6intxmora*(tmp.u6conptcar/100))) as ad4, round((tmp.u6deuvenc+ tmp.u6tdeuxven+tmp.u6carxtrve+ tmp.u6carxtrxv)*(tmp.u6conrepie/100)) as ad5,'' as codcedente

 from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_carga_deuda_conv_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'
"

 echo "**************CARGANDO FORMA DE CONTACTO***************"

mysql ${USUARIOBD} ${PWDBD} -e "
select replace(substring(tmp.dmssnum,1,length(tmp.dmssnum)-2),'.','') as rut,substring(tmp.dmssnum,-1) as dv,tmp.dmaddr1,'' as num,tmp.dmaddr2,tmp.dmcity,'',tmp.fono1,tmp.fono2,tmp.fono3,tmp.fono4,tmp.fono5

from ${BASE_DATOS}.${TBL_TEMPORAL} tmp 
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_carga_UBICABILIDAD_conv_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"
cd /var/www/html/sistema_gestion/archivos/cargar/
tar  cvf ABCDIN_carga_*_conv_${FECHA}.tar ABCDIN_carga_*_conv*${FECHA}.csv
cd /root
echo "*************ENVIANDO ARCHIVO DE CARGA************************"
echo "CARGA ABCDIN" | mutt $MAIL -s "FORMATOS CARGA ABCDIN COBRANZA" -a /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_carga_*_conv*${FECHA}.tar 
echo "********** CARGA FINALIZADA **************"

echo "*************** ENVIANDO ARCHIVO RESULTADO DE LA CARGA****************"
mysql ${USUARIOBD} ${PWDBD} -e "select * from ${BASE_DATOS}.sistema_temporal_resultado tr where tr.numcarga=${FECHA} and tr.campana='${TBL_TEMPORAL}'
INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'" 


mysql ${USUARIOBD} ${PWDBD} -e "
select count(*), da.rut,da.dv from ${BASE_DATOS}.${TBL_TEMPORAL} ab
inner join ${BASE_DATOS}.sistema_deudor da on concat(da.rut,'-',da.dv)=ab.dmssnum group by da.rut,da.campaign_id

INTO OUTFILE '/var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_ruts_exitentes_${FECHA}.csv'
FIELDS TERMINATED BY ';'
ENCLOSED BY ''
LINES TERMINATED BY '\n'"

cd /var/www/html/sistema_gestion/archivos/cargar/
tar cvf ABCDIN_resultado_${FECHA}.tar ABCDIN_resultado*${FECHA}.csv

echo "RESULTADO CARGA ABCDIN" | mutt $MAIL -s "RESULTADO CARGA ABCDIN CONVENIOS" -a /var/www/html/sistema_gestion/archivos/cargar/ABCDIN_resultado_${FECHA}.tar


