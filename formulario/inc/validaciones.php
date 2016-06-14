<script>
function valida_envia(){

fecha1=form1.fecha_compromiso.value;
fecha2=form1.no_pasar_max.value;
fecha3=form1.no_pasar_min.value;
	
f1=new Date(fecha1); //fecha compromiso
f2=new Date(fecha2); //fecha mas 3
f3=new Date(fecha3); //fecha minima

//Datos empresa.
	//valido el nombre
    if (document.form1.id_arbol.value=="null"){
        alert("Debe seleccionar un estado de gestion");
        document.form1.id_arbol.focus();
        return 0;
     }
    if (document.form1.opciones.value.length==0){
       alert("Debe seleccionar un estado de gestion");
       document.form1.opciones.focus();
       return 0;
    }
    
        if (document.form1.telefono_gestion.value.length==0){
       alert("Debe seleccionar un telefono de gestion");
       document.form1.telefono.focus();
       return 0;
    }

//        if (document.form1.opciones.value=='CP')
//        {
       
 //      if (document.form1.fecha_compromiso.value==''){
 //   	       	alert("Debe seleccionar una fecha control");
 //   	       	document.form1.fecha_compromiso.focus();
 //   	       	return 0;
 //     }
	       
       if (document.form1.fecha_compromiso.value!='')
       {
           console.log("i'm here");
      	   if (f1>f2){
	   	       alert("No debe superar 3 dias la fecha actual");
	   	       document.form1.fecha_compromiso.focus();
	   	       return 0;
   	       }
   	    
   	   	 	if (f1<=f3){
	   	       alert("No debe seleccionar fecha anterior a la actual");
	   	       document.form1.fecha_compromiso.focus();
	   	       return 0;
   	    	}
       }
//        if(document.form1.monto_compromiso.value ==''){	
//        alert("Debe seleccionar un monto para este estado CP");
//        document.form1.monto_compromiso.focus();
//        return 0;
//        }
//        }
       

    //el formulario se envia
    //alert("TODOS LOS CAMPOS HAN SIDO INGRESADOS CORRECTAMENTE, PROCEDIENDO...");
    //alert(document.form1.cierra.value);
    document.form1.submit();
} 
</script>
<script>
function valida_envia2(){

//VALIDACION TIPO CLIENTE: Juridico	
alert(document.form1.opciones.value);
//Datos empresa.
	//valido el nombre
    if (document.form1.id_arbol.value=="null"){
        alert("Debe seleccionar un estado de gestion");
        document.form1.id_arbol.focus();
        return 0;
     }
    if (document.form1.opciones.value.length==0){
       alert("Debe seleccionar un estado de gestion");
       document.form1.opciones.focus();
       return 0;
    }
    if (document.form1.opciones2.value.length==0){
       alert("Debe seleccionar un estado de gestion");
       document.form1.opciones2.focus();
       return 0;
    }

    if(document.form1.opciones.value == '103' || document.form1.opciones2.value == '6' || document.form1.opciones2.value == '24' || document.form1.opciones2.value == '25')
    {
       if(document.form1.fecha_compromiso.value =='')
       {	
       alert("Debe seleccionar una fecha de compromiso para este estado");
       document.form1.fecha_compromiso.focus();
       return 0;
       }
       if(document.form1.monto_compromiso.value =='')
       {	
       alert("Debe seleccionar un monto para este estado 2");
       document.form1.monto_compromiso.focus();
       return 0;
       }
       else
       {
       	alert(document.form1.monto_compromiso.value);
		return 0;
       }
       
    }
    //el formulario se envia
    //alert("TODOS LOS CAMPOS HAN SIDO INGRESADOS CORRECTAMENTE, PROCEDIENDO...");
    document.form1.submit();
} 
</script>


