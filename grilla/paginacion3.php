<title>Grilla Datux.cl</title>
<?php
session_start();

include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();

$consulta= "SELECT * from sistema_gestiones";
$result = $connect->consulta("$consulta");

$default_cuantas = 45;
$paginas = mysql_numrows($result)/$default_cuantas;
$paginas_botones = ceil($paginas);
$ancho_max=1024;

function select_paginas($paginas_botones)
{
$default_cuantas = 45;
$connect = new DB_mysql ;
$connect->conectar();
 

$result = $connect->consulta("SELECT * from sistema_gestiones limit $paginas_botones");
 
echo "<select name='selectpag' id='selectpag' onChange='display_data_select($default_cuantas)'>";
$pag=1;
while(mysql_fetch_array($result))
	{ 
	echo "<option value='$pag' id='opcion'>$pag</option>";
	$pag=$pag+1;
	}
echo "</select>";
}


//////////////////////CONFIG
//a futuro
$max_pages = 1;
$inicio = 1 ;




function paginas_cuantas($paginas_botones,$default_cuantas,$max_pages,$inicio,$avance,$ancho_max)
{   
	 
	echo "<table border=0 width='180' align=''>";
	echo "<tr  background='../images/ui-bg_gloss-wave_55_5c9ccc_500x100.png' height='20'><td align='right'>";
    
	//echo "<input type='button' id='inicio' value='inicio' onclick=''>";
	echo "<div id='select_paginas'>";
	select_paginas($paginas_botones);
	echo "</div>";
	echo "</td><td width='100'>";
	echo "<input type='button' id='retro_pag' value='<' onclick='display_data_retrocede($default_cuantas);'>";

	for ($i = $inicio; $i <= $max_pages; $i++) 
	{   
		echo "<input type='button' style='width:35px;' id='num_pagina' value='1' onclick='display_data($i,$default_cuantas);' disabled >";
    }

	echo "<input type='button' id='avan_pag' value='>' onclick='display_data_avance($default_cuantas,$i,$max_pages,$paginas_botones);'>";
	//echo "<input type='button' id='final' value='final' onclick='display_data($i,$default_cuantas);'>";
	echo "</td></tr>";
	echo "</table>";
}		

?>
 
<script src="../includes/jquery-ui/jquery-1.7.1.js"></script>
	<link rel="stylesheet" href="../includes/jquery-ui/jquery.ui.all.css">
	<script src="../includes/jquery-ui/jquery.ui.core.js"></script>
	<script src="../includes/jquery-ui/jquery.ui.widget.js"></script>
	<script src="../includes/jquery-ui/jquery.ui.datepicker.js"></script>
	<script src="../includes/jquery-ui/jquery.ui.datepicker-es.js"></script>
	<link rel="stylesheet" href="../includes/jquery-ui/demos.css">
	<link rel="stylesheet" href="../includes/jquery-ui/demos.css">
	<script>
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+0w",
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	</script>

<table border='1' width='1024'  cellspacing='0' cellpadding='0'>
<tr><td width='844'>

<div class="demo">
<label for="from">Desde</label>
<input type="text" id="from" style='width:80px;height:20px;' name="from"/>
<label for="to">Hasta</label>
<input type="text" id="to" style='width:80px;height:20px;' name="to"/>
RUT CLIENTE<input type="text" id="rut" style='width:80px;height:20px;' name="rut"/>
<?php echo "<input type='button' name='filtrofecha' value='Filtrar' onclick='display_data_busca(1,$default_cuantas);'>"; ?>
</div>
</td>
<td>

<?php
echo "<div id='selector_paginas'>";	
paginas_cuantas($paginas_botones,$default_cuantas,$max_pages,$inicio,0,$ancho_max);
//paginas en total, cuantos registros mostrar, maximo de paginas a mostrar
echo "</div>";
?>

</td>
</tr>
</table>

<div id="vodale">
Exportar Gestiones a <a href="export_gestiones.php" >Excel:  <img src='../images/excel_ico.ico'></a>
</div>
<div id="grilla" >
<body onload="display_data(1,<?php echo $default_cuantas; ?>);"></body>
</div>
		
		
 


