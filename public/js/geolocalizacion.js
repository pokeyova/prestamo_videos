$(document).ready(function () {
    cargaMapa();
    $('#location').change(function(){
        cargaMapa();
    });
    $('#location').keyup(function(){
        cargaMapa();
    });
});

function cargaMapa()
{
    if($('#location').val().trim() !='')
    {
        $('#contenedor-map').html($('#location').val());
    }
    else{
        $('#contenedor-map').html(`<img src="${$('#urlImg').val()}" alt="Imagen">`);
    }
}