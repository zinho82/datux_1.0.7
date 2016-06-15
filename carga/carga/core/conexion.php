<?php

class Conexion {
    function conectar_db($db){
        $conn=mysql_connect("localhost","root","zinho1982") or die(mysql_error().' '.  mysql_errno());
	if (! $conn){
         	echo "<h2 align='center'>ERROR: 1 Imposible establecer conecci&oacute;n con el servidor de BD</h2>";
	} 
//Seleccionamos la base
mysql_select_db($db,$conn);
mysql_query("SET NAMES 'utf8'"); 
return $conn;
	}
    function conectar_db_ppal($ip,$db){
   $conn=mysql_connect($ip,"zinho","zinho1982") or die(mysql_error().' '.  mysql_errno());
	if (! $conn){
         	echo "<h2 align='center'>ERROR: 2 Imposible establecer conecci&oacute;n con el servidor de BD</h2>";
		exit;
	}
//Seleccionamos la base
mysql_select_db($db,$conn);
mysql_query("SET NAMES 'utf8'"); 
return $conn;
}
    function espacios($campo,$largo)
	{
		$lcampo=strlen($campo);
		$tcampo=$largo-$lcampo;
		$lcampo;
		for($i=0;$i<$tcampo;$i++)
		{
			$campo=' '.$campo;
		}
		return $campo;
		 
	}
    function espacios_izq($campo,$largo)
	{
		$lcampo=strlen($campo);
		$tcampo=$largo-$lcampo;
		$lcampo;
		for($i=0;$i<$tcampo;$i++)
		{
			$campo=$campo.' ';
		}
		return $campo;
		 
	}
   function ceros($campo,$largo)
	{
		$lcampo=strlen($campo);
		$tcampo=$largo-$lcampo;
		$lcampo;
		for($i=0;$i<$tcampo;$i++)
		{
			$campo='0'.$campo;
		}
		return $campo;
		 
	}
function sanear_string($string)
{

    //$string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ã', 'Ã', 'Ã', 'Ã'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ã', 'ç', 'Ã'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );


    return $string;
}
        
}
