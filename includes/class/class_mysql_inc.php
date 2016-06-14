<?php
class DB_mysql {
/* variables de conexi�n */
var $BaseDatos;
var $Servidor;
var $Usuario;
var $Clave;
/* identificador de conexi�n y consulta */
var $Conexion_ID = 0;
var $Consulta_ID = 0;
/* n�mero de error y texto error */
var $Errno = 0;
var $Error = "";
/* M�todo Constructor: Cada vez que creemos una variable
de esta clase, se ejecutar� esta funci�n */
function DB_mysql($bd = "asterisk", $host = "localhost", $user = "root", $pass = "zinho1982") 
{
$this->BaseDatos = $bd;
$this->Servidor = $host;
$this->Usuario = $user;
$this->Clave = $pass;
}
/*Conexi�n a la base de datos*/
function conectar(){
if ($bd != "") $this->BaseDatos = $bd;
if ($host != "") $this->Servidor = $host;
if ($user != "") $this->Usuario = $user;
if ($pass != "") $this->Clave = $pass;
// Conectamos al servidor
$this->Conexion_ID = mysql_connect($this->Servidor, $this->Usuario, $this->Clave);
 
if (!$this->Conexion_ID) 
{
$this->Error = "Ha fallado la conexi�n.";
echo $this->Error;
return 0;
}
//seleccionamos la base de datos
if (!@mysql_select_db($this->BaseDatos, $this->Conexion_ID)) 
{
$this->Error = "Imposible abrir ".$this->BaseDatos ;
echo $this->Error;
return 0;
}
/* Si hemos tenido �xito conectando devuelve 
el identificador de la conexi�n, sino devuelve 0 */
return $this->Conexion_ID;
}

/* Ejecuta un consulta */

function consulta($sql = "")
{
if ($sql == "") {
$this->Error = "No ha especificado una consulta SQL";
return 0;
}

//ejecutamos la consulta
$this->Consulta_ID = @mysql_query($sql, $this->Conexion_ID);

if (!$this->Consulta_ID or !$this->Conexion_ID) 
{
$this->Errno = mysql_errno();
$this->Error = mysql_error();
echo $this->Errno;
echo $this->Error;
}
/* Si hemos tenido �xito en la consulta devuelve 
el identificador de la conexi�n, sino devuelve 0 */
return $this->Consulta_ID;
}


/* Muestra los datos de la consulta */
function verconsulta_homepage() 
{// mostrarmos los registros
if ($this->Conexion_ID and $this->Consulta_ID ) 
{
while ($row = mysql_fetch_array($this->Consulta_ID)) 
{
echo "<font class='main_text_c'><b>";
echo "<a href='ver_noticias.php?id_noticias_articulos=$row[id_noticias_articulos]'>".$row["titulo"]."</a><br>";

}
}
} 
 
/* Muestra los datos de la consulta */
function verconsulta_homepage_alerta() 
{// mostrarmos los registros
if ($this->Conexion_ID and $this->Consulta_ID ) 
{
while ($row = mysql_fetch_array($this->Consulta_ID)) 
{
echo "<font class='main_text_c'><b>";
echo "<a href='ver_alertas.php?id_alertas=$row[id_alertas]'>".$row["titulo"]."</a><br>";

}
}
} 
 
 
/*************************************/ 

} //fin de la Clse DB_mysql

?>
