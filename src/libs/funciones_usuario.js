// JavaScript Document
function validar_usuario()
{
    //alert("Pass:"+document.crear_usuario.password_usuario.value+"\n"+document.crear_usuario.password_usuario_1.value);
    if(document.crear_usuario.nombre_usuario.value.length==0)
            alert('Error: Favor complete el nombre de usuario');
    else if(document.crear_usuario.password_usuario.value!=document.crear_usuario.password_usuario_1.value)
            alert('Error: La clave y su confirmación no coinciden');
    else if(document.crear_usuario.password_usuario.value.length<4 ||
        document.crear_usuario.password_usuario.value.length>8 )
            alert('Error: La clave debe contener entre 4 y 8 caracteres');
    else
            document.crear_usuario.send_form.click();
}

function limpiar_campos()
{
    document.crear_usuario.borrar_campos.click();
}