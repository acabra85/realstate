
// JavaScript Document
function validar_solicitud()
{
    //nombre cliente
    if(!validarFechaPosterior("Inicio")){}
    else
    {
        copiarValorCombo(document.crear_solicitud_ini.cedulas_cliente,
                         document.crear_solicitud_ini.id_clie);
        document.crear_solicitud.submit();            
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
function validarFechaPosterior(s, objIni, objFin)
{
		var f = document.forms[0];
		var today;
		var eventDate;
		var dateArray;
		var textDate;
	if(s == "Inicio")
	{
		today = new Date();
		eventDate = new Date();
		dateArray = new Array();
		textDate = f.objIni.value;
		dateArray = textDate.split("/");
		dateArray[1] = dateArray[1] -1;
		eventDate.setFullYear(dateArray[2], dateArray[1],dateArray[0]);
		if(eventDate>today)
		{
			return false
		}
		else
		{
			return true;
		}
	}
	else
	{
		today = new Date();
		eventDate = new Date();
		dateArray = new Array();
		textDate = f.objFin.value;
		dateArray = textDate.split("/");
		dateArray[1] = dateArray[1] -1;
		eventDate.setFullYear(dateArray[2], dateArray[1],dateArray[0]);
		if(eventDate>today)
		{
			return false
		}
		else
		{
			return true;
		}
	}
}

function validarFechaPrevia(objIni, objFin)
{
	try
	{
	var fr = document.forms[0];
	var dateIni = new Date();
	var dateFin = new Date();
	var arrIni = new Array();
	var arrFin = new Array();
	var strIni = 	objIni.value;
	var strFin = objFin.value;
	
	arrIni = strIni.split("/");
	arrIni[1] = arrIni[1] - 1;
	arrFin = strFin.split("/");
	arrFin[1] = arrFin[1] - 1;
	dateIni.setFullYear(arrIni[2], arrIni[1], arrIni[0]);
	dateFin.setFullYear(arrFin[2], arrFin[1], arrFin[0]);
	if(dateIni>dateFin)
	{
		return false;
	}
	return true;
	}catch (e)
	{return false;}
}