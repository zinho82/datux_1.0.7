<?php
session_start();
include_once("class_mysql_inc.php");
include('../phpagi-2.14/phpagi-asmanager.php');



function verificar_ip($ip,$extension)
{
$connect = new DB_mysql;
$connect->conectar();
$asm = new AGI_AsteriskManager();

$result = $connect->consulta("SELECT * from extensiones where ip_exten = '$ip' limit 1");
if($row = mysql_fetch_array($result))
{
	$extension = $row["extension"];
 
if ($res = $asm->connect("127.0.0.1", "agitest", "1234"))
         {
	     $meet = $asm->command("sip show peer $row[extension]");
	     //echo $meet['data'];
	     //if($meet['data'] == 'No active conferences')
         }
         else 
         {
          fatal("No se puede conectar al manager asterisk" );
         } 

if(!strpos($meet['data'], ':'))
          echo $meet['data'];
        else
        {
          $data = array();
          foreach(explode("\n", $meet['data']) as $line)
          {
            $a = strpos('z'.$line, ':') - 1;
            if($a >= 0) $data[trim(substr($line, 0, $a))] = trim(substr($line, $a + 1));
          }
          list($status,$latencia)= explode(" (",$data['Status']);

       // print "STATUS:".substr($data['Status'],0,2)."<br>";
       // print "LATENCIA:".substr($data['Status'],3,10); 
        //print_r($data);
        }         
         
echo "<table border='0' cellpadding=0 cellspacing=5 style='background:url(images/top_bg.gif) repeat;'>";         
echo "<tr><td><font face='verdana' size='1' color='white'><b>";
echo "IP: $ip "."<br>";    
echo "Anexo: $extension"." ";
echo "Estado:".$status." "; // piece1
echo "Latencia:".str_replace(")","",$latencia); // piece2";
     
echo "</td></tr>";
echo "</table>";
if($status=='OK')         
return OK;
}
else 
{
	echo "<table border='0' cellpadding=5 cellspacing=5 align=center>";         
    echo "<tr><td valign='top'>";
	echo"<font face='verdana' size='1' color=''>LA DIRECCION IP NO SE ENCUENTRA VALIDADA <img src='images/icons/exclamation.png'>";
    echo "</td></tr>";
    echo "</table>";
}
}


