var fila_seleccionada = null;
var datos = null;
$(document).ready(function () {
    valida();
    enumerar($('#lista_videos'));
    
    $('#cliente').change(valida);

    $('#titulo, #actor, #nominacion').keyup(busqueda);
    $('#genero_nom').change(busqueda);

    $('#CancelarAgregar').click(limpiar);

    $('#lista_videos').on('click','.btns-opciones a.agregar',function(e){
        e.preventDefault();
        $('#url_info').val($(this).parents('tr.fila').attr('data-url'));
        $('#data_cod').val($(this).parents('tr.fila').attr('data-cod'));
        fila_seleccionada = $(this).parents('tr.fila');
        $('#stock_disponible').val($(this).parents('tr.fila').children('td').eq(5).text());
        $('#title_pelicula').text($(this).parents('tr.fila').children('td').eq(1).text());
        $('#modal-agregar').modal('show');
    });

    // AGREGAR PELICULA
    $('#btnAgregarPelicula').click(function(){

        if($('#cantidad_peliculas').val() != '')
        {
            $('#error-cantidad').addClass('oculto');
            if(parseInt($('#cantidad_peliculas').val()) <= parseInt($('#stock_disponible').val()))
            {
                $('#error-stock').addClass('oculto');
                $.ajax({
                    type: "GET",
                    url: $('#url_info').val(),
                    data: "",
                    dataType: "JSON",
                    success: function (response) {
                        // AGREGAR UNA FILA DE PELICULA CON LOS DATOS
                        let fila = `<tr data-cod="${$('#data_cod').val()}" data-title="${response.title}" data-cost0="${response.costo_unitario}" data-cost1="${response.costo1}" data-cost2="${response.costo2}" data-cost3="${response.costo3}" data-cost4="${response.costo4}" data-cost5="${response.costo5}" class="fila">
                                        <td>#</td>
                                        <td>${response.title}</td>
                                        <td class="centreado">${response.costo_unitario}</td>
                                        <td class="centreado">${$('#cantidad_peliculas').val()}</td>
                                        <td class="centreado">${(parseFloat(response.costo_unitario) * parseFloat($('#cantidad_peliculas').val())).toFixed(2)}</td>
                                        <td class="centreado quitar"><span title="Quitar" class="eliminar"><i class="fa fa-times"></i></span></td>
                                    </tr>`;
                        $('#lista_prestamos').children('tr.total').before(fila);
                        // si agrega actualizar el stock
                        fila_seleccionada.children('td').eq(5).text(parseInt($('#stock_disponible').val()) - parseInt($('#cantidad_peliculas').val()));
                        defineCosto($('#rango_dias').val());
                        enumerar($('#lista_prestamos'),'prestamos');
                        sumaTotal();
                        verificaDescuento();
                        $('#modal-agregar').modal('hide');
                        limpiar();
                        valida();
                    }
                });
            }
            else{
                $('#error-stock').removeClass('oculto');
            }
        }
        else{
            $('#error-cantidad').removeClass('oculto');
        }
    });

    // QUITAR VIDEO DE LA LISTA
    $('#lista_prestamos').on('click','tr.fila td.quitar span',function(){
        let data_cod = $(this).parents('tr').attr('data-cod');
        let cantidad = $(this).parents('tr').children('td').eq(3).text();
        // actualizar la cantidad de la lista de videos
        let fila_video = $('#lista_videos tr[data-cod="'+data_cod+'"]:first-child');
        let cantidad_actual = fila_video.children('td').eq(5).text();
        fila_video.children('td').eq(5).text(parseInt(cantidad_actual) + parseInt(cantidad));
        // eliminar la fila
        $(this).parents('tr').remove();
        enumerar($('#lista_prestamos'),'prestamos');
        sumaTotal();
        verificaDescuento();
        valida();
    });

    $('#fecha_devolucion').change(validaFecha);

    $('#registrarPrestamo').click(registraPrestamo);

});

