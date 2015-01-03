// JavaScript Document
function validar_pais()
{
    if(document.crear_pais.nombre_pais.value.length==0)
        alert('Error: Favor complete el nombre del pais');
    else if(document.crear_pais.codigo_pais.value.length==0)
        alert('Error: Favor complete el nombre del pais');
    else
        document.crear_pais.send_form.click();
}

function limpiar_campos()
{
    document.crear_pais.borrar_campos.click();
}

function soloNums(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
       charCode==14 || charCode==15);
}

function validar_depto()
{
    if(document.crear_depto.nom_pais.selectedIndex==0)
            alert('Error: Favor Seleccione el pais al que pertenece el Departamento');
    else if(document.crear_depto.nombre_depto.value.length==0)
        alert('Error: Favor complete el nombre del departamento');
    else if(document.crear_depto.codigo_depto.value.length==0)
        alert('Error: Favor complete el código del departamento');
    else
    {
        document.crear_depto.id_pais.value=document.crear_depto.nom_pais.value;
        document.crear_depto.submit();
    }
}
function validar_ciudad()
{
    if(document.getElementById('nom_pais').selectedIndex==0)
            alert('Error: Favor Seleccione el pais al que pertenece la ciudad');
    else if(document.getElementById('nom_depto').selectedIndex==0)
            alert('Error: Favor Seleccione el departamento al que pertenece la ciudad');
    else if(document.crear_ciudad.nombre_ciudad.value.length==0)
        alert('Error: Favor complete el nombre de la ciudad');
    else if(document.crear_ciudad.codigo_ciudad.value.length==0)
        alert('Error: Favor complete el código de la ciudad');
    else
        document.crear_ciudad.submit();
}

function habilitarDepartamento(strtxt)
{
    if( document.getElementById('nom_pais').selectedIndex==0)
    {
        document.getElementById('id_pais').value="-1";
        document.getElementById('id_depto').value="-1";
        document.getElementById('nom_depto').selectedIndex=0;
        document.getElementById('nom_depto').disabled=true;
    }
    else
    {
        document.getElementById('id_pais').value=document.getElementById('nom_pais').value;
        document.getElementById('id_depto').value=document.getElementById('nom_depto').value;
        obtenerDepartamento(strtxt);
        document.getElementById('id_depto').value="-1";
        document.getElementById('nom_depto').disabled=false;        
    }
}

function habilitarDepartamentoSucursal(strtxt)
{
    document.getElementById('id_depto').value="-1";
    document.getElementById('id_ciudad').value="-1";
    document.getElementById('nom_depto').selectedIndex=0;
    document.getElementById('nom_ciudad').selectedIndex=0;
    document.getElementById('nom_depto').disabled=true;
    document.getElementById('nom_ciudad').disabled=true
    if(document.getElementById('nom_pais').selectedIndex==0)
    {
        document.getElementById('id_pais').value="-1";
    }
    else
    {
        document.getElementById('id_pais').value=document.getElementById('nom_pais').value;
        if(document.getElementById('nom_pais').selectedIndex!=0 && document.getElementById('nom_depto').disabled)
            obtenerDepartamentoSucursal(strtxt,0);
        else if(document.getElementById('nom_depto').selectedIndex!=0)
            obtenerDepartamentoSucursal(strtxt,1);
        document.getElementById('id_depto').value="-1";
    }
}

function habilitarCiudadSucursal(strtxt) 
{
    document.getElementById('id_depto').value=document.getElementById('nom_depto').value;
    if(document.getElementById('nom_depto').selectedIndex==0)
    {
        document.getElementById('nom_ciudad').selectedIndex=0;
        document.getElementById('nom_ciudad').disabled=true;
    } 
    else 
    {
        obtenerDepartamentoSucursal(strtxt,1);
    }
}

function validar_sucursal()
{
    if(document.getElementById('nom_pais').selectedIndex==0)
            alert('Error: Favor Seleccione el pais al que pertenece la sucursal');
    else if(document.getElementById('nom_depto').selectedIndex==0)
            alert('Error: Favor Seleccione el departamento al que pertenece la sucursal');
    else if(document.getElementById('nom_ciudad').selectedIndex==0)
            alert('Error: Favor Seleccione la ciudad a la que pertenece la sucursal');
    else if(document.getElementById('nombre_sucursal').value.length==0)
        alert('Error: Favor complete el nombre de la sucursal');
    else if(document.getElementById('codigo_sucursal').value.length==0)
        alert('Error: Favor complete el código de la sucursal');
   else if(document.getElementById('div_res_dir').innerHTML.length==0)
         alert('Error: Favor Seleccione el link *Dirección* y luego de completar pulse OK');
    else
        document.crear_sucursal.submit();
        
}


function getXMLHTTP() 
{ 
    var xmlHttp = false;
   try {
     xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")  // For Old Microsoft Browsers
   }
   catch (e) {
     try {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")  // For Microsoft IE 6.0+
     }
     catch (e2) {
       xmlHttp = false   // No Browser accepts the XMLHTTP Object then false
     }
   }
   if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
     xmlHttp = new XMLHttpRequest();        //For Mozilla, Opera Browsers
   }
   return xmlHttp; 
}

function obtenerDepartamento(strVal)
{
    var date = new Date();
    var req = getXMLHTTP(); 
    if (req)
    {
        req.open("POST", strVal, true);
        req.onreadystatechange = function(){
                                    if (req.readyState == 4) 
                                    { 
                                        if (req.status == 200) 
                                        {                     
                                            document.getElementById('div_depto').innerHTML=req.responseText;
                                        }
                                        else
                                        { 
                                            alert("Error al realizar solicitud HTTP XMLHTTP:\n");
                                        }
                                    }            
                                }         
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        req.send("origin=ciudad&cod_pais=" + document.getElementById('nom_pais').value);
    }
}
function obtenerDepartamentoSucursal(strVal,num)
{
    var req = getXMLHTTP();
    if (req)
    {
        req.open("POST", strVal, true);
        req.onreadystatechange = function(){
                                    if (req.readyState == 4)
                                    {
                                        if (req.status == 200)
                                        {
                                            if(num==0){
                                                document.getElementById('div_depto').innerHTML=req.responseText;}
                                            else if(num==1){
                                                document.getElementById('div_ciudad').innerHTML=req.responseText;}
                                        }
                                        else
                                        {
                                            alert("Error al realizar solicitud HTTP XMLHTTP:\n");
                                        }
                                    }
                                }
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        if(num==0)
            req.send("origin=sucursal&cod_pais=" + document.getElementById('nom_pais').value);
        else if(num==1)
            req.send("origin=sucursal&cod_depto=" + document.getElementById('nom_depto').value+"&cod_pais="+ document.getElementById('nom_pais').value);
    }
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