<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Proveedor</h4>
            </div>

          <form id="form_actualizar"   class="form-horizontal"  data-parsley-validate novalidate>
            <div class="modal-body form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_actualizar">
                <input type="hidden" id="id_o_ruc">
                <input type="hidden" id="id_o_rsocial">
                <input type="hidden" id="id_o_direccion">
                <input type="hidden" id="id_o_ncontacto">
                <input type="hidden" id="id_o_email">
                <input type="hidden" id="id_o_celular">
                <input type="hidden" id="id_o_descripcion">
                <input type="hidden" id="id_o_estado">

                <div class="form-group">
                    <label for="ruc2" class="col-sm-4 control-label">Ruc*</label>
                    <div class="col-sm-7">
                        <input type="text" required class="form-control" id="ruc2" @keyup="changeRuc($event)" :style="{borderColor:errorRucBorder}" name="ruc"  >
                        <label id="ruc-error" class="error" for="ruc-error" :style="{display:errorRuc}">RUC no V&aacutelido!</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rsocial2" class="col-sm-4 control-label">Raz&oacute;n Social*</label>
                    <div class="col-sm-7">
                        <input type="text" required class="form-control" id="rsocial2" name="rsocial" @keyup="changeRsocial($event)" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="direccion2" class="col-sm-4 control-label">Direcci&oacute;n*</label>
                    <div class="col-sm-7">
                        <input type="text"  required class="form-control" id="direccion2" name="direccion" @keyup="changeDireccion($event)"  >
                    </div>
                </div>
                <div class="form-group">
                    <label for="ncompletos2" class="col-sm-4 control-label">Contacto:*</label>
                    <div class="col-sm-7">
                        <input type="text"  required class="form-control" id="ncontacto2" name="ncompletos" @keyup="changeNcontacto($event)"  >
                    </div>

                </div>
                <div class="form-group">
                    <label for="celular2" class="col-sm-4 control-label">Tel&eacutefono o Celular*</label>
                    <div class="col-sm-7">
                        <input type="text" required  class="form-control" id="celular2" name="celular" @keyup="changeCelular($event)" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="email2" class="col-sm-4 control-label">Email*</label>
                    <div class="col-sm-7">
                        <input type="email" required parsley-type="email" @keyup="changeEmail($event)"  class="form-control" id="email2" name="email"  >
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion2" class="col-sm-4 control-label">Descripcion*</label>
                    <div class="col-sm-7">
                        <input type="text" required class="form-control" id="descripcion2" name="descripcion" @keyup="changeDescripcion($event)" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="estado" class="col-sm-4 control-label">Estado:*</label>
                    <div class="col-sm-7">
                        <select name="estado" class="form-control" @change="changeEstado($event)" id="estado2" required>
                            <option value="1">Activo</option>
                            <option value="0">Suspendido</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" v-on:click="cancelarActualizar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                <button type="submit" v-if="activando2" id="proveedor_actualizar"  class="btn btn-primary waves-effect waves-light">
                    Actualizar
                </button>
            </div>
          </form>
        </div>
    </div>
</div>