<?php
session_start();

include_once("../includes/class/class_mysql_inc.php");

$connect = new DB_mysql ;
$connect->conectar();
 
$result = $connect->consulta("SELECT * from gestiones_tricot");
$default_cuantas = 30;
$paginas = mysql_numrows($result)/$default_cuantas;
$paginas_botones = ceil($paginas);
$max_pages = 6;
$inicio = 1 ;

function paginas_cuantas($paginas_botones,$default_cuantas,$max_pages,$inicio,$avance)
{
	if($avance ==1) 
 	{

 	}
 	
//	echo "paginas_max:".$max_pages."<br>";
//	echo "paginas_botones:".$paginas_botones."<br>";
// 	echo "default_cuantas:".$default_cuantas."<br>";
// 	echo "avance:".$avance."<br>";
// 	echo "inicio:".$inicio."<br>";
 	

 

 	
    echo "<form action='' method='POST'>";
    echo "<div id='formulario_vars'></div>";
	echo "<input type='button' id='inicio' value='inicio' onclick=''>";
	echo "<input type='button' id='retro_pag' value='<' onclick='display_data_retrocede();'>";
    
    //
   
	for ($i = $inicio; $i <= $max_pages; $i++) 
	{   
	       
		echo "<input type='button' id='num_pagina$i' style='width:40px;' value='$i' onclick='display_data($i,$default_cuantas);'>";

	}
	
	echo "<input type='button' id='avan_pag' value='>' onclick='display_data_avance($default_cuantas,$i,$max_pages);'>";
	
	
	echo "<input type='button' id='final' value='final' onclick='display_data($i,$default_cuantas);'>";
	
	echo "<form>";
   $max_pages= $max_pages+1;
   $inicio= $inicio+1;
   
   
}		

?>
 <body onload="display_data(1,<?php echo $default_cuantas; ?>);"></body>
<div id="grilla" ></div>		
		
		
<script type="text/javascript" language="javascript" src="inc/jquery-1.7.1.min.js">
<script type="text/javascript" charset="utf-8"></script>

<script>
function display_data(pagina,default_cuantas)
{
   var pagina= pagina;
   var cuantas = default_cuantas;
   //alert(pagina);
//   alert ($("#pagina_actual").attr("value"));  
//   ($("#probando").attr("value","123"));  
   
   $("input").removeAttr("disabled");  
   $("#num_pagina"+pagina).attr("disabled", true);
   var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas;
   $.post(mostrarOpciones, function (responseText){
		$("#grilla").html(responseText);
	});
}
</script>

<script>
function display_data_avance(default_cuantas,pagina,max_pages)
{
   var cuantas = default_cuantas;
  
   var pagina = parseInt($("#pagina_actual").attr("value")) +1;  
   var max = parseInt($("#max_pages").attr("value"));  
 
   var max_pages = max_pages;
  // alert(pagina);
   
   if(pagina > max_pages)
	{

	 var avance = 'paginacion2.php?pagina='+pagina+'&cuantas='+cuantas+'&avance=1';
     $.post(avance, function (responseText){
	 $("#selector_paginas").html(responseText);
	     $("input").removeAttr("disabled");  
     $("#num_pagina"+pagina).attr("disabled", true);
	 });
     //$("#formulario_vars").html("<input type='text' value="+pagina+" name='variable' id='max_pages'>");
     	 
     var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas+'&mostrar_paginas_max='+max_pages;
     $.post(mostrarOpciones, function (responseText){
	 $("#grilla").html(responseText);
     });
     
	}
	else
	{   
 
     $("input").removeAttr("disabled");  
     $("#num_pagina"+pagina).attr("disabled", true);
     var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas+'&mostrar_paginas_max='+max_pages;
     $.post(mostrarOpciones, function (responseText){
	 $("#grilla").html(responseText);
	});
	}
 return pagina;
}
</script>



<script>
function display_data_retrocede()
{
   var cuantas = 30;
   var pagina = parseInt($("#pagina_actual").attr("value")) -1;  
   
   $("input").removeAttr("disabled");  
   $("#num_pagina"+pagina).attr("disabled", true);
   var mostrarOpciones = 'carga_grilla.php?pagina='+pagina+'&cuantas='+cuantas;
   $.post(mostrarOpciones, function (responseText){
		$("#grilla").html(responseText);
	});
	//$("#selector_paginas").html("asdasd");
}
</script>


<?php



 

if($_REQUEST["avance"]==1)
{
paginas_cuantas($paginas_botones,$default_cuantas,$_REQUEST["pagina"]+$max_pages,$_REQUEST["pagina"],0);
}

else 
{

echo "<div id='formulario_vars'> </div>";

echo "<div id='selector_paginas'>";	
paginas_cuantas($paginas_botones,$default_cuantas,$max_pages,$inicio,0);
//paginas en total, cuantos registros mostrar, maximo de paginas a mostrar
echo "</div>";
}
 
echo "<div id='pagina_actual' value='$pagina'>".$pagina."</div>";
echo "<div id='pagina_actual' value='$cuantas'>".$cuantas."</div>";


 
?>
	
			
		
