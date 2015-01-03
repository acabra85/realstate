// JavaScript Document
function validar_tipo_inmueble()
{
    if(document.crear_tipo_inmueble.nom_inmueble.value.length==0)
         alert('Error: Favor complete el tipo de inmueble');
    else if(document.crear_tipo_inmueble.desc_inmueble.value.length==0)
         alert('Error: Favor complete la descripcion del tipo de inmueble');
    else
            document.crear_tipo_inmueble.send_form.click();
}

function validar_inmueble()
{
    if(document.crear_inmueble.nom_pais.selectedIndex==0 ||
            document.getElementById('nom_depto').selectedIndex==0 ||
                document.getElementById('nom_ciudad').selectedIndex==0)
                alert('Error: Favor genere el filtro adecuado para ubicar la ciudad');
   else if(document.crear_inmueble.tipo_inmueble.selectedIndex==0)
         alert('Error: Favor seleccione el tipo de inmueble');
   else if(document.crear_inmueble.matricula_inm.value.length==0)
         alert('Error: Favor complete el numero de matricula del inmueble');
   else if(!validarRadio(document.crear_inmueble.est_inmueble))
         alert('Error: Favor seleccione el estrato del inmueble');
   else if(document.getElementById('div_res_dir').innerHTML.length==0)
         alert('Error: Favor Seleccione el link *Dirección* y luego de completar pulse OK');
   else if(document.crear_inmueble.area_inm.value.length==0 || document.crear_inmueble.area_inm.value.length>6)
         alert('Error: Favor el area del inmueble en metros cuadrados');
   else if(document.crear_inmueble.cantba_inm.value.length==0)
         alert('Error: Favor indique la cantidad de baños del inmueble');
   else if(document.crear_inmueble.cantpi_inm.value.length==0)
         alert('Error: Favor indique la cantidad de pisos que tiene el inmueble');
   else if(document.crear_inmueble.cantparq_inm.value.length==0)
         alert('Error: Favor indique la cantidad de parqueaderos que tiene el inmueble');
   else if(document.crear_inmueble.valimp_inm.value.length==0)
         alert('Error: Favor indique el valor de impuestos anuales del inmueble');
   else if(document.crear_inmueble.valadm_inm.value.length==0)
         alert('Error: Favor indique el valor de la administracion');
   else if(document.crear_inmueble.desc_inm.value.length==0)
         alert('Error: Favor indique la descripcion adicional del inmueble');
   else
       document.crear_inmueble.send_form.click();
}

function validar_inmuebleM()
{

if(document.getElementById('valimp_inm').value.length==0)
         alert('Error: Favor indique el valor de impuestos anuales del inmueble');
   else if(document.getElementById('valadm_inm').value.length==0)
         alert('Error: Favor indique el valor de la administracion');
   else if(document.getElementById('desc_inm').value.length==0)
         alert('Error: Favor indique la descripcion adicional del inmueble');
   else
       document.modif_inmueble.send_form.click();
}

function soloNumerosArea(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) || 
       charCode==14 || charCode==15 || charCode==46);
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