<div class="modal modal-danger fade" id="modal-bajas">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar bajas</h4>
            </div>
            <div class="modal-body">
                <p><b>Pelicula: </b> <span id="title_pelicula_bajas"></span></p>
                <form action="" method="POST" id="formNuevasBajas">
                    <label>Cantidad*:</label>
                    <input type="number" min="1" value="1" name="cantidad" class="form-control">
                    <label>Razón*:</label>
                    <textarea name="reason" class="form-control" rows="2"></textarea>
                    <div class="oculto error error-cantidad">La cantidad no es un valor valido o esta vacio</div>
                    <div class="oculto error error-razon">Debes indicar una razón</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="btnCancelarBajas">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnRegistrarBajas">Agregar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>