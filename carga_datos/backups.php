<?php
   session_start();  
/* INCLUDE HOJA DE ESTILOS */
   include("includes/inc.est");
/* INCLUDE CLASE GLOBAL */
   include_once("includes/class/class_global.php");
 
//$seccion=$_POST['seccion']; 
$dir="backup/"; 
$directorio=opendir($dir); 
echo "<font class=main_text_c><b>Directorio actual:</b> &nbsp;&nbsp;&nbsp;$dir<br>"; 
echo "<font class=main_text_c><b>Archivos:</b> <br>"; 
$num=0; 
$i=0; 
while ($archivo = readdir($directorio)) { 
if ($archivo==".") { echo " "; } else if ($archivo=="..") { echo " "; } else { 
$archivo = str_replace("_", "&nbsp;", $archivo); 
$num++; 
$i++; 
$entradas[$archivo] = filemtime($dir."/".$archivo);

} } 
arsort($entradas);
closedir; 
?>
<br>
<table border="0" cellspacing="3">
<tr BGCOLOR="DADAd5"><td width="150"><font class=main_text_c><b>Fecha creacion</td><td width="300"><font class=main_text_c><b>Nombre Archivo</td><td width="5"><center><font class=main_text_c><b>D</td></tr> <?php
foreach ($entradas as $archivo => $timestamp) 
{ 
?><tr onMouseover="this.style.backgroundColor='#DDF'" onMouseout="this.style.backgroundColor='transparent'"><td width="150"><font class=main_text_c><?php echo date("d-m-Y h:m:s", $timestamp); ?></td>

<td width="380"><?php echo "<font class=main_text_c> - <b>$archivo</b> -"; ?></td>
<td width="5"><a href="<?php echo $dir.$archivo; ?>"><img src="images/basket_put.png" border="0"></a></td></tr><?php
} 

?>












    