<script>
function valida_envia_2(){
 
 
//VALIDACION TIPO CLIENTE: natural

//Datos empresa.
	//valido el nombre
    if (document.fvalida_n.p_rut.value.length==0){
        alert("Debe escribir el rut");
        document.fvalida_n.p_rut.focus();
        return 0;
     }
    if (document.fvalida_n.p_primer_nombre.value.length==0){
       alert("Debe escribir el primer nombre");
       document.fvalida_n.p_primer_nombre.focus();
       return 0;
    }
//    if (document.fvalida_n.p_segundo_nombre.value.length==0){
//       alert("Debe escribir el segundo nombre")
//       document.fvalida_n.p_segundo_nombre.focus()
//       return 0;
//    }
    if (document.fvalida_n.p_apellido_paterno.value.length==0){
       alert("Debe escribir el apellido paterno");
       document.fvalida_n.p_apellido_paterno.focus();
       return 0;
    } 
//    if (document.fvalida_n.p_apellido_materno.value.length==0){
//       alert("Debe escribir el apellido materno")
//       document.fvalida_n.p_apellido_materno.focus()
//       return 0;
//    }
    if (document.fvalida_n.p_profesion.value.length==0){
       alert("Debe escribir la profesion");
       document.fvalida_n.p_profesion.focus();
       return 0;
    }
    if (document.fvalida_n.p_sueldo.value.length==0){
       alert("Debe escribir el sueldo");
       document.fvalida_n.p_sueldo.focus();
       return 0;
    }
    if (document.fvalida_n.p_correo_electronico.value.length==0){
       alert("Debe escribir el correo electronico");
       document.fvalida_n.p_correo_electronico.focus();
       return 0;
    }

//    if (document.fvalida_n.p_est_civil.value=="SELECCIONE"){
//       alert("Debe seleccionar el estado civil")
//       document.fvalida_n.p_est_civil.focus()
//       return 0;
//    }
    if (document.fvalida_n.p_fecha_cumpleano.value.length==0){
       alert("Debe seleccionar la fecha de cumpleaños");
       document.fvalida_n.p_fecha_cumpleano.focus();
       return 0;
    } 
    
    
/////////////////////////////// DATOS DIRECCION
    
    if (document.fvalida_n.tipo_direccion.value=="SELECCIONE"){
       alert("Debe indicar el tipo de direccion");
       document.fvalida_n.tipo_direccion.focus();
       return 0;
    }    
    if (document.fvalida_n.calle.value.length==0){
       alert("Debe indicar la calle");
       document.fvalida_n.calle.focus();
       return 0;
    }    
    if (document.fvalida_n.numero.value.length==0){
       alert("Debe indicar numero");
       document.fvalida_n.numero.focus();
       return 0;
    }    
//    if (document.fvalida_n.depto_ofi.value.length==0){
//       alert("Debe indicar deptartamento u oficina")
//       document.fvalida_n.depto_ofi.focus()
//       return 0;
//    }
//    if (document.fvalida_n.piso.value.length==0){
//       alert("Debe indicar piso")
//       document.fvalida_n.piso.focus()
//       return 0;
//    }
//    if (document.fvalida_n.villa.value.length==0){
//       alert("Debe indicar la villa")
//       document.fvalida_n.villa.focus()
//       return 0;
//    }    

    if (document.fvalida_n.p_id_comuna.value=="null"){
        alert("Debe seleccionar la comuna");
        document.fvalida_n.p_id_comuna.focus();
        return 0;
     }
    if (document.fvalida_n.p_id_ciudad.value=="null"){
        alert("Debe seleccionar la ciudad");
        document.fvalida_n.p_id_ciudad.focus();
        return 0;
     }  
    
    if (document.fvalida_n.casilla.value.length==0){
       alert("Debe indicar el numero de casilla");
       document.fvalida_n.casilla.focus();
       return 0;
    }    
    if (document.fvalida_n.cod_postal.value.length==0){
       alert("Debe indicar el codigo postal");
       document.fvalida_n.cod_postal.focus();
       return 0;
    }    
    
//MEDIO DE CONTACTO
    if (document.fvalida_n.p_tipo_contacto.value=="SELECCIONE"){
       alert("Debe seleccionar el tipo de contacto");
       document.fvalida_n.p_tipo_contacto.focus();
       return 0;
    }        
    if (document.fvalida_n.p_area_contacto.value.length==0){
       alert("Debe indicar el area de contacto");
       document.fvalida_n.p_area_contacto.focus();
       return 0;
    }           
    if (document.fvalida_n.p_num_contacto.value.length==0){
       alert("Debe indicar el numero de contacto");
       document.fvalida_n.p_num_contacto.focus();
       return 0;
    }       


/*       
    //valido la edad. tiene que ser entero mayor que 18
    edad = document.fvalida.edad.value
    edad = validarEntero(edad)
    document.fvalida.edad.value=edad
    if (edad==""){
       alert("Tiene que introducir un n�mero entero en su edad.")
       document.fvalida.edad.focus()
       return 0;
    }else{
       if (edad<18){
          alert("Debe ser mayor de 18 a�os.")
          document.fvalida.edad.focus()
          return 0;
       }
    }
// validacion correo electronico

    alert("document.fvalida.correo_electronico.value");
    if (/^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/.document.fvalida.correo_electronico.value){
    	alert("La direcci�n de email " + document.fvalida.correo_electronico.value + " es correcta.")
    	 
    	} else {
    	alert("La direcci�n de email es incorrecta.");
    	document.fvalida.correo_electronico.focus();
    	}


    
    //valido el inter�s
    if (document.fvalida.interes.selectedIndex==0){
       alert("Debe seleccionar un motivo de su contacto.")
       document.fvalida.interes.focus()
       return 0;
    }
*/
    //el formulario se envia
 //   alert("TODOS LOS CAMPOS HAN SIDO INGRESADOS CORRECTAMENTE, PROCEDIENDO...");
    document.fvalida_n.submit();
} 
</script>
<script>
function valida_envia_n2(){
 
 
//VALIDACION TIPO CLIENTE SEGUNDA FASE: natural



//Datos empresa.
	//valido el nombre
    if (document.fvalida_n2.dc_rut.value.length==0){
        alert("Debe escribir el rut");
        document.fvalida_n2.dc_rut.focus();
        return 0;
     }
    if (document.fvalida_n2.dc_primer_nombre.value.length==0){
       alert("Debe escribir el primer nombre");
       document.fvalida_n2.dc_primer_nombre.focus();
       return 0;
    }
    if (document.fvalida_n2.dc_apellido_paterno.value.length==0){
       alert("Debe escribir el apellido paterno");
       document.fvalida_n2.dc_apellido_paterno.focus();
       return 0;
    } 
    if (document.fvalida_n2.dc_sexo.value=="SELECCIONE"){
       alert("Debe seleccionar el sexo del contacto");
       document.fvalida_n2.dc_sexo.focus();
       return 0;
    }
    if (document.fvalida_n2.dc_calle.value.length==0){
       alert("Debe indicar la calle");
       document.fvalida_n2.dc_calle.focus();
       return 0;
    }    
    if (document.fvalida_n2.dc_numero.value.length==0){
       alert("Debe indicar numero");
       document.fvalida_n2.dc_numero.focus();
       return 0;
    }    
    if (document.fvalida_n2.dc_id_comuna.value=="null" || document.fvalida_n2.dc_id_comuna.value==""){
       alert("Debe seleccionar la comuna");
       document.fvalida_n2.comuna_n.focus();
       return 0;
    }     

  

    //el formulario se envia
   //alert("TODOS LOS CAMPOS HAN SIDO INGRESADOS CORRECTAMENTE, PROCEDIENDO...");
   return true;
    //document.fvalida_n2.submit();
} 
</script>





 
<script language="javascript">
// ****** Script by Cristian Basaez ******
//VALIDACION DE RUT: NATURAL PRIMERA FASE

