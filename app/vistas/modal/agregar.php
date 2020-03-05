<div class="modal modal-danger fade" id="modal-agregar">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar pelicula</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="codigo_video" readonly>
                <label>Cantidad*:</label>
                <input type="number" min="1" value="1" name="cantidad_peliculas" id="cantidad_peliculas" class="form-control">
                <div class="oculto error" id="error-cantidad">Debes indicar la cantidad</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnAgregarPelicula">Agregar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>