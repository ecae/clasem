<div id="myModal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle del Proveedor</h4>
            </div>


                <div class="modal-body form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <input type="hidden" id="id_ver">

                    <div class="form-group">
                        <label for="ruc5" class="col-sm-4 control-label">RUC:</label>
                        <div class="col-sm-7">
                            <label id="ruc5" name="ruc" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rsocial5" class="col-sm-4 control-label">Raz&oacute;n Social:</label>
                        <div class="col-sm-7">
                            <label id="rsocial5" name="rsocial" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion5" class="col-sm-4 control-label">Direcci&oacute;n:</label>
                        <div class="col-sm-7">
                            <label id="direccion5" name="direccion" class="form-control"></label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="ncontacto5" class="col-sm-4 control-label">Contacto:</label>
                        <div class="col-sm-7">
                            <label id="ncontacto5" name="ncontacto" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email5" class="col-sm-4 control-label">Email:</label>
                        <div class="col-sm-7">
                            <label id="email5" name="email" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="celular5" class="col-sm-4 control-label">Celular:</label>
                        <div class="col-sm-7">
                            <label id="celular5" name="celular" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion5" class="col-sm-4 control-label">Descripci&oacute;n:</label>
                        <div class="col-sm-7">
                            <label id="descripcion5" name="descripcion" class="form-control"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado:</label>
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