function validar1(formulario) {
var rut = fvalida.rut.value;
var count = 0;
var count2 = 0;
var factor = 2;
var suma = 0;
var sum = 0;
var digito = 0;
count2 = rut.length - 1;
	while(count < rut.length) {

		sum = factor * (parseInt(rut.substr(count2,1)));
		suma = suma + sum;
		sum = 0;

		count = count + 1;
		count2 = count2 - 1;
		factor = factor + 1;

		if(factor > 7) {
			factor=2;
		}

	}
digito = 11 - (suma % 11);

if (digito == 11) {
	digito = 0;
}
if (digito == 10) {
	digito = "k";
}
fvalida.rut_g.value = digito;
}

</script>

<script language="javascript">
// ****** Script by Cristian Basaez ******
//VALIDACION DE RUT: NATURAL SEGUNDA FASE

function validar(formulario) {
var rut = fvalida_n2.dc_rut.value;
var count = 0;
var count2 = 0;
var factor = 2;
var suma = 0;
var sum = 0;
var digito = 0;
count2 = rut.length - 1;
	while(count < rut.length) {

		sum = factor * (parseInt(rut.substr(count2,1)));
		suma = suma + sum;
		sum = 0;

		count = count + 1;
		count2 = count2 - 1;
		factor = factor + 1;

		if(factor > 7) {
			factor=2;
		}

	}
digito = 11 - (suma % 11);

if (digito == 11) {
	digito = 0;
}
if (digito == 10) {
	digito = "k";
}
fvalida_n2.dc_rut_guion.value = digito;
fvalida_n2.dc_rut_guion_dis.value = digito;
}

</script>


<script language="javascript">
function probando(Cadena){
	alert("asdjhasdhjk");
}
</script>


