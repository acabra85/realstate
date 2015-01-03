// JavaScript Document
function validar_estado_cambios()
{
    if(document.crear_estado_cambios.nombre_estado.value.length==0)
            alert('Error: Favor complete el nombre del estado');
    else if(document.crear_estado_cambios.nombre_estado.value.length>12)
            alert('Error: El nombre debe tener maximo 12 caracteres');
    else if(document.crear_estado_cambios.desc_estado.value.length==0 )
            alert('Error: Favor complete la descripcion del estado');
    else if(document.crear_estado_cambios.desc_estado.value.length>150 )
            alert('Error: La descripcion debe tener maximo 150 caracteres');
    else
            document.crear_estado_cambios.send_form.click()
}

function limpiar_campos()
{
    document.crear_estado_cambios.borrar_campos.click();
}