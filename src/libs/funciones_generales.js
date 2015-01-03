// JavaScript Document
function volver()
{
    window.history.back();
}
function validarRadio(obj)
{
    for (var i=0; i<obj.length;i++)
    {   
        if(obj[i].checked)
            return true;
    }
    return false;
}

function soloLetrasNombre(evt)
{
   var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 65 && charCode <= 90) || 
            (charCode >= 97 && charCode <= 122) ||
            (charCode>=8 && charCode<=11) || 
            charCode==46 || charCode==14 || charCode==15 || charCode==32);
}

function validarEmail(obj) 
{
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var email = obj.value;
   if(reg.test(email) == false) 
      return false;
   else 
       return true;
}

function copiarValorCombo(objOri, objDest)
{
    objDest.value = objOri.options[objOri.selectedIndex].text;
}
function copiarValorCampo(objOri, objDest)
{
    objDest.value = objOri.value;
}

function cambiarTextoObjeto(idObj, strText)
{
    document.getElementById(idObj).innerHTML=strText;
}

function copiarTextoCombo(obj1, obj2)
{
    obj2.value=obj1[obj1.selectedIndex].text;
        
}

function mostrarVistaOculta()
{
     var obj=document.getElementById('div_vis_oculta');
    if(obj.style.display=='none')
    {
               $(document).ready(function(){
                   $("#div_vis_oculta").show(500);
               });
    }
    else
    {
               $(document).ready(function(){
                   $("#div_vis_oculta").hide(500);
               });
    }
}

function abrirInmueble(txt)
{
    document.getElementById('id_inmueble').value=txt;
    if(document.getElementById('id_inmueble').value.length!=0)
    document.getElementById('send_form').click();
}
function abrirCliente(txt)
{
    document.getElementById('id_cliente').value=txt;
    if(document.getElementById('id_cliente').value.length!=0)
        document.getElementById('send_form').click();
}
function abrirClienteJ(txt)
{
    document.getElementById('id_cliente').value=txt;
    if(document.getElementById('id_cliente').value.length!=0)
        document.getElementById('send_form').click();
}
function abrirVendedor(txt)
{
    document.getElementById('id_vendedor').value=txt;
    if(document.getElementById('id_vendedor').value.length!=0)
    document.getElementById('send_form').click();
}