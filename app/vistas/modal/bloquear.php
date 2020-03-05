<div class="modal modal-danger fade" id="modal-bloquear">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bloquear cliente</h4>
            </div>
            <div class="modal-body">
                <p id="mensajeBloquear"></p>
                <form action="" method="post" id="formBloquear">
                    <label>Razón del bloqueo*:</label>
                    <textarea name="reason" id="reason" class="form-control"></textarea>
                    <div class="oculto error" id="error-bloqueo">Debes indicar una razón</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnBloquear">Sí, bloquear</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>