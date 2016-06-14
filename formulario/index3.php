<style>
/* Gradient 1 */
.tb10 {
	border:0px solid #d1c7ac;
	/*width: 230px; */
	background: transparent;
 
	color:#333333;
	padding:0px;
	margin-right:0px;
	margin-bottom:0px;
	font-family:tahoma, arial, sans-serif;
	font-size:13;
}
</style>

<link href="inc/template.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="./inc/jquery-1.4.2.min.js"></script>


<ul class="tabs">
    <li><a href="#tab1"><font face="verdana,arial" size=2 >FICHA CLIENTE</a></li>
    <li><a href="#tab2"><font face="verdana,arial" size=2 >GESTIONES CLIENTE</a></li>
   
</ul>






<?php
session_start();
?>


<script>
   $(document).ready(function()
{
	$(".tab_content").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab_content:first").show();

	$("ul.tabs li").click(function()
       {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();

		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});
}); 
</script>



<script type="text/javascript">
function carga_opciones()
{
   var id_arbol= $('#id_arbol').val();
   var mostrarOpciones = 'carga_datos.php?id_arbol='+id_arbol;
	$.post(mostrarOpciones, function (responseText){
		$("#opciones").html(responseText);
	});
}
</script>

<script type="text/javascript">
function carga_estado()
{
	var opciones= $('#opciones').val();
	//alert(opciones)
	var mostrarEstado = 'carga_datos.php?id_opcion='+opciones;
	$.post(mostrarEstado, function (responseText){
		$("#estado").html(responseText);
	});
}
</script>

 
<?php
function arbol()
{ 
	
	$connect = new DB_mysql;
	$connect->conectar();
	$arbol = $connect->consulta("SELECT * from arbol_inicio");
    echo "<select name='id_arbol' id='id_arbol' class='tb10'  onchange='carga_opciones();'>";
	echo "<option value='null'>--ARBOL--</option>";
	while($row = mysql_fetch_array($arbol))
	{
		echo "<option value='$row[id_arbol]'>$row[opcion]</option>";
	}
	echo "</select>";
}

function opciones()
{ 
	echo "<select name='opciones' id='opciones' class='tb10' onchange='carga_estado();' width='500' style='width:300'>";
	echo "<option value='null'>--OPCIONES--</option>";
	echo "</select>";
}


////////////////////////////////////////////////
include("inc/validaciones.php");
?>
 

 
<div class="tab_container">
    <div id="tab1" class="tab_content">
    <?php 
    include("inc/capa1.php");
    
    ?>
     </div>
    <div id="tab2" class="tab_content">
  <?php 
    include("inc/capa2.php");
    ?>
    </div>
    
 <div id="tab3" class="tab_content">
  <?php 
    include("inc/capa2.php");
    
    ?>

    
    
    </div>
    
 




<?php







