<div id="myModal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle de Maquinaria</h4>
            </div>


                <div class="modal-body form-vertical">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id">
                <div class="row">
                    <div class="col-sm-8 ">
                        <div class="form-group">
                            <img id="img" class=" form-control img-rounded" style="height: 400px">
                        </div>
                    </div>
                    <div class="clearfix visible-xs"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Fabricante:</label>
                            <br>
                            <label id="fabricante1" name="fabricante" class="form-control"></label>
                            <br>
                            <label for="marca" class="col-sm-4 control-label">Marca:</label>
                            <br>
                            <label id="marca1" name="marca" class="form-control"></label>
                            <br>
                            <label for="modelo" class="col-sm-4 control-label">Modelo:</label>
                            <br>
                            <label id="modelo1" name="modelo" class="form-control"></label>
                            <br>
                            <label for="serie" class="col-sm-4 control-label">Serie:</label>
                            <br>
                            <label id="serie1" name="serie" class="form-control"></label>
                            <br>
                            <label for="fechacompra" class="col-sm-12 control-label">Fecha de Compra:</label>
                            <br>
                            <!--<input type="datetime" required parsley-type="text" class="form-control" id="fechacompra" name="fechacompra"  placeholder="Fecha de compra">-->
                            <label id="fechacompra1" name="fechacompra" class="form-control"></label>
                        </div>
                    </div>
                </div>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->