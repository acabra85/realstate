// JavaScript Document
function validar_vendedor()
{
    if(!validarMayoriaEdad('fechanac_vendedor'))
        alert('Error:El vendedor debe ser mayor de edad');
    else if (!validarFechaHoyAntes('fechaing_vendedor'))
        alert('Error:El ingreso no puede ser posterior al dia de hoy');
    else if(document.getElementById('nombre_vendedor').value.length == 0 ||
        document.getElementById('apellido_vendedor').value.length == 0 ||
        document.getElementById('genero_vendedor').value.length == 0 ||
        document.getElementById('fechanac_vendedor').value.length != 10 ||
        document.getElementById('cedula_vendedor').value.length == 0 ||
        document.getElementById('id_sucursal').value.length == 0 ||
        document.getElementById('fechaing_vendedor').value.length != 10 ||
        document.getElementById('password_usuario').value.length == 0)
        alert('Error:Favor Complete todos los campos');
    else
        document.crear_vendedor.submit();  
}// JavaScript Document
function validar_vendedorM()
{
    if(document.getElementById('nom_sucursal').selectedIndex==0)
        alert('Error:indique la sucursal donde quedará ubicado el vendedor');
    if(document.getElementById('cedula_vendedor').value.length == 0 ||
        document.getElementById('id_sucursal').value.length == 0 ||
        document.getElementById('password_usuario').value.length == 0)
        alert('Error:Favor Complete todos los campos');
    else
        document.modif_vendedor.submit();
}
function ubicarNombre(txt, num)
{
    for(i=0;i<parseInt(num);i++)
        if(document.getElementById('nom_sucursal').options[i].text==txt.toString())
            document.getElementById('nom_sucursal').selectedIndex=i;

}
function soloNumerosTelefonicos(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) || 
       charCode==14 || charCode==15);
}

function actualizarGenero(obj, objDest)
{    
    if(obj.id=='sexo_m')
        objDest.value = "M"
    else
        objDest.value = "F";
}

function actualizarCodigoSucursal()
{
    document.getElementById('id_sucursal').value = document.getElementById('nom_sucursal').value;
}


function validarMayoriaEdad(obj)
{
    var eventDate = new Date();
    var today = new Date();
    var dateArray = new Array();
    var textDate = document.getElementById(obj).value;
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    if((today.getFullYear()-eventDate.getFullYear())>=18)
        return true;
    else
        return false;

}


function validarFechaHoyAntes(obj)
{
    var today= new Date();
    var eventDate = new Date();
    var dateArray = new Array();
    var textDate = document.getElementById(obj).value;
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    if(eventDate>today)
        return false;
    else
        return true;

}

function validarFechaComparada(obj1, obj2)
{
    var today= new Date();
    var eventDate1 = new Date();
    var eventDate2 = new Date();
    var dateArray = new Array();
    textDate = document.getElementById(obj1).value;
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate1.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    textDate = document.getElementById(obj2).value;
    dateArray = new Array();
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate2.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    if(today<=eventDate1 && eventDate1<eventDate2)
        return true;
    else
        return false;

}