<div class="modal modal-danger fade" id="modal-estado">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambiar estado</h4>
            </div>
            <div class="modal-body">
                <form action="" id="formEstadoPrestamo" method="POST">
                    <label>Estado*:</label>
                    <select name="estado" id="select_estado" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="EN CURSO">EN CURSO</option>
                        <option value="DEVUELTO">DEVUELTO</option>
                        <option value="PERDIDO">PERDIDO</option>
                    </select>
                    <div class="oculto error error-valor">Debes seleccionar un estado</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="btnCancelarREgistroEstado">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnREgistraEstado">Agregar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>