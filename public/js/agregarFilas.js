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

function enumerar(contenedor)
{
    let filas = contenedor.children('tr.fila');
    contador = 0;
    filas.each(function(){
        contador++;
        let tdNum = $(this).children('td').eq(0);
        tdNum.text(contador);
    });

    let filaNoRegistros = contenedor.children('tr.odd');
    if(contador > 0)
    {
        filaNoRegistros.addClass('oculto');
    }
    else{
        filaNoRegistros.removeClass('oculto');
    }
}

function agregaFila(contenedor, valor, input, columna)
{
    let fila = `<tr class="fila">
                    <td>
                    #
                    </td>
                    <td>
                    ${valor}
                    <input type="hidden" value="${valor}" name="${columna}[]"/>
                    </td>
                    <td class="quitar">
                    <span class="eliminar" title="Eliminar">
                        <i class="fa fa-times"></i>
                    </span>
                    </td>
                </tr>`;

    contenedor.append(fila);
    input.val('');
    input.focus();
    enumerar(contenedor);
}

function agregaFilaNominacion(contenedor, valor1, valor2, input, columna1,columna2)
{
    let fila = `<tr class="fila">
                    <td>
                    #
                    </td>
                    <td>
                    ${valor1}
                    <input type="hidden" value="${valor1}" name="${columna1}[]"/>
                    </td>
                    <td>
                    ${valor2}
                    <input type="hidden" value="${valor2}" name="${columna2}[]"/>
                    </td>
                    <td class="quitar">
                    <span class="eliminar" title="Eliminar">
                        <i class="fa fa-times"></i>
                    </span>
                    </td>
                </tr>`;

    contenedor.append(fila);
    input.val('');
    input.focus();
    enumerar(contenedor);
}
function quitaFila(fila){
fila.remove();
enumerar();

}