<script>
function display_data_select(default_cuantas)
{
//   var pagina= pagina;
//   alert("kiwa");
   var pagina = $("#selectpag").val();
   var cuantas = default_cuantas;
   $("input").removeAttr("disabled");  
   $("#num_pagina").attr("disabled", true);
   var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas;
   $.post(mostrarOpciones, function (responseText){
		$("#grilla").html(responseText);
	});
	     $("#num_pagina").attr("disabled",true);  
     $("#num_pagina").attr("value", pagina);
  //   $("#formulario_vars").html("<input type='text' value="+pagina+" name='variable' id='max_pages'>");
}
</script>

<script>
function display_data(pagina,default_cuantas)
{
   var pagina= pagina;
   var cuantas = default_cuantas;
   $("input").removeAttr("disabled");  
   $("#num_pagina").attr("disabled", true);
   var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas;
   $.post(mostrarOpciones, function (responseText){
		$("#grilla").html(responseText);
	});
}
</script>

<script>
function display_data_avance(default_cuantas,pagina,max_pages,paginas_botones)
{
   var cuantas = default_cuantas;
   var paginas_botones = paginas_botones;
   var pagina = parseInt($("#pagina_actual").attr("value")) +1;  
   var desde = ($("#from").attr("value"));
   var hasta = ($("#to").attr("value"));
   
   
   if(pagina > paginas_botones)
   alert("no puede seguir");
   else
   {
   var max = parseInt($("#max_pages").attr("value"));  
   var max_pages = max_pages;
  // $("#formulario_vars").html("<input type='text' value="+pagina+" name='variable' id='max_pages'>");
     	 
     var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas+'&mostrar_paginas_max='+max_pages+'&desde='+desde+'&hasta='+hasta;
     $.post(mostrarOpciones, function (responseText){
	 $("#grilla").html(responseText);
     });

     $("#num_pagina").attr("disabled",true);  
     $("#num_pagina").attr("value", pagina);
//     var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas+'&mostrar_paginas_max='+max_pages;
//     $.post(mostrarOpciones, function (responseText){
//	 $("#grilla").html(responseText);
//	});
   }
 return pagina;
}
</script>

<script>
function display_data_busca(pagina,cuantas)
{
   desde = ($("#from").attr("value"));
   hasta = ($("#to").attr("value"));
   rut = ($("#rut").attr("value"));
       
   var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas+'&desde='+desde+'&hasta='+hasta+'&rut='+rut;
   $.post(mostrarOpciones, function (responseText){
		$("#grilla").html(responseText);
   });
       $("#num_pagina").attr("disabled",true);  
     $("#num_pagina").attr("value", pagina);
}
</script>

<script>
function display_data_retrocede(default_cuantas,pagina,max_pages,paginas_botones)
{
   var cuantas = default_cuantas;
   var desde = ($("#from").attr("value"));
   var hasta = ($("#to").attr("value"));
   var pagina = parseInt($("#pagina_actual").attr("value")) -1;  
   if(pagina == 0)
   alert("no puede seguir");
   else
   {
   //$("#formulario_vars").html("<input type='text' value="+pagina+" name='variable' id='max_pages'>");
   
   $("input").removeAttr("disabled");  
   $("#num_pagina").attr("disabled", true);
   $("#num_pagina").attr("value", pagina);
    var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas+'&mostrar_paginas_max='+max_pages+'&desde='+desde+'&hasta='+hasta;
   $.post(mostrarOpciones, function (responseText){
		$("#grilla").html(responseText);
	});
   }
	
}
</script>

<script>
function modificar_registro(id_gestion,fecha)
{
   $("input").attr("disabled", true);
   $("#"+id_gestion).removeAttr("disabled"); 
   $("#"+id_gestion+"fecha").removeAttr("disabled"); 
    $("#"+id_gestion).focus(); 
}
</script>


<?php


 
 
?>


 
