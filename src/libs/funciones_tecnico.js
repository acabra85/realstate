// JavaScript Document
function validar_tecnico()
{
    if(document.crear_tecnico.nombre_tecnico.value.length==0)
            alert('Error: Favor complete el nombre del tecnico');
    else if(document.crear_tecnico.nombre_tecnico.value.length>35)
            alert('Error: El nombre debe tener maximo 35 caracteres');
    else if(document.crear_tecnico.cedula_tecnico.value.length==0)
            alert('Error: Favor complete la cedula tecnico');
    else if(document.crear_tecnico.cedula_tecnico.value.length>10)
            alert('Error: El numero de cedula debe tener maximo 10 caracteres');
    else if(document.crear_tecnico.telc_tecnico.value.length==0)
            alert('Error: Favor complete el telefono celular del tecnico');
    else if(document.crear_tecnico.telc_tecnico.value.length>10)
            alert('Error: El numero celular debe tener maximo 10 caracteres');
    else
            document.crear_tecnico.submit();
}
function soloNumerosTelefonicos(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) || 
       charCode==14 || charCode==15);
}