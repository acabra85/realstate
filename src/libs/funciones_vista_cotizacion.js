// JavaScript Document

function soloNumeros(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
       charCode==14 || charCode==15);
}

function calcularTotal()
{
    var cantItems = document.getElementById("total_items").value;
    var totalCotizacion = 0;
    var i = 0;
    for (i = 0; i < cantItems; i++)
    {
        if(document.getElementById("chck_"+i).checked)
            {
                totalCotizacion = parseFloat(totalCotizacion) + (parseFloat(document.getElementById("cost_"+i).value)*parseInt(document.getElementById("cant_"+i).value));
            }
    }
    document.getElementById("total_cotizacion").value = totalCotizacion;
}