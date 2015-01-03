// JavaScript Document
function validar_producto()
{
    if(document.crear_producto.nombre_producto.value.length==0)
            alert('Error: Favor complete el nombre del producto');
    else if(document.crear_producto.desc_producto.value.length==0)
            alert('Error: Favor complete la descripcion del producto');
    else if(document.crear_producto.costo_producto.value.length==0)
            alert('Error: Favor complete el costo del producto');
    else if(document.crear_producto.costo_producto.value<0)
            alert('Error: El costo debe ser mayor que cero');
    else if(!validarNumero(document.crear_producto.costo_producto.value))
            alert('Error: Debe ingresar solo numeros para el costo');
    else
    {
        copiarValorCombo(document.crear_producto.tipo_producto, document.crear_producto.id_tipoproducto);
        document.crear_producto.submit();
    }
}
function soloLetras(e)
{
    var keynum
    var keychar
    var numcheck

    if(window.event) // IE
    {
        keynum = e.keyCode
    }
    else if(e.which) // Netscape/Firefox/Opera
    {
        keynum = e.which
    }
    keychar = String.fromCharCode(keynum)
    numcheck = /\d/
    return !numcheck.test(keychar)
}
function validarNumero(num)
{
    if (isNaN(num))
        return false;
    else if(!decimalValido(num))
        return false;
    return true;
}
function soloNumeros(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) || 
       charCode==46 || charCode==14 || charCode==15);
}
function limpiar_campos()
{
    document.crear_producto.borrar_campos.click();
}
function decimalValido(str)
{
    var cont = 0;
    for(var i=0;i<str.length&&cont<=1;i++)
    {
        if(str.charAt(i)=='.' && i==0)
            return false;
        if(str.charAt(i)=='.')
            cont ++;   
        if(str.charAt(i)=='.' && i==(str.length-1))
            return false;
    }
    if(cont>1)
        return false;   
    return true;
}
function corregirCampo(obj)
{
    var str = obj.value;
    if(!validarNumero(str))
    {
        alert('Error: Costo invalido')
        obj.value = "";   
    }
}