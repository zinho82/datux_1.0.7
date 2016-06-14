<?php
$dir=opendir("includes/class/");
while ($archivo=readdir($dir))
if ($archivo!="." && $archivo!=".." && $archivo!="clases.php")
include_once($archivo);
closedir($dir);
?>
