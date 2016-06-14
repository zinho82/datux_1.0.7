<?php
session_start();
include_once("../includes/class/class_mysql_inc.php");
$id_arbol= $_REQUEST['id_arbol'];
$id_opcion= $_REQUEST['id_opcion'];

$connect = new DB_mysql ;
$connect->conectar();

	$arbol_id = $connect->consulta("SELECT arbol from arbol_opciones1 where id_arbol = '$id_arbol' limit 1");
	while($row2 = mysql_fetch_array($arbol_id))
	{
	   $arbol = $row2["arbol"];
	}



if($_REQUEST['id_arbol'] && $_REQUEST['opcion1'] == '' && $_REQUEST['opcion2'] == '' )
{
	if($_SESSION[user] == "6666")
	
	$opciones = $connect->consulta("SELECT * FROM arbol_opciones1 WHERE arbol = '$arbol' and id_arbol = ".$_REQUEST['id_arbol'].";");
	else 
	$opciones = $connect->consulta("SELECT * FROM arbol_opciones1 WHERE arbol = '$arbol'  and id_arbol = ".$_REQUEST['id_arbol'].";");
		
	if(mysql_num_rows($opciones) == 0)
	{
	    echo "<select name='' id='opciones' class='tb10' disabled><option value='null'>--NO OPS--</option></select>";
			//	echo "<option id='opciones' value=''>--NO OPS--</option>";
	}
	else
	{
	//	echo "<select name='opciones' id='opciones' class='tb10'>";
	    echo "<option id='opciones' value=''>--SELECCIONE--</option>";
		while($row = mysql_fetch_array($opciones))
		{
			echo "<option id='opciones' value='$row[id_opcion]'>".strtoupper($row[opcion])."</option>";
		}
 //		echo "</select>";
	}	
}


//if($_REQUEST['id_opcion'])
//{
//
//	$estado = $connect->consulta("SELECT * FROM arbol_opciones1 WHERE id_opcion = ".$_REQUEST['id_opcion'].";");
//		
//	  
//		while($row = mysql_fetch_array($estado))
//		{
//			echo "<input type='text' id='estado' value='$row[estado]'>";
//		}
// 
//	}	
 
/////////////////////////////
if($_REQUEST['opciones'])
{
	$opciones = $connect->consulta("SELECT * FROM arbol_opciones2 WHERE id_opcion = '$_REQUEST[opciones]'");
		
	if(mysql_num_rows($opciones) == 0)
	{
		echo "<select name='' id='opciones2' class='tb10' disabled><option value='null'>--NO OPS--</option></select>";
		echo "<option id='opciones2' value='--no-ops--'>--NO OPS--</option>";
	}
	else
	{
		echo "<option id='opciones2' value=''>--SELECCIONE2--</option>";
	//	echo "<select name='opciones' id='opciones' class='tb10'>";
		while($row = mysql_fetch_array($opciones))
		{   
			
			echo "<option id='opciones2' value='$row[id_opcion2]'>$row[opcion]</option>";
		}
 //		echo "</select>";
	}	
}


/////////////////////////////
if($_REQUEST['opcion1'])
{
	$opciones = $connect->consulta("SELECT * FROM arbol_inicio WHERE id_arbol = '$_REQUEST[id_arbol]'");
		while($row = mysql_fetch_array($opciones))
 		{
   			echo $row["opcion"];
   			
 		}
			
	
}

/////////////////////////////
if($_REQUEST['opcion2'])
{
	

	
	
    	$opciones = $connect->consulta("SELECT * FROM arbol_opciones1 WHERE arbol = '$arbol' and id_opcion = '$_REQUEST[id_opcion]'");
		while($row = mysql_fetch_array($opciones))
 		{
   			echo $row["estado"];
   			
 		}
			
	
}

/////////////////////////////
if($_REQUEST['opcion3'])
{

	$opciones = $connect->consulta("SELECT * FROM arbol_opciones2 WHERE id_opcion2 = '$_REQUEST[id_opcion2]'");
		while($row = mysql_fetch_array($opciones))
 		{
   			echo $row["estado"];
   			
 		}
			
	
}
