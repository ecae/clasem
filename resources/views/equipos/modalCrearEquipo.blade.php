<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando Maquinaria: @{{ fabricante }} </h4>

            </div>
            <form id="form_registrar" class="form-vertical" enctype="multipart/form-data" data-parsley-validate novalidate>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fabricante" class="col-sm-4 control-label">Fabricante*</label>
                                <input type="text"  parsley-type="text" class="form-control" id="fabricante" name="fabricante" v-model="fabricante" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="marca" class="col-sm-4 control-label">Marca*</label>
                                <input type="text"  parsley-type="text" class="form-control" id="marca" name="marca" v-model="marca" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="modelo" class="col-sm-4 control-label">Modelo*</label>
                                <input type="text"  parsley-type="text" class="form-control" id="modelo" name="modelo" v-model="modelo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="col-sm-4 control-label">Descripcion*</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="2" v-model="descripcion" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="serie" class="col-sm-4 control-label">Serie*</label>
                                <input type="text"  parsley-type="text" class="form-control" id="serie" name="serie" v-model="serie" required   >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fechacompra" class="col-sm-12 control-label">Fecha de Compra*</label>
                                <!--<input type="datetime" required parsley-type="text" class="form-control" id="fechacompra" name="fechacompra"  placeholder="Fecha de compra">-->
                                <input type="date" class="form-control" name="fechacompra" placeholder="dd/mm/yyyy" v-model="fechacompra"  id="fechacompra" required>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="path" class="col-sm-4 control-label">Foto*</label>
                                <input class="form-control" name="path" id="foto" type="file" @change="changePath($event)"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipousuario" class="col-sm-4 control-label">Estado:*</label>
                                <select name="estado" class="form-control"  v-model="estado"   id="estado" required >
                                <option value="1">Activo</option>
                                <option value="0">Suspendido</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" v-on:click="cancelarCrear" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit"  v-show="activando" id="equipo_register"  class="btn btn-primary waves-effect waves-light">
                        Registrar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>
