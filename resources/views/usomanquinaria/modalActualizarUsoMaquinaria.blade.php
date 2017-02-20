<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
            </div>

          <form id="form_actualizar"   class="form-horizontal"  data-parsley-validate novalidate>
            <div class="modal-body form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_actualizar">
                <input type="hidden" id="id_o_tipousuario">
                <input type="hidden" id="id_o_username">
                <input type="hidden" id="id_o_estado">

                <div class="form-group">
                    <label for="tipousuario" class="col-sm-4 control-label">Tipo Usuario:*</label>

                    <div class="col-sm-7">
                        <select name="tipousuario_id" class="form-control" @change="changeTipousuario($event)" id="tipousuario_id2" required >

                            @foreach ($tipousuario as $t_user)
                                <option value="{{ $t_user->id }}">{{$t_user->tipousuario }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label">Nombre de Usuario*</label>
                    <div class="col-sm-7">
                        <input type="text" required parsley-type="text"  @keyup="changeUsername($event)" class="form-control" id="username2" name="username"   >
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Contrasena*</label>
                    <div class="col-sm-7">
                        <input id="password2" type="password" data-parsley-minlength="6" @keyup="changePassword($event)" v-bind="{required}" name="password"  class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation"class="col-sm-4 control-label">Confirmar Contrasena*</label>
                    <div class="col-sm-7">
                        <input data-parsley-equalto="#password2"    v-bind="{required}" type="password" @keyup="changeRepassword($event)"  class="form-control" id="password_confirmation">
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

                <button type="submit" v-if="activando2" id="username_actualizar"  class="btn btn-primary waves-effect waves-light">
                    Actualizar
                </button>
            </div>
          </form>
        </div>
    </div>
</div>