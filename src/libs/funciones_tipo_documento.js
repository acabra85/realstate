// JavaScript Document
function validar_tipo_documento()
{
    if(document.crear_tipo_documento.descripcion_documento.value.length==0)
         alert('Error: Favor complete el tipo de documento');
    else
            document.crear_tipo_documento.send_form.click();
}