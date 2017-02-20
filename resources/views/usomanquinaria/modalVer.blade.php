<div id="myModal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle del Reporte Diario</h4>
            </div>


                <div class="modal-body form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <input type="hidden" id="id_ver">

                    <div class="form-group">
                        <label for="detalle2" class="col-sm-4 control-label">Detalle:*</label>
                        <div class="col-sm-7">
                            <label id="detalle2" name="detalle" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="col-sm-4 control-label">Fecha*</label>
                        <div class="col-sm-7">
                            <label id="fecha" name="fecha" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hora_Inicial2" class="col-sm-4 control-label">Hora Inicio*</label>
                        <div class="col-sm-7">
                            <label id="hora_Inicial2" name="hora_Inicial" class="form-control"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hora_Final2" class="col-sm-4 control-label">Hora Fin:*</label>
                        <div class="col-sm-7">
                            <label id="hora_Final2" name="hora_Final" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inicial_horometro2" class="col-sm-4 control-label">Horometro Inicial:*</label>
                        <div class="col-sm-7">
                            <label id="inicial_horometro2" name="inicial_horometro" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="final_horometro2" class="col-sm-4 control-label">Horometro Final:*</label>
                        <div class="col-sm-7">
                            <label id="final_horometro2" name="final_horometro" class="form-control"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->