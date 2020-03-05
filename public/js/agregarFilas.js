var contador = 0;

$(document).ready(function () {

    enumerar($('#contenedorFilasTitulos'));
    enumerar($('#contenedorFilasNominaciones'));
    enumerar($('#contenedorFilasActores'));

    // TITULOS
    $('#btnAgregarTitulo').click(function(){
        let titulo = $('#txtTitulo').val().trim();
        if(titulo != '')
        {
            agregaFila($('#contenedorFilasTitulos'),titulo, $('#txtTitulo'),'alternativos')
        }
    });

    $(document).on('click','#contenedorFilasTitulos tr.fila td.quitar span',function(){
        let fila = $(this).parents('tr');
        quitaFila(fila);
    });

    
    // NOMINACIONES
    $('#btnAgregarNominacion').click(function(){
        let titulo = $('#txtNominacion').val().trim();
        let gano = $('#txtNominacionGano').val().trim();
        if(titulo != '')
        {
            agregaFilaNominacion($('#contenedorFilasNominaciones'),titulo,gano, $('#txtNominacion'),'nominaciones','gano')
        }
    });

    $(document).on('click','#contenedorFilasNominaciones tr.fila td.quitar span',function(){
        let fila = $(this).parents('tr');
        quitaFila(fila);
    });

    
    // ACTORES
    $('#btnAgregarActor').click(function(){
        let titulo = $('#txtActor').val().trim();
        if(titulo != '')
        {
            agregaFila($('#contenedorFilasActores'),titulo, $('#txtActor'),'actores')
        }
    });

    $(document).on('click','#contenedorFilasActores tr.fila td.quitar span',function(){
        let fila = $(this).parents('tr');
        quitaFila(fila);
    });
});
