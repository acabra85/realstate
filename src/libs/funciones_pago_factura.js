function soloNums(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
       charCode==14 || charCode==15);
}

function validar_generar_factura()
{
    if(document.getElementById('id_contrato').selectedIndex==0)
            alert('Error: Favor Seleccione el Contrato que desea pagar');
    else if(document.getElementById('tip_contrato').value.length==0 ||
       document.getElementById('total_cuota').value.length==0 ||
       document.getElementById('num_cuota').value.length==0 ||
       document.getElementById('ced_cliente').value.length==0 ||
       document.getElementById('con_num').value.length==0 )
       {
            alert('Error: No se pueden calcular los campos pendientes\nConsulte al administrador');
       }
    else
        document.crear_factura.submit();
}

function validar_pago_factura()
{
    if(document.getElementById('id_contrato').selectedIndex==0)
            alert('Error: Favor Seleccione el Contrato que desea pagar');
    else if(document.getElementById('tip_contrato').value.length==0 ||
       document.getElementById('total_cuota').value.length==0 ||
       document.getElementById('num_cuota').value.length==0 ||
       document.getElementById('ced_cliente').value.length==0 ||
       document.getElementById('con_num').value.length==0 )
       {
            alert('Error: No se pueden calcular los campos pendientes\nConsulte al administrador');
       }
    else
        document.crear_pago.submit();
}

function calcularCamposPago(obj,url)
{
    var tipo="";
    if(document.getElementById('id_tip_cons')[obj.selectedIndex].text=='1')
        tipo="Venta";
    else
        tipo="Arriendo";
    if(obj.selectedIndex==0)
        return;
    OnLockScreen('Calculando Digito');
    document.getElementById('num_matricula').value=document.getElementById('id_matricula')[obj.selectedIndex].text;
    document.getElementById('ced_cliente').value=document.getElementById('id_cedulas')[obj.selectedIndex].text;
    document.getElementById('val_cuota').value=document.getElementById('id_valores')[obj.selectedIndex].text;
    document.getElementById('tip_contrato').value=tipo;
    document.getElementById('con_num').value=obj.value;
    calcularIva(document.getElementById('val_cuota').value, document.getElementById('iva_cuota'),document.getElementById('base_cuota'));
    ajustarDecimales();
    obtenerCuotaPagar(url);
}

function ajustarDecimales()
{
    var iva = document.getElementById('iva_cuota');
    var base = document.getElementById('base_cuota');
    var indexI =0;
    var indexB =0;
    indexI = iva.value.toString().indexOf(".", 0);
    indexB = base.value.toString().indexOf(".", 0);
    base.value = base.value.toString().substring(0, indexB+4);
    iva.value = iva.value.toString().substring(0, indexI+4);
}

function calcularIva(valcuota, iva, base)
{
    var total = 0;
    total = parseInt(valcuota, 10);
    base.value= total/1.16;
    iva.value = (total)*0.1379310345;
}

function obtenerCuotaPagar(strVal)
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
                                            document.getElementById('div_res_query').innerHTML=req.responseText;
                                            document.getElementById('nom_cliente').value=document.getElementById('res_nom_cli').value;
                                            document.getElementById('num_cuota').value=document.getElementById('res_num_cuotas').value;
                                            document.getElementById('total_cuota').value=document.getElementById('val_cuota').value;
                                        }
                                        else
                                        {
                                            alert("Error al realizar solicitud HTTP XMLHTTP:\n");
                                        }
                                    }
                                }
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        req.send("origin=pago&con_num=" + document.getElementById('con_num').value+"&id_cliente="+document.getElementById('ced_cliente').value);
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