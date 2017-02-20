<div id="myModal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
            </div>


                <div class="modal-body form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <input type="hidden" id="id_ver">

                    <div class="form-group">
                        <label for="tipousuario" class="col-sm-4 control-label">Tipo Usuario:*</label>
                        <div class="col-sm-7">
                            <label id="tipousuario_id5" name="tipousuario_id" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Nombre de Usuario*</label>
                        <div class="col-sm-7">
                            <label id="username5" name="username" class="form-control"></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado:*</label>
                        <div class="col-sm-7">
                            <label id="estado5" name="estado" class="form-control"></label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->