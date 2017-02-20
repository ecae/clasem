<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando al usuario :@{{ nombreusuario }}</h4>

            </div>
            <form id="form_registrar" class="form-horizontal"  data-parsley-validate novalidate autocomplete="off">
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="tipousuario" class="col-sm-4 control-label">Tipo Usuario:*</label>

                        <div class="col-sm-7">
                            <select name="tipousuario_id" class="form-control" v-model.lazy="tipo_user" id="tipousuario_id" required >

                                @foreach ($tipousuario as $t_user)
                                    <option value="{{ $t_user->id }}">{{$t_user->tipousuario }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Nombre de Usuario*</label>
                        <div class="col-sm-7">
                            <input type="text" id="username" required  data-parsley-minlength="6" class="form-control" v-model="nombreusuario" name="username" >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Contrasena*</label>
                        <div class="col-sm-7">
                            <input id="password" type="password" data-parsley-minlength="6" v-model.lazy="contra" name="password"  required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation"class="col-sm-4 control-label">Confirmar Contrasena*</label>
                        <div class="col-sm-7">
                            <input data-parsley-equalto="#password" v-model.lazy="confircontra"  type="password" required  class="form-control" id="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado:*</label>
                        <div class="col-sm-7">
                            <select name="estado" class="form-control" v-model.lazy="estado" id="estado" required>
                                <option value="1">Activo</option>
                                <option value="0">Suspendido</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" v-on:click="cancelarCrear" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activando" id="username_register"  class="btn btn-primary waves-effect waves-light">
                        Registrar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>
