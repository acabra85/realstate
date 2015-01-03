
// JavaScript Document
function validar_solicitud_ini()
{
    //nombre cliente
    if(document.crear_solicitud_ini.cedulas_cliente.selectedIndex==0)
            alert('Error: Favor Seleccione el numero de cedula');
    else
    {
        copiarValorCombo(document.crear_solicitud_ini.cedulas_cliente,
                         document.crear_solicitud_ini.id_clie);
        document.crear_solicitud_ini.submit();
    }
}
function validar_ot_ini()
{
    //nombre cliente
    if(document.crear_ot_ini.ids_sol.selectedIndex==0)
            alert('Error: Favor Seleccione el numero de solicitud');
    else
    {
        copiarValorCombo(document.crear_ot_ini.ids_sol,
                         document.crear_ot_ini.id_sol);
        document.crear_ot_ini.submit();
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