function registraPrestamo()
{
    datos = {
        cod_client:'',
        borrow_date:'',
        return_date:'',
        codigos:[],
        precios:[],
        cantidades:[],
        totales:[],
        cod_discount:'',
        cantidad_total:'',
        total:'',
        total_final:''
    };

    // ARMAR CODIGOS,PRECIOS,CANTIDADES Y TOTALES
    let filas = $('#lista_prestamos').children('tr.fila');
    let array_codigos = [];
    let array_precios = [];
    let array_cantidades = [];
    let array_totales = [];
    filas.each(function(){
        let codigo = $(this).attr('data-cod');
        let precio = $(this).children('td').eq(2).text();
        let cantidad = $(this).children('td').eq(3).text();
        let total = $(this).children('td').eq(4).text();
        array_codigos.push(codigo);
        array_precios.push(precio);
        array_cantidades.push(cantidad);
        array_totales.push(total);
    });

    // OBTENER LOS DATOS DESCUENTO, TOTAL FINAL Y FECHAS ARMANDO EL OBJETO DATOS
    
    let fila_total = $('#lista_prestamos').children('tr.total');
    let td_cantidad = fila_total.children('td').eq(1);
    let td_total = fila_total.children('td').eq(2);

    datos.cod_client = $('#cliente').val();
    datos.borrow_date = $('#fecha_prestamo').val();
    datos.return_date = $('#fecha_devolucion').val();
    datos.codigos = array_codigos;
    datos.precios = array_precios;
    datos.cantidades = array_cantidades;
    datos.totales = array_totales;
    datos.cod_discount = $('#cod_discount').val();
    datos.cantidad_total = td_cantidad.text();
    datos.total = td_total.text();
    datos.total_final = $('#total_final').val();

    console.log(datos);
    $.ajax({
        type: "POST",
        url: $('#url_registra_prestamo').val(),
        data: datos,
        dataType: "json",
        success: function (response) {
            if(response.msj)
            {
                window.location = "/sisvideo/borrowing/show/"+response.cod_prestamo;
            }
        }
    });
}

function valida()
{
    $('#registrarPrestamo').prop('disabled',true);
    let filas_prestamo = $('#lista_prestamos').children('tr.fila');
    if($('#cliente').val() != '' && $('#cliente').val() != null && filas_prestamo.length > 0)
    {
        $('#registrarPrestamo').prop('disabled',false);
    }
}

function validaFecha()
{
    $.ajax({
        type: "GET",
        url: $('#url_valida_fecha').val(),
        data: {f1:$('#fecha_prestamo').val(),
                f2:$('#fecha_devolucion').val()},
        dataType: "json",
        success: function (response) {
            if(response.msj == 'mayor')
            {
                $('#error-fechas').text('El rango de fechas no es valido. El día de devolución no puede superar mas de 5 días al día de préstamo');
                $('#error-fechas').removeClass('oculto');
                // $('#fecha_prestamo').val(response.f1);
                // $('#fecha_devolucion').val(response.f2);
                $('#registrarPrestamo').prop('disabled',true);
                $('#rango_dias').val('');
            }
            else if(response.msj == 'menor'){
                $('#error-fechas').text('El rango de fechas no es valido. El día de devolución no puede ser igual o menor al día de préstamo');
                $('#error-fechas').removeClass('oculto');
                // $('#fecha_prestamo').val(response.f1);
                // $('#fecha_devolucion').val(response.f2);
                $('#registrarPrestamo').prop('disabled',true);
                $('#rango_dias').val('');
            }
            else{
                // SI ES CORRECTO
                // OBTENER LA CANTIDAD DE DÍAS Y REDEFINIR LOS COSTOS
                $('#rango_dias').val(response.intervalo);
                defineCosto(response.intervalo);
                // RECALCULAR LOS TOTALES
                sumaTotal();
                verificaDescuento();
                $('#registrarPrestamo').prop('disabled',false);
                $('#error-fechas').addClass('oculto');
            }
        }
    });
}

function verificaDescuento()
{
    // VERIFICAR SI TIENE UN DESCUENTO POR LA CANTIDAD DE VIDEOS
    let fila_total = $('#lista_prestamos').children('tr.total');
    let cantidad = fila_total.children('td').eq(1).text();
    $.ajax({
        type: "GET",
        url: $('#url_verifica_descuento').val(),
        data: {cantidad: cantidad},
        dataType: "json",
        success: function (response) {
            $('#descuento').val(response.descuento);
            $('#cod_discount').val(response.cod_discount);
            sumaTotal();
        }
    });
}

