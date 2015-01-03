// JavaScript Document
function validar_contrato()
{
    /*document.getElementById('tipo_contrato').selectedIndex=2;
    document.getElementById('id_inmueble').selectedIndex=1;
    document.getElementById('id_cliente').selectedIndex=1;
    document.getElementById('id_vendedor').selectedIndex=2;

    document.getElementById('fechaini_contrato').value="2011-12-09";
    document.getElementById('fechafin_contrato').value="2012-05-09";
    document.getElementById('val_cont').value="8500";
    document.getElementById('tipo_cont').value="2";
    copiarValorCampo(document.getElementById('id_cliente'),document.getElementById('id_cli'));
    copiarValorCampo(document.getElementById('id_inmueble'),document.getElementById('id_inm'));
    copiarValorCampo( document.getElementById('id_vendedor'),document.getElementById('id_vend'));*/


    if(document.getElementById('tipo_contrato').selectedIndex==0)
        alert("Error: Favor seleccione el tipo de contrato.");
    else if(document.getElementById('id_inmueble').selectedIndex==0)
        alert("Error: Favor seleccione el numero de matricula del inmueble asociado");
    else if(document.getElementById('id_cliente').selectedIndex==0)
        alert("Error: Favor seleccione la identificacion del cliente asociado.");
    else if(document.getElementById('fechaini_contrato').value.length!=10)
        alert("Error: Favor indique la fecha de inicio del contrato.");
    else if(document.getElementById('val_cont').value.length==0)
        alert("Error: Favor indique el valor correspondiente del contrato.");
    else
    {
        if(document.getElementById('tipo_cont').value==2)
        {
            if(document.getElementById('fechafin_contrato').value.length!=10)
                alert("Error: Favor indique la fecha de fin del contrato.");
            else if(!validarFechaHoyAntes("fechaini_contrato") || !validarFechaHoyAntes("fechafin_contrato") )
                alert("Error: Las fechas no pueden ser anteriores al dia de hoy.");
            else if(!validarFechaComparada("fechaini_contrato", "fechafin_contrato"))
                alert("Error: Favor Verifique el rango entre las fechas.");
            else if(!validarTiempoContrato("fechaini_contrato", "fechafin_contrato"))
                alert("Error: Los Contratos rangos de arrendamiento son:\n- Minimo seis(6) meses\n-Máximo un(1) año");
            else
                document.crear_contrato.submit();
        }
        else if(document.getElementById('tipo_cont').value==1)
        {
            if(!validarFechaHoyAntes("fechaini_contrato"))
                alert("Error: Las fechas no pueden ser anteriores al dia de hoy.");
            else
            {
                document.getElementById('fechafin_contrato').value = document.getElementById('fechaini_contrato').value;
                document.crear_contrato.submit();
            }
        }
    }
}

function validar_cesion_contrato()
{
    /*document.getElementById('tipo_contrato').selectedIndex=2;
    document.getElementById('id_inmueble').selectedIndex=1;
    document.getElementById('id_cliente').selectedIndex=1;
    document.getElementById('id_vendedor').selectedIndex=2;

    document.getElementById('fechaini_contrato').value="2011-12-09";
    document.getElementById('fechafin_contrato').value="2012-05-09";
    document.getElementById('val_cont').value="8500";
    document.getElementById('tipo_cont').value="2";
    copiarValorCampo(document.getElementById('id_cliente'),document.getElementById('id_cli'));
    copiarValorCampo(document.getElementById('id_inmueble'),document.getElementById('id_inm'));
    copiarValorCampo( document.getElementById('id_vendedor'),document.getElementById('id_vend'));*/



    if(document.getElementById('id_inmueble').selectedIndex==0)
        alert("Error: Favor seleccione el numero de matricula del inmueble asociado");
    else if(document.getElementById('id_cliente').selectedIndex==0)
        alert("Error: Favor seleccione la identificacion del cliente asociado.");
    else
        document.crear_cesion_contrato.submit();
}


