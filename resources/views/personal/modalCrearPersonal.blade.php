<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando Personal: @{{ nombre }} @{{apellidoPat}} @{{apellidoMat}}</h4>

            </div>
            <form id="form_registrar" class="form-horizontal"  data-parsley-validate novalidate>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="nombre" class="col-sm-4 control-label">Nombres*</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="nombre" v-model="nombre" name="nombre"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellidoMat" class="col-sm-4 control-label">Apellido Paterno*</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="apellidoPat" name="apellidoPat" v-model="apellidoPat" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellidoPat" class="col-sm-4 control-label">Apellido Materno*</label>
                        <div class="col-sm-7">
                            <input type="text"  required class="form-control" id="apellidoMat" name="apellidoMat" v-model="apellidoMat" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="area_id" class="col-sm-4 control-label">Area:*</label>

                        <div class="col-sm-7">
                            <select name="area_id" class="form-control" v-model="area" id="area_id" required >

                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{$area->area }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="user_id" class="col-sm-4 control-label">Usuario:*</label>
                        <div class="col-sm-7">
                            <select name="user_id" class="form-control" v-model="usuario" id="user_id" required >
                                @foreach ($usuarios as $user)
                                    <option value="{{ $user->id }}">{{$user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email*</label>
                        <div class="col-sm-7">
                            <input type="email" required parsley-type="email" v-model="email" class="form-control" id="email" name="email"  >
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