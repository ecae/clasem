<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando Proveedor: @{{ rsocial }} </h4>

            </div>
            <form id="form_registrar" class="form-horizontal"  data-parsley-validate novalidate autocomplete="off">
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="ruc" class="col-sm-4 control-label">RUC*</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" :style="{borderColor:errorRucBorder}" id="ruc" name="ruc" v-model="ruc" @keyup="ValidarRuc($event)" >
                            <label id="ruc-error" class="error" for="ruc-error" :style="{display:errorRuc}">RUC no V&aacutelido!</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-4 control-label">Raz&oacuten Social*</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="rsocial"  v-model="rsocial" name="rsocial"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion" class="col-sm-4 control-label">Direcci&oacuten*</label>
                        <div class="col-sm-7">
                            <input type="text"  required class="form-control" id="direccion" name="direccion" v-model="direccion" >
                        </div>
                    </div>

                    <h4 class="modal-title" id="myModalLabel">Datos del Contacto:   @{{ ncompletos }} </h4>
                    <hr>
                    <div class="form-group">
                        <label for="apellidoPat" class="col-sm-4 control-label">Nombres Completos*</label>
                        <div class="col-sm-7">
                            <input type="text"  required class="form-control" id="ncompletos" name="ncompletos" v-model="ncompletos" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="celular" class="col-sm-4 control-label">Tel&eacutefono o Celular*</label>
                        <div class="col-sm-7">
                            <input type="text" required  v-model="celular" class="form-control" id="celular" name="celular"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email*</label>
                        <div class="col-sm-7">
                            <input type="email" required parsley-type="email" v-model="email" class="form-control" id="email" name="email"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-4 control-label">Descripcion*</label>
                        <div class="col-sm-7">
                            <input type="text" required  v-model="descripcion" class="form-control" id="descripcion" name="descripcion"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado:*</label>
                        <div class="col-sm-7">
                            <select name="estado" class="form-control" v-model="estado" id="estado" required>
                                <option value="1">Activo</option>
                                <option value="0">Suspendido</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" v-on:click="cancelarCrear"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activando" id="personal_register"  class="btn btn-primary waves-effect waves-light">
                        Registrar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

