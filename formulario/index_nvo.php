<meta charset="utf-8">  
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
	font-size:11;
}
</style>
 
<link href="inc/template.css" rel="stylesheet" type="text/css" />
<link href="inc/template1.css" rel="stylesheet" type="text/css" />


<script src="../includes/jquery-ui/jquery-1.7.1.js"></script>


<ul class="tabs">
    <li><a href="#tab1"><font face="verdana,arial" size=1 >FICHA CLIENTE</a></li>
    <li><a href="#tab2"><font face="verdana,arial" size=1>GESTIONES CLIENTE</a></li>
    <li><a href="#tab3"><font face="verdana,arial" size=1>DOCUMENTOS</a></li>
    <li><a href="#tab4"><font face="verdana,arial" size=1>INFORMACION EXTRA</a></li>
   
</ul>




 



<?php
session_start();
//echo "USUARIO: ".$_SESSION[user];
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
  
  $('#opciones').removeAttr('disabled');
   var id_arbol= $('#id_arbol').val();
 //$('#glosa').html($('#id_arbol option:selected').text());
  	//alert(id_arbol);
    var mostrarOpciones = 'carga_datos.php?id_arbol='+id_arbol+'&opcion1=glosa1';
	$.post(mostrarOpciones, function (responseText){
		$("#glosa").html(responseText);
	});
	   
 
   var mostrarOpciones = 'carga_datos.php?id_arbol='+id_arbol;
	$.post(mostrarOpciones, function (responseText){
		$("#opciones").html(responseText);
	});
	

	
}
</script>

<script type="text/javascript">
function carga_opciones2()
{
   $('#opciones2').removeAttr('disabled');	
    var id_arbol= $('#id_arbol').val();
   //$('#glosa').html($('#opciones option:selected').text());
   var opciones= $('#opciones').val();
     
       var mostrarOpciones = 'carga_datos.php?id_arbol='+id_arbol+'&id_opcion='+opciones+'&opcion2=glosa2';
	$.post(mostrarOpciones, function (responseText){
		$("#glosa").html(responseText);
	});
   
   
   var mostrarOpciones = 'carga_datos.php?opciones='+opciones;
 	 $.post(mostrarOpciones, function (responseText){
		$("#opciones2").html(responseText);
	});
}
</script>


<script type="text/javascript">
function carga_opciones3()
{
   //$('#opciones2').removeAttr('disabled');	
   //$('#glosa').html($('#opciones option:selected').text());
   var opciones2= $('#opciones2').val();
      
       var mostrarOpciones = 'carga_datos.php?id_opcion2='+opciones2+'&opcion3=glosa3';
	$.post(mostrarOpciones, function (responseText){
		$("#glosa").html(responseText);
	});
   
   
//   var mostrarOpciones = 'carga_datos.php?opciones='+opciones;
// 	$.post(mostrarOpciones, function (responseText){
//		$("#opciones2").html(responseText);
//	});
}
</script>


<script type="text/javascript">
function carga_cuotas()
{
   //$('#opciones2').removeAttr('disabled');	
   //$('#glosa').html($('#opciones option:selected').text());
     var num_cuotas= $('#num_cuotas').val();
     var pie= $('#pie').val();
     var fecha_vencimiento = $('#fecha_vencimiento').val();
     
     var total_deuda_vencida_vencer= $('#total_deuda_vencida_vencer').val();
     
     var mostrarOpciones = 'carga_cuotas.php?num_cuotas='+num_cuotas+'&pie='+pie+'&total_deuda_vencida_vencer='+total_deuda_vencida_vencer+'&fecha_vencimiento='+fecha_vencimiento;
	$.post(mostrarOpciones, function (responseText){
		$("#desgloce_cuotas").html(responseText);
	});
   
   
//   var mostrarOpciones = 'carga_datos.php?opciones='+opciones;
// 	$.post(mostrarOpciones, function (responseText){
//		$("#opciones2").html(responseText);
//	});
}
</script>

<script>
function num_gestion(fono)
{
	var telefono_gestion = fono;
	alert(telefono_gestion);
	$('#telefono_gestion').val('hola');
}


</script>

 
<?php
function arbol()
{ 
	
	$connect = new DB_mysql;
	$connect->conectar();
	//calcular ID de arbol de la campa�a
	$id_arbol = $connect->consulta("SELECT id_arbol from sistema_arboles_asociacion where campaign = '$_GET[campaign]'");
	while($row2 = mysql_fetch_array($id_arbol))
	{
	   $id_arbol = $row2["id_arbol"];
	}
	$arbol = $connect->consulta("SELECT * from arbol_inicio where arbol = '$id_arbol' and opcion <> 'MAQUINA'");
    echo "<select name='id_arbol' id='id_arbol' class='tb10'  width='200' onchange='carga_opciones();'>";
	echo "<option value='null'>--ARBOL--</option>";
	while($row = mysql_fetch_array($arbol))
	{
		echo "<option value='$row[id_arbol]'>$row[opcion]</option>";
	}
	echo "</select>";
}

function opciones()
{ 
	echo "<select name='opciones' id='opciones' class='tb10' onchange='carga_opciones2();'  width='200' style='width:150;' disabled>";
	echo "<option value='null'>--OPCIONES--</option>";
	echo "</select>";
}

function opciones2()
{ 
	echo "<select name='opciones2' id='opciones2' class='tb10'  onchange='carga_opciones3();'  width='150'  style='width:150;' disabled>";
	echo "<option value='null'>--OPCIONES--</option>";
	;
	echo "</select>";
}


////////////////////////////////////////////////
include("inc/validaciones.php");
?>
 

 
<div class="tab_container">
    <div id="tab1" class="tab_content">
    <?php 
    include("inc/capa1din.php");
     
    ?>
     </div>
    <div id="tab2" class="tab_content">
  <?php 
    include("inc/capa2.php");
    ?>
    </div>
    
 <div id="tab3" class="tab_content">
  <?php 
    include("inc/capa3.php");
    
    ?>

    
    
    </div>
     <div id="tab4" class="tab_content">
  <?php 
    include("inc/capa4.php");
    
    ?>

    
    
    </div>
 




<?php







