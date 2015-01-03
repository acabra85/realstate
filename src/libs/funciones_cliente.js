// JavaScript Document
function validar_cliente()
{
    if(!validarRadio(document.crear_cliente.tipo_cliente))
            alert('Error: Favor seleccione el tipo de cliente');
    else if(document.crear_cliente.cedula_cliente.value.length==0)
            alert('Error: Favor complete el número de identificacion del cliente');
    else if(document.crear_cliente.nombre_cliente.value.length==0)
            alert('Error: Favor complete el nombre del cliente');
    else if (!validarEmail(document.crear_cliente.email_cliente))
            alert('Error: La direccion email es invalida');
    else if(document.crear_cliente.telf_cliente.value.length!=7)
            alert('Error: El numero telefonico fijo debe tener 7 digitos');
    else if(document.crear_cliente.telc_cliente.value.length==0)
            alert('Error: Favor complete el telefono celular del cliente');

    else
    {
        if(document.getElementById('tipo_persona').value=='natural')
        {
            if(document.crear_cliente.apellido_cliente.value.length==0)
                    alert('Error: Favor complete el apellido de el cliente');
            else if(!validarRadio(document.crear_cliente.sexo_cliente))
                    alert('Error: Favor complete el genero del cliente');
            else if(document.crear_cliente.fnac_cliente.value.length!=10)
                    alert('Error: Favor complete la fecha de nacimiento del cliente');
            else if(!validarMayoriaEdad('fnac_cliente'))
                    alert('Error: El cliente ingresado debe ser mayor de edad');
            else
                document.crear_cliente.submit();
        }
        else
        {
            if(document.crear_cliente.dirweb_cliente.value.length==0)
                alert('Error: Favor la direccion URL de la página web del cliente');
            else
                document.crear_cliente.submit();
        }
    }
}
function validar_clienteJ()
{
    if (!validarEmail(document.getElementById('email_cliente')))
            alert('Error: La direccion email es invalida');
    else if(document.getElementById('telf_cliente').value.length!=7)
            alert('Error: El numero telefonico fijo debe tener 7 digitos');
    else if(document.getElementById('telc_cliente').value.length==0)
            alert('Error: Favor complete el telefono celular del cliente');
    else if(document.getElementById('dirweb_cliente').value.length==0)
            alert('Error: Favor la direccion URL de la página web del cliente');

    else
        document.modif_clienteJ.submit();
}

function validar_clienteM()
{
    if (!validarEmail(document.getElementById('email_cliente')))
            alert('Error: La direccion email es invalida');
    else if(document.getElementById('telf_cliente').value.length!=7)
            alert('Error: El numero telefonico fijo debe tener 7 digitos');
    else if(document.getElementById('telc_cliente').value.length==0)
            alert('Error: Favor complete el telefono celular del cliente');
    else
    {
        document.modif_clienteM.submit();
    }
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

function mostrarCamposTipo1()
{
   $(document).ready(function(){});
}


function mostrarCamposTipoNJ(obj)
{
    if(obj.id=='tipo_cliente0')
    {
                document.getElementById('tipo_persona').value='natural';
               $(document).ready(function(){
                   $("#div_juri").hide(100);
                   $("#div_nat").show(100);
               });
    }
    else
    {
                document.getElementById('tipo_persona').value='juridico';
               $(document).ready(function(){
                   $("#div_nat").hide(100);
                   $("#div_juri").show(100);
               });
               document.getElementById("div_juri").style.visibility="";
    }
}

function apagarJuri()
{
    $(document).ready(function(){
                   $("#div_juri").hide(100);});
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