function obtener_extension($ip)
{
$connect = new DB_mysql;
$connect->conectar();

$result = $connect->consulta("SELECT * from extensiones where ip_exten = '$ip' limit 1");
if($row = mysql_fetch_array($result))
{
	$extension = $row["extension"];
	
}
return $extension;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function state_client($conf_exten,$type,$num_consulta)
{
$connect = new DB_mysql ;
$connect->conectar();
$asm = new AGI_AsteriskManager();
       if ($res = $asm->connect("127.0.0.1", "agitest", "1234"))
         {
         $meet = $asm->command("meetme list $conf_exten concise");
$linea1=0;
$linea2=0;
	     foreach(explode("\n", $meet['data']) as $line)
          {
          	$linea1++;
            $array[$linea1]=$line;
          }
//         echo $array[2]."<br>";   //AGENTE
//         echo $array[3]."<br>";   //AGENTE
//         echo $array[3];
         
//alguien en 
$linea1=0;
	     foreach(explode("!", $array[3]) as $a1)
          {
          	$linea1++;
            $alguien1[$linea1]=$a1;
          }


//alguien en
$linea1=0;
	     foreach(explode("!", $array[4]) as $a2)
          {
          	$linea1++;
            $alguien2[$linea1]=$a2;
          }


//alguien en 
$linea1=0;
	     foreach(explode("!", $array[5]) as $a3)
          {
          	$linea1++;
            $alguien3[$linea1]=$a3;
          }


//alguien en  
$linea1=0;
	     foreach(explode("!", $array[6]) as $a4)
          {
          	$linea1++;
            $alguien4[$linea1]=$a4;
          }         
echo "<font face='verdana' size='1' color=''>".$alguien1[3]."|".$alguien1[1]."<br>";         
echo $alguien2[3]."|".$alguien2[1]."<br>";
echo $alguien3[3]."|".$alguien3[1]."<br>";
echo $alguien4[3]."|".$alguien4[1]."<br>";



///////////////////
echo "<font face='verdana' size='1' color=''>".$alguien1[3]."|".$alguien1[1]."<br>";         
echo "<font face='verdana' size='1' color=''>".$alguien2[3]."|".$alguien2[1]."<br>";
echo "<font face='verdana' size='1' color=''>".$alguien3[3]."|".$alguien3[1]."<br>";
echo "<font face='verdana' size='1' color=''>".$alguien4[3]."|".$alguien4[1]."<br>";

if($alguien1[3] == 'CLIENTE')
{
	$mute = $alguien1[1];
}

if($alguien2[3] == 'CLIENTE')
{
	$mute = $alguien2[1];
}

if($alguien3[3] == 'CLIENTE')
{
	$mute = $alguien3[1];
}

if($alguien4[3] == 'CLIENTE')
{
	$mute = $alguien4[1];
}

echo "a mutear".$mute;

	$asm->command("meetme mute $_SESSION[conf_exten] $mute");
//$asm->command("meetme kick $_SESSION[conf_exten] $kick");
//$asm->redirect("$_SESSION[channel]","","$_SESSION[conf_exten]","inboundce","1");
////////////////////////

//$asm->command("meetme mute $_SESSION[conf_exten] 2");
//MOH
$asm->redirect("$_SESSION[channel]","","8301","inboundce","1");

//$asm->Originate("SIP/$num_consulta", "400", "internos", 1,"meetme", "$_SESSION[conf_exten]|q", $timeout, "CONSUL<$_SESSION[user]>", $variable, $account, $async,$actionid);
	
	
         }
       else 
         {
          fatal("No se puede conectar al manager asterisk" );
         } 
}

////////////////////////////////////////////////////////////////////////////////////////////
function state_client_ret($conf_exten)
{
//echo "conferencia:".$conf_exten;
//echo $type;


$connect = new DB_mysql ;
$connect->conectar();

//require('phpagi-2.14/phpagi-asmanager.php');
$asm = new AGI_AsteriskManager();
//

       if ($res = $asm->connect("127.0.0.1", "agitest", "1234"))
         {
         $meet = $asm->command("meetme list $conf_exten concise");
	     //echo "<font face='verdana' size='2' color='WHITE'>".$meet['data'];
	     
$linea1=0;
$linea2=0;
	   
	     foreach(explode("\n", $meet['data']) as $line)
          {
          	$linea1++;
            $array[$linea1]=$line;
          }

         
         
      //    echo $array[2]."<br>";   //AGENTE
      //    echo $array[3]."<br>";   //AGENTE
//         echo $array[3];
         
//alguien en 
$linea1=0;
	     foreach(explode("!", $array[3]) as $a1)
          {
          	$linea1++;
            $alguien1[$linea1]=$a1;
          }


//alguien en
$linea1=0;
	     foreach(explode("!", $array[4]) as $a2)
          {
          	$linea1++;
            $alguien2[$linea1]=$a2;
          }


//alguien en 
$linea1=0;
	     foreach(explode("!", $array[5]) as $a3)
          {
          	$linea1++;
            $alguien3[$linea1]=$a3;
          }


//alguien en  
$linea1=0;
	     foreach(explode("!", $array[6]) as $a4)
          {
          	$linea1++;
            $alguien4[$linea1]=$a4;
          }         
echo "<font face='verdana' size='1' color=''>".$alguien1[3]."|".$alguien1[1]."<br>";         
echo "<font face='verdana' size='1' color=''>".$alguien2[3]."|".$alguien2[1]."<br>";
echo "<font face='verdana' size='1' color=''>".$alguien3[3]."|".$alguien3[1]."<br>";
echo "<font face='verdana' size='1' color=''>".$alguien4[3]."|".$alguien4[1]."<br>";

if($alguien1[3] == 'CONSUL')
{
	$kick = $alguien1[1];
}

if($alguien2[3] == 'CONSUL')
{
	$kick = $alguien2[1];
}

if($alguien3[3] == 'CONSUL')
{
	$kick = $alguien3[1];
}

if($alguien4[3] == 'CONSUL')
{
	$kick = $alguien4[1];
}


$asm->command("meetme kick $_SESSION[conf_exten] $kick");
$asm->redirect("$_SESSION[channel]","","$_SESSION[conf_exten]","inboundce","1");


//$asm->Originate("SIP/$num_consulta", "400", "internos", 1,"meetme", "$_SESSION[conf_exten]|q", $timeout, "CONSUL<$_SESSION[user]>", $variable, $account, $async,$actionid);
	
	
         }
       else 
         {
          fatal("No se puede conectar al manager asterisk" );
         } 
}
////////////////////////////////////CORTAR

function state_client_cort($conf_exten)
{
//echo "conferencia:".$conf_exten;
//echo $type;


$connect = new DB_mysql ;
$connect->conectar();

//require('phpagi-2.14/phpagi-asmanager.php');
$asm = new AGI_AsteriskManager();
//

       if ($res = $asm->connect("127.0.0.1", "agitest", "1234"))
         {

         	
         	
         $meet = $asm->command("meetme list $conf_exten concise");
	     //echo "<font face='verdana' size='2' color='WHITE'>".$meet['data'];
	     
$linea1=0;
$linea2=0;
	   
	     foreach(explode("\n", $meet['data']) as $line)
          {
          	$linea1++;
            $array[$linea1]=$line;
          }

         
         
      //    echo $array[2]."<br>";   //AGENTE
      //    echo $array[3]."<br>";   //AGENTE
//         echo $array[3];
         
//alguien en 
$linea1=0;
	     foreach(explode("!", $array[3]) as $a1)
          {
          	$linea1++;
            $alguien1[$linea1]=$a1;
          }


//alguien en
$linea1=0;
	     foreach(explode("!", $array[4]) as $a2)
          {
          	$linea1++;
            $alguien2[$linea1]=$a2;
          }


//alguien en 
$linea1=0;
	     foreach(explode("!", $array[5]) as $a3)
          {
          	$linea1++;
            $alguien3[$linea1]=$a3;
          }


//alguien en  
$linea1=0;
	     foreach(explode("!", $array[6]) as $a4)
          {
          	$linea1++;
            $alguien4[$linea1]=$a4;
          }         
echo "<font face='verdana' size='1' color=''>".$alguien1[3]."|".$alguien1[1]."<br>";         
echo "<font face='verdana' size='1' color=''>".$alguien2[3]."|".$alguien2[1]."<br>";
echo "<font face='verdana' size='1' color=''>".$alguien3[3]."|".$alguien3[1]."<br>";
echo "<font face='verdana' size='1' color=''>".$alguien4[3]."|".$alguien4[1]."<br>";

if($alguien1[3] == 'CLIENTE')
{
	$kick = $alguien1[1];
}

if($alguien2[3] == 'CLIENTE')
{
	$kick = $alguien2[1];
}

if($alguien3[3] == 'CLIENTE')
{
	$kick = $alguien3[1];
}

if($alguien4[3] == 'CLIENTE')
{
	$kick = $alguien4[1];
}

 
$NOW = date("Y-m-d H:i:s");
//$asm->command("meetme kick $_SESSION[conf_exten] $kick | Fmq");

//$asm->command("meetme kick $_SESSION[conf_exten] $kick");

$result = $connect->consulta("SELECT * from login_agents where usuario='$_SESSION[user]' and conf_exten = '$conf_exten'");
while($row = mysql_fetch_array($result))
{
if($row['estado']=="INCALL")
{
$asm->redirect("$_SESSION[channel]","","9999","inboundce","1");
$result = $connect->consulta("UPDATE  login_agents SET estado='LIBRE',num_inbound='',u_actividad='$NOW',uniqueid='',channel='' where conf_exten='$_SESSION[conf_exten]'");
}
if($row['estado']=="DEAD")
$result = $connect->consulta("UPDATE  login_agents SET estado='LIBRE',num_inbound='',u_actividad='$NOW',uniqueid='',channel='' where conf_exten='$_SESSION[conf_exten]'");



//$asm->Originate("SIP/$num_consulta", "400", "internos", 1,"meetme", "$_SESSION[conf_exten]|q", $timeout, "CONSUL<$_SESSION[user]>", $variable, $account, $async,$actionid);
}
	
         }
       else 
         {
          fatal("No se puede conectar al manager asterisk" );
         } 
}


?>