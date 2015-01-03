
// JavaScript Document
function validar_ot()
{
    //nombre cliente
    if(document.crear_ot.fecha_ordentrabajo.value.length!=10)
        alert('Error: El campo fecha solicitud no puede ser vacio');
    else if(document.crear_ot.tipos_ordenes.selectedIndex==0)
        alert('Error: Seleccione un tipo de orden de trabajo');
    else if(document.crear_ot.estados_ordenes.selectedIndex==0)
        alert('Error: Seleccione un Estado inicial de la orden de trabajo');
    else if(document.crear_ot.tecnicos_asignados.selectedIndex==0)
        alert('Error: Seleccione un tecnico para atender la orden de trabajo');
    else if(document.crear_ot.desc_ordentrabajo.value.length==0)
        alert('Error: El campo descripcion no puede ser vacio');
    else if(document.crear_ot.desc_ordentrabajo.value.length>1000)
            alert('Error: La descripcion no debe superar 1000 caracteres');
    else if(!validarFechaHoyAntes(document.crear_ot.fecha_ordentrabajo))
        alert('Error: La fecha de asignacion no puede previa al dia de hoy');
    else
        document.crear_ot.submit();
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
    if(eventDate>=today)
        return true;
    else
        return false;

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

