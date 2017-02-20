<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Maquinaria</h4>
            </div>

          <form id="form_actualizar"   class="form-vertical" enctype="multipart/form-data" data-parsley-validate novalidate>
            <div class="modal-body">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_actualizar">
                <input type="hidden" id="id_o_fabricante">
                <input type="hidden" id="id_o_marca">
                <input type="hidden" id="id_o_modelo">
                <input type="hidden" id="id_o_serie">
                <input type="hidden" id="id_o_descripcion">
                <input type="hidden" id="id_o_fecha">
                <input type="hidden" id="id_o_foto">
                <input type="hidden" id="id_o_estado">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fabricante" class="col-sm-4 control-label">Fabricante*</label>
                            <input type="text"  parsley-type="text" class="form-control" id="fabricante2" name="fabricante"  @keyup="changeFabricante($event)" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="marca" class="col-sm-4 control-label">Marca*</label>
                            <input type="text"  parsley-type="text" class="form-control" id="marca2" name="marca"  @keyup="changeMarca($event)"  required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="modelo" class="col-sm-4 control-label">Modelo*</label>
                            <input type="text"  parsley-type="text" class="form-control" id="modelo2" name="modelo"  @keyup="changeModelo($event)" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-4 control-label">Descripcion*</label>
                            <textarea class="form-control" id="descripcion2" name="descripcion" rows="2"  @keyup="changeDescripcion($event)"  required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="serie" class="col-sm-4 control-label">Serie*</label>
                            <input type="text"  parsley-type="text" class="form-control" id="serie2" name="serie"  @keyup="changeSerie($event)" required   >
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fechacompra" class="col-sm-12 control-label">Fecha de Compra*</label>
                            <!--<input type="datetime" required parsley-type="text" class="form-control" id="fechacompra" name="fechacompra"  placeholder="Fecha de compra">-->
                            <input type="date" class="form-control" name="fechacompra"  placeholder="dd/mm/yyyy"  @change="changeFecha($event)" id="fechacompra2" required>
                            <input type="hidden" id="val_fecha"   >
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="path" class="col-sm-4 control-label">Foto*</label>

                            <input class="form-control" name="path"  @change="changePath($event)" id="foto2" type="file"  >

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipousuario" class="col-sm-4 control-label">Estado:*</label>
                            <select name="estado" class="form-control" @change="changeEstado($event)"   id="estado2" required >

                                <option value="1">Activo</option>
                                <option value="0">Suspendido</option>
                            </select>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" v-on:click="cancelarActualizar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                <button type="submit" v-show="activando2" id="equipo_actualizar"  class="btn btn-primary waves-effect waves-light">
                    Actualizar
                </button>
            </div>
          </form>
        </div>
    </div>
</div>