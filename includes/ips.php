<?php
include("inc.est");
#
# http://www.lawebdelprogramador.com
#
# codigo que intenta mostrar la IP local, IP p�blica, la IP del proxy y el hostname de la IP p�blica
#
if($_SERVER["HTTP_X_FORWARDED_FOR"])
{
	if($pos=strpos($_SERVER["HTTP_X_FORWARDED_FOR"]," "))
	{
		echo "<font class='main_text_c'><b>IP local:</b> ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$pos)." - IP P�blica: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
		$hostlocal=substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
	}else{
		echo "<font class='main_text_c'><b>IP P�blica: ".$_SERVER["HTTP_X_FORWARDED_FOR"];
		$hostlocal=$_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	if($_SERVER["REMOTE_ADDR"])
		echo "<font class='main_text_c'><b> - Proxy: </b>".$_SERVER["REMOTE_ADDR"];
}else{
	echo "<font class='main_text_c'><b>IP P�blica:</b> ".$_SERVER["REMOTE_ADDR"];
	$hostlocal=$_SERVER["REMOTE_ADDR"];
	if($hostlocal!=$_SERVER["REMOTE_ADDR"])
		echo " - Hostname: ".$hostlocal;
}
$hostname=gethostbyaddr($hostlocal);
if($hostlocal!=$hostname)
	echo "<font class='main_text_c'><b><br>Hostname:</b> ".$hostname;
?>
