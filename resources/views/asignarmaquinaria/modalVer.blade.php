<div id="myModal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle Asignacion</h4>
            </div>


                <div class="modal-body form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <input type="hidden" id="id_ver">

                    <div class="form-group">
                        <label for="nombre" class="col-sm-4 control-label">Para:*</label>
                        <div class="col-sm-7">
                            <label id="descripcion5" name="descripcion" class="form-control"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="col-sm-4 control-label">Encargado:*</label>
                        <div class="col-sm-7">
                            <label id="ncompletos5" name="ncompletos" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="equipo" class="col-sm-4 control-label">Equipo:*</label>
                        <div class="col-sm-7">
                            <label id="equipo5" name="equipo" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="marca" class="col-sm-4 control-label">Marca:*</label>
                        <div class="col-sm-7">
                            <label id="marca5" name="marca" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="area" class="col-sm-4 control-label">modelo*</label>
                        <div class="col-sm-7">
                            <label id="modelo5" name="modelo" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado*</label>
                        <div class="col-sm-7">
                            <label id="estado5" name="estado" class="form-control"></label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->