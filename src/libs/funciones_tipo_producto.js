// JavaScript Document
function validar_tipo_producto()
{
    if(document.crear_tipo_producto.nombre_tipo_producto.value.length==0)
            alert('Error: Favor complete el nombre del tipo de producto');
    else if(document.crear_tipo_producto.nombre_tipo_producto.value.length>14)
            alert('Error: El tipo debe tener maximo 12 caracteres');
    else if(document.crear_tipo_producto.desc_tipo_producto.value.length==0 )
            alert('Error: Favor complete la descripcion del tipo de producto');
    else if(document.crear_tipo_producto.desc_tipo_producto.value.length>150 )
            alert('Error: La descripcion debe tener maximo 150 caracteres');
    else
            document.crear_tipo_producto.send_form.click()
}

function limpiar_campos()
{
    document.crear_tipo_ot.borrar_campos.click();
}