function validar_devolver_inmueble()
{
    /*document.getElementById('tipo_contrato').selectedIndex=2;
    document.getElementById('id_inmueble').selectedIndex=1;
    document.getElementById('id_cliente').selectedIndex=1;
    document.getElementById('id_vendedor').selectedIndex=2;

    document.getElementById('fechaini_contrato').value="2011-12-09";
    document.getElementById('fechafin_contrato').value="2012-05-09";
    document.getElementById('val_cont').value="8500";
    document.getElementById('tipo_cont').value="2";
    copiarValorCampo(document.getElementById('id_cliente'),document.getElementById('id_cli'));
    copiarValorCampo(document.getElementById('id_inmueble'),document.getElementById('id_inm'));
    copiarValorCampo( document.getElementById('id_vendedor'),document.getElementById('id_vend'));*/



    if(document.getElementById('id_inmueble').selectedIndex==0)
        alert("Error: Favor seleccione el numero de matricula del inmueble asociado");
    else if(document.getElementById('num_con').value.length==0)
        alert("Error: El contrato correspondiente es invalido");
    else if(document.getElementById('inm_mat').value.length==0)
        alert("Error: La Matricula del inmueble es invalida");
    else
        document.devolver_inmueble.submit();
}

function soloNumerosArea(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
       charCode==14 || charCode==15 || charCode==46);
}

function soloNums(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
       charCode==14 || charCode==15);
}

function soloLetrasNum(evt)
{

   var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 65 && charCode <= 90) ||
            (charCode >= 97 && charCode <= 122) ||
            (charCode>=8 && charCode<=11) ||
            charCode==46 || charCode==14 || charCode==15 || charCode==32 ||(charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
            charCode==14 || charCode==15);
}


function validarNumero(num)
{
    if (isNaN(num))
        return false;
    else if(!decimalValido(num))
        return false;
    return true;
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
        alert('Error: Número Invalido')
        obj.value = "";
    }
}

function cambiarTextoArrendamiento(obj)
{
    copiarValorCampo(obj,document.getElementById('tipo_cont'));
    if(obj.value==1)
    {
        cambiarTextoObjeto('txt_arr',"Valor Venta Inmueble:");
    }
    else if(obj.value==2)
    {
        cambiarTextoObjeto('txt_arr',"Valor Renta Mensual:");
    }
}


function validarFechaHoyAntes(obj)
{
    var today= new Date();
    var eventDate = new Date();
    var dateArray = new Array();
    var textDate = document.getElementById(obj).value;
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    if(eventDate<today)
        return false;
    else
        return true;

}

function validarFechaComparada(obj1, obj2)
{
    var today= new Date();
    var eventDate1 = new Date();
    var eventDate2 = new Date();
    var dateArray = new Array();
    textDate = document.getElementById(obj1).value;
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate1.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    textDate = document.getElementById(obj2).value;
    dateArray = new Array();
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1] -1;
    eventDate2.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    if(today<=eventDate1 && eventDate1<eventDate2)
        return true;
    else
        return false;

}


function validarTiempoContrato(obj1, obj2)
{
    var eventDate1 = new Date();
    var eventDate2 = new Date();
    var dateArray = new Array();
    textDate = document.getElementById(obj1).value;
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1]-1;
    eventDate1.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    textDate = document.getElementById(obj2).value;
    dateArray = new Array();
    dateArray = textDate.split("-");
    dateArray[1] = dateArray[1]-1;
    eventDate2.setFullYear(dateArray[0], dateArray[1],dateArray[2]);
    if(eventDate2.getYear()==eventDate1.getYear())
    {
           
        if((eventDate2.getMonth()-eventDate1.getMonth())>5)
        {
            return true;
        }
        else
            return false;
    }
    else
    {
           
       if((eventDate2.getYear()-eventDate1.getYear())==1)
       {
           var mp2=0,mp1=0,mTot=0;
           mp2 = eventDate2.getMonth();
           mp1 = 11 - eventDate1.getMonth();
           mTot = mp2+mp1;           
           if(mTot>=5 && mTot<=11)
               return true;
           else
               return false;
       }
       else
           return false;
    }
}