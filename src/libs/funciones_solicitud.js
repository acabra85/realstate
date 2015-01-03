
// JavaScript Document
function validar_solicitud()
{
    //nombre cliente
    if(document.crear_solicitud.fecha_solicitud.value.length==0)
        alert('Error: El campo fecha solicitud no puede ser vacio');
    else if(document.crear_solicitud.desc_solicitud.value.length==0)
        alert('Error: El campo descripcion no puede ser vacio');
    else if(!validarFechaHoyAntes(document.crear_solicitud.fecha_solicitud))
        alert('Error: La fecha de la solicitud no puede ser posterior al dia de hoy');
    else if(!validarFechaComparada(document.crear_solicitud.fechaF_solicitud, document.crear_solicitud.fecha_solicitud))
        alert('Error: La fecha de asignacion no puede previa al dia de hoy');
    else if(document.crear_solicitud.desc_solicitud.value.length>1000)
            alert('Error: La descripcion no debe superar 1000 caracteres');
    else
        document.crear_solicitud.submit();            
}

function validarFechaHoyAntes(obj)
{
    var today= new Date();
    var eventDate = new Date();
    var dateArray = new Array();
    var textDate = obj.value;
    dateArray = textDate.split("/");
    dateArray[1] = dateArray[1] -1;
    eventDate.setFullYear(dateArray[2], dateArray[1],dateArray[0]);
    if(eventDate>today)
        return false;
    else
        return true;

}
function validarFechaComparada(obj2, obj1)
{
    var today= new Date();
    var eventDate1 = new Date();
    var eventDate2 = new Date();
    var dateArray = new Array();
    var textDate = obj1.value;
    dateArray = textDate.split("/");
    dateArray[1] = dateArray[1] -1;
    eventDate1.setFullYear(dateArray[2], dateArray[1],dateArray[0]);
    textDate = obj2.value;
    dateArray = new Array();
    dateArray = textDate.split("/");
    dateArray[1] = dateArray[1] -1;
    eventDate2.setFullYear(dateArray[2], dateArray[1],dateArray[0]);
    if(eventDate1>eventDate2)
    {
        return false;
    }
    else if(eventDate2<today)
    {
        return false;
    }
    else
        return true;

}

