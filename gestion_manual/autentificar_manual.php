<?php 
session_start();
 /* INCLUDE HOJA DE ESTILOS */
   include("../includes/inc.est");
/* INCLUDE CLASE GLOBAL */
include_once("../includes/class/class_mysql_inc.php");
/* DECLARACION DE CONEXION */
   $connect = new DB_mysql;
   $connect->conectar();

   
 $sw=0;
//comprobamos en la db si existe ese nick con esa pass
$usuarios = $connect->consulta("SELECT user,pass,full_name FROM vicidial_users WHERE user='$_POST[username]' and pass='$_POST[password]'");
if($user_ok = mysql_fetch_array($usuarios)) //si existe comenzamos con la sesion, si no, al index
{
$sw=1;

//damos valores a las variables de la sesión
$_SESSION[user] = $user_ok["user"]; //damos el nick a la variable usuario
$_SESSION[pass] = $user_ok["pass"]; //damos la id del user a la variable idusuario
$_SESSION[full_name] = $user_ok["full_name"];
$_SESSION[campaign_id] = $_REQUEST["campaign_id"];

 ?><script>
parent.location.href = 'paginacion3.php';
</script><?php
}

if($sw==0)
{
 ?><script>
//window.alert("Ha ingresado un Rut y/o password incorrecto ");
parent.location.href = 'index_manual.php';

</script><?php
} 
 
?>