function defineCosto(dias)
{
    filas = $('#lista_prestamos').children('tr.fila');
    filas.each(function(){
        let td_precio = $(this).children('td').eq(2);
        let td_cantidad = $(this).children('td').eq(3);
        let td_total = $(this).children('td').eq(4);
        let precio = $(this).attr('data-cost'+dias);
        td_precio.text(precio);
        td_total.text((parseFloat(precio) * parseInt(td_cantidad.text())).toFixed(2));
    });
}

function sumaTotal()
{
    filas = $('#lista_prestamos').children('tr.fila');
    let total_cantidad = 0;
    let total_costo = 0;
    filas.each(function(){
        let cantidad = $(this).children('td').eq(3).text();
        let total = $(this).children('td').eq(4).text();
        total_cantidad += parseInt(cantidad);
        total_costo += parseFloat(total);
    });
    let fila_total = $('#lista_prestamos').children('tr.total');
    fila_total.children('td').eq(1).text(total_cantidad);
    fila_total.children('td').eq(2).text(total_costo.toFixed(2));
    let total = parseFloat(fila_total.children('td').eq(2).text());
    let total_final = 0;
    let descuento = parseFloat($('#descuento').val());
    total_final = total - (total * (descuento/100));
    $('#total_final').val(total_final.toFixed(2));
    valida();
}

function busqueda()
{
    let titulo = $('#titulo').val().toLowerCase().trim();
    let actor = $('#actor').val().toLowerCase().trim();
    let nominacion = $('#nominacion').val().toLowerCase().trim();
    let genero_selec = $('#genero_nom').val().toLowerCase();
    let contenedor = $('#lista_videos');
    let filas = contenedor.children('tr.fila');
    var sw = false;
    filas.each(function(){
        let alternativos = $(this).children('td').eq(1).text().toLowerCase() + ' ' +$(this).children('td').eq(2).text().toLowerCase();
        let actores = $(this).children('td').eq(3).text().toLowerCase();
        let nominaciones = $(this).children('td').eq(4).text().toLowerCase();
        let genero = $(this).children('td').eq(5).text().toLowerCase();

        if(titulo == '' && actor == '' && nominacion == '' && genero_selec == '')
        {
            sw = true;
        }
        else{
            if(titulo != '')
            {
                if(alternativos.indexOf(titulo) > -1)
                {
                    sw = true;
                }
            }
            
            if(actor !='')
            {
                if(actores.indexOf(actor) > -1)
                {
                    sw = true;
                }
            }
    
            if(nominacion != '')
            {
                if(nominaciones.indexOf(nominacion) > -1)
                {
                    sw = true;
                }
            }
    
            if(genero_selec != '')
            {
                if(genero.indexOf(genero_selec) > -1)
                {
                    sw = true;
                }
            }
        }

        if(!sw)
        {
            $(this).addClass('oculto');
        }
        else{
            $(this).removeClass('oculto');
        }
        sw=false;
    });
    enumerar($('#lista_videos'),'videos');
}

function limpiar()
{
    fila_seleccionada = null;
    $('#url_info').val('');
    $('#data_cod').val('');
    $('#stock_disponible').val('');
    $('#title_pelicula').text('');
    $('#cantidad_peliculas').val('1');
    $('#error-cantidad').addClass('oculto');
    $('#error-stock').addClass('oculto');
}

function enumerar(contenedor,sw)
{
    let filas = contenedor.children('tr.fila');
    let sin_registros = contenedor.children('tr.sin_registros');
    contador = 0;
    filas.each(function(){
        if(!$(this).hasClass('oculto'))
        {
            contador++;
            let tdNum = $(this).children('td').eq(0);
            tdNum.text(contador);
        }
    });
    if(contador > 0)
    {
        sin_registros.addClass('oculto');
        
        if(sw=='prestamos')
        {
            $('#registrarPrestamo').prop('disabled',false);
        }
    }
    else{
        sin_registros.removeClass('oculto');
    }
    
}