<?php session_start();
 /* INCLUDE HOJA DE ESTILOS */
   include("includes/inc.est");
/* INCLUDE CLASE GLOBAL */
   include_once("includes/class/class_global.php");
/* DECLARACION DE CONEXION */
   $connect = new DB_mysql;
   $connect->conectar();

 $sw=0;
//comprobamos en la db si existe ese nick con esa pass
$usuarios = $connect->consulta("SELECT * FROM users_admin WHERE username='$_POST[username]' and password='$_POST[password]' and user_level = 4");
if($user_ok = mysql_fetch_array($usuarios)) //si existe comenzamos con la sesion, si no, al index
{
$sw=1;
session_register("usuario"); //registramos la variable usuario que contendrá el nick del user
session_register("id_user"); //registramos la variable idusuario que contendrá la id del user
session_register("level"); //registramos la variable level que contendrá el level del user

//damos valores a las variables de la sesión
$_SESSION[usuario] = $user_ok["username"]; //damos el nick a la variable usuario
$_SESSION[password] = $user_ok["password"]; //damos la id del user a la variable idusuario
$_SESSION[nivel] = $user_ok["user_level"]; //damos el level del user a la variable level
$_SESSION[nombres] = $user_ok["nombres"];
$_SESSION[apellidos] = $user_ok["apellidos"];
$_SESSION[id_user] = $user_ok["id_user"];
$_SESSION[server] = $user_ok["server"];

 ?><script>
parent.location.href = 'principal.php';
</script><?php
}
else
{
$usuarios2 = $connect->consulta("SELECT * FROM users_admin WHERE username='$_REQUEST[username]' and password='$_REQUEST[password]' and user_level = 3");
if($user_ok2 = mysql_fetch_array($usuarios2)) //si existe comenzamos con la sesion, si no, al index
{
$sw=1;
session_register("usuario"); //registramos la variable usuario que contendrá el nick del user
session_register("idusuario"); //registramos la variable idusuario que contendrá la id del user
session_register("level"); //registramos la variable level que contendrá el level del user
//damos valores a las variables de la sesión
$_SESSION[usuario] = $user_ok2["username"]; //damos el nick a la variable usuario
$_SESSION[password] = $user_ok2["password"]; //damos la id del user a la variable idusuario
$_SESSION[nivel] = $user_ok2["user_level"]; //damos el level del user a la variable level
$_SESSION[nombres] = $user_ok2["nombres"];
$_SESSION[apellidos] = $user_ok2["apellidos"];
$_SESSION[server] = $user_ok2["server"];
?>
<script>
parent.location.href = 'principal.php';
</script>
<?php
}
$usuarios3 = $connect->consulta("SELECT * FROM users_admin WHERE username='$_REQUEST[username]' and password='$_REQUEST[password]' and user_level = 1");
if($user_ok3 = mysql_fetch_array($usuarios3)) //si existe comenzamos con la sesion, si no, al index
{
$sw=1;
session_register("usuario"); //registramos la variable usuario que contendrá el nick del user
session_register("idusuario"); //registramos la variable idusuario que contendrá la id del user
session_register("level"); //registramos la variable level que contendrá el level del user
//damos valores a las variables de la sesión
$_SESSION[usuario] = $user_ok3["username"]; //damos el nick a la variable usuario
$_SESSION[password] = $user_ok3["password"]; //damos la id del user a la variable idusuario
$_SESSION[nivel] = $user_ok3["user_level"]; //damos el level del user a la variable level
$_SESSION[nombres] = $user_ok3["nombres"];
$_SESSION[apellidos] = $user_ok3["apellidos"];
$_SESSION[server] = $user_ok3["server"];
?>
<script>
parent.location.href = 'principal.php';
</script>
<?php
}
}
if($sw==0)
{
 ?><script>
//window.alert("Ha ingresado un Rut y/o password incorrecto ");
parent.location.href = 'index.php';

</script><?php
} 
 
?>