<script language="javascript">
//VALIDACION DE EMAIL PRIMERA FASE NATURAL.
function isMail(Cadena){
	Punto = Cadena.substring(Cadena.lastIndexOf('.') + 1, Cadena.length);			// Cadena del .com
	Dominio = Cadena.substring(Cadena.lastIndexOf('@') + 1, Cadena.lastIndexOf('.')); 	// Dominio @lala.com
	Usuario = Cadena.substring(0, Cadena.lastIndexOf('@'));					// Cadena lalala@
	Reserv = "@/�\"\'+*{}\\<>?�[]�����#��!^*;,:";						// Letras Reservadas
	
	// A�adida por El Codigo para poder emitir un alert en funcion de si email valido o no
	valido = true;
	
	// verifica qie el Usuario no tenga un caracter especial
	for (var Cont=0; Cont<Usuario.length; Cont++) {
		X = Usuario.substring(Cont,Cont+1);
		if (Reserv.indexOf(X)!=-1)
                	valido = false;
	}

	// verifica qie el Punto no tenga un caracter especial
	for (var Cont=0; Cont<Punto.length; Cont++) {
		X=Punto.substring(Cont,Cont+1);
		if (Reserv.indexOf(X)!=-1)
			valido = false;
	}
                        
	// verifica qie el Dominio no tenga un caracter especial
	for (var Cont=0; Cont<Dominio.length; Cont++) {
		X=Dominio.substring(Cont,Cont+1);
		if (Reserv.indexOf(X)!=-1)
			valido = false;
		}

	// Verifica la sintaxis b�sica.....
	if (Punto.length<2 || Dominio <1 || Cadena.lastIndexOf('.')<0 || Cadena.lastIndexOf('@')<0 || Usuario<1) {
		valido = false;
	}
	
	// A�adido por El C�digo para que emita un alert de aviso indicando si email v�lido o no
	if (valido) {
		//alert('Email v�lido.')
		return false;	//cambiar por return true para hacer el submit del formulario en caso de validacion correcta
	} else {
		alert('Email no valido.');
	//	document.fvalida_n.p_correo_electronico.focus()
		document.fvalida.email.value='';
		document.fvalida.email.focus();
		//return false
	}
}

</script>


<script language="javascript">
//VALIDACION DE EMAIL SEGUNDA FASE NATURAL.
function isMail2(Cadena){
	//alert("pase");
	Punto = Cadena.substring(Cadena.lastIndexOf('.') + 1, Cadena.length);			// Cadena del .com
	Dominio = Cadena.substring(Cadena.lastIndexOf('@') + 1, Cadena.lastIndexOf('.')); 	// Dominio @lala.com
	Usuario = Cadena.substring(0, Cadena.lastIndexOf('@'));					// Cadena lalala@
	Reserv = "@/�\"\'+*{}\\<>?�[]�����#��!^*;,:";
	
	// A�adida por El Codigo para poder emitir un alert en funcion de si email valido o no
	valido = true;
	
	// verifica qie el Usuario no tenga un caracter especial
	for (var Cont=0; Cont<Usuario.length; Cont++) {
		X = Usuario.substring(Cont,Cont+1);
		if (Reserv.indexOf(X)!=-1)
                	valido = false;
	}

	// verifica qie el Punto no tenga un caracter especial
	for (var Cont=0; Cont<Punto.length; Cont++) {
		X=Punto.substring(Cont,Cont+1);
		if (Reserv.indexOf(X)!=-1)
			valido = false;
	}
                        
	// verifica qie el Dominio no tenga un caracter especial
	for (var Cont=0; Cont<Dominio.length; Cont++) {
		X=Dominio.substring(Cont,Cont+1);
		if (Reserv.indexOf(X)!=-1)
			valido = false;
		}

	// Verifica la sintaxis b�sica.....
	if (Punto.length<2 || Dominio <1 || Cadena.lastIndexOf('.')<0 || Cadena.lastIndexOf('@')<0 || Usuario<1) {
		valido = false;
	}
	
	// A�adido por El C�digo para que emita un alert de aviso indicando si email v�lido o no
	if (valido) {
		//alert('Email v�lido.')
		return false;
	} else {
		alert('Email no v�lido.');
	//	document.fvalida_n.p_correo_electronico.focus()
		document.fvalida_n2.dc_correo_electronico.value='';
		document.fvalida_n2.dc_correo_electronico.focus();
		//return false
	}
}

</script>








<script language="javascript">
//SOLO CAMPOS NUMERICOS
function mis_datos()
{
//alert("aasdasd");
if(isNaN(document.fvalida_n.p_rut.value)==true)
{
document.fvalida_n.p_rut.value='';
alert("solo numeros");
}
}

</script>

<script language="javascript">
//SOLO CAMPOS NUMERICOS
function mis_datos_n2()
{
//alert("aasdasd");
if(isNaN(document.fvalida_n2.dc_rut.value)==true)
{
document.fvalida_n2.dc_rut.value='';
alert("solo numeros");
}
}

</script>


