// JavaScript Document
function validar_tipo_ot()
{
    if(document.crear_tipo_ot.nombre_tipo_ot.value.length==0)
            alert('Error: Favor complete el tipo de la orden de trabajo');
    else if(document.crear_tipo_ot.nombre_tipo_ot.value.length>14)
            alert('Error: El tipo debe tener maximo 12 caracteres');
    else if(document.crear_tipo_ot.desc_tipo_ot.value.length==0 )
            alert('Error: Favor complete la descripcion del tipo de orden de trabajo');
    else if(document.crear_tipo_ot.desc_tipo_ot.value.length>150 )
            alert('Error: La descripcion debe tener maximo 150 caracteres');
    else
            document.crear_tipo_ot.send_form.click()
}

function limpiar_campos()
{
    document.crear_tipo_ot.borrar_campos.click();
}